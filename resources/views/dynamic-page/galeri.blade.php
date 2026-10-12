@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@push('styles')
<style>
.gallery-item { cursor: zoom-in; }
.gallery-lightbox { display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.92);align-items:center;justify-content:center; }
.gallery-lightbox.active { display:flex; }
.gallery-lightbox img { max-width:90vw;max-height:90vh;object-fit:contain;border-radius:1rem;box-shadow:0 25px 80px rgba(0,0,0,.5); }
</style>
@endpush

@section('content')
<section class="relative min-h-[500px] overflow-hidden bg-[#0c1e33]">
    <img src="{{ asset('images/background.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none opacity-10" alt="Background">
    <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    <div class="absolute top-10 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 pt-32 pb-16">
        <div class="relative z-10">
            @if($page->hero_badge)
            <span class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-4 tracking-[0.2em] uppercase">
                {{ $page->hero_badge }}
            </span>
            @endif
            @php
                $titleWordsGl = explode(' ', $page->title);
                $lastWordGl = array_pop($titleWordsGl);
                $firstWordsGl = implode(' ', $titleWordsGl);
            @endphp
            <h2 class="text-3xl md:text-5xl font-black text-white px-2 drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)] font-montserrat uppercase tracking-tight leading-[1.1]">
                {{ $firstWordsGl }}
                @if($lastWordGl)
                    <span class="text-[#00c458]">{{ $lastWordGl }}</span>
                @endif
            </h2>
            @if(!empty($content['subtitle']))
            <p class="text-white/60 mt-4 max-w-xl mx-auto text-sm">{{ $content['subtitle'] }}</p>
            @endif
        </div>
    </div>
</section>

<section class="relative bg-white py-16 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 32px 32px;"></div>
    <div class="container mx-auto px-6 relative z-10">
        @php $images = $content['images'] ?? []; @endphp
        @if(count($images) > 0)
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($images as $img)
            @php $imgPath = $img['image'] ?? null; @endphp
            @if($imgPath)
            <div class="gallery-item break-inside-avoid" onclick="openGallery('{{ asset('storage/'.$imgPath) }}')">
                <div class="relative group rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                    <img src="{{ asset('storage/'.$imgPath) }}" alt="{{ $img['caption'] ?? '' }}"
                         class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-500 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                    @if(!empty($img['caption']))
                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-white text-xs font-medium">{{ $img['caption'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-slate-400">
            <p class="font-bold uppercase tracking-widest">Belum ada foto di galeri ini.</p>
        </div>
        @endif
    </div>
</section>

<!-- Lightbox -->
<div id="gallery-lightbox" class="gallery-lightbox" onclick="closeGallery()">
    <button onclick="closeGallery()" class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="lightbox-img" src="" alt="">
</div>

@push('scripts')
<script>
function openGallery(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('gallery-lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeGallery() {
    document.getElementById('gallery-lightbox').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeGallery(); });
</script>
@endpush
@endsection
