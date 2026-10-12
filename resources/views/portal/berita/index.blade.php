@extends('layouts.portal')
@section('title', 'Berita & Informasi')
@section('meta_desc', 'Berita, pengumuman, dan informasi terkini dari Badan Pendapatan Daerah Provinsi Kalimantan Timur.')

@section('content')

{{-- ============================
     PAGE HERO
     ============================ --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Berita & Informasi', 'url' => null]
    ];
@endphp
<x-portal.page-header :title="'Berita & Pengumuman'" :breadcrumbs="$breadcrumbs">
    <p class="text-surface/80 text-lg max-w-2xl mx-auto font-body">
        Informasi resmi dan pengumuman terbaru dari Bapenda Kaltim.
    </p>
</x-portal.page-header>

{{-- ============================
     FILTER BAR (Sticky)
     ============================ --}}
<div class="sticky top-20 z-30 bg-surface/95 backdrop-blur-md border-b border-border-base shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" class="flex flex-wrap items-center gap-3 md:gap-4">
            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px]">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari berita atau pengumuman..."
                       class="w-full pl-12 pr-4 py-3 rounded-xl border border-border-base text-sm text-text-base placeholder-text-muted bg-bg-base focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
            </div>

            {{-- Kategori --}}
            <select name="kategori" class="px-5 py-3 rounded-xl border border-border-base text-sm text-text-base bg-bg-base focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer min-w-[180px]">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" @selected($cat->slug === $categorySlug)>{{ $cat->name }}</option>
                @endforeach
            </select>

            {{-- Submit --}}
            <button type="submit" class="px-6 py-3 rounded-xl bg-primary hover:bg-primary-dark text-surface font-semibold text-sm transition-colors flex items-center gap-2 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari
            </button>

            @if($search || $categorySlug)
            <a href="{{ route('portal.berita.index', $website->slug) }}"
               class="px-5 py-3 rounded-xl border border-border-base text-sm text-text-muted hover:bg-bg-base hover:text-text-base transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Reset
            </a>
            @endif
        </form>
    </div>
</div>

{{-- ============================
     KONTEN UTAMA
     ============================ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">

    @if($posts->count())

    {{-- Featured Post (post pertama) --}}
    @php $featured = $posts->first(); $restPosts = $posts->skip(1); @endphp

    @if(!$search && !$categorySlug && $posts->currentPage() === 1)
    <div class="mb-14 reveal">
        <a href="{{ route('portal.berita.show', [$website->slug, $featured->slug]) }}"
           class="group flex flex-col lg:flex-row gap-0 bg-surface rounded-3xl overflow-hidden border border-border-base shadow-sm hover:shadow-lg hover:border-primary/30 transition-all duration-300">
            {{-- Image --}}
            <div class="lg:w-[55%] aspect-video lg:aspect-auto overflow-hidden bg-bg-base relative">
                @if($featured->file)
                <img src="{{ Storage::url($featured->file->storage_path ?? $featured->file->path ?? '') }}"
                     alt="{{ $featured->title }}" onerror="this.onerror=null;this.src='{{ asset('images/gedung-bapenda-hero.jpg') }}'"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @else
                <div class="w-full h-full bg-gradient-to-br from-navy to-primary-dark flex items-center justify-center">
                    <svg class="w-20 h-20 text-primary-light/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endif
                <div class="absolute top-4 left-4 flex items-center gap-2">
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-primary text-surface uppercase shadow-sm">
                        {{ $featured->category->name ?? 'Berita' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-red-600 font-bold bg-surface/95 backdrop-blur px-3 py-1.5 rounded-full border border-red-100 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                        Terkini
                    </span>
                </div>
            </div>
            {{-- Info --}}
            <div class="lg:w-[45%] p-8 lg:p-12 flex flex-col justify-center">
                <h2 class="text-2xl md:text-4xl font-heading font-black text-text-base leading-tight mb-4 group-hover:text-primary transition-colors">
                    {{ $featured->title }}
                </h2>
                @if($featured->excerpt ?? strip_tags($featured->content))
                <p class="text-text-muted text-base leading-relaxed mb-8 line-clamp-3 font-body">
                    {{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 180) }}
                </p>
                @endif
                <div class="flex flex-wrap items-center justify-between pt-6 border-t border-border-base gap-4">
                    <div class="flex items-center gap-4 text-xs font-medium text-text-muted font-mono">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $featured->published_at?->translatedFormat('d F Y') }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ number_format($featured->read) }}x
                        </span>
                    </div>
                    <span class="flex items-center gap-1 text-sm font-bold text-primary group-hover:gap-2 transition-all">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </div>
        </a>
    </div>

    {{-- Section divider --}}
    <div class="flex items-center gap-4 mb-10">
        <h2 class="text-xl font-heading font-black text-text-base uppercase tracking-wider shrink-0">Berita Lainnya</h2>
        <div class="h-px bg-border-base flex-grow"></div>
    </div>

    {{-- Grid berita (sisanya) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12 reveal">
        @foreach($restPosts as $post)
        <x-portal.post-card :post="$post" :website="$website" />
        @endforeach
    </div>

    @else

    {{-- Grid berita (semua, saat search/filter aktif) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 reveal">
        @foreach($posts as $post)
        <x-portal.post-card :post="$post" :website="$website" />
        @endforeach
    </div>

    @endif

    {{-- Pagination --}}
    <div class="mt-8 flex justify-center">
        {{ $posts->appends(request()->query())->links() }}
    </div>

    @else

    {{-- Empty State --}}
    <div class="text-center py-24 bg-surface rounded-3xl shadow-sm border border-border-base reveal">
        <div class="w-24 h-24 rounded-full bg-bg-base flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-text-muted/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h3 class="text-2xl font-heading font-bold text-text-base mb-3">Tidak Ada Berita Ditemukan</h3>
        <p class="text-text-muted text-base mb-8 font-body max-w-md mx-auto">Kami tidak dapat menemukan berita dengan kata kunci atau filter tersebut. Coba gunakan istilah lain.</p>
        <a href="{{ route('portal.berita.index', $website->slug) }}"
           class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-primary text-surface font-bold hover:bg-primary-dark transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Reset Pencarian
        </a>
    </div>

    @endif

</div>

@endsection
