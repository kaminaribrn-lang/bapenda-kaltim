<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Website extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'domain',
        'is_main',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_main' => 'boolean',
            'status'  => 'boolean',
        ];
    }

    // ── Relasi ke Users ──────────────────────────────────────────
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // ── Relasi ke Konten ─────────────────────────────────────────
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function postCategories(): HasMany
    {
        return $this->hasMany(PostCategory::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function dynamicPages(): HasMany
    {
        return $this->hasMany(DynamicPage::class);
    }

    public function agenda(): HasMany
    {
        return $this->hasMany(Agenda::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function ppids(): HasMany
    {
        return $this->hasMany(Ppid::class);
    }

    public function ppidRequests(): HasMany
    {
        return $this->hasMany(PpidRequest::class);
    }

    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function fileSharings(): HasMany
    {
        return $this->hasMany(FileSharing::class);
    }

    public function leaderProfiles(): HasMany
    {
        return $this->hasMany(LeaderProfile::class);
    }

    public function contentProposals(): HasMany
    {
        return $this->hasMany(ContentProposal::class);
    }

    // ── Singleton (1-to-1) ───────────────────────────────────────
    public function identity(): HasOne
    {
        return $this->hasOne(WebsiteIdentity::class);
    }

    public function portalSetting(): HasOne
    {
        return $this->hasOne(PortalSetting::class);
    }

    public function disqusSetting(): HasOne
    {
        return $this->hasOne(DisqusSetting::class);
    }

    // ── Helper ───────────────────────────────────────────────────
    public static function getUploadDir(string $path): string
    {
        $tenant = class_exists('\Filament\Facades\Filament') ? \Filament\Facades\Filament::getTenant() : null;
        $slug = $tenant ? $tenant->slug : 'global';
        
        return $slug . '/' . $path;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
