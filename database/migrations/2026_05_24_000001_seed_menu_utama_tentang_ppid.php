<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan id website utama = 1, sesuaikan jika berbeda
        DB::table('menus')->insert([
            [
                'website_id' => 1,
                'name' => 'Tentang PPID',
                'slug' => 'tentang-ppid',
                'link' => '/tentang-ppid',
                'template' => null,
                'icon' => null,
                'logo' => null,
                'parent_id' => null,
                'position' => 'main',
                'order' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('menus')->where('website_id', 1)->where('slug', 'tentang-ppid')->delete();
    }
};
