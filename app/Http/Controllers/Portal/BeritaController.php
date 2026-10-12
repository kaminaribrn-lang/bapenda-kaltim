<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Menu;

class BeritaController extends Controller
{
    public function index(Website $website)
    {
        $identity   = $website->identity;
        $menus      = $this->getMenus($website);
        $categories = PostCategory::withoutGlobalScopes()
                                  ->where('website_id', $website->id)
                                  ->get();

        $categorySlug = request('kategori');
        $search       = request('q');

        $query = Post::withoutGlobalScopes()
                     ->where('website_id', $website->id)
                     ->where(function ($q) {
                         $q->where('status', 'published')
                           ->orWhere('status', 1)
                           ->orWhere('status', true);
                     })
                     ->with(['file', 'category'])
                     ->latest('published_at');

        if ($categorySlug) {
            $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->paginate(9)->withQueryString();

        return view('portal.berita.index', compact(
            'website', 'identity', 'menus', 'posts', 'categories', 'categorySlug', 'search'
        ));
    }

    public function show(Website $website, string $slug)
    {
        $identity = $website->identity;
        $menus    = $this->getMenus($website);

        $post = Post::withoutGlobalScopes()
                    ->where('website_id', $website->id)
                    ->where('slug', $slug)
                    ->where(function ($q) {
                        $q->where('status', 'published')
                          ->orWhere('status', 1)
                          ->orWhere('status', true);
                    })
                    ->with(['file', 'category', 'user'])
                    ->firstOrFail();

        // Increment read
        $post->increment('read');

        $related = Post::withoutGlobalScopes()
                       ->where('website_id', $website->id)
                       ->where(function ($q) {
                           $q->where('status', 'published')
                             ->orWhere('status', 1)
                             ->orWhere('status', true);
                       })
                       ->where('id', '!=', $post->id)
                       ->when($post->category_id, fn($q) => $q->where('category_id', $post->category_id))
                       ->with(['file', 'category'])
                       ->latest('published_at')
                       ->take(4)
                       ->get();

        return view('portal.berita.show', compact(
            'website', 'identity', 'menus', 'post', 'related'
        ));
    }

    private function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }
}
