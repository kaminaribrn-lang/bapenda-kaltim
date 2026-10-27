@extends('layouts.portal')
@section('title', 'Agenda Kerja')

@section('content')

@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Informasi Lainnya', 'url' => '#'],
        ['label' => 'Agenda Kerja', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Agenda Kerja" :breadcrumbs="$breadcrumbs" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        <article class="reveal">
            <div class="bg-surface rounded-3xl shadow-sm border border-border-base p-4 md:p-6 mb-8">
                <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-light text-primary text-[10px] font-black uppercase tracking-widest border border-primary/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Jadwal Kegiatan
                    </div>
                    <span class="text-xs font-medium text-text-muted">
                        @if($startDate && $endDate)
                            Rentang: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                        @else
                            Tanggal aktif: {{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}
                        @endif
                    </span>
                </div>

                @if($fallbackDate ?? null)
                    <div class="mb-6 rounded-2xl border border-primary/20 bg-primary-light px-4 py-3 text-sm text-text-base">
                        Tidak ada agenda pada hari ini ({{ \Carbon\Carbon::today()->translatedFormat('d F Y') }}).
                        Menampilkan agenda {{ \Carbon\Carbon::parse($fallbackDate)->isFuture() ? 'terdekat berikutnya' : 'terakhir' }}
                        pada <strong>{{ \Carbon\Carbon::parse($fallbackDate)->translatedFormat('d F Y') }}</strong>.
                    </div>
                @endif

                <div class="mb-6 rounded-2xl border border-border-base bg-bg-base p-3 md:p-4">
                    <form method="GET" class="flex flex-col md:flex-row md:items-end gap-3">
                        <div class="flex-1 min-w-[180px]">
                            <label for="q" class="block text-[11px] font-bold uppercase tracking-[0.12em] text-text-muted mb-1.5">Pencarian</label>
                            <input type="text" id="q" name="q" value="{{ $search }}" placeholder="Cari judul, lokasi, atau deskripsi..." class="w-full rounded-xl border border-border-base bg-surface px-3 py-2.5 text-sm text-text-base placeholder-text-muted focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/15">
                        </div>

                        <div class="w-full md:w-52">
                            <label for="start_date" class="block text-[11px] font-bold uppercase tracking-[0.12em] text-text-muted mb-1.5">Tanggal Mulai</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $startDate ?? '' }}" class="w-full rounded-xl border border-border-base bg-surface px-3 py-2.5 text-sm text-text-base focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/15">
                        </div>

                        <div class="w-full md:w-52">
                            <label for="end_date" class="block text-[11px] font-bold uppercase tracking-[0.12em] text-text-muted mb-1.5">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $endDate ?? '' }}" class="w-full rounded-xl border border-border-base bg-surface px-3 py-2.5 text-sm text-text-base focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/15">
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-surface hover:bg-primary-dark transition-colors">
                                Cari
                            </button>
                            <a href="{{ route('portal.informasi.agenda-kerja', $website->slug) }}" class="inline-flex items-center justify-center rounded-xl border border-border-base bg-surface px-4 py-2.5 text-sm font-medium text-text-muted hover:bg-bg-base transition-colors">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                @if($agendas->count())
                    <div class="overflow-x-auto rounded-2xl border border-border-base">
                        <table class="min-w-full divide-y divide-border-base text-left text-sm">
                            <thead class="bg-bg-base">
                                <tr>
                                    <th class="px-3 py-3 text-[11px] font-black uppercase tracking-[0.12em] text-text-muted">Tanggal</th>
                                    <th class="px-3 py-3 text-[11px] font-black uppercase tracking-[0.12em] text-text-muted">Agenda</th>
                                    <th class="px-3 py-3 text-[11px] font-black uppercase tracking-[0.12em] text-text-muted">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-base bg-surface">
                                @foreach($agendas as $agenda)
                                    <tr class="hover:bg-bg-base/60 transition-colors">
                                        <td class="px-3 py-3 align-top whitespace-nowrap">
                                            <div class="font-semibold text-text-base">{{ $agenda->schedule?->translatedFormat('d F Y') }}</div>
                                            <div class="text-[11px] text-text-muted uppercase tracking-wide">{{ $agenda->schedule?->translatedFormat('D') }}</div>
                                        </td>
                                        <td class="px-3 py-3 align-top">
                                            <div class="font-semibold text-text-base leading-snug">{{ $agenda->caption ?? 'Agenda Kerja' }}</div>
                                            @if($agenda->description)
                                                <div class="mt-1 text-xs text-text-muted leading-relaxed">{{ Str::limit(strip_tags($agenda->description), 140) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 align-top text-text-muted">
                                            {{ $agenda->location ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16 bg-bg-base rounded-2xl border border-border-base border-dashed">
                        <div class="w-14 h-14 rounded-full bg-surface text-text-muted flex items-center justify-center mx-auto mb-4 shadow-sm border border-border-base">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-heading font-bold text-base text-text-base mb-2">Tidak Ada Agenda</h3>
                        <p class="font-body text-text-muted text-sm max-w-md mx-auto">Belum ada agenda yang sesuai dengan pencarian atau tanggal yang dipilih.</p>
                        @if($previousAgendaDate ?? null)
                            <a href="{{ route('portal.informasi.agenda-kerja', ['website' => $website->slug, 'start_date' => $previousAgendaDate, 'end_date' => $previousAgendaDate]) }}"
                               class="mt-5 inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-surface hover:opacity-90 transition">
                                Lihat agenda terakhir ({{ \Carbon\Carbon::parse($previousAgendaDate)->translatedFormat('d F Y') }})
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </article>

        @include('portal.informasi.partials.sidebar')

    </div>
</div>


@endsection
