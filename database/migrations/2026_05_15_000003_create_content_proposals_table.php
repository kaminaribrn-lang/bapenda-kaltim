<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites')->cascadeOnDelete();
            $table->foreignId('proposer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('verifier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('planned_upload_at');
            $table->unsignedInteger('upload_count')->default(1);
            $table->json('upload_channels');
            $table->string('target_link')->nullable();

            $table->string('status')->default('submitted');
            $table->boolean('is_publishable')->nullable();
            $table->text('verifier_notes')->nullable();
            $table->text('approval_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index(['website_id', 'status']);
            $table->index(['proposer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_proposals');
    }
};
