<?php

use App\Models\SamsatLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Import data awal lokasi SAMSAT dari public/daftar-layanan.csv ke tabel
     * samsat_locations, khusus untuk website "utama" (Bapenda Pusat) — sumber
     * data untuk Peta Layanan Samsat di halaman /layanan.
     */
    public function up(): void
    {
        $csvPath = public_path('daftar-layanan.csv');

        if (! is_file($csvPath)) {
            return;
        }

        $website = DB::table('websites')->where('slug', 'utama')->first();
        if (! $website) {
            $website = DB::table('websites')->orderBy('id')->first();
        }
        if (! $website) {
            return;
        }

        // Jika sudah pernah diimpor sebelumnya, jangan duplikasi.
        $alreadyImported = DB::table('samsat_locations')->where('website_id', $website->id)->exists();
        if ($alreadyImported) {
            return;
        }

        $handle = fopen($csvPath, 'r');
        if ($handle === false) {
            return;
        }

        $header = fgetcsv($handle, 0, ';');
        if ($header === false) {
            fclose($handle);
            return;
        }
        $header = array_map(fn ($h) => trim((string) $h), $header);

        $idxWilayah = array_search('WILAYAH', $header, true);
        $idxNamaSamsat = array_search('NAMA SAMSAT', $header, true);
        $idxNamaLayanan = array_search('NAMA LAYANAN SAMSAT', $header, true);
        $idxAlamat = array_search('ALAMAT', $header, true);
        $idxLat = array_search('x', $header, true);
        $idxLng = array_search('y', $header, true);

        $rows = [];
        $order = 0;
        $now = now();

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            if (count(array_filter($row, fn ($v) => trim((string) $v) !== '')) === 0) {
                continue;
            }

            $nama = $idxNamaLayanan !== false ? trim((string) ($row[$idxNamaLayanan] ?? '')) : '';
            $namaSingkat = $idxNamaSamsat !== false ? trim((string) ($row[$idxNamaSamsat] ?? '')) : '';
            if ($nama === '') {
                $nama = $namaSingkat ?: 'Samsat';
            }

            $wilayah = $idxWilayah !== false ? trim((string) ($row[$idxWilayah] ?? '')) : '-';
            $alamat = $idxAlamat !== false ? trim((string) ($row[$idxAlamat] ?? '')) : '';

            $lat = $idxLat !== false ? $this->toFloatOrNull($row[$idxLat] ?? null) : null;
            $lng = $idxLng !== false ? $this->toFloatOrNull($row[$idxLng] ?? null) : null;

            if (! $this->isValidKaltimCoord($lat, $lng)) {
                $lat = null;
                $lng = null;
            }

            $rows[] = [
                'website_id' => $website->id,
                'wilayah' => $wilayah ?: '-',
                'nama' => $nama,
                'label_singkat' => $namaSingkat ?: null,
                'alamat' => $alamat ?: null,
                'latitude' => $lat,
                'longitude' => $lng,
                'jenis_layanan' => SamsatLocation::guessJenisFromNama($nama),
                'whatsapp' => null,
                'order' => $order++,
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        fclose($handle);

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('samsat_locations')->insert($chunk);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('samsat_locations')->truncate();
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
};
