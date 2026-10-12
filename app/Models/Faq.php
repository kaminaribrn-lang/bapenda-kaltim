<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasWebsiteScope;
    use HasFactory;

    protected $fillable = [
        'website_id',
        'uptd_slug',
        'question',
        'answer',
        'sort_order',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];
}
