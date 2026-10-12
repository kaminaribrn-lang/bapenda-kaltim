<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Gallery;
use App\Models\Menu;

class GaleriController extends Controller
{
    public function index(Website $website)
    {
        $galleries = Gallery::withoutGlobalScopes()
                            ->where('website_id', $website->id)
                            ->where('status', 1)
                            ->with('file')
                            ->paginate(18);

        return view('portal.galeri.index', [
            'website'   => $website,
            'identity'  => $website->identity,
            'menus'     => $this->getMenus($website),
            'galleries' => $galleries,
        ]);
    }

    private function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }
}
