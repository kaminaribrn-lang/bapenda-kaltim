<?php

namespace App\Traits;

use App\Models\Website;
use App\Scopes\WebsiteScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * HasWebsiteScope — Trait untuk model konten.
 *
 * Cara pakai: tambahkan `use HasWebsiteScope;` di setiap model konten.
 * Trait ini akan:
 * 1. Mendaftarkan WebsiteScope (filter otomatis by website_id)
 * 2. Mengisi website_id otomatis saat create dari user yang login
 * 3. Menyediakan relasi belongsTo Website
 */
trait HasWebsiteScope
{
    public static function bootHasWebsiteScope(): void
    {
        // 1. Daftarkan Global Scope
        static::addGlobalScope(new WebsiteScope());

        // 2. Auto-isi website_id saat creating jika user login sebagai Admin
        static::creating(function ($model) {
            // Priority 1: Current Filament Tenant
            if (class_exists('\Filament\Facades\Filament') && $tenant = \Filament\Facades\Filament::getTenant()) {
                if (empty($model->website_id)) {
                    $model->website_id = $tenant->id;
                }
                return;
            }

            // Priority 2: User's website_id (for non-SuperAdmin)
            if (
                auth()->check() &&
                empty($model->website_id) &&
                auth()->user()->website_id
            ) {
                $model->website_id = auth()->user()->website_id;
            }
        });
    }

    // ── Relasi ke Website ─────────────────────────────────────────
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
