<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * WebsiteScope — Global Scope untuk isolasi data per website.
 *
 * Cara kerja:
 * - SuperAdmin (website_id = NULL) → tidak difilter, lihat semua data
 * - Admin (website_id = X)         → otomatis filter WHERE website_id = X
 */
class WebsiteScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        // Hanya terapkan scope jika ada user yang sedang login
        if (! auth()->check()) {
            return;
        }

        $user = auth()->user();
        $tenant = class_exists('\Filament\Facades\Filament')
            ? \Filament\Facades\Filament::getTenant()
            : null;

        if ($tenant && $user->canAccessTenant($tenant)) {
            $builder->where($model->getTable() . '.website_id', $tenant->id);
            return;
        }

        if ($user->isSuperAdmin()) {
            return;
        }

        if ($user->website_id) {
            $builder->where($model->getTable() . '.website_id', $user->website_id);
            return;
        }

        $builder->whereRaw('1 = 0');
    }
}
