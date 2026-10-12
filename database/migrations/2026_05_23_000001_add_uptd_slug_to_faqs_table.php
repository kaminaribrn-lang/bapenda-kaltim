<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('uptd_slug')->nullable()->after('website_id');
            $table->index(['website_id', 'uptd_slug']);
        });
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex(['website_id', 'uptd_slug']);
            $table->dropColumn('uptd_slug');
        });
    }
};
