@extends('layouts.portal')
@section('title', 'Dokumen Publik')
@section('meta_desc', 'Repository dokumen publik, regulasi, dan informasi resmi dari Bapenda Provinsi Kalimantan Timur.')

@section('content')

{{-- ============================
     PAGE HERO
     ============================ --}}
<section class="relative bg-[#042f2e] overflow-hidden pt-24 md:pt-40">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-14 md:py-18">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-emerald-300/70 mb-6 font-medium flex-wrap">
            <a href="{{ route('portal.beranda', $website->slug) }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('portal.dokumen.index', $website->slug) }}" class="hover:text-white transition-colors {{ !count($breadcrumbs) ? 'text-white' : '' }}">Dokumen Publik</a>
            @foreach($breadcrumbs as $crumb)
            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('portal.dokumen.index', [$website->slug]).'?folder='.$crumb->id }}"
               class="hover:text-white transition-colors {{ $loop->last ? 'text-white' : '' }}">{{ $crumb->title }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center border border-emerald-500/30">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
            </div>
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-2 border border-emerald-500/30">
                    Transparansi & Keterbukaan
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white" style="font-family: 'Montserrat', sans-serif;">
                    @if(count($breadcrumbs)) {{ collect($breadcrumbs)->last()->title }} @else Dokumen Publik @endif
                </h1>
            </div>
        </div>
    </div>
</section>

{{-- ============================
     KONTEN DOKUMEN
     ============================ --}}
<div class="max-w-6xl mx-auto px-4 py-12">

    @if($items->count())

    {{-- File type legend + count --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <p class="text-sm text-slate-500">
            Menampilkan <span class="font-bold text-slate-700">{{ $items->count() }}</span> item
        </p>
        <div class="flex items-center gap-3 text-xs text-slate-500 flex-wrap">
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-red-100 border border-red-300"></span> PDF</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-blue-100 border border-blue-300"></span> Word</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-green-100 border border-green-300"></span> Excel</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-amber-100 border border-amber-300"></span> Folder</span>
        </div>
    </div>

    {{-- Grid Dokumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($items as $item)

        @php
            $ext = strtolower($item->type ?? '');
            $isFolder = $item->is_folder;
            // Warna & icon per tipe
            if ($isFolder) {
                $bg = 'bg-amber-50'; $border = 'border-amber-200'; $iconColor = 'text-amber-500'; $badgeBg = 'bg-amber-100 text-amber-700';
            } elseif (in_array($ext, ['pdf'])) {
                $bg = 'bg-red-50'; $border = 'border-red-200'; $iconColor = 'text-red-500'; $badgeBg = 'bg-red-100 text-red-700';
            } elseif (in_array($ext, ['doc', 'docx'])) {
                $bg = 'bg-blue-50'; $border = 'border-blue-200'; $iconColor = 'text-blue-500'; $badgeBg = 'bg-blue-100 text-blue-700';
            } elseif (in_array($ext, ['xls', 'xlsx', 'csv'])) {
                $bg = 'bg-green-50'; $border = 'border-green-200'; $iconColor = 'text-green-600'; $badgeBg = 'bg-green-100 text-green-700';
            } else {
                $bg = 'bg-slate-50'; $border = 'border-slate-200'; $iconColor = 'text-slate-400'; $badgeBg = 'bg-slate-100 text-slate-600';
            }
        @endphp

        <div class="bg-white rounded-2xl border {{ $border }} shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col overflow-hidden group">

            {{-- Icon area --}}
            <div class="{{ $bg }} p-6 flex items-center justify-center border-b {{ $border }}">
                @if($isFolder)
                    <svg class="w-14 h-14 {{ $iconColor }}" fill="currentColor" viewBox="0 0 24 24"><path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/></svg>
                @elseif($ext === 'pdf')
                    <svg class="w-14 h-14 {{ $iconColor }}" fill="currentColor" viewBox="0 0 384 512"><path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 38-13.6 57.1-17.2-10.1-23.6-21.5-46.5-28.7-45.5zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-5.6 14.3-12.4 30.8-20.4 49.4-19.1 8.2-28 16.4-29.2 16.4-40.9 22.9-29.7 48.3-14.1 48.3 10.9 0 32.1-13.5 50.5-45.6 17.1-5.7 36.4-11.6 55.3-15.6 18.2 9.9 38 14.5 51.3 14.5 32.7 0 37.5-25.8 22.9-42.1 0 0 .1 0-.1.5zm-141.5 54.7c2.9-3.5 6.5-6.7 12.5-10.2-2.2 3.9-12.5 10.2-12.5 10.2zm130.3-20.3c-7.1-5.5-13.5-22-7.8-22 4.5 0 10.5 15.4 7.8 22z"/></svg>
                @elseif(in_array($ext, ['doc','docx']))
                    <svg class="w-14 h-14 {{ $iconColor }}" fill="currentColor" viewBox="0 0 384 512"><path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm57.1 120H208v16h73.1c4.4 0 8 3.6 8 8s-3.6 8-8 8H208v16h73.1c4.4 0 8 3.6 8 8s-3.6 8-8 8H208v16h73.1c4.4 0 8 3.6 8 8s-3.6 8-8 8H208v8c0 8.8-7.2 16-16 16h-48c-8.8 0-16-7.2-16-16V256c0-8.8 7.2-16 16-16h96v-16h-96c-8.8 0-16-7.2-16-16s7.2-16 16-16h96v-8c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v8h73.1c4.4 0 8 3.6 8 8s-3.6 8-8 8zm64-144L217.9 8C214.1 2.8 209.4 0 204.6 0H192v128h128v-16z"/></svg>
                @elseif(in_array($ext, ['xls','xlsx','csv']))
                    <svg class="w-14 h-14 {{ $iconColor }}" fill="currentColor" viewBox="0 0 384 512"><path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm60.1 106.5L224 336l60.1 93.5c5.1 8-.6 18.5-10.1 18.5h-34.9c-4.4 0-8.5-2.4-10.6-6.3C208.9 405.5 192 373 192 373c-6.4 14.8-10 20.7-36.6 68.7-2.1 3.9-6.1 6.3-10.5 6.3H110c-9.5 0-15.2-10.5-10.1-18.5l60.3-93.5-60.3-93.5c-5.2-8 .6-18.5 10.1-18.5h34.8c4.4 0 8.5 2.4 10.6 6.3 26.1 48.8 20 33.6 36.6 68.5 0 0 6.1-11.7 36.6-68.5 2.1-3.9 6.2-6.3 10.6-6.3H274c9.5-.1 15.2 10.4 10.1 18.5z"/></svg>
                @else
                    <svg class="w-14 h-14 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                @endif
            </div>

            {{-- Info area --}}
            <div class="p-4 flex flex-col flex-grow">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="text-sm font-bold text-slate-800 leading-snug line-clamp-2 flex-grow group-hover:text-emerald-700 transition-colors">
                        {{ $item->title }}
                    </h3>
                    @if(!$isFolder)
                    <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $badgeBg }}">{{ $ext ?: 'FILE' }}</span>
                    @else
                    <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $badgeBg }}">Folder</span>
                    @endif
                </div>

                @if(!$isFolder)
                <div class="flex items-center gap-3 text-[11px] text-slate-400 mt-1 mb-4">
                    <span>{{ $item->file_size_formatted }}</span>
                    <span>·</span>
                    <span>{{ $item->download_count }}x diunduh</span>
                </div>
                @else
                <div class="mt-1 mb-4"></div>
                @endif

                {{-- Actions --}}
                <div class="mt-auto flex gap-2">
                    @if($isFolder)
                    <a href="{{ route('portal.dokumen.index', [$website->slug]).'?folder='.$item->id }}"
                       class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/></svg>
                        Buka Folder
                    </a>
                    @else
                    <a href="{{ route('portal.dokumen.download', [$website->slug, $item->share_code]) }}"
                       class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh
                    </a>
                    @endif
                </div>
            </div>
        </div>

        @endforeach
    </div>

    @else

    {{-- Empty State --}}
    <div class="text-center py-24">
        <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Dokumen</h3>
        <p class="text-slate-400 text-sm">Folder ini masih kosong atau dokumen belum dipublikasikan.</p>
    </div>

    @endif

</div>

@endsection
