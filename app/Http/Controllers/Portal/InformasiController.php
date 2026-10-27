<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Menu;
use App\Models\Agenda;
use App\Traits\RendersDynamicPage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    use RendersDynamicPage;

    private function getCommonData(Website $website): array
    {
        return [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => Menu::getForWebsite($website),
        ];
    }

    public function agendaKerja(Website $website, Request $request)
    {
        $search = trim((string) $request->input('q', ''));
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (empty($startDate) && empty($endDate)) {
            $startDate = Carbon::today()->toDateString();
            $endDate = Carbon::today()->toDateString();
        } elseif (empty($startDate) && ! empty($endDate)) {
            $startDate = $endDate;
        } elseif (empty($endDate) && ! empty($startDate)) {
            $endDate = $startDate;
        }

        $query = Agenda::withoutGlobalScopes()
            ->where('website_id', $website->id);

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('caption', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if (! empty($startDate) && ! empty($endDate)) {
            $query->whereBetween(
                'schedule',
                [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()]
            );
        }

        $agendas = $query->orderByDesc('schedule')->get();

        // Halaman dibuka tanpa filter dan hari ini kosong: tampilkan tanggal agenda terakhir yang tersedia
        // (bila belum ada agenda lampau sama sekali, pakai agenda terdekat yang akan datang).
        $fallbackDate = null;
        $isDefaultView = $search === '' && ! $request->filled('start_date') && ! $request->filled('end_date');

        if ($agendas->isEmpty() && $isDefaultView) {
            $nearest = Agenda::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where('schedule', '<=', Carbon::today()->endOfDay())
                ->orderByDesc('schedule')
                ->first()
                ?? Agenda::withoutGlobalScopes()
                    ->where('website_id', $website->id)
                    ->where('schedule', '>', Carbon::today()->endOfDay())
                    ->orderBy('schedule')
                    ->first();

            if ($nearest) {
                $fallbackDate = $nearest->schedule->toDateString();
                $startDate = $endDate = $fallbackDate;
                $agendas = Agenda::withoutGlobalScopes()
                    ->where('website_id', $website->id)
                    ->whereBetween('schedule', [Carbon::parse($fallbackDate)->startOfDay(), Carbon::parse($fallbackDate)->endOfDay()])
                    ->orderByDesc('schedule')
                    ->get();
            }
        }

        // Saat tanggal pilihan kosong, siapkan tautan ke agenda terakhir sebelum tanggal itu.
        $previousAgendaDate = null;
        if ($agendas->isEmpty() && ! empty($startDate)) {
            $previousAgendaDate = Agenda::withoutGlobalScopes()
                ->where('website_id', $website->id)
                ->where('schedule', '<', Carbon::parse($startDate)->startOfDay())
                ->orderByDesc('schedule')
                ->value('schedule');
            $previousAgendaDate = $previousAgendaDate ? Carbon::parse($previousAgendaDate)->toDateString() : null;
        }

        return view('portal.informasi.agenda-kerja', array_merge(
            $this->getCommonData($website),
            compact('agendas', 'search', 'startDate', 'endDate', 'fallbackDate', 'previousAgendaDate')
        ));
    }

    public function skGubernur(Website $website)
    {
        return $this->renderMenuPage($website, 'sk-gubernur', 'portal.informasi.sk-gubernur', $this->getCommonData($website));
    }

    public function peraturanDaerah(Website $website)
    {
        return $this->renderMenuPage($website, 'peraturan-daerah', 'portal.informasi.peraturan-daerah', $this->getCommonData($website));
    }

    public function peraturanGubernur(Website $website)
    {
        return $this->renderMenuPage($website, 'peraturan-gubernur', 'portal.informasi.peraturan-gubernur', $this->getCommonData($website));
    }

    public function maklumatPelayananUptd(Website $website)
    {
        return $this->renderMenuPage($website, 'maklumat-pelayanan-uptd', 'portal.informasi.maklumat-pelayanan-uptd', $this->getCommonData($website));
    }

    public function inovasi(Website $website)
    {
        return $this->renderMenuPage($website, 'inovasi', 'portal.informasi.inovasi', $this->getCommonData($website));
    }
}
