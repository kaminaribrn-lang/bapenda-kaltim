<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Pengaduan;
use App\Models\WbsAbout;
use App\Models\Menu;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Website $website)
    {
        return view('portal.pengaduan.form', [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => $this->getMenus($website),
        ]);
    }

    public function store(Website $website, Request $request)
    {
        $validated = $request->validate([
            'kategori'         => 'required|string',
            'nama_lengkap'     => 'required_unless:is_anonymous,on|nullable|string|max:255',
            'nik'              => 'nullable|string|max:20',
            'email'            => 'required_unless:is_anonymous,on|nullable|email|max:255',
            'telepon'          => 'nullable|string|max:20',
            'alamat'           => 'nullable|string|max:500',
            'pekerjaan'        => 'nullable|string|max:255',
            'judul_laporan'    => 'required|string|max:255',
            'kronologis'       => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'is_anonymous'     => 'nullable',
        ]);

        $isAnonymous = $request->has('is_anonymous');

        $pengaduan = Pengaduan::create([
            'website_id'       => $website->id,
            'kode_laporan'     => Pengaduan::generateKodeLaporan(),
            'kategori'         => $validated['kategori'],
            'nama_lengkap'     => $isAnonymous ? 'Anonim' : ($validated['nama_lengkap'] ?? null),
            'nik'              => $isAnonymous ? null : ($validated['nik'] ?? null),
            'email'            => $isAnonymous ? null : ($validated['email'] ?? null),
            'telepon'          => $isAnonymous ? null : ($validated['telepon'] ?? null),
            'alamat'           => $isAnonymous ? null : ($validated['alamat'] ?? null),
            'pekerjaan'        => $validated['pekerjaan'] ?? null,
            'judul_laporan'    => $validated['judul_laporan'],
            'kronologis'       => $validated['kronologis'],
            'tanggal_kejadian' => $validated['tanggal_kejadian'],
            'status'           => 'baru',
            'is_anonymous'     => $isAnonymous,
        ]);

        return redirect()
            ->route('portal.pengaduan.cek', $website->slug)
            ->with('kode_laporan', $pengaduan->kode_laporan)
            ->with('success', 'Laporan berhasil dikirim! Simpan kode laporan Anda.');
    }

    public function cekStatus(Website $website)
    {
        return view('portal.pengaduan.cek', [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => $this->getMenus($website),
            'pengaduan' => null,
        ]);
    }

    public function hasilCek(Website $website, Request $request)
    {
        $request->validate(['kode_laporan' => 'required|string']);

        $pengaduan = Pengaduan::withoutGlobalScopes()
                              ->where('website_id', $website->id)
                              ->where('kode_laporan', strtoupper($request->kode_laporan))
                              ->first();

        return view('portal.pengaduan.cek', [
            'website'   => $website,
            'identity'  => $website->identity,
            'menus'     => $this->getMenus($website),
            'pengaduan' => $pengaduan,
            'kodeCari'  => $request->kode_laporan,
        ]);
    }

    public function wbs(Website $website)
    {
        $wbsAbout = WbsAbout::withoutGlobalScopes()
                            ->where('website_id', $website->id)
                            ->where('is_active', true)
                            ->first();

        return view('portal.wbs.form', [
            'website'   => $website,
            'identity'  => $website->identity,
            'menus'     => $this->getMenus($website),
            'wbsAbout'  => $wbsAbout,
        ]);
    }

    public function storeWbs(Website $website, Request $request)
    {
        $validated = $request->validate([
            'judul_laporan'    => 'required|string|max:255',
            'kronologis'       => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'unit_kerja'       => 'nullable|string|max:255',
        ]);

        $pengaduan = Pengaduan::create([
            'website_id'       => $website->id,
            'kode_laporan'     => Pengaduan::generateKodeLaporan(),
            'kategori'         => 'WBS',
            'nama_lengkap'     => 'Pelapor WBS',
            'judul_laporan'    => $validated['judul_laporan'],
            'kronologis'       => $validated['kronologis'],
            'tanggal_kejadian' => $validated['tanggal_kejadian'],
            'unit_kerja'       => $validated['unit_kerja'] ?? null,
            'status'           => 'baru',
            'is_anonymous'     => true,
        ]);

        return redirect()
            ->route('portal.wbs.index', $website->slug)
            ->with('kode_laporan', $pengaduan->kode_laporan)
            ->with('success', 'Laporan WBS berhasil dikirim. Catat kode laporan Anda.');
    }

    private function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }
}
