@extends('layouts.portal')
@section('title', 'UPTD PPRD Wilayah Samarinda - Bapenda Kaltim')

@push('head')
<style>
/*
 * =====================================================================
 * UPTD SAMARINDA — FORCE GLOBAL CSS VARIABLE OVERRIDE
 * =====================================================================
 */
:root,
html,
body {
    --color-primary:        #15803D !important; /* Hijau Botani */
    --color-primary-dark:   #166534 !important; 
    --color-primary-light:  #DCFCE7 !important; 

    --color-secondary:      #EF4444 !important; /* Merah Energi */
    --color-secondary-dark: #DC2626 !important; 
    --color-secondary-light:#FEE2E2 !important; 

    --color-navy:           #14532D !important; /* Hijau Tua */
    --color-navy-dark:      #052E16 !important; 
    --color-navy-light:     #22C55E !important; 
}

/* ── Dekorasi background ── */
.ui-bg-grid {
    background-image:
        linear-gradient(to right, rgba(21,128,61,0.06) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(21,128,61,0.06) 1px, transparent 1px) !important;
}
.ui-floating-glow {
    background: radial-gradient(circle, rgba(21,128,61,0.09) 0%, transparent 60%) !important;
}
.ui-blob.primary {
    background: linear-gradient(45deg, #15803D, #86efac) !important;
}
.ui-blob.secondary {
    background: linear-gradient(45deg, #EF4444, #fca5a5) !important;
}
.ui-pattern-dots {
    background-image: radial-gradient(rgba(21,128,61,0.1) 1px, transparent 1px) !important;
}
.ui-btn-shimmer {
    background: linear-gradient(135deg, #15803D, #14532D) !important;
}
.ui-btn-shimmer:hover {
    box-shadow: 0 10px 20px -10px rgba(21,128,61,0.6) !important;
}
.ui-float-badge:hover {
    box-shadow: 0 15px 25px -5px rgba(21,128,61,0.25) !important;
}
.ui-list-item:hover {
    border-color: rgba(21,128,61,0.3) !important;
}
.ui-list-item::before {
    background: linear-gradient(90deg, transparent, rgba(21,128,61,0.05), rgba(21,128,61,0.1)) !important;
}
.ui-card-icon-wrapper::after {
    border-color: rgba(21,128,61,0.5) !important;
}
.ui-pulse-icon::before {
    background: #EF4444 !important;
}
.ui-arrow-link:hover .ui-arrow {
    color: #EF4444 !important;
}
.ui-card-border::before {
    background: linear-gradient(45deg, transparent, #15803D, #EF4444, transparent) !important;
}
.ui-card-border::before {
    background-size: 200% 200% !important;
}

/* ── Float Animation ─────────────────── */
@keyframes float {
    0%, 100% { transform: translateY(-6px); }
    50%       { transform: translateY(-22px); }
}

/* ── Swiper: Banner ─────────────────────────────── */
.banner-swiper {
    perspective: 1200px;
    transform-style: preserve-3d;
}
.banner-swiper .swiper-slide {
    transform-origin: bottom;
    transform: scale(0.95) rotateX(8deg);
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.6s ease;
    opacity: 0.6;
    width: 80%;
    max-width: 720px;
    aspect-ratio: 21/9;
    border-radius: 1rem;
    overflow: hidden;
}
@media (min-width: 768px) {
    .banner-swiper .swiper-slide { width: 55%; }
}
.banner-swiper .swiper-slide-active {
    transform: scale(1) rotateX(0deg);
    opacity: 1;
    z-index: 10;
    box-shadow: 0 30px 60px -10px rgba(21,128,61,0.5);
}
.banner-swiper .swiper-slide-active .slide-overlay { opacity: 0; }
.banner-swiper .swiper-slide-active .slide-content { opacity: 1; visibility: visible; }
.banner-swiper .swiper-slide:not(.swiper-slide-active) .slide-content { opacity: 0; visibility: hidden; }

/* Pagination dots */
.banner-swiper .swiper-pagination-bullet { background: rgba(255,255,255,0.4); }
.banner-swiper .swiper-pagination-bullet-active { background: #EF4444; width: 24px; border-radius: 4px; }

/* UI Instagram Card & Pajak Slider */
.ui-instagram-card {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.ui-instagram-card:hover {
    box-shadow: 0 20px 40px -10px rgba(var(--color-primary), 0.15), 0 0 0 2px rgba(var(--color-primary), 0.2);
    transform: translateY(-4px);
}
.pajak-pagination .swiper-pagination-bullet {
    background: #cbd5e1;
    width: 6px;
    height: 6px;
    opacity: 0.5;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 9999px;
}
.pajak-pagination .swiper-pagination-bullet-active {
    background: var(--color-primary) !important;
    width: 20px !important;
    opacity: 1 !important;
    border-radius: 4px !important;
    box-shadow: 0 0 10px rgba(var(--color-primary), 0.4) !important;
}
.love-btn.active svg {
    fill: var(--color-secondary) !important;
    stroke: var(--color-secondary) !important;
    filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.6)) !important;
    animation: heartBeat 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
@keyframes heartBeat {
    0% { transform: scale(1); }
    30% { transform: scale(1.4); }
    60% { transform: scale(0.9); }
    100% { transform: scale(1.2); }
}

</style>
@endpush

@section('content')

{{-- S1: HERO SECTION --}}
<section class="relative min-h-[600px] md:min-h-[750px] overflow-hidden flex flex-col items-center justify-center pt-24" 
         style="background: url('{{ \App\Models\WebsiteIdentity::heroBackgroundFor($welcomeIdentity ?? null, asset('images/bapendasamarinda/hero-samarinda.png')) }}') center/cover no-repeat;">
    
    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-black/60 z-0"></div>


    {{-- Modern Accent: Glow Orb kiri --}}
    <div class="absolute -left-32 -bottom-32 w-[500px] h-[500px] rounded-full z-[1] pointer-events-none" style="background: radial-gradient(circle, rgba(176,58,46,0.25) 0%, transparent 70%);"></div>
    {{-- Modern Accent: Glow Orb kanan --}}
    <div class="absolute -right-32 -top-32 w-[400px] h-[400px] rounded-full z-[1] pointer-events-none" style="background: radial-gradient(circle, rgba(220,38,38,0.15) 0%, transparent 70%);"></div>
    {{-- Modern Accent: Corner Diamond kiri bawah --}}
    <div class="absolute left-8 bottom-8 z-[1] pointer-events-none opacity-20">
        <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
            <rect x="10" y="10" width="100" height="100" rx="4" stroke="white" stroke-width="1" stroke-dasharray="6 4" fill="none"/>
            <rect x="30" y="30" width="60" height="60" rx="2" stroke="white" stroke-width="1" fill="none"/>
            <rect x="50" y="50" width="20" height="20" rx="1" fill="white" fill-opacity="0.3"/>
        </svg>
    </div>
    {{-- Modern Accent: Corner Circles kanan atas --}}
    <div class="absolute right-8 top-8 z-[1] pointer-events-none opacity-15">
        <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
            <circle cx="50" cy="50" r="45" stroke="white" stroke-width="1" stroke-dasharray="4 4" fill="none"/>
            <circle cx="50" cy="50" r="30" stroke="white" stroke-width="1" fill="none"/>
            <circle cx="50" cy="50" r="8" fill="white" fill-opacity="0.2"/>
        </svg>
    </div>
    
    {{-- Pesut Accents (Figma Style) --}}
    {{-- Left Pesut --}}
    <div class="absolute left-0 bottom-0 z-[1] pointer-events-none w-[250px] md:w-[350px] opacity-100 transform -scale-x-100">
        <img src="{{ asset('images/bapendasamarinda/icon pesut/pesutkembar.svg') }}" alt="Pesut Kiri" class="w-full h-auto">
    </div>
    {{-- Right Pesut --}}
    <div class="absolute right-0 bottom-0 z-[1] pointer-events-none w-[250px] md:w-[350px] opacity-100">
        <img src="{{ asset('images/bapendasamarinda/icon pesut/pesutkembar.svg') }}" alt="Pesut Kanan" class="w-full h-auto">
    </div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-7xl px-4 text-center mt-[-20px] md:mt-[-40px]">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-white leading-tight uppercase tracking-widest font-heading mb-8 drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]">
            Membangun Kaltim
            Untuk Semua<br>
            <span class="text-red-400 drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">Wilayah Samarinda</span>
        </h1>

        {{-- 3D Slider Carousel (Uiverse Pattern) --}}
        <div class="w-full max-w-6xl mx-auto relative perspective-[1200px] transform-style-3d">
            <div class="swiper banner-swiper w-full py-8 overflow-visible">
                <div class="swiper-wrapper">
                    @php $slides = [['img'=>asset('images/slider berita/Home-2.png'),'title'=>'Layanan UPTD Samarinda'],['img'=>asset('images/slider berita/Home-8.png'),'title'=>'Inovasi Pajak'],['img'=>asset('images/slider berita/Bapenda-Imlek.png'),'title'=>'Pelayanan Prima'],['img'=>asset('images/slider berita/Slider-BAPENDA-Kaltim-puasa.png'),'title'=>'Info Layanan'],['img'=>asset('images/slider berita/Bunda-KORMI.png'),'title'=>'Kegiatan UPTD']]; @endphp
                    @foreach($slides as $sl)
                    <div class="swiper-slide w-[85vw] md:w-[65vw] max-w-[850px] cursor-pointer group flex flex-col items-center"
                         onclick="openLightbox('{{ $sl['img'] }}', '{{ $sl['title'] }}')">
                        
                        <div class="w-full rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.5)] border border-white/10 relative bg-transparent">
                            <img src="{{ $sl['img'] }}" alt="{{ $sl['title'] }}" class="w-full h-auto block transform transition-transform duration-[2s] ease-out group-hover:scale-105">
                            <div class="slide-overlay absolute inset-0 bg-black/50 transition-opacity duration-700 pointer-events-none"></div>
                        </div>
                        
                        <div class="mt-5 opacity-0 transition-opacity duration-700 ease-in-out slide-content text-center">
                            <h2 class="text-base md:text-lg font-bold text-white font-heading tracking-widest uppercase drop-shadow-md">{{ $sl['title'] }}</h2>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !-bottom-12"></div>
            </div>
        </div>
    </div>
</section>

{{-- S2: SELAMAT DATANG --}}
{{-- Section sambutan: dapat diatur dari Identitas Website > Sambutan Beranda --}}
@php
    $welcome = \App\Models\WebsiteIdentity::welcomeFor($welcomeIdentity ?? null, [
        'line1' => 'UPTD PPRD Wilayah',
        'line2' => 'Samarinda - Prov Kaltim',
        'content' => 'Mewujudkan tata kelola pelayanan pajak daerah yang inovatif, transparan, dan akuntabel di wilayah Kota Samarinda untuk mendukung pembangunan Kaltim.',
        'name' => 'Maya Fitria',
        'position' => 'Plt. Kepala UPTD PPRD Samarinda',
    ]);
@endphp
<section class="relative bg-white xl:h-[681.75px] w-full overflow-hidden reveal py-20 xl:py-0">
    
    {{-- Section Top Divider Line --}}
    <div class="w-full h-[4px] absolute top-0 left-0 opacity-[0.30] bg-gradient-to-r from-transparent via-primary to-transparent pointer-events-none"></div>

    {{-- Left Background Blur Blob --}}
    <div class="absolute left-[-128px] top-[241.75px] w-[400px] h-[400px] opacity-[0.40] rounded-full blur-[40px] pointer-events-none bg-gradient-to-br from-primary/50 to-primary-light"></div>

    {{-- Right Background Blur Blob --}}
    <div class="absolute left-[1566px] top-[-80px] w-[500px] h-[500px] opacity-[0.40] rounded-full blur-[40px] pointer-events-none bg-gradient-to-br from-primary to-primary-light"></div>

    {{-- Background Overlay 1 (Subtle vignette) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.15]" style="background: radial-gradient(ellipse 70.71% 70.71% at 50% 50%, black 30%, transparent 80%);"></div>

    {{-- Background Overlay 2 (Green tint) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.8]" style="background: radial-gradient(ellipse 70.71% 70.71% at 48.56% 41.13%, rgba(21,128,61,0.1) 3%, transparent 80%);"></div>

    {{-- Small center green oval --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-8 rounded-full bg-primary-light/60 blur-md pointer-events-none"></div>

    <div class="ui-pattern-dots" style="background-image:radial-gradient(rgba(21,128,61,0.05) 1px,transparent 1px);"></div>

    {{-- Content Container --}}
    <div class="container mx-auto px-6 relative z-10 h-full xl:max-w-[1906px] xl:px-0">
        
        {{-- Responsive Layout for Mobile/Tablet & Exact absolute positioning for Desktop (xl) --}}
        <div class="flex flex-col lg:flex-row gap-12 items-center xl:block xl:relative xl:w-full xl:h-full">
            
            {{-- Left Welcome Text Block --}}
            <div class="w-full lg:w-[60%] xl:w-[893.80px] xl:h-[425.75px] xl:absolute xl:left-[93px] xl:top-[115px] xl:m-0 flex flex-col items-start">
                
                {{-- Text lines absolute-positioned on desktop, flex on mobile --}}
                <div class="xl:relative xl:w-full xl:h-full">
                    
                    {{-- Selamat Datang di Website Resmi --}}
                    <h2 class="font-black text-[#0F172A] font-heading uppercase tracking-tight text-4xl md:text-5xl xl:text-[48px] xl:leading-[48px] block xl:absolute xl:left-0 xl:top-0 xl:m-0">
                        {!! nl2br(e($welcome['title'])) !!}
                    </h2>

                    {{-- UPTD PPRD Wilayah --}}
                    <div class="xl:absolute xl:left-0 xl:top-[96px] xl:m-0 mt-4 xl:mt-0 relative">
                        <span class="font-black text-primary font-heading uppercase tracking-tight text-3xl md:text-4xl xl:text-[36px] xl:leading-[40px] block font-black">
                            {{ $welcome['line1'] }}
                        </span>
                        
                        {{-- Red Underline --}}
                        <div class="w-[64px] h-[6px] bg-secondary rounded-full absolute bottom-[-10px] left-0 xl:top-[42px] xl:bottom-auto" style="background-color: var(--color-secondary);"></div>
                    </div>

                    {{-- Samarinda - Prov Kaltim --}}
                    <h2 class="font-black text-primary font-heading uppercase tracking-tight text-3xl md:text-4xl xl:text-[36px] xl:leading-[40px] block xl:absolute xl:left-0 xl:top-[144px] xl:m-0 mt-8 xl:mt-0">
                        {{ $welcome['line2'] }}
                    </h2>

                    {{-- Paragraph --}}
                    <div class="text-[15px] md:text-[18px] xl:text-[18px] xl:leading-[29px] text-[#90A1B9] font-body leading-relaxed max-w-xl xl:max-w-[570px] xl:absolute xl:left-0 xl:top-[228px] xl:m-0 mt-6 xl:mt-0">
                        {{ $welcome['content'] }}
                    </div>

                    {{-- Badges --}}
                    <div class="flex flex-wrap gap-4 xl:absolute xl:left-0 xl:top-[351.75px] xl:m-0 mt-8 xl:mt-0">
                        {{-- Berintegritas --}}
                        <div class="flex items-center gap-3 bg-white border border-primary-light px-5 py-3.5 rounded-[16px] shadow-[0_10px_20px_-10px_rgba(21,128,61,0.1)]">
                            <div class="w-10 h-10 bg-primary text-primary-light rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="text-sm font-black text-[#1D293D] font-heading uppercase tracking-wide">Berintegritas</span>
                        </div>
                        
                        {{-- Akuntabel --}}
                        <div class="flex items-center gap-3 bg-white border border-primary-light px-5 py-3.5 rounded-[16px] shadow-[0_10px_20px_-10px_rgba(21,128,61,0.1)]">
                            <div class="w-10 h-10 bg-primary text-primary-light rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-sm font-black text-[#1D293D] font-heading uppercase tracking-wide">Akuntabel</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Mascot and Card Container --}}
            <div class="w-full lg:w-[40%] xl:w-[800px] xl:h-[720px] xl:absolute xl:right-[0px] xl:top-[0px] flex justify-center items-center py-6 xl:py-0">
                
                {{-- Mascot Pesut Baring --}}
                <div class="absolute right-0 bottom-[-20px] xl:left-[1085px] xl:top-[26px] xl:w-[1159px] xl:h-[702px] xl:right-auto xl:bottom-auto z-0 pointer-events-none opacity-90"
                     style="mask-image: linear-gradient(to bottom, black 55%, transparent 95%); -webkit-mask-image: linear-gradient(to bottom, black 55%, transparent 95%);">
                    <img src="{{ asset('images/bapendasamarinda/icon pesut/pesutbaring.svg') }}" alt="Pesut Baring" class="w-[250px] md:w-[450px] xl:w-full xl:h-full object-contain xl:object-cover mix-blend-multiply animate-float-slow">
                </div>

                {{-- Profile Card --}}
                <div class="relative z-10 w-full max-w-[240px] xl:w-[241px] xl:h-[340.66px]"> 
                    
                    {{-- Soft Green Glow --}}
                    <div class="absolute inset-0 bg-primary-light rounded-[3rem] blur-2xl transform -rotate-6 scale-110 opacity-70"></div>
                    
                    {{-- Card Base --}}
                    <div class="bg-white rounded-[40px] p-[5px] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] border border-primary-light/30 relative w-[241px] h-[340.66px] overflow-hidden">
                        
                        {{-- Grey background area --}}
                        <div class="bg-[#F8FAFC] rounded-[40px] w-[231px] h-[330.66px] relative overflow-hidden">
                            
                            {{-- Fallback text at top left --}}
                            @if($welcome['photo_url'])
                                <img src="{{ $welcome['photo_url'] }}" alt="{{ $welcome['name'] }}" class="absolute inset-0 w-full h-full object-cover object-top">
                            @else
                                @include('portal.partials.siluet-pimpinan')
                            @endif

                            {{-- Floating Navy Box --}}
                            <div class="bg-[#0f2744]/90 backdrop-blur-md border border-white/10 rounded-2xl p-3 absolute bottom-[12px] left-[12px] right-[12px] h-[99px] flex flex-col justify-between">
                                <h3 class="text-[14px] xl:text-[16px] font-black text-white uppercase leading-tight font-heading text-left">
                                    {{ $welcome['name'] }}
                                </h3>
                                
                                <div class="flex items-center gap-2 my-1">
                                    <div class="flex-1 h-px bg-primary/30"></div>
                                    <div class="w-2 h-2 rounded-full bg-[#FB2C36] shadow-[0_0_8px_rgba(251,44,54,0.8)] animate-pulse"></div>
                                    <div class="flex-1 h-px bg-primary/30"></div>
                                </div>
                                
                                <p class="text-primary-light text-[8px] font-black uppercase tracking-[0.15em] leading-relaxed font-body text-center font-bold">
                                    {{ $welcome['position'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- White Bottom Fade Overlay --}}
    <div class="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-white via-white/90 to-transparent z-[5] pointer-events-none"></div>
</section>

{{-- Modern Corporate Divider --}}
<div class="relative w-full py-4 overflow-hidden bg-white flex flex-col items-center gap-2">
    <div class="flex items-center gap-3 w-full max-w-4xl px-6">
        <div class="flex-1 h-px bg-gradient-to-r from-transparent to-slate-200"></div>
        <div class="flex items-center gap-2">
            <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
            <div class="w-2 h-2 rounded-full bg-red-500"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
        </div>
        <div class="flex-1 h-px bg-gradient-to-l from-transparent to-slate-200"></div>
    </div>
</div>

{{-- S3: LAYANAN --}}
<section id="layanan" class="relative bg-emerald-50/20 py-10 md:py-24 reveal overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle, #059669 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>
    
    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        <h2 class="sr-only">Daftar Layanan</h2>
        @if(count($services))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($services as $svc)
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/20 border border-slate-100 flex flex-col items-start relative group hover:bg-primary hover:border-primary hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/30 transition-all duration-500">
                <div class="w-14 h-14 bg-primary-light text-primary rounded-xl flex items-center justify-center mb-6 relative z-10 group-hover:bg-white/20 group-hover:text-white transition-all duration-500 shadow-sm group-hover:shadow-inner">
                    @if ($svc->file?->storage_path || $svc->file?->path)
                        <img src="{{ Storage::url($svc->file->storage_path ?? $svc->file->path) }}" alt="{{ $svc->name }}" class="w-8 h-8 object-contain">
                    @else
                        <svg class="w-7 h-7 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v18m9-9H3"></path></svg>
                    @endif
                </div>
                <h3 class="font-heading font-black text-slate-900 group-hover:text-white transition-colors duration-500 text-lg md:text-xl mb-3 uppercase tracking-tight relative z-10">{{ $svc->name }}</h3>
                <div class="w-10 h-1.5 bg-secondary rounded-full mb-4 transform origin-left transition-transform duration-500 group-hover:scale-x-150 group-hover:bg-white"></div>
                <p class="font-body text-slate-500 group-hover:text-white/90 transition-colors duration-500 text-sm leading-relaxed flex-1 mb-8 relative z-10">{{ $svc->description }}</p>
                <a href="{{ $svc->link ?: route('portal.layanan.index', $website->slug) }}" class="ui-arrow-link inline-flex items-center gap-2 font-heading text-xs font-black uppercase tracking-widest text-primary group-hover:text-white transition-colors duration-500 relative z-10 mt-auto">
                    KUNJUNGI LAYANAN
                    <svg class="ui-arrow w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Layanan Samsat khusus wilayah UPTD ini --}}
        @if(count($samsatLocations ?? []))
        <div class="{{ count($services) ? 'mt-12' : '' }}">
            <x-portal.peta-layanan-samsat :locations="$samsatLocations" height="600px" />
        </div>
        @elseif(! count($services))
        <p class="col-span-full rounded-2xl border border-slate-200 bg-white p-8 text-center text-slate-500">Belum ada layanan yang dipublikasikan.</p>
        @endif
    </div>
</section>

{{-- S4: CEK PAJAK --}}
<section id="cek-pajak" class="relative bg-white py-20 lg:py-28 overflow-hidden reveal">

    <div class="absolute inset-0 opacity-40 ui-bg-grid"></div>
    <div class="ui-floating-glow -left-32 top-32"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16 md:mb-24 relative">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-light text-primary text-[10px] font-black rounded-full mb-4 tracking-[0.2em] uppercase font-heading">
                <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div> Layanan Cepat
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 font-heading tracking-tighter uppercase leading-none">
                Cek <span class="text-primary relative inline-block">Pajak Kendaraan <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-red-600 rounded-full"></div></span>
            </h2>
            <p class="text-slate-500 mt-6 max-w-xl mx-auto text-sm md:text-base font-medium font-body">Akses informasi tagihan pajak kendaraan bermotor yang transparan dan akuntabel secara mandiri.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch max-w-6xl mx-auto">
            <!-- Left Card: Cek Pajak Form -->
            <div class="lg:col-span-6 bg-white p-8 md:p-12 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-center text-center relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500">
                <div class="absolute -right-16 -top-16 w-32 h-32 bg-primary/5 rounded-full blur-xl pointer-events-none group-hover:bg-primary/10 transition-colors duration-500"></div>
                <div class="w-20 h-20 rounded-3xl bg-primary-light border border-primary-light flex items-center justify-center mx-auto mb-8 shadow-inner group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight mb-2 font-heading">Masukkan Nomor Polisi</h3>
                <p class="text-xs text-slate-400 mb-6 font-body font-medium">Contoh: KT 1234 ABC</p>
                <form action="http://simpator.kaltimprov.go.id/cari.php" method="POST" target="_blank" class="flex flex-col gap-5 max-w-md mx-auto">
                    <div class="flex items-center justify-center gap-3">
                        <label for="kt" class="sr-only">Kode Wilayah Awal</label>
                        <input type="text" id="kt" name="kt" aria-label="Kode Wilayah Awal" placeholder="KT" value="KT" class="w-[70px] bg-slate-50 rounded-2xl px-2 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading" required>
                        <label for="nomor" class="sr-only">Nomor Polisi</label>
                        <input type="number" id="nomor" name="nomor" aria-label="Nomor Polisi" placeholder="1234" class="flex-1 bg-slate-50 rounded-2xl px-4 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading tracking-widest hide-scrollbar" required>
                        <label for="seri" class="sr-only">Kode Wilayah Akhir</label>
                        <input type="text" id="seri" name="seri" aria-label="Kode Wilayah Akhir" placeholder="ABC" class="w-[90px] bg-slate-50 rounded-2xl px-2 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading" required>
                    </div>
                    <button type="submit" name="pkb" value="Process" class="ui-btn-shimmer w-full px-8 py-4 font-black tracking-widest uppercase flex items-center justify-center gap-3 font-heading text-base">
                        Cek Pajak di SIMPATOR
                        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>

            <!-- Right Card: Infographic Slider (Instagram UI Verse Style) -->
            <div class="lg:col-span-6 bg-white p-6 md:p-8 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-between relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 min-h-[500px]">
                <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-secondary/5 rounded-full blur-xl pointer-events-none group-hover:bg-secondary/10 transition-colors duration-500"></div>
                
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-tighter leading-none font-heading">Informasi & Sosialisasi</h3>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="pajak-prev w-8 h-8 rounded-full border border-slate-200 text-slate-600 flex items-center justify-center hover:bg-primary hover:border-primary hover:text-white hover:scale-105 transition-all duration-300" aria-label="Slide Sebelumnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button class="pajak-next w-8 h-8 rounded-full border border-slate-200 text-slate-600 flex items-center justify-center hover:bg-primary hover:border-primary hover:text-white hover:scale-105 transition-all duration-300" aria-label="Slide Selanjutnya">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <div class="relative w-full flex-1 overflow-hidden">
                    <div class="swiper pajak-slider w-full h-full">
                        <div class="swiper-wrapper">
                            @php
                            $pajakSlides = [
                                ['img' => asset('images/slider berita/Slider-BAPENDA-Kaltim-puasa.png'), 'caption' => 'Pelayanan PKB Nyaman & Cepat di Bulan Suci Ramadhan'],
                                ['img' => asset('images/slider berita/Bapenda-Imlek.png'), 'caption' => 'Ayo Bayar Pajak Kendaraan Bermotor Anda Tepat Waktu!'],
                                ['img' => asset('images/slider berita/Home-2.png'), 'caption' => 'Disiplin & Profesional: Bukti Nyata ASN Berintegritas!'],
                                ['img' => asset('images/slider berita/Home-8.png'), 'caption' => 'Sosialisasi Samsat Kaltim Terpadu dan Layanan Elektronik Terbaru'],
                                ['img' => asset('images/slider berita/Bunda-KORMI.png'), 'caption' => 'Mewujudkan Pembangunan Kaltim Berdaulat Bersama Bapenda']
                            ];
                            @endphp
                            @foreach($pajakSlides as $slide)
                            <div class="swiper-slide h-full">
                                <!-- UI Verse Instagram Card -->
                                <div class="ui-instagram-card w-full h-full relative flex flex-col bg-white/80 backdrop-blur-md rounded-[2rem] border border-slate-100 shadow-lg overflow-hidden group/slide cursor-pointer" onclick="openLightbox('{{ $slide['img'] }}', '{{ $slide['caption'] }}')">
                                    
                                    <!-- Post Header -->
                                    <div class="flex items-center justify-between px-4 py-3 bg-white/50 border-b border-slate-100">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full border border-primary/20 overflow-hidden bg-white p-0.5 shrink-0">
                                                <img src="{{ asset('images/logo bapenda.png') }}" class="w-full h-full object-contain" alt="Logo">
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[11px] font-black text-slate-800 font-heading tracking-wide">bapendakaltim</span>
                                                    <svg class="w-3 h-3 text-blue-500 fill-current" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                                </div>
                                                <p class="text-[8px] font-bold text-slate-400 font-body leading-none">Samarinda, Indonesia</p>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-primary/10 text-primary text-[8px] font-black rounded-full uppercase tracking-wider font-heading">
                                            <span class="w-1 h-1 rounded-full bg-emerald-500 animate-ping"></span> Live Feed
                                        </span>
                                    </div>

                                    <!-- Main Image -->
                                    <div class="relative w-full overflow-hidden flex-1 aspect-square bg-slate-50">
                                        <img src="{{ $slide['img'] }}" alt="{{ $slide['caption'] }}" class="w-full h-full object-cover transition-transform duration-[1s] ease-out group-hover/slide:scale-105">
                                        
                                        <!-- Floating Caption -->
                                        <div class="absolute bottom-3 left-3 right-3 bg-slate-900/85 backdrop-blur-md rounded-xl p-3.5 border border-white/10 shadow-2xl transform translate-y-2 opacity-0 group-hover/slide:translate-y-0 group-hover/slide:opacity-100 transition-all duration-300 ease-out z-20">
                                            <p class="text-emerald-400 font-heading font-black text-[9px] uppercase tracking-widest mb-0.5" style="color: var(--color-navy-light);">Info Detail</p>
                                            <p class="text-white font-body font-bold text-[11px] leading-snug line-clamp-2">
                                                {{ $slide['caption'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Action Bar -->
                                    <div class="flex items-center justify-between px-4 py-2.5 bg-white/50 border-t border-slate-100 text-slate-600 z-10">
                                        <div class="flex items-center gap-3">
                                            <button class="love-btn hover:text-red-500 hover:scale-125 transition-all duration-300" onclick="toggleLove(event, this)">
                                                <svg class="w-4.5 h-4.5 transition-transform duration-300 fill-none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                            </button>
                                            <button class="hover:text-primary hover:scale-125 transition-all duration-300" onclick="event.stopPropagation();">
                                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                            </button>
                                        </div>
                                        <button class="hover:text-primary hover:scale-125 transition-all duration-300" onclick="event.stopPropagation();">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="pajak-pagination flex justify-center gap-2 mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- S5: BERITA + GPR (sama dengan beranda utama) --}}
@include('portal.partials.berita-gpr')

{{-- S8: SOSIAL MEDIA (komponen bersama + hiasan pesut) --}}
@php
    $sosmedDecor = '<div class="absolute left-0 bottom-0 z-[1] pointer-events-none w-[150px] md:w-[250px] opacity-70"><img src="' . e(asset('images/bapendasamarinda/icon pesut/pesut.svg')) . '" alt="Pesut Bottom" class="w-full h-auto"></div>';
@endphp
@include('portal.partials.media-sosial')

{{-- LIGHTBOX MODAL --}}
<div id="imageLightbox" class="fixed inset-0 z-[200] items-center justify-center p-4 md:p-8 hidden" onclick="closeLightbox(event)">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-sm transition-opacity duration-300"></div>
    <button onclick="closeLightbox(event, true)" class="absolute top-4 right-4 md:top-8 md:right-8 z-10 w-12 h-12 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-all duration-300 group">
        <svg class="w-6 h-6 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    <div class="relative z-10 max-w-6xl w-full max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
        <img id="lightboxImage" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl transition-transform duration-500" style="transform: scale(0.9);">
        <p id="lightboxCaption" class="mt-4 text-white text-lg font-bold text-center drop-shadow-md font-heading tracking-wide"></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openLightbox(src, caption) {
    if(!src) return;
    const lightbox = document.getElementById('imageLightbox');
    const img = document.getElementById('lightboxImage');
    const cap = document.getElementById('lightboxCaption');
    img.src = src;
    img.alt = caption;
    cap.textContent = caption;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    setTimeout(() => { img.style.transform = 'scale(1)'; }, 50);
}

function closeLightbox(event, force = false) {
    if (force || event.target === event.currentTarget) {
        const lightbox = document.getElementById('imageLightbox');
        const img = document.getElementById('lightboxImage');
        img.style.transform = 'scale(0.9)';
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            img.src = '';
        }, 300);
    }
}

function toggleLove(event, button) {
    event.stopPropagation();
    button.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded',()=>{
    new Swiper('.banner-swiper',{
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        spaceBetween: 40,
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        keyboard: { enabled: true },
        a11y: { enabled: true }
    });

    new Swiper('.pajak-slider',{
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        navigation: { nextEl: '.pajak-next', prevEl: '.pajak-prev' },
        pagination: { el: '.pajak-pagination', clickable: true },
        spaceBetween: 20,
        grabCursor: true,
        slidesPerView: 1
    });
});
</script>
@endpush
