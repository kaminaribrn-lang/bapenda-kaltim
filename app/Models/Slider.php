<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasWebsiteScope;
    use HasFactory;

    protected $fillable = [
        'website_id',
        'caption',
        'description',
        'link',
        'status',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'status' => 'integer',
    ];

    public function file(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
