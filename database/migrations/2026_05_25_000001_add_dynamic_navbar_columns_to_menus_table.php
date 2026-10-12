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
        Schema::table('menus', function (Blueprint $table) {
            $table->text('svg_icon')->nullable()->after('icon');
            $table->string('active_pattern')->nullable()->after('slug');
            $table->string('css_variant')->nullable()->after('position');
            $table->boolean('open_in_new_tab')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['svg_icon', 'active_pattern', 'css_variant', 'open_in_new_tab']);
        });
    }
};
