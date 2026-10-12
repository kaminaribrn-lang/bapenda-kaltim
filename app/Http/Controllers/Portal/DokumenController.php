<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\FileSharing;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DokumenController extends Controller
{
    public function index(Website $website)
    {
        $parentId = request('folder');

        $items = FileSharing::withoutGlobalScopes()
                            ->where('website_id', $website->id)
                            ->where('is_public', true)
                            ->where('status', 1)
                            ->where('parent_id', $parentId)
                            ->orderByDesc('is_folder')
                            ->orderBy('title')
                            ->get();

        $breadcrumbs = [];
        if ($parentId) {
            $folder = FileSharing::withoutGlobalScopes()->find($parentId);
            $breadcrumbs = $this->buildBreadcrumbs($folder);
        }

        return view('portal.dokumen.index', [
            'website'     => $website,
            'identity'    => $website->identity,
            'menus'       => $this->getMenus($website),
            'items'       => $items,
            'breadcrumbs' => $breadcrumbs,
            'currentFolder' => $parentId ? FileSharing::withoutGlobalScopes()->find($parentId) : null,
        ]);
    }

    public function download(Website $website, string $shareCode)
    {
        $file = FileSharing::withoutGlobalScopes()
                           ->where('website_id', $website->id)
                           ->where('share_code', $shareCode)
                           ->where('is_public', true)
                           ->where('status', 1)
                           ->where('is_folder', false)
                           ->firstOrFail();

        $file->increment('download_count');

        return Storage::disk('public')->download($file->file_path, $file->title);
    }

    private function buildBreadcrumbs(?FileSharing $folder): array
    {
        if (!$folder) return [];
        $crumbs = [];
        $current = $folder;
        while ($current) {
            array_unshift($crumbs, $current);
            $current = $current->parent_id
                ? FileSharing::withoutGlobalScopes()->find($current->parent_id)
                : null;
        }
        return $crumbs;
    }

    private function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }
}
