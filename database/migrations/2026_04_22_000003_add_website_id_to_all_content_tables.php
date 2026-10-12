<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar semua tabel konten yang perlu ditambahkan website_id.
     * Format: 'nama_tabel' => 'posisi_kolom_after'
     */
    private array $tables = [
        'posts'            => 'id',
        'post_categories'  => 'id',
        'files'            => 'id',
        'galleries'        => 'id',
        'sliders'          => 'id',
        'slider_portals'   => 'id',
        'menus'            => 'id',
        'dynamic_pages'    => 'id',
        'agenda'           => 'id',
        'services'         => 'id',
        'widgets'          => 'id',
        'ppids'            => 'id',
        'ppid_items'       => 'id',
        'ppid_abouts'      => 'id',
        'ppid_requests'    => 'id',
        'pengaduans'       => 'id',
        'wbs_abouts'       => 'id',
        'file_sharings'    => 'id',
        'leader_profiles'  => 'id',
        'website_identities' => 'id',
        'portal_settings'  => 'id',
        'disqus_settings'  => 'id',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName => $afterColumn) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'website_id')) {
                Schema::table($tableName, function (Blueprint $table) use ($afterColumn) {
                    $table->foreignId('website_id')
                        ->after($afterColumn)
                        ->constrained('websites')
                        ->cascadeOnDelete();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (array_keys($this->tables) as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'website_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropForeign(['website_id']);
                    $table->dropColumn('website_id');
                });
            }
        }
    }
};
