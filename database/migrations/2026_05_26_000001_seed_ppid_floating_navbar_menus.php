<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Seed default PPID-only floating navbar menus (position = 'ppid') so the
     * PPID micro-site immediately shows a distinct navigation from the main
     * website menu, without waiting for manual admin configuration.
     */
    public function up(): void
    {
        $websites = DB::table('websites')->get();

        $menus = [
            [
                'name' => 'Beranda PPID',
                'link' => 'route:portal.ppid.index',
                'slug' => 'ppid-beranda',
                'active_pattern' => 'portal.ppid.index',
                'svg_icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'order' => 10,
            ],
            [
                'name' => 'Daftar Informasi',
                'link' => 'route:portal.ppid.index#daftar-informasi-publik',
                'slug' => 'ppid-daftar-informasi',
                'active_pattern' => null,
                'svg_icon' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2',
                'order' => 20,
            ],
            [
                'name' => 'Ajukan Permohonan',
                'link' => 'route:portal.ppid.permohonan',
                'slug' => 'ppid-permohonan',
                'active_pattern' => 'portal.ppid.permohonan',
                'svg_icon' => 'M12 4v16m8-8H4',
                'order' => 30,
            ],
            [
                'name' => 'Tata Cara Keberatan',
                'link' => 'route:portal.ppid.index#permohonan-keberatan',
                'slug' => 'ppid-keberatan',
                'active_pattern' => null,
                'svg_icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                'order' => 40,
            ],
            [
                'name' => 'Situs Utama',
                'link' => 'route:portal.beranda',
                'slug' => 'ppid-situs-utama',
                'active_pattern' => null,
                'svg_icon' => 'M10 19l-7-7m0 0l7-7m-7 7h18',
                'css_variant' => 'danger',
                'order' => 50,
            ],
        ];

        foreach ($websites as $website) {
            foreach ($menus as $m) {
                $exists = DB::table('menus')->where([
                    'website_id' => $website->id,
                    'position' => 'ppid',
                    'name' => $m['name'],
                    'parent_id' => null,
                ])->exists();

                if ($exists) {
                    continue;
                }

                DB::table('menus')->insert([
                    'website_id' => $website->id,
                    'name' => $m['name'],
                    'link' => $m['link'],
                    'slug' => $m['slug'],
                    'active_pattern' => $m['active_pattern'],
                    'svg_icon' => $m['svg_icon'],
                    'css_variant' => $m['css_variant'] ?? null,
                    'position' => 'ppid',
                    'order' => $m['order'],
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('menus')->where('position', 'ppid')->delete();
    }
};
