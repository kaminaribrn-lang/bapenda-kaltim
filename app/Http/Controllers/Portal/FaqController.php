<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Website;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // FAQ untuk portal utama

    public function index(Website $website)
    {
        // Ambil FAQ utama dulu
        $faqs = Faq::where('website_id', $website->id)
            ->whereNull('uptd_slug')
            ->where('status', true)
            ->orderBy('sort_order')
            ->get();

        // Jika tidak ada FAQ utama, fallback ke FAQ UPTD (uptd_slug = website slug)
        if ($faqs->isEmpty()) {
            $faqs = Faq::where('website_id', $website->id)
                ->where('uptd_slug', $website->slug)
                ->where('status', true)
                ->orderBy('sort_order')
                ->get();
        }

        $identity = $website->identity;
        $menus = \App\Models\Menu::getForWebsite($website);
        return view('portal.faq', compact('website', 'faqs', 'identity', 'menus'));
    }

    // FAQ untuk UPTD (per slug)


    public function uptd(Website $website, $slug)
    {
        $faqs = Faq::where('website_id', $website->id)
            ->where('status', true)
            ->where('uptd_slug', $slug)
            ->orderBy('sort_order')
            ->get();
            
        $identity = $website->identity;
        // Fallback: jika $website->id tidak ada menu, ambil menu global/null
        $menus = \App\Models\Menu::getForWebsite($website);

        return view('portal.uptd.faq', compact('website', 'faqs', 'slug', 'identity', 'menus'));
    }
}
