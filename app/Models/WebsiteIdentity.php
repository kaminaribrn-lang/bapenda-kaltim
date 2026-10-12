<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;

use Illuminate\Database\Eloquent\Model;

class WebsiteIdentity extends Model
{
    use HasWebsiteScope;

    protected $fillable = [
        'website_id',
        'name',
        'description',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'welcome_title',
        'welcome_subtitle',
        'welcome_content',
        'welcome_photo',
        'welcome_leader_name',
        'welcome_leader_position',
        'hero_background',
        'email',
        'phone',
        'header_contact_text',
        'whatsapp',
        'address',
        'google_maps_embed',
        'logo',
        'logo_secondary',
        'favicon',
        'footer_logo',
        'leaders',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'tiktok',
        'footer_links_related',
        'footer_links_city',
        'footer_links_regency',
        'gpr_widget_status',
        'gpr_widget_rss_url',
        'survey_link_url',
        'userway_account_id',
    ];

    protected $casts = [
        'leaders'               => 'array',
        'footer_links_related'  => 'array',
        'footer_links_city'     => 'array',
        'footer_links_regency'  => 'array',
        'gpr_widget_status'     => 'boolean',
    ];

    public function hasWelcomeSettings(): bool
    {
        return filled($this->welcome_title)
            || filled($this->welcome_subtitle)
            || filled($this->welcome_content)
            || filled($this->welcome_photo)
            || filled($this->welcome_leader_name)
            || filled($this->welcome_leader_position);
    }

    /**
     * URL gambar latar hero beranda: unggahan admin bila ada, selain itu gambar bawaan halaman.
     */
    public static function heroBackgroundFor(?self $identity, string $default): string
    {
        return filled($identity?->hero_background)
            ? asset('storage/' . ltrim($identity->hero_background, '/'))
            : $default;
    }

    /**
     * Data section "Selamat Datang" di beranda. Kolom yang kosong memakai nilai bawaan halaman.
     *
     * @param  array{title?: string, line1?: string, line2?: string, content?: string, photo_url?: ?string, name?: string, position?: string}  $defaults
     * @return array{title: string, line1: string, line2: string, content: string, photo_url: ?string, name: string, position: string}
     */
    public static function welcomeFor(?self $identity, array $defaults = []): array
    {
        $welcome = array_merge([
            'title' => "Selamat Datang\ndi Website Resmi",
            'line1' => '',
            'line2' => '',
            'content' => '',
            'photo_url' => null,
            'name' => '',
            'position' => '',
        ], $defaults);

        if (! $identity) {
            return $welcome;
        }

        if (filled($identity->welcome_title)) {
            $welcome['title'] = trim($identity->welcome_title);
        }

        if (filled($identity->welcome_subtitle)) {
            $lines = preg_split('/\R/', trim($identity->welcome_subtitle), 2);
            $welcome['line1'] = trim($lines[0]);
            $welcome['line2'] = trim($lines[1] ?? '');
        }

        if (filled($identity->welcome_content)) {
            $welcome['content'] = trim($identity->welcome_content);
        }

        if (filled($identity->welcome_photo)) {
            $welcome['photo_url'] = asset('storage/' . ltrim($identity->welcome_photo, '/'));
        }

        if (filled($identity->welcome_leader_name)) {
            $welcome['name'] = trim($identity->welcome_leader_name);
        }

        if (filled($identity->welcome_leader_position)) {
            $welcome['position'] = trim($identity->welcome_leader_position);
        }

        return $welcome;
    }
}
