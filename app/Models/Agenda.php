<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasWebsiteScope;
    use HasFactory;

    protected $table = 'agenda'; // Standard pluralization might fail here if not configured, better explicit.

    protected $fillable = [
        'website_id',
        'schedule',
        'caption',
        'description',
        'location',
    ];

    protected $casts = [
        'schedule' => 'datetime',
    ];
}
