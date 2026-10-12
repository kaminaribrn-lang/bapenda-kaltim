<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
    use HasFactory;

    protected $fillable = [
        'website_id',
        'user_id',
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

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
