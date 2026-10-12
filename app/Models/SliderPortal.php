<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderPortal extends Model
{
    use HasWebsiteScope;
    use HasFactory;

    protected $table = 'slider_portals';

    protected $fillable = [
        'website_id',
        'caption',
        'description',
        'link',
        'status',
    ];

    public function file(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
