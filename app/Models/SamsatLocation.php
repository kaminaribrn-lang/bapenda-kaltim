<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;
use Illuminate\Database\Eloquent\Model;

class SamsatLocation extends Model
{
    use HasWebsiteScope;

    protected $fillable = [
        'website_id',
        'wilayah',
        'nama',
        'label_singkat',
        'alamat',
        'latitude',
        'longitude',
        'jenis_layanan',
        'whatsapp',
        'order',
        'status',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'order' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Kategori jenis layanan yang tersedia untuk dipilih di form admin.
     * Dipakai juga sebagai referensi warna legenda pada peta publik.
     */
    public static function jenisOptions(): array
    {
        return [
            'Induk' => 'Induk',
            'Penuh' => 'Penuh',
            'Pembantu' => 'Pembantu',
            'Payment Point' => 'Payment Point',
            'Drive Thru' => 'Drive Thru',
            'Keliling' => 'Keliling',
            'Mall / Gerai' => 'Mall / Gerai',
            'MPP' => 'MPP',
            'Pelita' => 'Pelita',
            'Paten' => 'Paten',
            'Lainnya' => 'Lainnya',
        ];
    }

    /**
     * Menebak jenis layanan dari teks nama layanan (dipakai saat impor CSV).
     */
    public static function guessJenisFromNama(string $nama): string
    {
        $rules = [
            'drive thru' => 'Drive Thru',
            'keliling' => 'Keliling',
            'terapung' => 'Keliling',
            'jelajah' => 'Keliling',
            'payment point' => 'Payment Point',
            'mall pelayanan publik' => 'MPP',
            'mpp' => 'MPP',
            'pelita' => 'Pelita',
            'paten' => 'Paten',
            'mall' => 'Mall / Gerai',
            'corner' => 'Mall / Gerai',
            'pembantu' => 'Pembantu',
            'penuh' => 'Penuh',
            'induk' => 'Induk',
        ];

        $needle = mb_strtolower($nama);

        foreach ($rules as $keyword => $label) {
            if (str_contains($needle, $keyword)) {
                return $label;
            }
        }

        return 'Lainnya';
    }

    /**
     * Wilayah Samsat yang dilayani tiap UPTD, dipetakan dari slug website/halaman UPTD.
     */
    public static function wilayahForUptd(string $slug): ?string
    {
        return [
            'samarinda' => 'Samarinda',
            'balikpapan' => 'Balikpapan',
            'bontang' => 'Bontang',
            'paser' => 'Paser',
            'berau' => 'Berau',
            'kukar' => 'Kutai Kartanegara',
            'kutai-kartanegara' => 'Kutai Kartanegara',
            'kutim' => 'Kutai Timur',
            'kutai-timur' => 'Kutai Timur',
            'kubar' => 'Kutai Barat',
            'kutai-barat' => 'Kutai Barat',
            'ppu' => 'Penajam Paser Utara',
            'penajam-paser-utara' => 'Penajam Paser Utara',
            'mahulu' => 'Mahakam Ulu',
        ][$slug] ?? null;
    }

    /**
     * Lokasi layanan Samsat milik satu UPTD saja: data wilayahnya di website utama
     * ditambah lokasi yang diinput sendiri oleh website UPTD tersebut.
     *
     * @param  array<int>  $uptdWebsiteIds
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
    public static function mapArraysForUptd(string $slug, array $uptdWebsiteIds = []): \Illuminate\Support\Collection
    {
        $wilayah = static::wilayahForUptd($slug);
        $mainWebsiteIds = Website::where('is_main', true)->pluck('id');

        return static::withoutGlobalScopes()
            ->where('status', true)
            ->where(function ($query) use ($wilayah, $mainWebsiteIds, $uptdWebsiteIds) {
                $query->whereIn('website_id', $uptdWebsiteIds);

                if (blank($wilayah)) {
                    return;
                }

                $query->orWhere(function ($query) use ($wilayah, $mainWebsiteIds) {
                    $query->whereIn('website_id', $mainWebsiteIds);

                    // Mahakam Ulu belum punya wilayah sendiri di data; lokasinya tercatat di Kutai Barat.
                    if ($wilayah === 'Mahakam Ulu') {
                        $query->where(function ($query) {
                            $query->where('wilayah', 'Mahakam Ulu')
                                ->orWhere('nama', 'like', '%Mahulu%')
                                ->orWhere('alamat', 'like', '%Mahakam Ulu%');
                        });

                        return;
                    }

                    $query->where('wilayah', $wilayah);
                });
            })
            ->orderBy('order')
            ->get()
            ->map(fn (SamsatLocation $location) => $location->toMapArray())
            ->values();
    }

    /**
     * Bentuk array siap pakai untuk peta publik (Leaflet + sidebar filter).
     */
    public function toMapArray(): array
    {
        return [
            'wilayah' => $this->wilayah,
            'nama' => $this->nama,
            'alamat' => $this->alamat ?? '',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'jenis' => $this->jenis_layanan ?: 'Lainnya',
            'wa' => $this->whatsapp ?? '',
        ];
    }
}
