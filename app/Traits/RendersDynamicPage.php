<?php

namespace App\Traits;

use App\Models\DynamicPage;
use App\Models\Menu;
use App\Models\Website;
use Illuminate\Contracts\View\View;

/**
 * RendersDynamicPage
 *
 * Dipakai oleh controller Portal yang punya halaman "statis" (Profil, Informasi, Data, dll).
 * Sebelum merender view statis lama, cek dulu apakah Admin sudah membuat & mempublikasikan
 * Halaman Dinamis (Dynamic Page) untuk menu terkait. Jika ada, tampilkan itu — sehingga
 * perubahan yang dilakukan di Admin Panel selalu sinkron dengan frontend.
 *
 * Jika belum ada Dynamic Page yang dipublikasikan (menu belum dikonfigurasi via admin),
 * fallback ke view statis seperti biasa — tidak ada yang rusak untuk halaman yang belum diisi.
 */
trait RendersDynamicPage
{
    protected function renderMenuPage(Website $website, string $menuSlug, string $fallbackView, array $commonData): View
    {
        $menu = Menu::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('slug', $menuSlug)
            ->first();

        $page = $menu
            ? DynamicPage::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where('menu_id', $menu->id)
                ->where('published', true)
                ->first()
            : null;

        if (! $page) {
            return view($fallbackView, $commonData);
        }

        $view = 'dynamic-page.' . $page->template;
        if (! view()->exists($view)) {
            $view = 'dynamic-page.blank_editor';
        }

        $content = is_array($page->content) ? $page->content : [];

        return view($view, array_merge($commonData, [
            'page' => $page,
            'menu' => $menu,
            'content' => $content,
        ]));
    }
}
