@extends('layouts.portal')
@section('title', $post->title)
@section('meta_desc', Str::limit(strip_tags($post->content), 160))

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-10">

        {{-- ============================
             ARTIKEL UTAMA
             ============================ --}}
        <article class="bg-surface p-6 md:p-10 rounded-3xl shadow-sm border border-border-base">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs text-text-muted mb-6 font-medium flex-wrap font-body">
                <a href="{{ route('portal.beranda', $website->slug) }}" class="hover:text-primary transition-colors">Beranda</a>
                <svg class="w-3 h-3 shrink-0 text-border-base" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('portal.berita.index', $website->slug) }}" class="hover:text-primary transition-colors">Berita</a>
                @if($post->category)
                <svg class="w-3 h-3 shrink-0 text-border-base" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                <span class="text-text-base">{{ $post->category->name }}</span>
                @endif
            </nav>

            {{-- Category & Meta --}}
            <div class="flex flex-wrap items-center gap-3 mb-6 font-body">
                @if($post->category)
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-primary-light text-primary uppercase tracking-wide">
                    {{ $post->category->name }}
                </span>
                @endif
                <span class="text-xs text-text-muted font-medium flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $post->published_at?->translatedFormat('d F Y') }}
                </span>
                @if($post->penulis)
                <span class="flex items-center gap-1.5 text-xs text-text-muted">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $post->penulis }}
                </span>
                @endif
                <span class="flex items-center gap-1.5 text-xs text-text-muted">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    {{ number_format($post->read) }}x dibaca
                </span>
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-black leading-tight text-text-base mb-8">
                {{ $post->title }}
            </h1>

            {{-- Foto Utama --}}
            @if($post->file)
            <div class="relative w-full rounded-2xl overflow-hidden mb-10 aspect-video bg-bg-base shadow-sm">
                <img src="{{ Storage::url($post->file->storage_path ?? $post->file->path ?? '') }}"
                     alt="{{ $post->title }}" onerror="this.onerror=null;this.src='{{ asset('images/gedung-bapenda-hero.jpg') }}'"
                     class="w-full h-full object-cover">
            </div>
            @endif

            {{-- Separator --}}
            <div class="h-px bg-border-base mb-10"></div>

            {{-- Konten Artikel --}}
            <div class="portal-prose text-text-base leading-relaxed text-base md:text-lg font-body">
                {!! \App\Support\RichContent::html($post->content) !!}
            </div>

            {{-- Tags --}}
            @if($post->tags && count($post->tags))
            <div class="flex flex-wrap gap-2 mt-12 pt-8 border-t border-border-base font-body">
                <span class="text-xs font-semibold text-text-muted self-center mr-2">Tag Terkait:</span>
                @foreach($post->tags as $tag)
                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-bg-base text-text-muted hover:bg-primary-light hover:text-primary transition-colors cursor-default border border-border-base">#{{ $tag }}</span>
                @endforeach
            </div>
            @endif

            {{-- Share --}}
            <div class="flex flex-wrap items-center gap-3 mt-8 pt-6 border-t border-border-base font-body">
                <span class="text-sm font-bold text-text-base mr-2">Bagikan Artikel:</span>
                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-[#1877F2] text-white hover:opacity-90 transition-opacity shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    Facebook
                </a>
                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" rel="noopener"
                   class="flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-[#25D366] text-white hover:opacity-90 transition-opacity shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                    WhatsApp
                </a>
                {{-- Copy Link --}}
                <button onclick="navigator.clipboard.writeText(window.location.href); this.textContent='✓ Disalin!'; setTimeout(()=>this.textContent='Salin Link', 2000)"
                        class="flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-bg-base text-text-muted hover:bg-border-base transition-colors cursor-pointer border border-border-base">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    Salin Link
                </button>
            </div>

        </article>

        {{-- ============================
             SIDEBAR
             ============================ --}}
        <aside>
            <div class="sticky top-28 space-y-6">

                {{-- Kembali --}}
                <a href="{{ route('portal.berita.index', $website->slug) }}"
                   class="flex items-center gap-2 px-6 py-4 rounded-2xl border border-border-base bg-surface text-text-base text-sm font-bold hover:border-primary/50 hover:text-primary transition-all group shadow-sm font-heading">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Indeks Berita
                </a>

                {{-- Berita Terkait --}}
                <div class="bg-surface rounded-3xl border border-border-base shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-border-base flex items-center gap-3">
                        <div class="w-1.5 h-6 rounded-full bg-primary"></div>
                        <h3 class="font-heading font-black text-text-base text-sm uppercase tracking-wider">Berita Terkait</h3>
                    </div>
                    <div class="p-4 space-y-2">
                        @forelse($related as $rel)
                        <a href="{{ route('portal.berita.show', [$website->slug, $rel->slug]) }}"
                           class="flex gap-4 group items-center p-2 rounded-xl hover:bg-bg-base transition-colors">
                            <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-bg-base border border-border-base">
                                @if($rel->file)
                                <img src="{{ Storage::url($rel->file->storage_path ?? $rel->file->path ?? '') }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                     alt="{{ $rel->title }}" onerror="this.onerror=null;this.src='{{ asset('images/gedung-bapenda-hero.jpg') }}'">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-navy to-primary-dark"></div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-heading font-bold leading-snug line-clamp-2 text-text-base group-hover:text-primary transition-colors mb-1">{{ $rel->title }}</p>
                                <p class="text-xs font-body text-text-muted flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $rel->published_at?->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                        @empty
                        <p class="text-sm text-text-muted text-center py-6 font-body border-2 border-dashed border-border-base rounded-xl m-2">Tidak ada berita terkait.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </aside>

    </div>
</div>

@endsection
