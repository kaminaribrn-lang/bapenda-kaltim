<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasWebsiteScope;

    protected $fillable = [
        'website_id',
        'type',
        'caption',
        'slug',
        'link',
        'tags',
        'description',
        'read',
        'featured',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status'   => 'integer',
    ];

    // Accessor: `title` → pakai `caption` di tabel
    public function getTitleAttribute(): ?string
    {
        return $this->caption;
    }

    // Accessor: `image` → file via morphOne
    public function getImageAttribute(): ?string
    {
        return $this->file?->storage_path ?? $this->file?->path;
    }

    public function file(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(\App\Models\File::class, 'fileable');
    }

    // Scope is_active = status aktif (1)
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
}
