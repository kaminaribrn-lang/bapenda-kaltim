<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Menu;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // ── 1. SEED WEBSITES ─────────────────────────────────────
        $websites = [
            ['name' => 'Bapenda Pusat',                'slug' => 'utama',                  'is_main' => true,  'status' => true],
            ['name' => 'UPTD Samarinda',              'slug' => 'samarinda',              'is_main' => false, 'status' => true],
            ['name' => 'UPTD Balikpapan',             'slug' => 'balikpapan',             'is_main' => false, 'status' => true],
            ['name' => 'UPTD Bontang',                'slug' => 'bontang',                'is_main' => false, 'status' => true],
            ['name' => 'UPTD Paser',                  'slug' => 'paser',                  'is_main' => false, 'status' => true],
            ['name' => 'UPTD Kutai Kartanegara',      'slug' => 'kukar',                  'is_main' => false, 'status' => true],
            ['name' => 'UPTD Kutai Timur',            'slug' => 'kutim',                  'is_main' => false, 'status' => true],
            ['name' => 'UPTD Mahakam Ulu',            'slug' => 'mahulu',                 'is_main' => false, 'status' => true],
            ['name' => 'UPTD Kutai Barat',            'slug' => 'kubar',                  'is_main' => false, 'status' => true],
            ['name' => 'UPTD Penajam Paser Utara',    'slug' => 'ppu',                    'is_main' => false, 'status' => true],
            ['name' => 'UPTD Berau',                 'slug' => 'berau',                 'is_main' => false, 'status' => true],
        ];

        Website::where('slug', '-')->delete();
        User::whereIn('email', ['admin--@bapenda.go.id', 'admin-@bapenda.go.id'])->delete();
        User::where('name', 'Admin -')->delete();

        foreach ($websites as $data) {
            Website::updateOrCreate(['slug' => $data['slug']], $data);
        }

        foreach (Website::all() as $website) {
            $this->seedDefaultWebsiteMenus($website);
        }

        $websiteUtama = Website::where('slug', 'utama')->first();

        // ── 2. SEED SUPER ADMIN ──────────────────────────────────
        if (! User::where('email', 'superadmin@bapenda.go.id')->exists()) {
            User::create([
                'website_id' => null,
                'name'       => 'Super Admin',
                'username'   => 'superadmin',
                'email'      => 'superadmin@bapenda.go.id',
                'password'   => bcrypt('password'),
                'role'       => UserRole::SuperAdmin,
            ]);
        }

        // ── 3. SEED ADMIN PER WEBSITE ─────────────────────────────
        $adminWebsites = Website::all();
        foreach ($adminWebsites as $website) {
            $email = $website->slug === 'utama'
                ? 'admin@bapenda.go.id'
                : 'admin-' . $website->slug . '@bapenda.go.id';

            $username = $website->slug === 'utama'
                ? 'admin-utama'
                : 'admin-' . $website->slug;

            if (! User::where('email', $email)->exists()) {
                User::create([
                    'website_id' => $website->id,
                    'name'       => $website->slug === 'utama'
                        ? 'Admin Bapenda Pusat'
                        : 'Admin ' . $website->name,
                    'username'   => $username,
                    'email'      => $email,
                    'password'   => bcrypt('password'),
                    'role'       => UserRole::Admin,
                ]);
            }
        }

        // ── 4. SEED WEBSITE IDENTITIES ───────────────────────────
        foreach (Website::all() as $ws) {
            \App\Models\WebsiteIdentity::updateOrCreate(
                ['website_id' => $ws->id],
                [
                    'name' => $ws->name,
                    'description' => 'Portal Resmi ' . $ws->name,
                    'email' => strtolower(str_replace(' ', '', $ws->name)) . '@bapenda.go.id',
                    'phone' => '0541-123456',
                    'address' => 'Jl. Kesuma Bangsa No. 1, ' . ($ws->slug === 'utama' ? 'Samarinda' : ucfirst($ws->slug)),
                    'userway_account_id' => 'n3T9RkU4t7',
                ]
            );
        }

        Schema::enableForeignKeyConstraints();

        $this->command->info('✅ Websites, menus, & users berhasil di-seed!');
        $this->command->table(
            ['ID', 'Nama Website', 'Slug', 'Utama'],
            Website::all(['id', 'name', 'slug', 'is_main'])->toArray()
        );
    }

    private function seedDefaultWebsiteMenus(Website $website): void
    {
        $menus = [
            [
                'name' => 'Beranda',
                'link' => 'route:portal.beranda',
                'slug' => 'beranda',
                'active_pattern' => 'portal.beranda',
                'svg_icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'order' => 10,
                'children' => [],
            ],
            [
                'name' => 'Profil',
                'link' => null,
                'slug' => 'profil',
                'active_pattern' => '*/profil*',
                'svg_icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'order' => 20,
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
                    ['name' => 'Kabupaten Mahakam Ulu', 'link' => '/mahulu', 'order' => 100],
                ],
            ],
            [
                'name' => 'Data',
                'link' => null,
                'slug' => 'data',
                'active_pattern' => '*/data*',
                'svg_icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
                'order' => 40,
                'children' => [
                    ['name' => 'Penerimaan Retribusi', 'link' => 'route:portal.data.retribusi-daerah', 'order' => 10],
                    ['name' => 'Pendapatan Daerah', 'link' => 'route:portal.data.pendapatan-daerah', 'order' => 20],
                ],
            ],
            [
                'name' => 'Produk Hukum',
                'link' => null,
                'slug' => 'produk-hukum',
                'active_pattern' => '*/dokumen*?kategori=peraturan-gubernur,*/dokumen*?kategori=sk-gubernur,*/dokumen*?kategori=peraturan-daerah,*/dokumen*?kategori=uu-perpres-pmk',
                'svg_icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3',
                'order' => 50,
                'children' => [
                    ['name' => 'Peraturan Gubernur', 'link' => 'route:portal.dokumen.index?kategori=peraturan-gubernur', 'order' => 10],
                    ['name' => 'SK Gubernur', 'link' => 'route:portal.dokumen.index?kategori=sk-gubernur', 'order' => 20],
                    ['name' => 'Peraturan Daerah', 'link' => 'route:portal.dokumen.index?kategori=peraturan-daerah', 'order' => 30],
                    ['name' => 'UU/PERPRES/PMK', 'link' => 'route:portal.dokumen.index?kategori=uu-perpres-pmk', 'order' => 40],
                ],
            ],
            [
                'name' => 'Laporan Berkala',
                'link' => null,
                'slug' => 'laporan',
                'active_pattern' => '*/dokumen*?kategori=rencana-strategis,*/dokumen*?kategori=rencana-kerja,*/dokumen*?kategori=perjanjian-kinerja,*/dokumen*?kategori=indikator-kinerja-utama',
                'svg_icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'order' => 60,
                'children' => [
                    ['name' => 'Rencana Strategis', 'link' => 'route:portal.dokumen.index?kategori=rencana-strategis', 'order' => 10],
                    ['name' => 'Rencana Kerja', 'link' => 'route:portal.dokumen.index?kategori=rencana-kerja', 'order' => 20],
                    ['name' => 'Perjanjian Kinerja', 'link' => 'route:portal.dokumen.index?kategori=perjanjian-kinerja', 'order' => 30],
                    ['name' => 'Indikator Kinerja Utama', 'link' => 'route:portal.dokumen.index?kategori=indikator-kinerja-utama', 'order' => 40],
                ],
            ],
            [
                'name' => 'Informasi',
                'link' => null,
                'slug' => 'informasi',
                'active_pattern' => '*/berita*,*/galeri*,*/agenda-kerja*',
                'svg_icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'order' => 70,
                'children' => [
                    ['name' => 'Berita & Artikel', 'link' => 'route:portal.berita.index', 'order' => 10],
                    ['name' => 'Galeri Kegiatan', 'link' => 'route:portal.galeri.index', 'order' => 20],
                    ['name' => 'Agenda Kerja', 'link' => 'route:portal.informasi.agenda-kerja', 'order' => 30],
                ],
            ],
            [
                'name' => 'Inovasi',
                'link' => 'route:portal.informasi.inovasi',
                'slug' => 'inovasi',
                'active_pattern' => '*/inovasi*',
                'svg_icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                'order' => 80,
                'children' => [],
            ],
            [
                'name' => 'PPID',
                'link' => 'route:portal.ppid.index',
                'slug' => 'ppid',
                'active_pattern' => '*/ppid*',
                'svg_icon' => null,
                'css_variant' => 'danger',
                'order' => 90,
                'children' => [],
            ],
            [
                'name' => 'WBS',
                'link' => 'route:portal.wbs.index',
                'slug' => 'wbs',
                'active_pattern' => '*/wbs*',
                'svg_icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                'order' => 100,
                'children' => [],
            ],
            [
                'name' => 'Portal',
                'link' => '/',
                'slug' => 'portal',
                'active_pattern' => null,
                'svg_icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
                'order' => 110,
                'children' => [],
            ],
        ];

        foreach ($menus as $menuData) {
            $menu = Menu::withoutGlobalScopes()->updateOrCreate(
                [
                    'website_id' => $website->id,
                    'position' => 'website',
                    'name' => $menuData['name'],
                    'parent_id' => null,
                ],
                [
                    'link' => $menuData['link'],
                    'slug' => $menuData['slug'],
                    'active_pattern' => $menuData['active_pattern'] ?? null,
                    'svg_icon' => $menuData['svg_icon'] ?? null,
                    'css_variant' => $menuData['css_variant'] ?? null,
                    'position' => 'website',
                    'order' => $menuData['order'],
                    'status' => true,
                ]
            );

            foreach ($menuData['children'] as $childData) {
                Menu::withoutGlobalScopes()->updateOrCreate(
                    [
                        'website_id' => $website->id,
                        'position' => 'website',
                        'name' => $childData['name'],
                        'parent_id' => $menu->id,
                    ],
                    [
                        'link' => $childData['link'],
                        'slug' => $childData['slug'] ?? Str::slug($childData['name']),
                        'template' => $childData['template'] ?? null,
                        'position' => 'website',
                        'order' => $childData['order'],
                        'status' => true,
                    ]
                );
            }
        }
    }
}
