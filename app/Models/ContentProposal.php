<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'proposer_id',
        'verifier_id',
        'approved_by',
        'title',
        'description',
        'planned_upload_at',
        'upload_count',
        'upload_channels',
        'target_link',
        'status',
        'is_publishable',
        'verifier_notes',
        'approval_notes',
        'verified_at',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'planned_upload_at' => 'date',
            'upload_count' => 'integer',
            'upload_channels' => 'array',
            'is_publishable' => 'boolean',
            'verified_at' => 'datetime',
            'approved_at' => 'datetime',
        ];
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function proposer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proposer_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifier_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function uploadChannelOptions(): array
    {
        return [
            'website' => __('Website'),
            'instagram' => __('Instagram'),
            'facebook' => __('Facebook'),
            'youtube' => __('YouTube'),
            'tiktok' => __('TikTok'),
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'submitted' => __('Diajukan'),
            'verified' => __('Terverifikasi'),
            'approved' => __('Disetujui'),
            'rejected' => __('Ditolak'),
        ];
    }

    public static function statusColor(string $status): string
    {
        return match ($status) {
            'submitted' => 'warning',
            'verified' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'gray',
        };
    }
}
