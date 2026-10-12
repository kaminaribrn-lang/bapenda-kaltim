<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Sub-menu kabupaten pada menu "UPTD PPRD" sebelumnya mengarah ke halaman
     * daftar UPTD (portal.uptd.index#...), bukan ke halaman UPTD masing-masing.
     */
    private array $links = [
        'route:portal.uptd.index#kukar' => '/uptd/kutai-kartanegara',
        'route:portal.uptd.index#kutim' => '/uptd/kutai-timur',
        'route:portal.uptd.index#kubar' => '/uptd/kutai-barat',
        'route:portal.uptd.index#berau' => '/uptd/berau',
        'route:portal.uptd.index#paser' => '/uptd/paser',
        'route:portal.uptd.index#ppu' => '/uptd/penajam-paser-utara',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->links as $old => $new) {
            DB::table('menus')->where('link', $old)->update([
                'link' => $new,
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->links as $old => $new) {
            DB::table('menus')->where('link', $new)->update([
                'link' => $old,
                'updated_at' => now(),
            ]);
        }
    }
};
