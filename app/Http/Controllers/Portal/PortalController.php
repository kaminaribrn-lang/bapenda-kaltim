<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\LeaderProfile;
use App\Models\Menu;
use App\Models\Post;
use App\Models\SamsatLocation;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function beranda(Website $website)
    {
        $identity = $website->identity;
        $menus = Menu::getForWebsite($website);

        // Ambil slider sesuai user login, fallback ke website jika tidak login
        if (Auth::check()) {
            $sliders = Slider::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where('user_id', Auth::id())
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->with('file')
                ->get();
            // Jika user belum punya slider, fallback ke slider umum website
            if ($sliders->isEmpty()) {
                $sliders = Slider::withoutGlobalScopes()
                    ->where('website_id', $website->id)
                    ->whereNull('user_id')
                    ->where('status', 1)
                    ->latest()
                    ->take(8)
                    ->with('file')
                    ->get();
            }
        } else {
            $sliders = Slider::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->whereNull('user_id')
                ->where('status', 1)
                ->latest()
                ->take(8)
                ->with('file')
                ->get();
        }

        $beritaTerbaru = Post::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where(function ($q) {
                $q->where('status', 'published')
                    ->orWhere('status', 1)
                    ->orWhere('status', true);
            })
            ->with(['file', 'category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $beritaPopuler = Post::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where(function ($q) {
                $q->where('status', 'published')
                    ->orWhere('status', 1)
                    ->orWhere('status', true);
            })
            ->with(['file', 'category'])
            ->orderByDesc('read')
            ->take(5)
            ->get();

        $galleries = Gallery::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('status', 1)
            ->with('file')
            ->take(8)
            ->get();

        $services = Service::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('status', 1)
            ->with('file')
            ->take(6)
            ->get();

        $calendarAgendas = Agenda::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->orderBy('schedule')
            ->get();

        $agendas = $calendarAgendas
            ->where('schedule', '>=', now())
            ->take(4)
            ->values();

        $leaders = LeaderProfile::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('status', true)
            ->orderBy('order')
            ->take(1)
            ->get();

        if (! $website->is_main) {
            $namaUptd = str_replace('UPTD ', '', $website->name);
            $uptd = [
                'name' => $namaUptd,
                'slug' => $website->slug,
                'address' => $identity->address ?? null,
                'phone' => $identity->phone ?? null,
                'hours' => null,
                'description' => $identity->description ?? null,
                'map_url' => null,
            ];

            $uptdViews = [
                'kukar' => 'kutai-kartanegara',
                'kutim' => 'kutai-timur',
                'kubar' => 'kutai-barat',
                'ppu' => 'penajam-paser-utara',
            ];
            $uptdView = $uptdViews[$website->slug] ?? $website->slug;
            $welcomeIdentity = $identity;
            $samsatLocations = SamsatLocation::mapArraysForUptd($website->slug, [$website->id]);

            // Beranda UPTD menampilkan lebih banyak berita di slider-nya.
            $beritaTerbaru = Post::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where(function ($q) {
                    $q->where('status', 'published')
                        ->orWhere('status', 1)
                        ->orWhere('status', true);
                })
                ->with(['file', 'category', 'website'])
                ->latest('published_at')
                ->take(6)
                ->get();

            if (view()->exists("portal.uptd.{$uptdView}")) {
                return view("portal.uptd.{$uptdView}", compact(
                    'samsatLocations',
                    'website',
                    'identity',
                    'welcomeIdentity',
                    'menus',
                    'uptd',
                    'beritaTerbaru',
                    'services',
                    'galleries',
                    'agendas',
                    'calendarAgendas',
                    'leaders'
                ));
            }

            return view('portal.uptd.placeholder', compact('website', 'identity', 'menus', 'uptd'));
        }

        $uptdData = (new \App\Http\Controllers\Portal\UptdController)->getUptdDataPublic();

        // Ambil data infografis
        $infografis = \App\Models\Infografis::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('status', 1)
            ->with('file')
            ->orderByDesc('is_pinned')
            ->latest()
            ->take(8)
            ->get();

        // Peta Layanan Samsat (section "Layanan Unggulan")
        $samsatLocations = SamsatLocation::where('website_id', $website->id)
            ->where('status', true)
            ->orderBy('order')
            ->get()
            ->map(fn (SamsatLocation $location) => $location->toMapArray())
            ->values();

        return view('portal.beranda', compact(
            'website', 'identity', 'menus',
            'sliders', 'beritaTerbaru', 'beritaPopuler',
            'galleries', 'services', 'agendas', 'calendarAgendas', 'leaders', 'uptdData',
            'infografis', 'samsatLocations'
        ));
    }
}
