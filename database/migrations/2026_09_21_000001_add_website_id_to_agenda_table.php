<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('agenda')) {
            return;
        }

        if (! Schema::hasColumn('agenda', 'website_id')) {
            Schema::table('agenda', function (Blueprint $table) {
                $table->foreignId('website_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('websites')
                    ->nullOnDelete();
            });
        }

        $websiteId = DB::table('websites')->value('id');

        if ($websiteId) {
            DB::table('agenda')
                ->whereNull('website_id')
                ->update(['website_id' => $websiteId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('agenda') || ! Schema::hasColumn('agenda', 'website_id')) {
            return;
        }

        Schema::table('agenda', function (Blueprint $table) {
            $table->dropForeign(['website_id']);
            $table->dropColumn('website_id');
        });
    }
};
