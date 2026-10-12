<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $websites = DB::table('websites')->get();

        foreach ($websites as $website) {
            // Seed main menus
            $menus = [
                [
                    'name' => 'Beranda',
                    'link' => 'route:portal.beranda',
                    'slug' => 'beranda',
                    'active_pattern' => 'portal.beranda',
                    'svg_icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'position' => 'website',
                    'order' => 10,
                    'status' => 1,
                    'children' => []
                ],
                [
                    'name' => 'Profil',
                    'link' => null,
                    'slug' => 'profil',
                    'active_pattern' => '*/profil*',
                    'svg_icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'position' => 'website',
                    'order' => 20,
                    'status' => 1,
                    'children' => [
                        ['name' => 'Kepala Bapenda', 'link' => 'route:portal.profil.kepala-bapenda', 'order' => 10],
                        ['name' => 'Struktur Organisasi', 'link' => 'route:portal.profil.struktur-organisasi', 'order' => 20],
                        ['name' => 'UPTD Wilayah', 'link' => '#', 'order' => 5, 'template' => 'section_header'],
                        ['name' => 'Kota Samarinda', 'link' => '/samarinda', 'order' => 10],
                        ['name' => 'Kota Balikpapan', 'link' => '/balikpapan', 'order' => 20],
                        ['name' => 'Kota Bontang', 'link' => '/bontang', 'order' => 30],
                        ['name' => 'Kabupaten Kukar', 'link' => '/kukar', 'order' => 40],
                        ['name' => 'Kabupaten Kutim', 'link' => '/kutim', 'order' => 50],
                        ['name' => 'Kabupaten Kubar', 'link' => '/kubar', 'order' => 60],
                        ['name' => 'Kabupaten Berau', 'link' => '/berau', 'order' => 70],
                        ['name' => 'Kabupaten Paser', 'link' => '/paser', 'order' => 80],
                        ['name' => 'Kabupaten Penajam Paser Utara', 'link' => '/ppu', 'order' => 90],
                    ]
                ],
                [
                    'name' => 'Data',
                    'link' => null,
                    'slug' => 'data',
                    'active_pattern' => '*/data*',
                    'svg_icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
                    'position' => 'website',
                    'order' => 40,
                    'status' => 1,
                    'children' => [
                        ['name' => 'Penerimaan Retribusi', 'link' => 'route:portal.data.retribusi-daerah', 'order' => 10],
                        ['name' => 'Pendapatan Daerah', 'link' => 'route:portal.data.pendapatan-daerah', 'order' => 20],
                    ]
                ],
                [
                    'name' => 'Produk Hukum',
                    'link' => null,
                    'slug' => 'produk-hukum',
                    'active_pattern' => '*/dokumen*?kategori=peraturan-gubernur,*/dokumen*?kategori=sk-gubernur,*/dokumen*?kategori=peraturan-daerah,*/dokumen*?kategori=uu-perpres-pmk',
                    'svg_icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3',
                    'position' => 'website',
                    'order' => 50,
                    'status' => 1,
                    'children' => [
                        ['name' => 'Peraturan Gubernur', 'link' => 'route:portal.dokumen.index?kategori=peraturan-gubernur', 'order' => 10],
                        ['name' => 'SK Gubernur', 'link' => 'route:portal.dokumen.index?kategori=sk-gubernur', 'order' => 20],
                        ['name' => 'Peraturan Daerah', 'link' => 'route:portal.dokumen.index?kategori=peraturan-daerah', 'order' => 30],
                        ['name' => 'UU/PERPRES/PMK', 'link' => 'route:portal.dokumen.index?kategori=uu-perpres-pmk', 'order' => 40],
                    ]
                ],
                [
                    'name' => 'Laporan Berkala',
                    'link' => null,
                    'slug' => 'laporan',
                    'active_pattern' => '*/dokumen*?kategori=rencana-strategis,*/dokumen*?kategori=rencana-kerja,*/dokumen*?kategori=perjanjian-kinerja,*/dokumen*?kategori=indikator-kinerja-utama',
                    'svg_icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'position' => 'website',
                    'order' => 60,
                    'status' => 1,
                    'children' => [
                        ['name' => 'Rencana Strategis', 'link' => 'route:portal.dokumen.index?kategori=rencana-strategis', 'order' => 10],
                        ['name' => 'Rencana Strategis', 'link' => 'route:portal.dokumen.index?kategori=rencana-strategis', 'order' => 10],
                        ['name' => 'Rencana Kerja', 'link' => 'route:portal.dokumen.index?kategori=rencana-kerja', 'order' => 20],
                        ['name' => 'Perjanjian Kinerja', 'link' => 'route:portal.dokumen.index?kategori=perjanjian-kinerja', 'order' => 30],
                        ['name' => 'Indikator Kinerja Utama', 'link' => 'route:portal.dokumen.index?kategori=indikator-kinerja-utama', 'order' => 40],
                    ]
                ],
                [
                    'name' => 'Informasi',
                    'link' => null,
                    'slug' => 'informasi',
                    'active_pattern' => '*/berita*,*/galeri*,*/agenda-kerja*',
                    'svg_icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'position' => 'website',
                    'order' => 70,
                    'status' => 1,
                    'children' => [
                        ['name' => 'Berita & Artikel', 'link' => 'route:portal.berita.index', 'order' => 10],
                        ['name' => 'Galeri Kegiatan', 'link' => 'route:portal.galeri.index', 'order' => 20],
                        ['name' => 'Agenda Kerja', 'link' => 'route:portal.informasi.agenda-kerja', 'order' => 30],
                    ]
                ],
                [
                    'name' => 'Inovasi',
                    'link' => 'route:portal.informasi.inovasi',
                    'slug' => 'inovasi',
                    'active_pattern' => '*/inovasi*',
                    'svg_icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                    'position' => 'website',
                    'order' => 80,
                    'status' => 1,
                    'children' => []
                ],
                [
                    'name' => 'PPID',
                    'link' => 'route:portal.ppid.index',
                    'slug' => 'ppid',
                    'active_pattern' => '*/ppid*',
                    'svg_icon' => null,
                    'css_variant' => 'danger',
                    'position' => 'website',
                    'order' => 90,
                    'status' => 1,
                    'children' => []
                ],
                [
                    'name' => 'WBS',
                    'link' => 'route:portal.wbs.index',
                    'slug' => 'wbs',
                    'active_pattern' => '*/wbs*',
                    'svg_icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                    'position' => 'website',
                    'order' => 100,
                    'status' => 1,
                    'children' => []
                ],
                [
                    'name' => 'Portal',
                    'link' => '/',
                    'slug' => 'portal',
                    'active_pattern' => null,
                    'svg_icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
                    'position' => 'website',
                    'order' => 110,
                    'status' => 1,
                    'children' => []
                ]
            ];

            foreach ($menus as $m) {
                // Check if main menu already exists
                $menuId = DB::table('menus')->where([
                    'website_id' => $website->id,
                    'position' => 'website',
                    'name' => $m['name'],
                    'parent_id' => null
                ])->value('id');

                if (!$menuId) {
                    $menuId = DB::table('menus')->insertGetId([
                        'website_id' => $website->id,
                        'name' => $m['name'],
                        'link' => $m['link'],
                        'slug' => $m['slug'],
                        'active_pattern' => $m['active_pattern'],
                        'svg_icon' => $m['svg_icon'],
                        'css_variant' => $m['css_variant'] ?? null,
                        'position' => $m['position'],
                        'order' => $m['order'],
                        'status' => $m['status'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Update dynamic attributes if already exists
                    DB::table('menus')->where('id', $menuId)->update([
                        'active_pattern' => $m['active_pattern'],
                        'svg_icon' => $m['svg_icon'],
                        'css_variant' => $m['css_variant'] ?? null,
                        'updated_at' => now(),
                    ]);
                }

                // Seed children
                foreach ($m['children'] as $child) {
                    $childExists = DB::table('menus')->where([
                        'website_id' => $website->id,
                        'position' => 'website',
                        'name' => $child['name'],
                        'parent_id' => $menuId
                    ])->exists();

                    if (!$childExists) {
                        DB::table('menus')->insert([
                            'website_id' => $website->id,
                            'name' => $child['name'],
                            'link' => $child['link'],
                            'slug' => Str::slug($child['name']),
                            'template' => $child['template'] ?? null,
                            'parent_id' => $menuId,
                            'position' => 'website',
                            'order' => $child['order'],
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Simple deletion of website menus seeded
        DB::table('menus')->where('position', 'website')->delete();
    }
};
