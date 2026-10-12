<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use App\Models\Menu;
use App\Models\Ppid;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DynamicPageController extends Controller
{
    public function show(Website $website, string $menuSlug)
    {
        $menu = $this->resolveMenuByPublicSlug($website, $menuSlug);

        $page = DynamicPage::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('menu_id', $menu->id)
            ->where('published', true)
            ->firstOrFail();

        $menus = $this->getMenus($website);
        $identity = $website->identity;

        $view = 'dynamic-page.' . $page->template;
        if (!view()->exists($view)) {
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

    public function trackManualView(Website $website, int $page, int $index): JsonResponse
    {
        return $this->trackManualMetric($website, $page, $index, 'views');
    }

    public function trackManualDownload(Website $website, int $page, int $index): JsonResponse
    {
        return $this->trackManualMetric($website, $page, $index, 'downloads');
    }

    protected function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }

    private function trackManualMetric(Website $website, int $pageId, int $index, string $metric): JsonResponse
    {
        abort_unless(in_array($metric, ['views', 'downloads'], true), 404);

        $page = DynamicPage::withoutGlobalScopes()
            ->whereKey($pageId)
            ->where('website_id', $website->id)
            ->firstOrFail();

        $content = is_array($page->content) ? $page->content : [];
        $documents = is_array($content['documents'] ?? null) ? $content['documents'] : [];

        abort_unless(array_key_exists($index, $documents), 404);

        $current = (int) ($documents[$index][$metric] ?? 0);
        $documents[$index][$metric] = $current + 1;
        $content['documents'] = $documents;

        $page->content = $content;
        $page->save();

        return response()->json([
            'success' => true,
            $metric => $documents[$index][$metric],
        ]);
    }

    protected function buildPageContent(DynamicPage $page, Website $website): array
    {
        $content = is_array($page->content) ? $page->content : [];

        if (! in_array($page->template, ['dokumen_grid', 'dokumen_list', 'tabel'], true)) {
            return $content;
        }

        $mode = $content['mode'] ?? 'manual';

        if ($mode === 'automatic' && ! empty($content['ppid_id'])) {
            $content['documents'] = $this->mapDocumentsFromPpid($website, (int) $content['ppid_id']);
        } else {
            $content['documents'] = $this->normalizeManualDocuments($content['documents'] ?? []);
        }

        return $content;
    }

    private function mapDocumentsFromPpid(Website $website, int $ppidId): array
    {
        $ppid = Ppid::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->with(['items', 'children.items'])
            ->find($ppidId);

        if (! $ppid) {
            return [];
        }

        $items = $ppid->items->concat(
            $ppid->children->flatMap(fn (Ppid $child) => $child->items)
        )->values();

        return $items->map(function ($item) {
            $filePath = $this->normalizeStoragePath($item->file);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'date' => $item->tanggal_pembuatan,
                'description' => $item->description ?: ($item->penanggung_jawab ?? ''),
                'file_url' => $filePath,
                'file_href' => $this->resolvePublicFileUrl($filePath),
                'views' => (int) $item->views,
                'downloads' => (int) $item->downloads,
            ];
        })->all();
    }

    private function normalizeManualDocuments(mixed $documents): array
    {
        if (! is_array($documents)) {
            return [];
        }

        return collect($documents)
            ->filter(fn ($doc) => is_array($doc))
            ->map(function (array $doc) {
                $filePath = $this->normalizeStoragePath((string) ($doc['file_url'] ?? ''));
                $fileHref = $doc['file_href'] ?? $this->resolvePublicFileUrl($filePath);

                return array_merge($doc, [
                    'file_url' => $filePath,
                    'file_href' => $fileHref,
                    'views' => (int) ($doc['views'] ?? 0),
                    'downloads' => (int) ($doc['downloads'] ?? 0),
                ]);
            })
            ->values()
            ->all();
    }

    private function resolvePublicFileUrl(string $path): string
    {
        if ($path === '') {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    private function normalizeStoragePath(?string $path): string
    {
        if (! is_string($path) || trim($path) === '') {
            return '';
        }

        $path = str_replace('\\', '/', trim($path));

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'storage/')) {
            return substr($path, strlen('storage/'));
        }

        return $path;
    }

    /**
     * Resolve menu row from URL segment. Prefer `slug` column when present;
     * otherwise match Str::slug(name) or last path segment of `link` (legacy DB).
     */
    protected function resolveMenuByPublicSlug(Website $website, string $menuSlug, ?string $position = null): Menu
    {
        $base = Menu::withoutGlobalScopes()
            ->where('website_id', $website->id)
            ->where('status', true);

        if ($position !== null) {
            $base = $base->where('position', $position);
        }

        if (Schema::hasColumn('menus', 'slug')) {
            $bySlug = (clone $base)->where('slug', $menuSlug)->first();
            if ($bySlug) {
                return $bySlug;
            }
        }

        $needle = mb_strtolower($menuSlug);

        $found = (clone $base)->get()->first(function (Menu $menu) use ($needle) {
            if (Str::slug($menu->name) === $needle) {
                return true;
            }
            $link = $menu->link;
            if (!is_string($link) || $link === '') {
                return false;
            }
            $path = parse_url($link, PHP_URL_PATH);
            if ($path === null || $path === '' || $path === false) {
                $path = $link;
            }
            $path = trim(str_replace('\\', '/', (string) $path), '/');
            if ($path === '') {
                return false;
            }
            
            // Cek kecocokan full path terlebih dahulu
            if (mb_strtolower($path) === $needle) {
                return true;
            }
            
            $last = mb_strtolower(last(explode('/', $path)));

            return $last === $needle || Str::slug($last) === $needle;
        });

        abort_if($found === null, 404);

        return $found;
    }
}
