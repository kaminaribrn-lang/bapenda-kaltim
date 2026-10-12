<?php

namespace App\Http\Controllers\Portal;

use App\Models\DynamicPage;
use App\Models\Menu;
use App\Models\Website;

/**
 * PpidPageController
 *
 * Merender "Halaman PPID" (DynamicPage yang menu-nya berposisi `ppid`) memakai
 * template yang sama persis dengan sistem Halaman Dinamis biasa (penjelasan_1,
 * penjelasan_2, dokumen_list, dll), namun berada di dalam micro-site PPID —
 * sehingga floating navbar yang tampil adalah Menu PPID, bukan Menu Website.
 */
class PpidPageController extends DynamicPageController
{
    public function show(Website $website, string $menuSlug)
    {
        $menu = $this->resolveMenuByPublicSlug($website, $menuSlug, 'ppid');

        $page = DynamicPage::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('menu_id', $menu->id)
            ->where('published', true)
            ->firstOrFail();

        $menus = $this->getMenus($website);
        $identity = $website->identity;

        $view = 'dynamic-page.' . $page->template;
        if (! view()->exists($view)) {
            $view = 'dynamic-page.blank_editor';
        }

        $content = $this->buildPageContent($page, $website);

        return view($view, [
            'website' => $website,
            'identity' => $identity,
            'menus' => $menus,
            'page' => $page,
            'menu' => $menu,
            'content' => $content,
        ]);
    }

    protected function getMenus(Website $website)
    {
        $ppidMenus = Menu::getForWebsitePpid($website);

        return $ppidMenus->isNotEmpty() ? $ppidMenus : Menu::getForWebsite($website);
    }
}
