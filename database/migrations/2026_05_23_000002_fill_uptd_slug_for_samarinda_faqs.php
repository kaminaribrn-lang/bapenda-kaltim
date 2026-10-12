<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Contoh: update semua FAQ milik website_id Samarinda (ganti sesuai id Samarinda di tabel websites)
        $samarindaWebsiteId = DB::table('websites')->where('slug', 'samarinda')->value('id');
        if ($samarindaWebsiteId) {
            DB::table('faqs')
                ->where('website_id', $samarindaWebsiteId)
                ->update(['uptd_slug' => 'samarinda']);
        }
    }

    public function down(): void
    {
        $samarindaWebsiteId = DB::table('websites')->where('slug', 'samarinda')->value('id');
        if ($samarindaWebsiteId) {
            DB::table('faqs')
                ->where('website_id', $samarindaWebsiteId)
                ->update(['uptd_slug' => null]);
        }
    }
};
