@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@push('styles')
<style>
.profil-numbered-list ol { list-style:none!important;padding:0!important;margin:0!important;counter-reset:profil-counter;display:flex;flex-direction:column;gap:.625rem; }
.profil-numbered-list ol li { counter-increment:profil-counter;display:flex!important;align-items:flex-start;gap:.875rem;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.10);border-radius:.75rem;padding:.75rem 1rem;color:rgba(255,255,255,.88)!important;font-size:.9rem;line-height:1.5;transition:background .2s; }
.profil-numbered-list ol li:hover { background:rgba(255,255,255,.11); }
.profil-numbered-list ol li::before { content:counter(profil-counter)!important;min-width:2rem;height:2rem;background:#10b981;border-radius:.4rem;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem;color:#fff;flex-shrink:0;margin-top:.05rem; }
.profil-numbered-list p { color:rgba(255,255,255,.85);font-size:.9rem;line-height:1.6;margin-bottom:.5rem; }
</style>
@endpush

@section('content')
<section class="relative min-h-[700px] overflow-hidden flex items-center bg-[#0c1e33]">
    <img src="{{ asset('images/background.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none scale-110 opacity-10" alt="Background">
    <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#00c458]/5 rounded-full blur-[120px]"></div>

    <div class="container mx-auto px-6 relative z-10 py-32">
        <div class="text-center mb-16 reveal">
            @if($page->hero_badge)
            <span class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-6 tracking-[0.2em] uppercase">
                {{ $page->hero_badge }}
            </span>
            @endif
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-montserrat uppercase tracking-tight leading-[1.1] mb-4">
                @php
                    $titleWords = explode(' ', $page->title);
                    $lastWord = count($titleWords) > 1 ? array_pop($titleWords) : '';
                    $firstPart = implode(' ', $titleWords);
                @endphp
                @if($lastWord)
                    {{ $firstPart }} <span class="text-[#00c458]">{{ $lastWord }}</span>
                @else
                    {{ $page->title }}
                @endif
            </h2>
            @if(!empty($content['subtitle']))
            <p class="text-white/60 text-sm md:text-base font-inter max-w-xl mx-auto">{{ $content['subtitle'] }}</p>
            @endif
        </div>

        <div class="max-w-4xl mx-auto space-y-10">
            <div class="reveal">
                <div class="relative bg-white/10 backdrop-blur-xl rounded-[2rem] p-8 md:p-10 border border-white/20">
                    @if(!empty($content['judul']))
                    <h3 class="text-2xl md:text-3xl font-black text-white font-montserrat uppercase tracking-tight mb-6">
                        <span class="text-[#00c458]">{{ $content['judul'] }}</span>
                    </h3>
                    <div class="w-16 h-1 bg-[#00c458] rounded-full mb-6"></div>
                    @endif
                    <div class="profil-numbered-list">
                        {!! filled($content['isi_konten'] ?? null) ? \App\Support\RichContent::html($content['isi_konten']) : '<p class="text-white/50 text-sm italic">Konten halaman belum diisi.</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
