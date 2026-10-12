<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('website_identities', function (Blueprint $table) {
            $table->string('hero_background')->nullable()->after('welcome_leader_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_identities', function (Blueprint $table) {
            $table->dropColumn('hero_background');
        });
    }
};
