<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class PpidAbout extends Model
{
    use HasWebsiteScope;
    protected $fillable = [
        'website_id',
        'profil',
        'visi',
        'misi',
        'maklumat',
    ];

    public function files()
    {
        return $this->hasMany(PpidAboutFile::class);
    }
}
