<?php

namespace App\Filament\Widgets;

use App\Models\WebsiteIdentity;
use App\Models\User;
use Filament\Widgets\Widget;

class SiteIdentityWidget extends Widget
{
    protected string $view = 'filament.widgets.site-identity-widget';

    public function getData(): array
    {
        $identity = WebsiteIdentity::first();
        $adminCount = User::count();
        
        return [
            'site_name' => $identity?->name ?? __('Sapri CMS'),
            'user_name' => auth()->user()->name,
            'user_role' => auth()->user()->role?->label() ?? __('Internal User'),
            'email' => $identity?->email ?? __('admin@sapri.dev'),
            'phone' => $identity?->phone ?? __('+62 812-3456-7890'),
            'address' => $identity?->address ?? __('Jl. Melati No. 45, Sleman, Yogyakarta'),
            'logo' => asset('images/logo-bapenda-kaltim.png') . '?v=2',
            'admin_count' => $adminCount,
            'status' => __('Aktif'),
            'logo_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=059669&background=ecfdf5',
        ];
    }
}
