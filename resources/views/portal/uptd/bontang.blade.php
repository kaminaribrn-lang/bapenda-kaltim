@extends('layouts.portal')
@section('title', 'UPTD PPRD Wilayah Bontang - Bapenda Kaltim')

@push('head')
<style>
/*
 * =====================================================================
 * UPTD BONTANG — FORCE GLOBAL CSS VARIABLE OVERRIDE
 * Di-inject di <head> via push('head') agar semua utility Tailwind
 * yang consume var(--color-*) otomatis pakai palet Bontang:
 *  Primary   → Biru Tua Resmi Bontang (#0033A0)
 *  Secondary → Kuning Emas Resmi Bontang (#FFC72C)
 * =====================================================================
 */
:root,
html,
body {
    /* --- WARNA UTAMA (Diambil dari elemen Biru & Biru Tua Lambang) --- */
    --color-primary:        #0033A0 !important; /* Biru Tua Resmi Bontang */
    --color-primary-dark:   #002166 !important; /* Varian lebih gelap untuk hover tombol */
    --color-primary-light:  #E6EDFA !important; /* Tint biru sangat muda untuk latar komponen */

    /* --- WARNA AKSEN/SEKUNDER (Diambil dari elemen Kuning Emas Lambang) --- */
    --color-secondary:      #FFC72C !important; /* Kuning Emas Resmi Bontang */
    --color-secondary-dark: #D9A314 !important; /* Varian emas gelap agar teks di atasnya terbaca */
    --color-secondary-light:#FFF9E6 !important; /* Tint kuning sangat muda untuk alert/banner */

    /* --- WARNA NAVY (Untuk alternatif variasi navigasi atau teks gelap) --- */
    --color-navy:           #002884 !important; /* Navy pekat berbasis biru Bontang */
    --color-navy-dark:      #001C5C !important; /* Sangat gelap, cocok untuk teks utama (substitusi hitam) */
    --color-navy-light:     #1A47A9 !important; /* Navy terang untuk borders atau elemen aktif */
}

/* ── Dekorasi background: hilangkan semua jejak hijau ── */
.ui-bg-grid {
    background-image:
        linear-gradient(to right, rgba(0,51,160,0.06) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0,51,160,0.06) 1px, transparent 1px) !important;
}
.ui-floating-glow {
    background: radial-gradient(circle, rgba(0,51,160,0.09) 0%, transparent 60%) !important;
}
.ui-blob.primary {
    background: linear-gradient(45deg, #0033A0, #93c5fd) !important;
}
.ui-blob.secondary {
    background: linear-gradient(45deg, #FFC72C, #fde68a) !important;
}
.ui-pattern-dots {
    background-image: radial-gradient(rgba(0,51,160,0.1) 1px, transparent 1px) !important;
}
.ui-btn-shimmer {
    background: linear-gradient(135deg, #0033A0, #002884) !important;
}
.ui-btn-shimmer:hover {
    box-shadow: 0 10px 20px -10px rgba(0,51,160,0.6) !important;
}
.ui-float-badge:hover {
    box-shadow: 0 15px 25px -5px rgba(0,51,160,0.25) !important;
}
.ui-list-item:hover {
    border-color: rgba(0,51,160,0.3) !important;
}
.ui-list-item::before {
    background: linear-gradient(90deg, transparent, rgba(0,51,160,0.05), rgba(0,51,160,0.1)) !important;
}
.ui-card-icon-wrapper::after {
    border-color: rgba(0,51,160,0.5) !important;
}
.ui-pulse-icon::before {
    background: #FFC72C !important;
}
.ui-arrow-link:hover .ui-arrow {
    color: #FFC72C !important;
}
.ui-card-border::before {
    background: linear-gradient(45deg, transparent, #0033A0, #FFC72C, transparent) !important;
}
.ui-card-border::before {
    background-size: 200% 200% !important;
}

/* ── Kuntul Perak Float Animation ─────────────────── */
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
    box-shadow: 0 30px 60px -10px rgba(0,51,160,0.5);
}
.banner-swiper .swiper-slide-active .slide-overlay { opacity: 0; }
.banner-swiper .swiper-slide-active .slide-content { opacity: 1; visibility: visible; }
.banner-swiper .swiper-slide:not(.swiper-slide-active) .slide-content { opacity: 0; visibility: hidden; }

/* Pagination dots → Gold */
.banner-swiper .swiper-pagination-bullet { background: rgba(255,255,255,0.4); }
.banner-swiper .swiper-pagination-bullet-active { background: #FFC72C; width: 24px; border-radius: 4px; }

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
         style="background: url('{{ \App\Models\WebsiteIdentity::heroBackgroundFor($welcomeIdentity ?? null, asset('images/gedung-bapenda-hero.jpg')) }}') center/cover no-repeat;">
    
    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    {{-- Modern Accent: Grid Lines --}}
    <div class="absolute inset-0 z-[1] pointer-events-none opacity-[0.08]" style="background-image: linear-gradient(rgba(255,255,255,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 80px 80px;"></div>
    {{-- Modern Accent: Glow Orb kiri --}}
    <div class="absolute -left-32 -bottom-32 w-[500px] h-[500px] rounded-full z-[1] pointer-events-none" style="background: radial-gradient(circle, rgba(0,51,160,0.25) 0%, transparent 70%);"></div>
    {{-- Modern Accent: Glow Orb kanan --}}
    <div class="absolute -right-32 -top-32 w-[400px] h-[400px] rounded-full z-[1] pointer-events-none" style="background: radial-gradient(circle, rgba(255,199,44,0.15) 0%, transparent 70%);"></div>
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
    {{-- Kuntul Perak Mascot - Hero Floating --}}
    <div class="absolute bottom-0 right-4 md:right-12 lg:right-20 z-[2] pointer-events-none" style="height:clamp(160px,28vw,340px);padding-bottom:8px;">
        <img src="{{ asset('images/bapendabontang/burungkuntulherosection.png') }}" 
             alt="Kuntul Perak - Maskot Bontang"
             class="h-full w-auto object-contain drop-shadow-[0_20px_30px_rgba(0,0,0,0.5)]"
             style="filter: drop-shadow(0 0 20px rgba(255,199,44,0.3)); animation: float 4s ease-in-out infinite; transform: translateY(-6px);">
        {{-- Gold glow ring under bear --}}
        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3/4 h-4 rounded-full blur-md" style="background:rgba(255,199,44,0.35);"></div>
    </div>
    <div class="relative z-10 w-full max-w-7xl px-4 text-center mt-[-20px] md:mt-[-40px]">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-white leading-tight uppercase tracking-widest font-heading mb-8 drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]">
            Membangun Kaltim
            Untuk Semua<br>
            <span class="text-[#FFC72C] drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">Wilayah Bontang</span>
        </h1>

        {{-- 3D Slider Carousel (Uiverse Pattern) --}}
        <div class="w-full max-w-6xl mx-auto relative perspective-[1200px] transform-style-3d">
            <div class="swiper banner-swiper w-full py-8 overflow-visible">
                <div class="swiper-wrapper">
                    @php $slides = [['img'=>asset('images/slider berita/Home-2.png'),'title'=>'Layanan UPTD Bontang'],['img'=>asset('images/slider berita/Home-8.png'),'title'=>'Inovasi Pajak'],['img'=>asset('images/slider berita/Bapenda-Imlek.png'),'title'=>'Pelayanan Prima'],['img'=>asset('images/slider berita/Slider-BAPENDA-Kaltim-puasa.png'),'title'=>'Info Layanan'],['img'=>asset('images/slider berita/Bunda-KORMI.png'),'title'=>'Kegiatan UPTD']]; @endphp
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
        'line2' => 'Bontang - Prov Kaltim',
        'content' => 'Mewujudkan tata kelola pendapatan daerah Provinsi Kalimantan Timur yang inovatif, transparan, dan akuntabel untuk mendukung pembangunan Kaltim Berdaulat.',
        'name' => 'Indun Salbiah Ningsih',
        'position' => 'Kepala UPTD PPRD Bontang',
    ]);
@endphp
<section class="relative bg-white xl:h-[681.75px] w-full overflow-hidden reveal py-20 xl:py-0">
    
    {{-- Section Top Divider Line --}}
    <div class="w-full h-[4px] absolute top-0 left-0 opacity-[0.30] bg-gradient-to-r from-transparent via-[#0033A0] to-transparent pointer-events-none"></div>

    {{-- Left Background Blur Blob --}}
    <div class="absolute left-[-128px] top-[241.75px] w-[400px] h-[400px] opacity-[0.40] rounded-full blur-[40px] pointer-events-none bg-gradient-to-br from-[#0033A0] to-[#93c5fd]"></div>

    {{-- Right Background Blur Blob --}}
    <div class="absolute left-[1566px] top-[-80px] w-[500px] h-[500px] opacity-[0.40] rounded-full blur-[40px] pointer-events-none bg-gradient-to-br from-[#FFC72C] to-[#FFF9E6]"></div>

    {{-- Background Overlay 1 (Subtle vignette) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.15]" style="background: radial-gradient(ellipse 70.71% 70.71% at 50% 50%, black 30%, transparent 80%);"></div>

    {{-- Background Overlay 2 (Blue/Gold tint) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.8]" style="background: radial-gradient(ellipse 70.71% 70.71% at 48.56% 41.13%, rgba(0,51,160,0.1) 3%, transparent 80%);"></div>

    {{-- Small center blue/gold oval --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-8 rounded-full bg-blue-100/60 blur-md pointer-events-none"></div>

    <div class="ui-pattern-dots" style="background-image:radial-gradient(rgba(0,51,160,0.05) 1px,transparent 1px);"></div>

    {{-- Content Container --}}
    <div class="container mx-auto px-6 relative z-10 h-full xl:max-w-[1906px] xl:px-0">
        
        {{-- S2 Wrapper --}}
        <div class="flex flex-col lg:flex-row gap-12 items-center xl:block xl:relative xl:w-full xl:h-full">
            
            {{-- 1. Left Welcome Text Block --}}
            <div class="w-full lg:w-[60%] xl:w-[893.80px] xl:h-[425.75px] xl:absolute xl:left-[93px] xl:top-[115px] xl:m-0 flex flex-col items-start z-10">
                <div class="xl:relative xl:w-full xl:h-full">
                    
                    {{-- Selamat Datang di Website Resmi --}}
                    <h2 class="font-black text-[#0F172A] font-heading uppercase tracking-tight text-4xl md:text-5xl xl:text-[48px] xl:leading-[48px] block xl:absolute xl:left-0 xl:top-0 xl:m-0">
                        {!! nl2br(e($welcome['title'])) !!}
                    </h2>

                    {{-- UPTD PPRD Wilayah --}}
                    <div class="xl:absolute xl:left-0 xl:top-[96px] xl:m-0 mt-4 xl:mt-0 relative">
                        <span class="font-black text-[#0033A0] font-heading uppercase tracking-tight text-3xl md:text-4xl xl:text-[36px] xl:leading-[40px] block font-black">
                            {{ $welcome['line1'] }}
                        </span>
                        
                        {{-- Gold Underline --}}
                        <div class="w-[64px] h-[6px] bg-[#FFC72C] rounded-full absolute bottom-[-10px] left-0 xl:top-[42px] xl:bottom-auto" style="background-color: #FFC72C;"></div>
                    </div>

                    {{-- Bontang - Prov Kaltim --}}
                    <h2 class="font-black text-[#0033A0] font-heading uppercase tracking-tight text-3xl md:text-4xl xl:text-[36px] xl:leading-[40px] block xl:absolute xl:left-0 xl:top-[144px] xl:m-0 mt-8 xl:mt-0">
                        {{ $welcome['line2'] }}
                    </h2>

                    {{-- Paragraph --}}
                    <div class="text-[15px] md:text-[18px] xl:text-[18px] xl:leading-[29px] text-[#90A1B9] font-body leading-relaxed max-w-xl xl:max-w-[570px] xl:absolute xl:left-0 xl:top-[228px] xl:m-0 mt-6 xl:mt-0">
                        {{ $welcome['content'] }}
                    </div>

                    {{-- Badges --}}
                    <div class="flex flex-wrap gap-4 xl:absolute xl:left-0 xl:top-[351.75px] xl:m-0 mt-8 xl:mt-0">
                        {{-- Berintegritas --}}
                        <div class="flex items-center gap-3 bg-white border border-[#E6EDFA] px-5 py-3.5 rounded-[16px] shadow-[0_10px_20px_-10px_rgba(0,51,160,0.1)]">
                            <div class="w-10 h-10 bg-[#0033A0] text-[#E6EDFA] rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="text-sm font-black text-[#1D293D] font-heading uppercase tracking-wide">Berintegritas</span>
                        </div>
                        
                        {{-- Akuntabel --}}
                        <div class="flex items-center gap-3 bg-white border border-[#E6EDFA] px-5 py-3.5 rounded-[16px] shadow-[0_10px_20px_-10px_rgba(0,51,160,0.1)]">
                            <div class="w-10 h-10 bg-[#0033A0] text-[#E6EDFA] rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-sm font-black text-[#1D293D] font-heading uppercase tracking-wide">Akuntabel</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Mascot Egret --}}
            <div class="absolute right-0 bottom-0 xl:right-0 xl:bottom-0 xl:left-auto xl:top-auto xl:w-[48%] xl:h-full xl:max-w-[900px] z-10 pointer-events-none opacity-95">
                <img src="{{ asset('images/bapendabontang/burungkuntulselamatdatang.png') }}" alt="Kuntul Perak" class="w-[280px] md:w-[480px] xl:w-full xl:h-full xl:object-contain xl:object-right xl:object-bottom object-contain">
                {{-- Kabut Putih Kanan --}}
                <div class="absolute right-0 top-0 bottom-0 w-48 bg-gradient-to-l from-white via-white/40 to-transparent pointer-events-none"></div>
                {{-- Kabut Putih Bawah --}}
                <div class="absolute bottom-0 left-0 right-0 h-44 bg-gradient-to-t from-white via-white/50 to-transparent pointer-events-none"></div>
            </div>

            {{-- 3. Profile Card --}}
            <div class="relative z-20 w-full max-w-[240px] mt-8 lg:mt-0 lg:mx-auto xl:mx-0 xl:absolute xl:left-auto xl:right-[calc(min(24%,450px)-120.5px)] xl:top-[170.55px] xl:w-[241px] xl:h-[340.66px]"> 
                
                {{-- Soft Emerald Glow --}}
                <div class="absolute inset-0 bg-emerald-100 rounded-[48px] blur-[20px] transform -rotate-6 scale-110 opacity-70"></div>
                
                {{-- Card Base --}}
                <div class="bg-white rounded-[40px] p-[5px] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] border border-[#0033A0]/20 relative w-[241px] h-[340.66px] overflow-hidden">
                    
                    {{-- Grey background area --}}
                    <div class="bg-[#F8FAFC] rounded-[40px] w-[231px] h-[330.66px] relative overflow-hidden">
                        
                        {{-- Fallback text at top left --}}
                        @if($welcome['photo_url'])
                            <img src="{{ $welcome['photo_url'] }}" alt="{{ $welcome['name'] }}" class="absolute inset-0 w-full h-full object-cover object-top">
                        @else
                            @include('portal.partials.siluet-pimpinan')
                        @endif

                        {{-- Floating Navy Box --}}
                        <div class="bg-[#0f2744]/90 backdrop-blur-md border border-white/10 rounded-2xl p-3 absolute bottom-[12px] left-[12px] right-[12px] h-[99px] flex flex-col justify-between z-30">
                            <h3 class="text-[14px] xl:text-[16px] font-black text-white uppercase leading-tight font-heading text-left">
                                {{ $welcome['name'] }}
                            </h3>
                            
                            <div class="flex items-center gap-2 my-1">
                                <div class="flex-1 h-px bg-[#E6EDFA]/30"></div>
                                <div class="w-2 h-2 rounded-full bg-[#FB2C36] shadow-[0_0_8px_rgba(251,44,54,0.8)] animate-pulse"></div>
                                <div class="flex-1 h-px bg-[#E6EDFA]/30"></div>
                            </div>
                            
                            <p class="text-[#E6EDFA] text-[8px] font-black uppercase tracking-[0.15em] leading-relaxed font-body text-center">
                                {{ $welcome['position'] }}
                            </p>
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
            <div class="w-1.5 h-1.5 rounded-full bg-[#0033A0]"></div>
            <div class="w-2 h-2 rounded-full bg-[#FFC72C]"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-[#0033A0]"></div>
        </div>
        <div class="flex-1 h-px bg-gradient-to-l from-transparent to-slate-200"></div>
    </div>
</div>

{{-- S3: LAYANAN --}}
<section id="layanan" class="relative bg-blue-50/20 py-10 md:py-24 reveal overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle, #0033A0 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>
    
    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        <h2 class="sr-only">Daftar Layanan</h2>
        @if(count($services))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($services as $svc)
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/20 border border-slate-100 flex flex-col items-start relative group hover:bg-[#0033A0] hover:border-[#0033A0] hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#0033A0]/30 transition-all duration-500">
                <div class="w-14 h-14 bg-blue-100 text-[#0033A0] rounded-xl flex items-center justify-center mb-6 relative z-10 group-hover:bg-white/20 group-hover:text-white transition-all duration-500 shadow-sm group-hover:shadow-inner">
                    @if ($svc->file?->storage_path || $svc->file?->path)
                        <img src="{{ Storage::url($svc->file->storage_path ?? $svc->file->path) }}" alt="{{ $svc->name }}" class="w-8 h-8 object-contain">
                    @else
                        <svg class="w-7 h-7 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v18m9-9H3"></path></svg>
                    @endif
                </div>
                <h3 class="font-heading font-black text-slate-900 group-hover:text-white transition-colors duration-500 text-lg md:text-xl mb-3 uppercase tracking-tight relative z-10">{{ $svc->name }}</h3>
                <div class="w-10 h-1.5 bg-[#FFC72C] rounded-full mb-4 transform origin-left transition-transform duration-500 group-hover:scale-x-150 group-hover:bg-white"></div>
                <p class="font-body text-slate-500 group-hover:text-white/90 transition-colors duration-500 text-sm leading-relaxed flex-1 mb-8 relative z-10">{{ $svc->description }}</p>
                <a href="{{ $svc->link ?: route('portal.layanan.index', $website->slug) }}" class="ui-arrow-link inline-flex items-center gap-2 font-heading text-xs font-black uppercase tracking-widest text-[#0033A0] group-hover:text-white transition-colors duration-500 relative z-10 mt-auto">
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
    <div class="absolute inset-0 opacity-40" style="background-image:linear-gradient(to right,rgba(0,51,160,0.06) 1px,transparent 1px),linear-gradient(to bottom,rgba(0,51,160,0.06) 1px,transparent 1px);background-size:50px 50px;"></div>
    <div class="absolute w-[600px] h-[600px] -left-32 top-32 pointer-events-none z-0" style="background:radial-gradient(circle,rgba(0,51,160,0.08) 0%,transparent 60%);border-radius:50%;"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16 md:mb-24 relative">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-100 text-[#0033A0] text-[10px] font-black rounded-full mb-4 tracking-[0.2em] uppercase font-heading">
                <div class="w-2 h-2 rounded-full bg-[#FFC72C] animate-pulse"></div> Layanan Cepat
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 font-heading tracking-tighter uppercase leading-none">
                Cek <span class="text-[#0033A0] relative inline-block">Pajak Kendaraan <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-20 h-1.5 bg-[#FFC72C] rounded-full"></div></span>
            </h2>
            <p class="text-slate-500 mt-6 max-w-xl mx-auto text-sm md:text-base font-medium font-body">Akses informasi tagihan pajak kendaraan bermotor yang transparan dan akuntabel secara mandiri.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch max-w-6xl mx-auto relative">
            {{-- Mascot Kuntul Perak Terbang (Flying Egret) - Behind Card --}}
            <div class="absolute left-[-80px] sm:left-[-120px] md:left-[-340px] lg:left-[-410px] xl:left-[-480px] top-[-110px] sm:top-[-140px] md:top-[-150px] lg:top-[-180px] xl:top-[-220px] w-64 sm:w-80 md:w-[500px] lg:w-[600px] xl:w-[700px] z-0 pointer-events-none select-none"
                 style="animation: float 4s ease-in-out infinite; filter: drop-shadow(0 15px 25px rgba(0,0,0,0.1)) drop-shadow(0 0 25px rgba(255,199,44,0.2));">
                <img src="{{ asset('images/bapendabontang/burungluntulcekpajak.png') }}" 
                     alt="Kuntul Perak Terbang" 
                     class="w-full h-auto object-contain">
            </div>

            <!-- Left Card: Cek Pajak Form -->
            <div class="lg:col-span-6 bg-white/90 backdrop-blur-md p-8 md:p-12 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-center text-center relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 z-10">
                <div class="absolute -right-16 -top-16 w-32 h-32 bg-primary/5 rounded-full blur-xl pointer-events-none group-hover:bg-primary/10 transition-colors duration-500"></div>
                <div class="w-20 h-20 rounded-3xl bg-blue-100 border border-blue-100 flex items-center justify-center mx-auto mb-8 shadow-inner group-hover:scale-110 transition-transform duration-500">
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
            <div class="lg:col-span-6 bg-white/95 backdrop-blur-md p-6 md:p-8 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-between relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 min-h-[500px] z-10">
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
                                                <p class="text-[8px] font-bold text-slate-400 font-body leading-none">Bontang, Indonesia</p>
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

{{-- S8: SOSIAL MEDIA (sama dengan beranda utama) --}}
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
        slidesPerView: 'auto'
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
