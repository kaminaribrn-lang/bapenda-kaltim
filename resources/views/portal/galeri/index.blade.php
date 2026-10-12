@extends('layouts.portal')
@section('title', 'Galeri Foto Kegiatan')
@section('meta_desc', 'Dokumentasi foto kegiatan dan program Badan Pendapatan Daerah Provinsi Kalimantan Timur.')

@section('content')

{{-- ============================
     PAGE HERO
     ============================ --}}
<section class="relative bg-[#042f2e] overflow-hidden pt-24 md:pt-40">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-500 rounded-full blur-[130px] opacity-10 pointer-events-none translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-16 md:py-20">
        <nav class="flex items-center gap-2 text-xs text-emerald-300/70 mb-6 font-medium">
            <a href="{{ route('portal.beranda', $website->slug) }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Galeri Foto</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-4 border border-emerald-500/30">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Dokumentasi Kegiatan
        </div>
        <h1 class="text-3xl md:text-5xl font-black text-white leading-tight" style="font-family: 'Montserrat', sans-serif;">
            Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Foto</span>
        </h1>
    </div>
</section>

{{-- ============================
     GRID MASONRY GALERI
     ============================ --}}
<div class="max-w-6xl mx-auto px-4 py-12">

    @if($galleries->count())

    <div class="columns-2 md:columns-3 lg:columns-4 gap-3 space-y-3 reveal"
         x-data="{
             lightbox: null,
             lightboxCaption: '',
             current: 0,
             images: {{ $galleries->where('file', '!=', null)->map(fn($g) => ['src' => Storage::url($g->file->storage_path ?? $g->file->path ?? ''), 'caption' => $g->caption])->values()->toJson() }},
             open(idx) { this.current = idx; this.lightbox = this.images[idx]?.src; this.lightboxCaption = this.images[idx]?.caption; },
             prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; this.lightbox = this.images[this.current]?.src; this.lightboxCaption = this.images[this.current]?.caption; },
             next() { this.current = (this.current + 1) % this.images.length; this.lightbox = this.images[this.current]?.src; this.lightboxCaption = this.images[this.current]?.caption; },
             close() { this.lightbox = null; }
         }">

        @foreach($galleries as $i => $gallery)
        @php $imgUrl = $gallery->file ? Storage::url($gallery->file->storage_path ?? $gallery->file->path ?? '') : null; @endphp
        @if($imgUrl)
        <div class="break-inside-avoid rounded-2xl overflow-hidden group cursor-zoom-in shadow-sm hover:shadow-xl transition-all duration-300 relative mb-3"
             @click="open({{ $i }})">
            <img src="{{ $imgUrl }}"
                 alt="{{ $gallery->caption }}"
                 loading="lazy"
                 class="w-full object-cover group-hover:scale-105 transition-transform duration-700">
            {{-- Hover Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                @if($gallery->caption)
                <p class="text-white text-xs font-semibold line-clamp-2 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">{{ $gallery->caption }}</p>
                @endif
            </div>
            {{-- Zoom icon --}}
            <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
            </div>
        </div>
        @endif
        @endforeach

        {{-- Lightbox Modal --}}
        <div x-show="lightbox" x-cloak
             class="fixed inset-0 z-[999] bg-black/95 flex flex-col items-center justify-center p-4"
             @click.self="close()" @keydown.escape.window="close()"
             @keydown.arrow-left.window="prev()" @keydown.arrow-right.window="next()"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Close --}}
            <button @click="close()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition z-10 cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            {{-- Prev --}}
            <button @click.stop="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition z-10 cursor-pointer">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>

            {{-- Image --}}
            <img :src="lightbox" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain" :alt="lightboxCaption">

            {{-- Caption --}}
            <p x-show="lightboxCaption" x-text="lightboxCaption" class="text-white/70 text-sm mt-4 text-center max-w-lg"></p>

            {{-- Counter --}}
            <p class="text-white/40 text-xs mt-2" x-text="(current+1) + ' / ' + images.length"></p>

            {{-- Next --}}
            <button @click.stop="next()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition z-10 cursor-pointer">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $galleries->links() }}
    </div>

    @else

    {{-- Empty State --}}
    <div class="text-center py-24">
        <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Foto</h3>
        <p class="text-slate-400 text-sm">Galeri foto kegiatan akan segera hadir.</p>
    </div>

    @endif

</div>

@endsection
