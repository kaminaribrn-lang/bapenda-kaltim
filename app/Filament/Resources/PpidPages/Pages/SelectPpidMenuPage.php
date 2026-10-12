<?php

namespace App\Filament\Resources\PpidPages\Pages;

use App\Filament\Resources\PpidPages\PpidPageResource;
use App\Models\DynamicPage;
use App\Models\Menu;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class SelectPpidMenuPage extends Page
{
    protected static string $resource = PpidPageResource::class;

    protected string $view = 'filament.resources.ppid-pages.pages.select-menu';

    public function getTitle(): string
    {
        return __('Halaman PPID');
    }

    /**
     * Menu PPID bersifat flat (tidak bertingkat seperti Menu Website), jadi
     * cukup ambil semua menu PPID top-level beserta anak-anaknya sekaligus.
     */
    public function getMenus(): Collection
    {
        return Menu::where('position', 'ppid')
            ->whereNull('parent_id')
            ->where('status', true)
            ->orderBy('order')
            ->with(['children' => function ($query) {
                $query->where('status', true)->orderBy('order');
            }])
            ->get();
    }

    public function getPageIdForMenu(int $menuId): ?int
    {
        return DynamicPage::where('menu_id', $menuId)->value('id');
    }
}
