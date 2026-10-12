<?php

namespace App\Filament\Resources\SamsatLocations\Pages;

use App\Filament\Resources\SamsatLocations\SamsatLocationResource;
use App\Models\SamsatLocation;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;

class ListSamsatLocations extends ListRecords
{
    protected static string $resource = SamsatLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('importCsv')
                ->label(__('Impor CSV'))
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->schema([
                    FileUpload::make('file')
                        ->label(__('File CSV'))
                        ->helperText(__('Format kolom (pisahkan dengan ";"): WILAYAH, NAMA SAMSAT, NAMA LAYANAN SAMSAT, ALAMAT, x (latitude), y (longitude).'))
                        ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                        ->required()
                        ->disk('local')
                        ->directory('tmp-imports')
                        ->visibility('private'),

                    Toggle::make('replace')
                        ->label(__('Hapus semua data lama sebelum impor'))
                        ->helperText(__('Jika dimatikan, data CSV akan ditambahkan sebagai lokasi baru.'))
                        ->default(false),
                ])
                ->action(function (array $data) {
                    $count = $this->importCsv($data['file'], (bool) ($data['replace'] ?? false));

                    Notification::make()
                        ->title(__(':count lokasi berhasil diimpor.', ['count' => $count]))
                        ->success()
                        ->send();
                }),

            CreateAction::make()
                ->label(__('Tambah Lokasi')),
        ];
    }

    private function importCsv(string $storedPath, bool $replace): int
    {
        $fullPath = Storage::disk('local')->path($storedPath);

        if (! is_file($fullPath)) {
            Notification::make()->title(__('File tidak ditemukan.'))->danger()->send();
            return 0;
        }

        $delimiter = $this->detectDelimiter($fullPath);

        $handle = fopen($fullPath, 'r');
        if ($handle === false) {
            return 0;
        }

        $header = fgetcsv($handle, 0, $delimiter);
        if ($header === false) {
            fclose($handle);
            return 0;
        }
        $header = array_map(fn ($h) => trim((string) $h), $header);

        $find = function (array $keywords) use ($header) {
            foreach ($header as $i => $h) {
                foreach ($keywords as $kw) {
                    if (str_contains(mb_strtolower($h), $kw)) {
                        return $i;
                    }
                }
            }
            return null;
        };

        $idxWilayah = $find(['wilayah']);
        $idxNamaSamsat = $find(['nama samsat', 'nama_samsat']);
        $idxNamaLayanan = $find(['nama layanan', 'nama_layanan']);
        $idxAlamat = $find(['alamat']);
        $idxLat = $find(['latitude', 'lat', ' x']) ?? $find(['x']);
        $idxLng = $find(['longitude', 'lng', 'bujur']) ?? $find(['y']);
        $idxJenis = $find(['jenis']);
        $idxWa = $find(['whatsapp', 'wa']);

        $tenantId = \Filament\Facades\Filament::getTenant()?->id;

        if ($replace) {
            SamsatLocation::query()->when($tenantId, fn ($q) => $q->where('website_id', $tenantId))->delete();
        }

        $order = (int) SamsatLocation::query()->max('order') + 1;
        $now = now();
        $rows = [];

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (count(array_filter($row, fn ($v) => trim((string) $v) !== '')) === 0) {
                continue;
            }

            $nama = $idxNamaLayanan !== null ? trim((string) ($row[$idxNamaLayanan] ?? '')) : '';
            $namaSingkat = $idxNamaSamsat !== null ? trim((string) ($row[$idxNamaSamsat] ?? '')) : '';
            if ($nama === '') {
                $nama = $namaSingkat ?: 'Samsat';
            }

            $lat = $idxLat !== null ? $this->toFloatOrNull($row[$idxLat] ?? null) : null;
            $lng = $idxLng !== null ? $this->toFloatOrNull($row[$idxLng] ?? null) : null;

            if (! $this->isValidKaltimCoord($lat, $lng)) {
                $lat = null;
                $lng = null;
            }

            $jenis = $idxJenis !== null ? trim((string) ($row[$idxJenis] ?? '')) : '';
            if ($jenis === '') {
                $jenis = SamsatLocation::guessJenisFromNama($nama);
            }

            $rows[] = [
                'website_id' => $tenantId,
                'wilayah' => $idxWilayah !== null ? (trim((string) ($row[$idxWilayah] ?? '')) ?: '-') : '-',
                'nama' => $nama,
                'label_singkat' => $namaSingkat ?: null,
                'alamat' => $idxAlamat !== null ? (trim((string) ($row[$idxAlamat] ?? '')) ?: null) : null,
                'latitude' => $lat,
                'longitude' => $lng,
                'jenis_layanan' => $jenis,
                'whatsapp' => $idxWa !== null ? (trim((string) ($row[$idxWa] ?? '')) ?: null) : null,
                'order' => $order++,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        fclose($handle);
        Storage::disk('local')->delete($storedPath);

        foreach (array_chunk($rows, 100) as $chunk) {
            SamsatLocation::query()->insert($chunk);
        }

        return count($rows);
    }

    private function detectDelimiter(string $path): string
    {
        $handle = fopen($path, 'r');
        $firstLine = $handle ? fgets($handle) : '';
        if ($handle) {
            fclose($handle);
        }

        $semicolons = substr_count($firstLine ?: '', ';');
        $commas = substr_count($firstLine ?: '', ',');

        return $semicolons >= $commas ? ';' : ',';
    }

    private function toFloatOrNull(mixed $value): ?float
    {
        $value = trim((string) $value);
        if ($value === '' || ! is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }

    private function isValidKaltimCoord(?float $lat, ?float $lng): bool
    {
        if ($lat === null || $lng === null) {
            return false;
        }

        return $lat >= -6 && $lat <= 6 && $lng >= 108 && $lng <= 126;
    }
}
