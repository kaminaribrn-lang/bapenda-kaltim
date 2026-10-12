<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Scopes\WebsiteScope;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements FilamentUser, HasName, HasTenants
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->username)) {
                $user->username = \Illuminate\Support\Str::slug($user->name ?? explode('@', $user->email)[0]);
            }
        });
    }

    protected $fillable = [
        'website_id',
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_content_verifier',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role'      => UserRole::class,
            'is_content_verifier' => 'boolean',
        ];
    }

    // ── Role Helpers ─────────────────────────────────────────────
    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SuperAdmin;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isContentVerifier(): bool
    {
        return (bool) $this->is_content_verifier;
    }

    public function isMainWebsiteAdmin(): bool
    {
        return $this->isAdmin() && (bool) $this->website?->is_main;
    }

    public function canApproveContentProposal(): bool
    {
        return $this->isSuperAdmin() || $this->isMainWebsiteAdmin();
    }

    // ── Relasi ───────────────────────────────────────────────────
    public function website(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function proposedContentProposals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContentProposal::class, 'proposer_id');
    }

    public function verifiedContentProposals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContentProposal::class, 'verifier_id');
    }

    public function approvedContentProposals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContentProposal::class, 'approved_by');
    }

    // ── Filament ─────────────────────────────────────────────────
    public function canAccessPanel(Panel $panel): bool
    {
        // Sesuaikan logika izin akses di sini (contoh: izinkan SuperAdmin dan Admin)
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    public function getFilamentName(): string
    {
        $role = $this->role?->label() ?? 'User';
        return "{$this->name} ({$role})";
    }

    // ── Filament Multi-Tenancy ───────────────────────────────────
    public function getTenants(Panel $panel): Collection
    {
        if ($this->isSuperAdmin()) {
            return Website::all();
        }

        if (! $this->isAdmin() || ! $this->website_id) {
            return Website::query()->whereRaw('1 = 0')->get();
        }

        return Website::whereKey($this->website_id)->get();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        if (! $tenant instanceof Website) {
            return false;
        }

        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->isAdmin()
            && $this->website_id !== null
            && (int) $this->website_id === (int) $tenant->getKey();
    }
}