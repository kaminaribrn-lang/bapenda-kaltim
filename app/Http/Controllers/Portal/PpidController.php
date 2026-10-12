<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\PpidRequest;
use App\Models\Menu;
use App\Models\Ppid;
use App\Models\PpidItem;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PpidController extends Controller
{
    public function index(Website $website)
    {
        $ppids = Ppid::withoutGlobalScopes()
                     ->where('website_id', $website->id)
                     ->whereNull('parent_id')
                     ->with(['children.items', 'items'])
                     ->get();

        return view('portal.ppid.index', [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => $this->getMenus($website),
            'ppids'    => $ppids,
        ]);
    }

    public function formPermohonan(Website $website)
    {
        return view('portal.ppid.permohonan', [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => $this->getMenus($website),
        ]);
    }

    public function storePermohonan(Website $website, Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'nik'               => 'nullable|string|max:20',
            'email'             => 'required|email|max:255',
            'no_telepon'        => 'required|string|max:20',
            'alamat'            => 'required|string|max:500',
            'pekerjaan'         => 'required|string|max:255',
            'tujuan_penggunaan' => 'required|string',
            'rincian_informasi' => 'required|string',
            'cara_mendapatkan'  => ['required', 'in:Melihat / Membaca,Mendapatkan Salinan,Mendapat Penjelasan'],
            'cara_memperoleh'   => ['required', 'in:Mengambil Langsung,Email,Kurir'],
        ]);

        PpidRequest::create(array_merge($validated, [
            'website_id'      => $website->id,
            'kode_permohonan' => strtoupper(\Illuminate\Support\Str::random(8)),
            'status'          => 'baru',
        ]));

        return back()->with('success', 'Permohonan informasi berhasil dikirim. Kami akan menghubungi Anda dalam 10 hari kerja.');
    }

    public function trackItemView(Website $website, int $item): JsonResponse
    {
        return $this->trackItemMetric($website, $item, 'views');
    }

    public function trackItemDownload(Website $website, int $item): JsonResponse
    {
        return $this->trackItemMetric($website, $item, 'downloads');
    }

    private function getMenus(Website $website)
    {
        $ppidMenus = Menu::getForWebsitePpid($website);

        return $ppidMenus->isNotEmpty() ? $ppidMenus : Menu::getForWebsite($website);
    }

    private function trackItemMetric(Website $website, int $itemId, string $metric): JsonResponse
    {
        abort_unless(in_array($metric, ['views', 'downloads'], true), 404);

        $item = PpidItem::withoutGlobalScopes()
            ->whereKey($itemId)
            ->where('website_id', $website->id)
            ->first();

        if (! $item) {
            $item = PpidItem::withoutGlobalScopes()
                ->whereKey($itemId)
                ->whereHas('ppid', fn ($query) => $query->withoutGlobalScopes()->where('website_id', $website->id))
                ->firstOrFail();
        }

        $item->increment($metric);
        $item->refresh();

        return response()->json([
            'success' => true,
            $metric => (int) $item->{$metric},
        ]);
    }
}
