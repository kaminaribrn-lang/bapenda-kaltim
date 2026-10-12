@extends('layouts.portal')
@section('title', 'PPID — Keterbukaan Informasi Publik')
@section('meta_desc', 'Pejabat Pengelola Informasi dan Dokumentasi Bapenda Kaltim. Akses informasi publik sesuai UU No. 14 Tahun 2008.')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'PPID', 'url' => null]
    ];
@endphp
<x-portal.page-header title="PPID Bapenda Kaltim" :breadcrumbs="$breadcrumbs">
    <p class="text-surface/80 text-lg max-w-2xl mx-auto font-body">
        Mewujudkan tata kelola pemerintahan yang transparan dan akuntabel sesuai <strong>UU No. 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik.
    </p>
    <div class="mt-8">
        <a href="{{ route('portal.ppid.permohonan', $website->slug) }}"
           class="inline-flex items-center gap-2.5 px-7 py-4 rounded-xl bg-surface text-primary font-bold text-sm transition-all shadow-lg hover:bg-bg-base hover:-translate-y-0.5 group">
            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Ajukan Permohonan Informasi
        </a>
    </div>
</x-portal.page-header>

{{-- 3 PILAR INFO PPID --}}
<div class="bg-surface border-b border-border-base">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'primary', 'title' => 'Informasi Berkala', 'desc' => 'Diumumkan secara rutin minimal 6 bulan sekali tanpa diminta.'],
                ['icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color' => 'blue', 'title' => 'Informasi Serta-merta', 'desc' => 'Diumumkan seketika karena menyangkut hajat hidup orang banyak.'],
                ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'amber', 'title' => 'Informasi Atas Permintaan', 'desc' => 'Direspons paling lambat 10 hari kerja sejak permohonan diterima.'],
            ] as $pilar)
            <div class="flex items-start gap-4 p-5 rounded-2xl border border-border-base bg-bg-base hover:shadow-md transition-shadow">
                @php 
                    $bgClass = $pilar['color'] === 'primary' ? 'bg-primary-light text-primary' : ($pilar['color'] === 'blue' ? 'bg-blue-50 text-blue-600' : 'bg-amber-50 text-amber-600');
                @endphp
                <div class="w-12 h-12 rounded-xl {{ $bgClass }} flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $pilar['icon'] }}"/></svg>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-text-base mb-1">{{ $pilar['title'] }}</h3>
                    <p class="text-text-muted text-sm leading-relaxed font-body">{{ $pilar['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- TATA CARA KEBERATAN --}}
<section id="permohonan-keberatan" class="scroll-mt-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-4 reveal">
    <div class="rounded-3xl border border-border-base bg-surface p-8 shadow-sm border-l-4 border-l-amber-500">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h2 class="text-xl font-heading font-black text-text-base mb-2">Tata Cara Pengajuan Keberatan</h2>
                <p class="text-sm text-text-muted leading-relaxed max-w-3xl font-body">
                    Apabila permohonan informasi ditolak atau tidak dipenuhi sesuai ketentuan peraturan perundang-undangan, pemohon dapat mengajukan keberatan melalui prosedur yang ditetapkan.
                    Untuk informasi lebih lanjut hubungi unit PPID atau gunakan kanal resmi instansi.
                </p>
                <a href="{{ route('portal.kontak.index', $website->slug) }}" class="inline-flex mt-4 px-5 py-2.5 bg-bg-base hover:bg-border-base text-text-base text-sm font-bold rounded-xl transition-colors border border-border-base">
                    Hubungi PPID
                </a>
            </div>
        </div>
    </div>
</section>

{{-- DAFTAR INFORMASI PPID --}}
<section id="daftar-informasi-publik" class="scroll-mt-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 reveal">

    @if($ppids->count())

    <div class="flex flex-col items-center justify-center text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-bold uppercase tracking-widest mb-4">
            Repository Informasi
        </div>
        <h2 class="text-3xl md:text-4xl font-heading font-black text-text-base">Daftar Informasi Publik</h2>
        <div class="h-1 w-20 bg-primary rounded-full mt-6"></div>
    </div>

    <div class="space-y-6" x-data="{ openSection: 0 }">
        @foreach($ppids as $idx => $ppid)
        <div class="bg-surface rounded-2xl border border-border-base shadow-sm overflow-hidden">

            {{-- Section Header --}}
            <button class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-bg-base transition-colors cursor-pointer focus:outline-none"
                    @click="openSection = openSection === {{ $idx }} ? null : {{ $idx }}">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-primary-light text-primary flex items-center justify-center shrink-0 font-heading font-black text-base border border-primary/20">
                        {{ $idx + 1 }}
                    </div>
                    <div class="text-left">
                        <h3 class="font-heading font-bold text-text-base text-lg">{{ $ppid->name }}</h3>
                        @if($ppid->description)
                        <p class="text-text-muted text-sm mt-0.5 font-body">{{ $ppid->description }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-3 shrink-0 ml-4">
                    @if($ppid->items->count())
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-200">
                        {{ $ppid->items->count() }} Dokumen
                    </span>
                    @endif
                    <div class="w-8 h-8 rounded-full bg-bg-base flex items-center justify-center border border-border-base transition-transform duration-300"
                         :class="openSection === {{ $idx }} ? 'rotate-180 bg-primary text-surface border-primary' : 'text-text-muted'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </button>

            {{-- Section Content --}}
            <div x-show="openSection === {{ $idx }}" x-collapse x-cloak>
                @if($ppid->items->count())
                <div class="border-t border-border-base overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-bg-base border-b border-border-base">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider w-16">No</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Nama Informasi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider hidden md:table-cell">Format</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider hidden md:table-cell">Penanggungjawab</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-base">
                            @foreach($ppid->items as $i => $item)
                            <tr class="hover:bg-bg-base transition-colors">
                                <td class="px-6 py-4 text-text-muted font-body text-sm">{{ $i+1 }}</td>
                                <td class="px-6 py-4 font-heading font-bold text-text-base text-sm">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-text-muted hidden md:table-cell">
                                    @if($item->format_informasi)
                                    <span class="px-2.5 py-1 rounded-md text-xs bg-surface border border-border-base font-medium uppercase tracking-wider">{{ $item->format_informasi }}</span>
                                    @else —
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-text-muted hidden md:table-cell text-sm">{{ $item->penanggung_jawab ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary hover:bg-primary-dark text-surface text-xs font-bold transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Unduh
                                    </a>
                                    @else
                                    <span class="text-text-muted text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                {{-- Sub-kategori --}}
                @if($ppid->children->count())
                <div class="border-t border-border-base p-6 space-y-6 bg-bg-base">
                    @foreach($ppid->children as $child)
                    <div class="bg-surface rounded-2xl border border-border-base p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-2 h-6 rounded-full bg-primary"></div>
                            <h4 class="font-heading font-bold text-text-base text-base">{{ $child->name }}</h4>
                        </div>
                        @if($child->items->count())
                        <div class="overflow-x-auto rounded-xl border border-border-base">
                            <table class="min-w-full text-sm">
                                <thead class="bg-bg-base border-b border-border-base">
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-bold text-text-muted w-12">No</th>
                                        <th class="px-5 py-3 text-left text-xs font-bold text-text-muted">Nama</th>
                                        <th class="px-5 py-3 text-left text-xs font-bold text-text-muted hidden md:table-cell">Penanggungjawab</th>
                                        <th class="px-5 py-3 text-left text-xs font-bold text-text-muted">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-base bg-surface">
                                    @foreach($child->items as $j => $item)
                                    <tr class="hover:bg-bg-base transition-colors">
                                        <td class="px-5 py-3 text-text-muted font-body text-xs">{{ $j+1 }}</td>
                                        <td class="px-5 py-3 font-heading font-bold text-text-base text-sm">{{ $item->name }}</td>
                                        <td class="px-5 py-3 text-text-muted hidden md:table-cell text-xs">{{ $item->penanggung_jawab ?? '—' }}</td>
                                        <td class="px-5 py-3">
                                            @if($item->file)
                                            <a href="{{ Storage::url($item->file) }}" target="_blank"
                                               class="text-primary text-sm font-bold hover:underline flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                Unduh
                                            </a>
                                            @else
                                            <span class="text-text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @else
    {{-- Empty State --}}
    <div class="text-center py-24 bg-surface rounded-3xl border border-border-base">
        <div class="w-20 h-20 rounded-3xl bg-bg-base border border-border-base flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-heading font-black text-text-base mb-2">Data PPID Belum Tersedia</h3>
        <p class="text-text-muted text-sm font-body">Informasi publik akan segera dipublikasikan di sini.</p>
    </div>
    @endif

</section>

{{-- CTA BANNER --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 reveal">
    <div class="bg-navy rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-5 mix-blend-overlay"></div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary rounded-full blur-[80px] opacity-30 pointer-events-none"></div>

        <div class="relative z-10">
            <h3 class="text-2xl md:text-3xl font-heading font-black text-surface mb-3">
                Tidak Menemukan Informasi yang Dicari?
            </h3>
            <p class="text-surface/80 text-base max-w-xl font-body">
                Ajukan permohonan informasi publik secara resmi. Tim PPID kami akan merespons dalam waktu <strong class="text-surface font-bold">10 hari kerja</strong>.
            </p>
        </div>
        <a href="{{ route('portal.ppid.permohonan', $website->slug) }}"
           class="shrink-0 relative z-10 inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-surface font-bold text-base transition-colors shadow-lg">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Ajukan Permohonan
        </a>
    </div>
</section>

@endsection
