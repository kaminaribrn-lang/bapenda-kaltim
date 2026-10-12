<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class PortalSetting extends Model
{
    use HasWebsiteScope;
    protected $fillable = [
        'website_id','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
