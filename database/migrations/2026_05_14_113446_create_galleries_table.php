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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites')->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->string('caption');
            $table->string('slug');
            $table->string('link')->nullable();
            $table->text('tags')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('read')->default(0);
            $table->boolean('featured')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            
            $table->unique(['website_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
