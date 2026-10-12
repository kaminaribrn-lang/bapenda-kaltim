<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Agenda;
use App\Models\LeaderProfile;

class DummyUptdDataSeeder extends Seeder
{
    public function run(): void
    {
        $mainWebsite = Website::where('id', 1)->orWhere('slug', 'bapenda-kaltim')->first();
        if (!$mainWebsite) return;

        $otherWebsites = Website::where('id', '!=', $mainWebsite->id)->get();

        foreach ($otherWebsites as $website) {
            // Clone Menus
            if (Menu::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainMenus = Menu::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->whereNull('parent_id')->get();
                foreach ($mainMenus as $menu) {
                    $newMenu = $menu->replicate();
                    $newMenu->website_id = $website->id;
                    $newMenu->save();

                    // Clone children
                    foreach ($menu->children()->withoutGlobalScopes()->get() as $child) {
                        $newChild = $child->replicate();
                        $newChild->website_id = $website->id;
                        $newChild->parent_id = $newMenu->id;
                        $newChild->save();
                    }
                }
            }

            // Clone Sliders
            if (Slider::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainSliders = Slider::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->get();
                foreach ($mainSliders as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }

            // Clone Posts (Berita)
            if (Post::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainPosts = Post::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->take(6)->get();
                foreach ($mainPosts as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }

            // Clone Galleries
            if (Gallery::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainGalleries = Gallery::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->take(8)->get();
                foreach ($mainGalleries as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }

            // Clone Services
            if (Service::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainServices = Service::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->get();
                foreach ($mainServices as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }

            // Clone Agendas
            if (Agenda::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainAgendas = Agenda::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->get();
                foreach ($mainAgendas as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }
            
            // Clone Leader Profile
            if (LeaderProfile::withoutGlobalScopes()->where('website_id', $website->id)->count() === 0) {
                $mainLeaders = LeaderProfile::withoutGlobalScopes()->where('website_id', $mainWebsite->id)->get();
                foreach ($mainLeaders as $item) {
                    $newItem = $item->replicate();
                    $newItem->website_id = $website->id;
                    $newItem->save();
                }
            }
        }
    }
}
