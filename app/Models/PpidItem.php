<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class PpidItem extends Model
{
    use HasWebsiteScope;
    protected $guarded = [];

    protected $fillable = [
        'website_id',
        'ppid_id',
        'name',
        'description',
        'tempat_pembuatan',
        'penanggung_jawab',
        'format_informasi',
        'tanggal_pembuatan',
        'jangka_waktu_penyimpanan',
        'file',
        'views',
        'downloads',
    ];

    public function ppid()
    {
        return $this->belongsTo(Ppid::class);
    }
}
