<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasWebsiteScope;
    protected $fillable = [
        'website_id',
        'status',
        'rss_url',
        'position',
        'width',
    ];

    protected $casts = [
        'status' => 'boolean',
        'width' => 'integer',
    ];
}
