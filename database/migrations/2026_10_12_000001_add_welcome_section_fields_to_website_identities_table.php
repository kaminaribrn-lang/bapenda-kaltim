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
            $table->text('welcome_content')->nullable()->after('welcome_subtitle');
            $table->string('welcome_photo')->nullable()->after('welcome_content');
            $table->string('welcome_leader_name')->nullable()->after('welcome_photo');
            $table->string('welcome_leader_position')->nullable()->after('welcome_leader_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_identities', function (Blueprint $table) {
            $table->dropColumn([
                'welcome_content',
                'welcome_photo',
                'welcome_leader_name',
                'welcome_leader_position',
            ]);
        });
    }
};
