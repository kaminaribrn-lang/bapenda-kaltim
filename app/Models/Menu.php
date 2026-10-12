<?php

namespace App\Models;

use App\Traits\HasWebsiteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasWebsiteScope;

    protected $fillable = [
        'website_id',
        'name',
        'link',
        'slug',
        'active_pattern',
        'template',
        'icon',
        'svg_icon',
        'logo',
        'parent_id',
        'position',
        'css_variant',
        'order',
        'status',
        'open_in_new_tab',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
        'open_in_new_tab' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function dynamicPage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DynamicPage::class, 'menu_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Menu $menu) {
            // Hapus halaman dinamis yang terhubung
            if ($menu->dynamicPage) {
                $menu->dynamicPage->delete();
            }

            // Hapus sub-menu secara rekursif (Cascade Delete)
            $menu->children->each(function ($child) {
                $child->delete();
            });
        });
    }

    /**
     * URL untuk portal publik: pakai `link` jika diisi, else route halaman dinamis.
     * Segmen URL mengikuti kolom `slug` jika ada nilai, atau Str::slug(name).
     * Mendukung prefix 'route:' untuk rute internal Laravel.
     */
    public function portalHref(Website $website): string
    {
        if ($this->position === 'website') {
            $hasPublishedDynamicPage = DynamicPage::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where('menu_id', $this->id)
                ->where('published', true)
                ->exists();

            if ($hasPublishedDynamicPage) {
                $segment = filled($this->slug) ? $this->slug : Str::slug((string) ($this->name ?? ''));

                return route('portal.page.show', [$website->slug, $segment ?: 'halaman']);
            }
        }

        if (! empty($this->link)) {
            if (str_starts_with($this->link, 'route:')) {
                $rawRoute = substr($this->link, 6);
                
                $fragment = '';
                $query = [];
                
                $hashPos = strpos($rawRoute, '#');
                if ($hashPos !== false) {
                    $fragment = substr($rawRoute, $hashPos);
                    $rawRoute = substr($rawRoute, 0, $hashPos);
                }
                
                $queryPos = strpos($rawRoute, '?');
                if ($queryPos !== false) {
                    $queryString = substr($rawRoute, $queryPos + 1);
                    $rawRoute = substr($rawRoute, 0, $queryPos);
                    parse_str($queryString, $query);
                }
                
                try {
                    $routeObj = \Illuminate\Support\Facades\Route::getRoutes()->getByName($rawRoute);
                    $parameters = [];
                    if ($routeObj && in_array('website', $routeObj->parameterNames())) {
                        $parameters['website'] = $website->slug;
                    }
                    $parameters = array_merge($parameters, $query);
                    return route($rawRoute, $parameters) . $fragment;
                } catch (\Exception $e) {
                    return $this->link;
                }
            }
            
            if (str_starts_with($this->link, '/') && $this->link !== '/') {
                $segments = explode('/', trim($this->link, '/'));
                $targetWebsite = Website::withoutGlobalScopes()
                    ->where('slug', $segments[0] ?? '')
                    ->where('status', true)
                    ->first();

                if ($targetWebsite) {
                    return url($this->link);
                }

                return url('/' . $website->slug . $this->link);
            }
            
            return $this->link;
        }

        $segment = filled($this->slug) ? $this->slug : Str::slug((string) ($this->name ?? ''));

        if ($this->position === 'ppid') {
            return route('portal.ppid.page.show', [$website->slug, $segment ?: 'halaman']);
        }

        return route('portal.page.show', [$website->slug, $segment ?: 'halaman']);
    }

    /**
     * Memeriksa apakah menu ini aktif berdasarkan active_pattern
     */
    public function isActive(): bool
    {
        if (empty($this->active_pattern)) {
            if (!empty($this->link)) {
                if (str_starts_with($this->link, 'route:')) {
                    $routeName = substr($this->link, 6);
                    $hashPos = strpos($routeName, '#');
                    if ($hashPos !== false) {
                        $routeName = substr($routeName, 0, $hashPos);
                    }
                    $queryPos = strpos($routeName, '?');
                    if ($queryPos !== false) {
                        $routeName = substr($routeName, 0, $queryPos);
                    }
                    return request()->routeIs($routeName) || request()->routeIs($routeName . '.*');
                }
                return request()->is(ltrim($this->link, '/')) || request()->is(ltrim($this->link, '/') . '/*');
            }
            return false;
        }

        $patterns = explode(',', $this->active_pattern);

        foreach ($patterns as $pattern) {
            $pattern = trim($pattern);
            
            if (\Illuminate\Support\Facades\Route::has($pattern)) {
                if (request()->routeIs($pattern) || request()->routeIs($pattern . '.*')) {
                    return true;
                }
            }

            if (request()->is($pattern) || request()->is(ltrim($pattern, '/'))) {
                return true;
            }

            if (str_contains($pattern, '?')) {
                $parts = explode('?', $pattern, 2);
                $pathPattern = $parts[0];
                $queryStr = $parts[1];

                if (request()->is($pathPattern) || request()->is(ltrim($pathPattern, '/'))) {
                    parse_str($queryStr, $queryParts);
                    $matchedAll = true;
                    foreach ($queryParts as $key => $val) {
                        if (request()->query($key) !== $val) {
                            $matchedAll = false;
                            break;
                        }
                    }
                    if ($matchedAll) {
                        return true;
                    }
                }
            }
        }

        // Check if any child is active
        if ($this->relationLoaded('children')) {
            foreach ($this->children as $child) {
                if ($child->isActive()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get website menus for a given tenant website.
     */
    public static function getForWebsite(Website $website)
    {
        return static::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('position', 'website')
            ->whereNull('parent_id')
            ->where('status', true)
            ->orderBy('order')
            ->with(['children' => fn($q) => $q->where('status', true)->orderBy('order')])
            ->get();
    }

    /**
     * Get PPID-specific menus for a given tenant website (used inside the
     * PPID micro-site so the floating nav differs from the main website nav).
     */
    public static function getForWebsitePpid(Website $website)
    {
        return static::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('position', 'ppid')
            ->whereNull('parent_id')
            ->where('status', true)
            ->orderBy('order')
            ->with(['children' => fn($q) => $q->where('status', true)->orderBy('order')])
            ->get();
    }
}