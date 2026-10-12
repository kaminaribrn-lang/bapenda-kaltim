<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Menu;

class KontakController extends Controller
{
    public function index(Website $website)
    {
        $identity = $website->identity;
        $menus    = Menu::getForWebsite($website);

        return view('portal.kontak.index', compact('website', 'identity', 'menus'));
    }
}
