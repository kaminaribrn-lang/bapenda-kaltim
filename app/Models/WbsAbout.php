<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class WbsAbout extends Model
{
    use HasWebsiteScope;
    protected $fillable = [
        'website_id',
        'title',
        'description',
        'image',
        'button_text',
        'is_active',
    ];
}
