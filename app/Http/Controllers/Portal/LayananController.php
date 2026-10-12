<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\SamsatLocation;
use App\Models\Website;
use App\Models\Menu;

class LayananController extends Controller
{
    private function getCommonData(Website $website)
    {
        return [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => Menu::getForWebsite($website),
        ];
    }

    public function index(Website $website)
    {
        // Website UPTD hanya menampilkan layanan Samsat di wilayahnya sendiri.
        $locations = $website->is_main
            ? SamsatLocation::where('website_id', $website->id)
                ->where('status', true)
                ->orderBy('order')
                ->get()
                ->map(fn (SamsatLocation $location) => $location->toMapArray())
                ->values()
            : SamsatLocation::mapArraysForUptd($website->slug, [$website->id]);

        return view('portal.layanan.index', array_merge(
            $this->getCommonData($website),
            ['samsatLocations' => $locations]
        ));
    }

    public function samsatOnline(Website $website)
    {
        return view('portal.layanan.samsat-online', $this->getCommonData($website));
    }

    public function samsatCorner(Website $website)
    {
        return view('portal.layanan.samsat-corner', $this->getCommonData($website));
    }

    public function samsatDriveThru(Website $website)
    {
        return view('portal.layanan.samsat-drive-thru', $this->getCommonData($website));
    }

    public function samsatMobil(Website $website)
    {
        return view('portal.layanan.samsat-mobil', $this->getCommonData($website));
    }
}
