<?php

use App\Models\Faq;
use App\Models\Website;
use App\Models\WebsiteIdentity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\ProfilController;
use App\Http\Controllers\Portal\InformasiController;
use App\Http\Controllers\Portal\PortalController;
use App\Http\Controllers\Portal\BeritaController;
use App\Http\Controllers\Portal\PengaduanController;
use App\Http\Controllers\Portal\PpidController;
use App\Http\Controllers\Portal\GaleriController;
use App\Http\Controllers\Portal\DokumenController;
use App\Http\Controllers\Portal\DynamicPageController;
use App\Http\Controllers\Portal\LayananController;
use App\Http\Controllers\Portal\UptdController;
use App\Http\Controllers\Portal\KontakController;
use App\Http\Controllers\Portal\DataController;
use App\Http\Controllers\TileProxyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root → Halaman Portal (3 Kartu)
Route::get('/', function () {
    $websites = \App\Models\Website::where('status', true)->get();
    return view('portal.welcome', compact('websites'));
})->name('home');

// Tile proxy: meneruskan request tile ke tile.openstreetmap.org dengan header User-Agent dan caching dasar
Route::get('/tiles/{z}/{x}/{y}.png', [\App\Http\Controllers\TileProxyController::class, 'tile'])
    ->where(['z' => '[0-9]+', 'x' => '[0-9]+', 'y' => '[0-9]+'])
    ->middleware('throttle:60,1');

/*
|--------------------------------------------------------------------------
| Portal Publik — Multi-Tenant via /{website:slug}
|--------------------------------------------------------------------------
*/
// FAQ Portal Utama (global, bukan per-website)
Route::get('/faq', function() {
    $identity = \App\Models\WebsiteIdentity::first();
    $faqs = \App\Models\Faq::whereNull('website_id')->orWhere('website_id', 0)->where('status', true)->orderBy('sort_order')->get();
    $menus = \App\Models\Menu::withoutGlobalScopes()
        ->whereNull('website_id')
        ->whereNull('parent_id')
        ->where('status', true)
        ->orderBy('order')
        ->with('children')
        ->get();
    return view('portal.faq', [
        'faqs' => $faqs,
        'identity' => $identity,
        'website' => null,
        'menus' => $menus,
    ]);
})->name('faq.global');

Route::prefix('/{website:slug}')->name('portal.')->group(function () {

    // Beranda
    Route::get('/', [PortalController::class, 'beranda'])->name('beranda');

    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

    // Layanan
    // Layanan (Static Pages)
    Route::prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/', [LayananController::class, 'index'])->name('index');
        Route::get('/samsat-online', [LayananController::class, 'samsatOnline'])->name('samsat-online');
        Route::get('/samsat-corner', [LayananController::class, 'samsatCorner'])->name('samsat-corner');
        Route::get('/samsat-drive-thru', [LayananController::class, 'samsatDriveThru'])->name('samsat-drive-thru');
        Route::get('/samsat-mobil', [LayananController::class, 'samsatMobil'])->name('samsat-mobil');
    });



    // FAQ (Utama & UPTD) — route: /{website:slug}/faq untuk utama, /{website:slug}/{slug}/faq untuk uptd
    Route::get('/faq', [\App\Http\Controllers\Portal\FaqController::class, 'index'])->name('faq');
    Route::get('/{slug}/faq', [\App\Http\Controllers\Portal\FaqController::class, 'uptd'])
        ->where('slug', '^(?!faq$|berita$|galeri$|layanan$|uptd$|kontak$|dokumen$|ppid$|pengaduan$|wbs$|profil$|informasi$|data$)[a-zA-Z0-9_-]+$')
        ->name('uptd.faq');

    // UPTD Wilayah
    Route::get('/uptd', [UptdController::class, 'index'])->name('uptd.index');
    Route::get('/uptd/{slug}', [UptdController::class, 'show'])->name('uptd.show');

    // Kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

    // Dokumen Publik
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::get('/dokumen/download/{shareCode}', [DokumenController::class, 'download'])->name('dokumen.download');

    // PPID
    Route::get('/ppid', [PpidController::class, 'index'])->name('ppid.index');
    Route::get('/ppid/permohonan', [PpidController::class, 'formPermohonan'])->name('ppid.permohonan');
    Route::post('/ppid/permohonan', [PpidController::class, 'storePermohonan'])->name('ppid.permohonan.store');
    Route::post('/ppid/item/{item}/view', [PpidController::class, 'trackItemView'])->whereNumber('item')->name('ppid.item.view');
    Route::post('/ppid/item/{item}/download', [PpidController::class, 'trackItemDownload'])->whereNumber('item')->name('ppid.item.download');
    // Halaman PPID (Dynamic Page khusus micro-site PPID)
    Route::get('/ppid/halaman/{menuSlug}', [\App\Http\Controllers\Portal\PpidPageController::class, 'show'])
        ->where('menuSlug', '.*')
        ->name('ppid.page.show');

    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/cek', [PengaduanController::class, 'cekStatus'])->name('pengaduan.cek');
    Route::post('/pengaduan/cek', [PengaduanController::class, 'hasilCek'])->name('pengaduan.cek.hasil');

    // WBS (Whistle Blowing System) — pakai controller yang sama, kategori berbeda
    Route::get('/wbs', [PengaduanController::class, 'wbs'])->name('wbs.index');
    Route::post('/wbs', [PengaduanController::class, 'storeWbs'])->name('wbs.store');

    // Profil (Static Pages)
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/kepala-bapenda', [ProfilController::class, 'kepalaBapenda'])->name('kepala-bapenda');
        Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
        Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
        Route::get('/maklumat-layanan', [ProfilController::class, 'maklumatLayanan'])->name('maklumat-layanan');
        Route::get('/tentang-bapenda', [ProfilController::class, 'tentangBapenda'])->name('tentang-bapenda');
    });

    // Informasi Lainnya & Regulasi (Static Pages)
    Route::prefix('informasi')->name('informasi.')->group(function () {
        Route::get('/agenda-kerja', [InformasiController::class, 'agendaKerja'])->name('agenda-kerja');
        Route::get('/sk-gubernur', [InformasiController::class, 'skGubernur'])->name('sk-gubernur');
        Route::get('/peraturan-daerah', [InformasiController::class, 'peraturanDaerah'])->name('peraturan-daerah');
        Route::get('/peraturan-gubernur', [InformasiController::class, 'peraturanGubernur'])->name('peraturan-gubernur');
        Route::get('/maklumat-pelayanan-uptd', [InformasiController::class, 'maklumatPelayananUptd'])->name('maklumat-pelayanan-uptd');
        Route::get('/inovasi', [InformasiController::class, 'inovasi'])->name('inovasi');
    });

    // Data (Static Pages)
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/retribusi-daerah', [DataController::class, 'retribusiDaerah'])->name('retribusi-daerah');
        Route::get('/pendapatan-daerah', [DataController::class, 'pendapatanDaerah'])->name('pendapatan-daerah');
    });

    Route::post('/dynamic-page/manual-view/{page}/{index}', [DynamicPageController::class, 'trackManualView'])
        ->whereNumber('page')
        ->whereNumber('index')
        ->name('dynamic.manual.view');
    Route::post('/dynamic-page/manual-download/{page}/{index}', [DynamicPageController::class, 'trackManualDownload'])
        ->whereNumber('page')
        ->whereNumber('index')
        ->name('dynamic.manual.download');

    // Dynamic Pages (fallback — harus paling bawah)
    Route::get('/{menuSlug}', [DynamicPageController::class, 'show'])->name('page.show')->where('menuSlug', '.*');
});

// Route catch-all untuk Dynamic Pages di Frontend
Route::get('/{slug}', function ($slug) {
    // Normalisasi slug (pastikan menggunakan leading slash agar cocok dengan field link di Menu)
    $normalizedSlug = '/' . ltrim($slug, '/');

    // Cari menu berdasarkan URL link
    // Karena ini di akses dari root (tanpa slug tenant), maka ini adalah menu portal utama.
    $menu = \App\Models\Menu::withoutGlobalScopes()
        ->where('position', 'portal')
        ->where(function($query) use ($slug, $normalizedSlug) {
            $query->where('link', $normalizedSlug)
                  ->orWhere('link', $slug);
        })
        ->where('status', true)
        ->first();

    if (!$menu) {
        abort(404, "Halaman tidak ditemukan.");
    }

    // Cari konten halaman dinamis yang terhubung ke menu ini
    $page = \App\Models\DynamicPage::withoutGlobalScopes()->where('menu_id', $menu->id)->first();

    if (!$page) {
        abort(404, "Konten untuk halaman ini belum tersedia atau belum diterbitkan.");
    }

    $viewName = 'dynamic-page.' . $page->template;

    if (!view()->exists($viewName)) {
        abort(404, "Template '{$page->template}' tidak ditemukan.");
    }

    // Load website identity untuk UI template jika diperlukan
    $identity = \App\Models\WebsiteIdentity::where('website_id', $page->website_id)->first();
    if (!$identity) {
        $identity = (object) ['name' => 'Badan Pendapatan Daerah'];
    }

    $content = $page->content ?? [];

    return view($viewName, compact('page', 'content', 'identity'));
})->where('slug', '.*');
