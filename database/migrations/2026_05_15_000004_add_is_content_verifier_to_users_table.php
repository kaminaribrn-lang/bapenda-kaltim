<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'is_content_verifier')) {
                $table->boolean('is_content_verifier')
                    ->default(false)
                    ->after('role');
            }
        });

        $hasVerifier = DB::table('users')
            ->where('is_content_verifier', true)
            ->exists();

        if (! $hasVerifier) {
            $candidate = DB::table('users')
                ->select('id')
                ->orderByRaw("CASE WHEN role = 'super_admin' THEN 0 ELSE 1 END")
                ->orderBy('id')
                ->first();

            if ($candidate) {
                DB::table('users')
                    ->where('id', $candidate->id)
                    ->update(['is_content_verifier' => true]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_content_verifier')) {
                $table->dropColumn('is_content_verifier');
            }
        });
    }
};
