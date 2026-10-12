@props(['website', 'post'])
<div class="bg-surface rounded-2xl border border-border-base shadow-sm overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all duration-300 reveal">
    {{-- Image --}}
    <a href="{{ route('portal.berita.show', [$website->slug, $post->slug]) }}" class="block relative aspect-[16/10] overflow-hidden bg-bg-base">
        @if($post->file)
        <img src="{{ Storage::url($post->file->storage_path ?? $post->file->path ?? '') }}" alt="{{ $post->title }}" onerror="this.onerror=null;this.src='{{ asset('images/gedung-bapenda-hero.jpg') }}'"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
        <div class="w-full h-full flex items-center justify-center text-text-subtle">
            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        @endif
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full bg-red-600 text-white text-[10px] font-semibold uppercase tracking-wider shadow-[0_0_8px_rgba(220,38,38,0.4)]">
                {{ $post->category->name ?? 'INFO' }}
            </span>
        </div>
    </a>
    {{-- Content --}}
    <div class="p-6">
        <div class="flex items-center gap-2 text-[10px] font-semibold text-text-subtle uppercase tracking-wider mb-3">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $post->published_at?->translatedFormat('d F Y') }}
        </div>
        <h3 class="text-base font-bold text-text-base leading-snug group-hover:text-red-600 transition-colors mb-3 line-clamp-2">
            <a href="{{ route('portal.berita.show', [$website->slug, $post->slug]) }}">{{ $post->title }}</a>
        </h3>
        <p class="text-sm text-text-muted line-clamp-2 mb-5 leading-relaxed">
            {{ Str::limit(strip_tags($post->body), 100) }}
        </p>
        <a href="{{ route('portal.berita.show', [$website->slug, $post->slug]) }}" 
           class="inline-flex items-center gap-2 text-xs font-semibold text-primary group-hover:text-red-600 transition-colors group/link">
            Baca Selengkapnya
            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>

