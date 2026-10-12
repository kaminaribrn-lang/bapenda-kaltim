@extends('layouts.portal')
@section('title', 'Beranda — Bapenda Kaltim')

@section('content')

    {{-- S1: HERO SECTION --}}
    <section class="relative min-h-[600px] md:min-h-[600px] overflow-hidden flex flex-col items-center pt-24 "
        style="background: url('{{ \App\Models\WebsiteIdentity::heroBackgroundFor($identity ?? null, asset('images/gedung-bapenda-hero.jpg')) }}') center/cover no-repeat;">

        {{-- Dark Overlay --}}
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        {{-- Modern Accent: Grid Lines --}}
        <div class="absolute inset-0 z-[1] pointer-events-none opacity-[0.08]"
            style="background-image: linear-gradient(rgba(255,255,255,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 80px 80px;">
        </div>
        {{-- Modern Accent: Glow Orb kiri --}}
        <div class="absolute -left-32 -bottom-32 w-[500px] h-[500px] rounded-full z-[1] pointer-events-none"
            style="background: radial-gradient(circle, rgba(5,150,105,0.25) 0%, transparent 70%);"></div>
        {{-- Modern Accent: Glow Orb kanan --}}
        <div class="absolute -right-32 -top-32 w-[400px] h-[400px] rounded-full z-[1] pointer-events-none"
            style="background: radial-gradient(circle, rgba(201, 53, 53, 0.15) 0%, transparent 70%);"></div>
        {{-- Modern Accent: Corner Diamond kiri bawah --}}
        <div class="absolute left-8 bottom-8 z-[1] pointer-events-none opacity-20">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
                <rect x="10" y="10" width="100" height="100" rx="4" stroke="white" stroke-width="1" stroke-dasharray="6 4"
                    fill="none" />
                <rect x="30" y="30" width="60" height="60" rx="2" stroke="white" stroke-width="1" fill="none" />
                <rect x="50" y="50" width="20" height="20" rx="1" fill="white" fill-opacity="0.3" />
            </svg>
        </div>
        {{-- Modern Accent: Corner Circles kanan atas --}}
        <div class="absolute right-8 top-8 z-[1] pointer-events-none opacity-15">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
                <circle cx="50" cy="50" r="45" stroke="white" stroke-width="1" stroke-dasharray="4 4" fill="none" />
                <circle cx="50" cy="50" r="30" stroke="white" stroke-width="1" fill="none" />
                <circle cx="50" cy="50" r="8" fill="white" fill-opacity="0.2" />
            </svg>
        </div>

        {{-- Content --}}
        <div class="relative z-10 w-full max-w-7xl px-4 text-center ">
            <h1
                class="text-2xl md:text-3xl lg:text-4xl font-black text-white leading-tight uppercase tracking-widest font-heading mb-8 drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]">
                Membangun Kaltim
                Untuk Semua<br>
                <span class="text-emerald-400 drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">Sejahtera & Berdaulat</span>
            </h1>

            {{-- 3D Slider Carousel (Uiverse Pattern) --}}
            <div class="w-full max-w-6xl mx-auto relative perspective-[1200px] transform-style-3d">
                <div class="swiper banner-swiper w-full py-8 overflow-visible">
                    <div class="swiper-wrapper">
                        @php $slides = isset($sliders) && $sliders->count() ? $sliders->map(fn($s) => ['img' => $s->file ? Storage::url($s->file->storage_path ?? $s->file->path ?? '') : null, 'title' => $s->caption])->toArray() : [['img' => asset('images/slider berita/Home-2.png'), 'title' => 'Layanan Bapenda'], ['img' => asset('images/slider berita/Home-8.png'), 'title' => 'Inovasi Pajak'], ['img' => asset('images/slider berita/Bapenda-Imlek.png'), 'title' => 'Selamat Imlek'], ['img' => asset('images/slider berita/Slider-BAPENDA-Kaltim-puasa.png'), 'title' => 'Ramadhan'], ['img' => asset('images/slider berita/Bunda-KORMI.png'), 'title' => 'Kegiatan KORMI']]; @endphp
                        @foreach($slides as $sl)
                            @if($sl['img'])
                                <!-- 3D Slide -->
                                <div class="swiper-slide w-[85vw] md:w-[65vw] max-w-[850px] cursor-pointer group flex flex-col items-center"
                                    onclick="openLightbox('{{ $sl['img'] }}', '{{ $sl['title'] }}')">

                                    <!-- Image Container (Auto Height) -->
                                    <div
                                        class="w-full rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.5)] border border-white/10 relative bg-transparent">
                                        <img src="{{ $sl['img'] }}" alt="{{ $sl['title'] }}"
                                            class="w-full h-auto block transform transition-transform duration-[2s] ease-out group-hover:scale-105">

                                        <!-- Dark Overlay for Inactive Slides -->
                                        <div
                                            class="slide-overlay absolute inset-0 bg-black/50 transition-opacity duration-700 pointer-events-none">
                                        </div>
                                    </div>

                                    <!-- Slide Title Below Image -->
                                    <div
                                        class="mt-5 opacity-0 transition-opacity duration-700 ease-in-out slide-content text-center">
                                        <h2
                                            class="text-base md:text-lg font-bold text-white font-heading tracking-widest uppercase drop-shadow-md">
                                            {{ $sl['title'] }}</h2>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-pagination !-bottom-12"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- S2: SELAMAT DATANG --}}
    @php 
            $leader = (isset($leaders) && $leaders->count()) ? $leaders->first() : (object) ['name' => 'Dr. Dasmiah, S.Pd., M.A.P.', 'position' => 'Plt Kepala Bapenda', 'description' => 'Mewujudkan tata kelola pendapatan daerah Provinsi Kalimantan Timur yang inovatif, transparan, dan akuntabel untuk mendukung pembangunan Kaltim Berdaulat.', 'file' => null];
        $leaderPhotoSrc = isset($leader->file) && $leader->file ? Storage::url($leader->file->storage_path ?? $leader->file->path ?? '') : asset('images/pltbapenda3.png');

        // Dapat diatur dari Identitas Website > Sambutan Beranda
        $welcome = \App\Models\WebsiteIdentity::welcomeFor($identity ?? null, [
            'line1' => 'Bapenda Provinsi',
            'line2' => 'Kalimantan Timur',
            'content' => strip_tags($leader->description ?? '', '<strong><b><em><i>'),
            'photo_url' => $leaderPhotoSrc,
            'name' => $leader->name,
            'position' => $leader->position,
        ]);
        $welcomeTitleLines = preg_split('/\R/', $welcome['title']);
        $welcomeContentIsCustom = filled($identity->welcome_content ?? null);
    @endphp
    <section class="relative bg-white py-20 lg:py-32 overflow-hidden reveal" aria-labelledby="welcome-heading">

        {{-- Uiverse Accent: Morphing Blobs --}}
        <div class="ui-blob primary w-[500px] h-[500px] -right-40 -top-20"></div>
        <div class="ui-blob secondary w-[400px] h-[400px] -left-32 bottom-10 opacity-30"></div>

        {{-- Uiverse Accent: Subtle Dot Pattern --}}
        <div class="ui-pattern-dots"></div>

        {{-- Modern Accent: Top border accent --}}
        <div
            class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-30 pointer-events-none">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <!-- Left Side: Welcome Text -->
                <div class="order-1 lg:order-1 w-full lg:w-[60%] relative pl-0">
                    <div class="flex flex-col items-start">
                        <h2 id="welcome-heading"
                            class="font-black text-slate-900 mb-6 font-heading leading-[1.15] uppercase tracking-tight">
                            @foreach($welcomeTitleLines as $welcomeTitleLine)
                            <span class="text-3xl md:text-4xl lg:text-5xl">{{ $welcomeTitleLine }}</span> <br />
                            @endforeach
                            <span class="text-2xl md:text-3xl lg:text-4xl text-primary relative inline-block">
                                {{ $welcome['line1'] }}
                                <!-- Red Accent Line -->
                                <div class="absolute -bottom-2 left-0 w-16 h-1.5 bg-red-600 rounded-full"></div>
                            </span> <br />
                            <span class="text-2xl md:text-3xl lg:text-4xl text-primary mt-2 block">{{ $welcome['line2'] }}</span>
                        </h2>

                        <div class="text-base text-gray-600 font-body leading-relaxed mb-10 max-w-xl mt-4">
                            @if($welcomeContentIsCustom)
                                {!! nl2br(e($welcome['content'])) !!}
                            @else
                                {!! $welcome['content'] !!}
                            @endif
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <div
                                class="ui-float-badge flex items-center gap-3 bg-white shadow-xl shadow-primary/5 border border-primary-light p-4 rounded-2xl">
                                <div
                                    class="ui-badge-icon w-10 h-10 bg-primary-light text-primary rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="text-sm font-black text-slate-800 font-heading uppercase tracking-tight">Berintegritas</span>
                            </div>
                            <div
                                class="ui-float-badge flex items-center gap-3 bg-white shadow-xl shadow-primary/5 border border-primary-light p-4 rounded-2xl">
                                <div
                                    class="ui-badge-icon w-10 h-10 bg-primary-light text-primary rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <span
                                    class="text-sm font-black text-slate-800 font-heading uppercase tracking-tight">Akuntabel</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Photo Card -->
                <div class="order-2 lg:order-2 w-full lg:w-[35%] flex justify-center items-center py-6">
                    <div class="relative w-full max-w-[240px]">
                        <div
                            class="absolute inset-0 bg-primary-light rounded-[3rem] blur-2xl transform -rotate-6 scale-110">
                        </div>

                        <div
                            class="bg-white p-1 rounded-[2.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] relative overflow-hidden group border border-primary-light/30 mb-6">
                            <div class="aspect-[3/4] overflow-hidden rounded-[2.5rem] relative bg-slate-50">
                                <img src="{{ $welcome['photo_url'] }}" alt="{{ $welcome['name'] }}"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110"
                                    onerror="this.onerror=null;this.src='{{ asset('images/pltbapenda3.png') }}'">

                                <div class="absolute inset-x-0 bottom-0 p-3">
                                    <div
                                        class="bg-navy/90 backdrop-blur-xl px-4 py-3 rounded-2xl w-full shadow-2xl border border-white/10 overflow-hidden transition-all duration-300 group-hover:bg-navy-dark/95">
                                        <h3
                                            class="text-sm md:text-base font-black text-white uppercase leading-tight tracking-tight font-heading">
                                            {{ $welcome['name'] }}
                                        </h3>
                                        <div class="flex items-center gap-2 my-1.5">
                                            <div class="flex-1 h-px bg-primary/30"></div>
                                            <div
                                                class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)]">
                                            </div>
                                            <div class="flex-1 h-px bg-primary/30"></div>
                                        </div>
                                        <p
                                            class="text-primary-light text-[7px] md:text-[8px] font-black uppercase tracking-[0.15em] leading-relaxed font-body text-center">
                                            {{ $welcome['position'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6"></div>
                    </div>
                </div>
            </div>
        </div>
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
    <section id="layanan" class="relative bg-emerald-50/20 py-12 md:py-24 reveal overflow-hidden">

        {{-- Modern Accent: Dot matrix pattern --}}
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
            style="background-image: radial-gradient(circle, #059669 1.5px, transparent 1.5px); background-size: 28px 28px;">
        </div>
        {{-- Modern Accent: Diagonal lines kanan --}}
        <div class="absolute right-0 top-0 bottom-0 w-1/3 pointer-events-none opacity-[0.03]"
            style="background-image: repeating-linear-gradient(-45deg, #059669 0, #059669 1px, transparent 0, transparent 50%); background-size: 20px 20px;">
        </div>
        {{-- Modern Accent: Glow emerald kiri --}}
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-72 h-72 pointer-events-none"
            style="background: radial-gradient(circle, rgba(5,150,105,0.07) 0%, transparent 70%);"></div>

        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 font-heading uppercase tracking-tight">Layanan
                    Unggulan</h2>
                <div class="w-16 h-1.5 bg-red-600 rounded-full mx-auto mt-4"></div>
                <p class="text-slate-500 font-body text-sm md:text-base max-w-xl mx-auto mt-4">
                    Cari lokasi dan jenis layanan SAMSAT terdekat di seluruh Kalimantan Timur.
                </p>
            </div>

            <x-portal.peta-layanan-samsat :locations="$samsatLocations ?? []" height="600px" />
        </div>
    </section>

    {{-- S4: CEK PAJAK --}}
    <section id="cek-pajak" class="relative bg-white py-20 lg:py-28 overflow-hidden reveal">

        <div class="absolute inset-0 opacity-40 ui-bg-grid"></div>
        <div class="ui-floating-glow -left-32 top-32"></div>

        <div class="container mx-auto px-6 relative z-10">


            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch max-w-6xl mx-auto">
                <!-- Left Card: Cek Pajak Form -->
                <div
                    class="lg:col-span-8 bg-white p-8 md:p-12 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-between text-center relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-tighter leading-none font-heading">
                            Cek Pajak Kendaraan Anda</h3>
                    </div>
                    <div class="flex flex-col items-center justify-center    gap-2">
                        <div
                            class="absolute -right-16 -top-16 w-32 h-32 bg-primary/5 rounded-full blur-xl pointer-events-none group-hover:bg-primary/10 transition-colors duration-500">
                        </div>
                        <div
                            class="w-20 h-20 rounded-3xl bg-primary-light border border-primary-light flex items-center justify-center mx-auto mb-8 shadow-inner group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight mb-2 font-heading">Masukkan
                            Nomor Polisi</h3>
                        <p class="text-xs text-slate-400 mb-6 font-body font-medium">Contoh: KT 1234 ABC</p>
                        <form action="http://simpator.kaltimprov.go.id/cari.php" method="POST" target="_blank"
                            class="flex flex-col gap-5 max-w-md mx-auto">
                            <div class="flex items-center justify-center gap-3">
                                <label for="kt" class="sr-only">Kode Wilayah Awal</label>
                                <input type="text" id="kt" name="kt" aria-label="Kode Wilayah Awal (contoh: KT)"
                                    placeholder="KT" value="KT"
                                    class="w-[70px] bg-slate-50 rounded-2xl px-2 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading"
                                    required>
                                <label for="nomor" class="sr-only">Nomor Polisi</label>
                                <input type="number" id="nomor" name="nomor" aria-label="Nomor Polisi" placeholder="1234"
                                    class="flex-1 bg-slate-50 rounded-2xl px-4 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading tracking-widest hide-scrollbar"
                                    required>
                                <label for="seri" class="sr-only">Kode Wilayah Akhir</label>
                                <input type="text" id="seri" name="seri" aria-label="Kode Wilayah Akhir (contoh: ABC)"
                                    placeholder="ABC"
                                    class="w-[90px] bg-slate-50 rounded-2xl px-2 py-4 text-slate-800 font-bold text-center text-xl uppercase placeholder:text-slate-300 outline-none focus:ring-4 focus:ring-primary/50 transition-all border-2 border-slate-100 focus:border-primary font-heading"
                                    required>
                            </div>
                            <button type="submit" name="pkb" value="Process"
                                class="ui-btn-shimmer w-full px-8 py-4 font-black tracking-widest uppercase flex items-center justify-center gap-3 font-heading text-base">
                                Cek Pajak di SIMPATOR
                                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>

                    </div>
                    <div class="mb-3"></div>
                </div>

                <!-- Right Card: Infographic Slider (Instagram UI Verse Style) -->
                <div
                    class="lg:col-span-4 bg-white p-6 md:p-4 rounded-[3rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 flex flex-col justify-between relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 min-h-[500px]">
                    <div
                        class="absolute -left-16 -bottom-16 w-32 h-32 bg-secondary/5 rounded-full blur-xl pointer-events-none group-hover:bg-secondary/10 transition-colors duration-500">
                    </div>

                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                            <h3
                                class="text-sm font-black text-slate-900 uppercase tracking-tighter leading-none font-heading">
                                Informasi Grafis</h3>
                        </div>

                        <div class="flex gap-2">
                            <button
                                class="pajak-prev w-8 h-8 rounded-full border border-slate-200 text-slate-600 flex items-center justify-center hover:bg-primary hover:border-primary hover:text-white hover:scale-105 transition-all duration-300"
                                aria-label="Slide Sebelumnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button
                                class="pajak-next w-8 h-8 rounded-full border border-slate-200 text-slate-600 flex items-center justify-center hover:bg-primary hover:border-primary hover:text-white hover:scale-105 transition-all duration-300"
                                aria-label="Slide Selanjutnya">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative w-full flex-1 overflow-hidden">
                        <div class="swiper pajak-slider w-full h-full">
                            <div class="swiper-wrapper">
                                @if(isset($infografis) && count($infografis))
                                    @foreach($infografis as $item)
                                        <div class="swiper-slide h-full">
                                            <div class="ui-instagram-card w-full h-full relative flex flex-col bg-white/80 backdrop-blur-md rounded-lg border border-slate-100 shadow-lg overflow-hidden group/slide cursor-pointer"
                                                onclick="openLightbox('{{ $item->file ? Storage::url($item->file->path) : asset('images/slider berita/Home-2.png') }}', '{{ $item->caption }}')">
                                                <!-- <div class="flex items-center justify-between px-4 py-3 bg-white/50 border-b border-slate-100"> -->
                                                    <!-- <div class="flex items-center gap-2">
                                                        <div class="w-7 h-7 rounded-full border border-primary/20 overflow-hidden bg-white p-0.5 shrink-0">
                                                            <img src="{{ asset('images/logo bapenda.png') }}" class="w-full h-full object-contain" alt="Logo">
                                                        </div>
                                                        <div>
                                                            <div class="flex items-center gap-1">
                                                                <span class="text-[11px] font-black text-slate-800 font-heading tracking-wide">bapendakaltim</span>
                                                                <svg class="w-3 h-3 text-blue-500 fill-current" viewBox="0 0 24 24">
                                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                                                </svg>
                                                            </div>
                                                            <p class="text-[8px] font-bold text-slate-400 font-body leading-none">Samarinda, Indonesia</p>
                                                        </div>
                                                    </div> -->
                                                    <!-- <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-primary/10 text-primary text-[8px] font-black rounded-full uppercase tracking-wider font-heading">
                                                        <span class="w-1 h-1 rounded-full bg-emerald-500 animate-ping"></span> Live Feed
                                                    </span> -->
                                                <!-- </div> -->
                                                <div class="relative w-full overflow-hidden flex-1 aspect-square bg-slate-50">
                                                    <img src="{{ $item->file ? Storage::url($item->file->path) : asset('images/slider berita/Home-2.png') }}" alt="{{ $item->caption }}" class="w-full h-full object-cover transition-transform duration-[1s] ease-out group-hover/slide:scale-105">
                                                    <div class="absolute bottom-3 left-3 right-3 bg-slate-900/85 backdrop-blur-md rounded-xl p-3.5 border border-white/10 shadow-2xl transform translate-y-2 opacity-0 group-hover/slide:translate-y-0 group-hover/slide:opacity-100 transition-all duration-300 ease-out z-20">
                                                        <p class="text-emerald-400 font-heading font-black text-[9px] uppercase tracking-widest mb-0.5">Info Detail</p>
                                                        <p class="text-white font-body font-bold text-[11px] leading-snug line-clamp-2">{{ $item->caption }}</p>
                                                    </div>
                                                </div>
                                                <!-- <div class="flex items-center justify-between px-4 py-2.5 bg-white/50 border-t border-slate-100 text-slate-600 z-10">
                                                    <div class="flex items-center gap-3">
                                                        <button class="love-btn hover:text-red-500 hover:scale-125 transition-all duration-300" onclick="toggleLove(event, this)">
                                                            <svg class="w-4.5 h-4.5 transition-transform duration-300 fill-none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                        </button>
                                                        <button class="hover:text-primary hover:scale-125 transition-all duration-300" onclick="event.stopPropagation();">
                                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    @endforeach
                                @else
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
                                            <div class="ui-instagram-card w-full h-full relative flex flex-col bg-white/80 backdrop-blur-md rounded-[2rem] border border-slate-100 shadow-lg overflow-hidden group/slide cursor-pointer"
                                                onclick="openLightbox('{{ $slide['img'] }}', '{{ $slide['caption'] }}')">
                                                <!-- Post Header -->
                                                <div class="flex items-center justify-between px-4 py-3 bg-white/50 border-b border-slate-100">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-7 h-7 rounded-full border border-primary/20 overflow-hidden bg-white p-0.5 shrink-0">
                                                            <img src="{{ asset('images/logo bapenda.png') }}" class="w-full h-full object-contain" alt="Logo">
                                                        </div>
                                                        <div>
                                                            <div class="flex items-center gap-1">
                                                                <span class="text-[11px] font-black text-slate-800 font-heading tracking-wide">bapendakaltim</span>
                                                                <svg class="w-3 h-3 text-blue-500 fill-current" viewBox="0 0 24 24">
                                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                                                </svg>
                                                            </div>
                                                            <p class="text-[8px] font-bold text-slate-400 font-body leading-none">Samarinda, Indonesia</p>
                                                        </div>
                                                    </div>
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-primary/10 text-primary text-[8px] font-black rounded-full uppercase tracking-wider font-heading">
                                                        <span class="w-1 h-1 rounded-full bg-emerald-500 animate-ping"></span> Live Feed
                                                    </span>
                                                </div>
                                                <div class="relative w-full overflow-hidden flex-1 aspect-square bg-slate-50">
                                                    <img src="{{ $slide['img'] }}" alt="{{ $slide['caption'] }}" class="w-full h-full object-cover transition-transform duration-[1s] ease-out group-hover/slide:scale-105">
                                                    <div class="absolute bottom-3 left-3 right-3 bg-slate-900/85 backdrop-blur-md rounded-xl p-3.5 border border-white/10 shadow-2xl transform translate-y-2 opacity-0 group-hover/slide:translate-y-0 group-hover/slide:opacity-100 transition-all duration-300 ease-out z-20">
                                                        <p class="text-emerald-400 font-heading font-black text-[9px] uppercase tracking-widest mb-0.5">Info Detail</p>
                                                        <p class="text-white font-body font-bold text-[11px] leading-snug line-clamp-2">{{ $slide['caption'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-between px-4 py-2.5 bg-white/50 border-t border-slate-100 text-slate-600 z-10">
                                                    <div class="flex items-center gap-3">
                                                        <button class="love-btn hover:text-red-500 hover:scale-125 transition-all duration-300" onclick="toggleLove(event, this)">
                                                            <svg class="w-4.5 h-4.5 transition-transform duration-300 fill-none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                        </button>
                                                        <button class="hover:text-primary hover:scale-125 transition-all duration-300" onclick="event.stopPropagation();">
                                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                                <button class="hover:text-primary hover:scale-125 transition-all duration-300"
                                                    onclick="event.stopPropagation();">
                                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                            </div>
                            <div class="pajak-pagination flex justify-center gap-2 mt-4"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- S5: BERITA + GPR --}}
    @include('portal.partials.berita-gpr')

    {{-- S8: SOSIAL MEDIA --}}
    @include('portal.partials.media-sosial')



    {{-- S6B: PETA UPTD KALIMANTAN TIMUR --}}
    <section class="relative py-20 lg:py-28 overflow-hidden reveal"
        style="background: linear-gradient(135deg, #0f172a 0%, #064e3b 50%, #0f172a 100%);">

        {{-- Decorative Elements --}}
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: radial-gradient(rgba(16, 185, 129, 0.5) 1px, transparent 1px); background-size: 40px 40px;">
        </div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-400/10 rounded-full blur-[120px]"></div>

        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-12">
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 bg-teal-500/20 border border-teal-400/30 rounded-full text-[10px] md:text-xs text-teal-300 uppercase font-black tracking-[0.2em] mb-4">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Jaringan UPTD
                </span>
                <h2
                    class="text-3xl md:text-5xl font-black text-white font-heading uppercase tracking-tight leading-[1.1] mb-4">
                    Peta <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-300">UPTD
                        Pelayanan Pajak</span>
                </h2>
                <p class="text-white/50 text-sm md:text-base font-body max-w-xl mx-auto">
                    Jelajahi lokasi UPTD Badan Pendapatan Daerah di seluruh kabupaten dan kota se-Kalimantan Timur.
                </p>
                <div class="w-16 h-1.5 bg-red-600 rounded-full mx-auto mt-6"></div>
            </div>

            {{-- Interactive Map Component --}}
            <x-portal.kaltim-map :website="$website" :uptds="$uptdData ?? []" />
        </div>
    </section>


    {{-- S7: APLIKASI & AGENDA --}}
    <section class="bg-slate-900 py-16 md:py-28 relative overflow-hidden reveal">

        <!-- Dynamic Background Elements -->
        <div class="absolute inset-0 opacity-[0.15] ui-bg-grid"
            style="background-image: radial-gradient(#059669 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-900/20 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="flex flex-col lg:grid lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">

                {{-- Aplikasi Lainya --}}
                <div class="lg:col-span-8 xl:col-span-9 flex flex-col">
                    <div class="mb-8 md:mb-12 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <span
                                class="inline-block px-3 py-1 bg-white/10 text-primary-light text-[10px] font-black rounded-full mb-3 tracking-[0.2em] uppercase font-heading backdrop-blur-sm border border-white/10 shadow-[0_0_15px_rgba(5,150,105,0.2)]">Jejaring
                                Pintar</span>
                            <h2
                                class="text-3xl md:text-4xl font-black text-white font-heading tracking-tighter uppercase mb-2">
                                Aplikasi <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-primary-light to-emerald-200">&
                                    Layanan</span></h2>
                        </div>
                        <div class="flex gap-3">
                            <button
                                class="app-prev w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-white flex items-center justify-center hover:bg-primary hover:border-primary transition-all duration-300 backdrop-blur-sm group shadow-lg"
                                aria-label="Aplikasi Sebelumnya">
                                <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" aria-hidden="true"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button
                                class="app-next w-12 h-12 rounded-2xl bg-white/5 border border-white/10 text-white flex items-center justify-center hover:bg-primary hover:border-primary transition-all duration-300 backdrop-blur-sm group shadow-lg"
                                aria-label="Aplikasi Selanjutnya">
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" aria-hidden="true"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="swiper app-swiper w-full overflow-visible py-4 flex-1 flex items-center">
                        <div class="swiper-wrapper items-center">
                            @foreach([['name' => 'E-Samsat', 'url' => 'https://esamsat.kaltimprov.go.id', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'], ['name' => 'SP4N LAPOR!', 'url' => 'https://www.lapor.go.id/', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'], ['name' => 'PPID Kaltim', 'url' => 'https://ppid.kaltimprov.go.id/', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'], ['name' => 'Pemprov Kaltim', 'url' => 'https://kaltimprov.go.id/', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9']] as $eg)
                                <div class="swiper-slide !w-64 md:!w-[280px] pt-4 pb-8">
                                    <a href="{{ $eg['url'] }}" target="_blank"
                                        class="block bg-[#1e293b]/80 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 text-center hover:-translate-y-4 transition-all duration-500 h-full group hover:bg-[#1e293b] relative overflow-hidden shadow-[0_8px_32px_0_rgba(0,0,0,0.3)]">
                                        <!-- Hover Glow Effect -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-b from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                                        </div>

                                        <div class="relative z-10">
                                            <div
                                                class="w-20 h-20 mx-auto mb-8 rounded-[1.5rem] bg-white/5 border border-white/10 text-white flex items-center justify-center group-hover:scale-110 group-hover:bg-primary group-hover:border-primary group-hover:shadow-[0_0_30px_rgba(5,150,105,0.4)] transition-all duration-500">
                                                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="{{ $eg['icon'] }}" />
                                                </svg>
                                            </div>
                                            <h4
                                                class="font-heading font-black text-white text-lg md:text-xl uppercase tracking-wide mb-6 group-hover:text-primary-light transition-colors">
                                                {{ $eg['name'] }}</h4>

                                            <div
                                                class="inline-flex items-center gap-2 text-primary-light font-bold text-[11px] uppercase tracking-[0.2em] opacity-80 group-hover:opacity-100 transition-opacity font-heading">
                                                KUNJUNGI <svg
                                                    class="w-4 h-4 group-hover:translate-x-2 transition-transform duration-300"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Agenda JS Calendar --}}
                <div class="lg:col-span-4 xl:col-span-3 w-full relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-primary to-blue-500 rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition-opacity duration-500">
                    </div>
                    <div
                        class="bg-[#0f172a] rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/10 flex flex-col h-full relative z-10">
                        <div
                            class="bg-gradient-to-br from-white/5 to-transparent border-b border-white/5 p-6 relative overflow-hidden">
                            <!-- Decorative pattern -->
                            <div class="absolute inset-0 opacity-[0.03]"
                                style="background-image: repeating-linear-gradient(45deg, #fff 0, #fff 1px, transparent 0, transparent 50%); background-size: 10px 10px;">
                            </div>

                            <div class="flex items-center justify-between mb-4 relative z-10">
                                <h3
                                    class="text-base md:text-lg font-black text-white font-heading tracking-widest uppercase flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-primary/20 border border-primary/50 text-primary-light flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    Agenda Bapenda
                                </h3>
                            </div>

                            <!-- Calendar Navigation -->
                            <div
                                class="flex items-center justify-between text-white bg-white/5 border border-white/10 rounded-xl p-2 backdrop-blur-md relative z-10">
                                <button id="cal-prev"
                                    class="w-8 h-8 flex items-center justify-center hover:bg-primary hover:text-white rounded-lg transition-colors"
                                    aria-label="Bulan Sebelumnya">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <h4 id="cal-month-year"
                                    class="font-black text-sm uppercase tracking-widest font-heading text-primary-light"
                                    aria-live="polite">Mei 2026</h4>
                                <button id="cal-next"
                                    class="w-8 h-8 flex items-center justify-center hover:bg-primary hover:text-white rounded-lg transition-colors"
                                    aria-label="Bulan Selanjutnya">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col bg-white">
                            <!-- Days Header -->
                            <div class="grid grid-cols-7 gap-1 mb-2">
                                <div class="text-center text-[10px] font-bold text-slate-400 uppercase">Sen</div>
                                <div class="text-center text-[10px] font-bold text-slate-400 uppercase">Sel</div>
                                <div class="text-center text-[10px] font-bold text-slate-400 uppercase">Rab</div>
                                <div class="text-center text-[10px] font-bold text-slate-400 uppercase">Kam</div>
                                <div class="text-center text-[10px] font-bold text-slate-400 uppercase">Jum</div>
                                <div class="text-center text-[10px] font-bold text-red-400 uppercase">Sab</div>
                                <div class="text-center text-[10px] font-bold text-red-400 uppercase">Min</div>
                            </div>
                            <!-- Calendar Grid -->
                            <div id="cal-grid" class="grid grid-cols-7 gap-1 flex-1">
                                <!-- JS akan merender tanggal disini -->
                            </div>

                            <!-- Agenda Info Box -->
                            <div id="cal-agenda-info" class="mt-4 pt-4 border-t border-slate-100 hidden">
                                <div
                                    class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-3 flex items-center justify-between">
                                    <span id="cal-agenda-date"></span>
                                    <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded-full text-[9px]">Ada
                                        Agenda</span>
                                </div>
                                <div id="cal-agenda-list" class="flex flex-col gap-2 max-h-[140px] overflow-y-auto pr-1">
                                    <!-- JS Agenda items -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- LIGHTBOX MODAL --}}
    <div id="imageLightbox" class="fixed inset-0 z-[200] items-center justify-center p-4 md:p-8 hidden"
        onclick="closeLightbox(event)">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-sm transition-opacity duration-300"></div>
        <button onclick="closeLightbox(event, true)"
            class="absolute top-4 right-4 md:top-8 md:right-8 z-10 w-12 h-12 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-white/20 transition-all duration-300 group"
            aria-label="Tutup Lightbox">
            <svg class="w-6 h-6 transition-transform group-hover:rotate-90" aria-hidden="true" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="relative z-10 max-w-6xl w-full max-h-[90vh] flex flex-col items-center"
            onclick="event.stopPropagation()">
            <img id="lightboxImage" src="" alt=""
                class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl transition-transform duration-500"
                style="transform: scale(0.9);">
            <p id="lightboxCaption"
                class="mt-4 text-white text-lg font-bold text-center drop-shadow-md font-heading tracking-wide"></p>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
    <script>
        function openLightbox(src, caption) {
            if (!src) return;
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

        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.banner-swiper', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                spaceBetween: 40,
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto'
            });
            new Swiper('.app-swiper', {
                loop: true,
                autoplay: { delay: 3000, disableOnInteraction: false },
                navigation: { nextEl: '.app-next', prevEl: '.app-prev' },
                spaceBetween: 24,
                grabCursor: true,
                slidesPerView: 'auto'
            });

            new Swiper('.pajak-slider', {
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

    <style>
        @keyframes heroOrb {

            0%,
            100% {
                transform: translate(0, 0) scale(1)
            }

            50% {
                transform: translate(40px, -30px) scale(1.1)
            }
        }

        /* Banner Swiper — Centered Slide Effect */
        .banner-swiper .swiper-slide {
            width: 80%;
            max-width: 720px;
            aspect-ratio: 21/9;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            transform: scale(0.85);
            border-radius: 1rem;
            overflow: hidden;
        }

        @media (min-width: 768px) {
            .banner-swiper .swiper-slide {
                width: 55%;
            }
        }

        .banner-swiper .swiper-slide-active {
            transform: scale(1);
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        .banner-swiper .swiper-slide-active .slide-overlay {
            opacity: 0 !important;
        }

        .banner-swiper .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.4);
        }

        .banner-swiper .swiper-pagination-bullet-active {
            background: #059669;
            width: 24px;
            border-radius: 4px;
        }

        /* UI Verse Glowing Border Effect for Slide Post */
        .ui-instagram-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .ui-instagram-card:hover {
            box-shadow: 0 20px 40px -10px rgba(5, 150, 105, 0.15), 0 0 0 2px rgba(5, 150, 105, 0.2);
            transform: translateY(-4px);
        }

        /* Custom Swiper Pagination for Pajak Slider */
        .pajak-pagination .swiper-pagination-bullet {
            background: #cbd5e1;
            width: 6px;
            height: 6px;
            opacity: 0.5;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 9999px;
        }

        .pajak-pagination .swiper-pagination-bullet-active {
            background: #059669;
            width: 20px;
            opacity: 1;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(5, 150, 105, 0.4);
        }

        /* Glowing Love Animation */
        .love-btn.active svg {
            fill: #ef4444;
            stroke: #ef4444;
            filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.6));
            animation: heartBeat 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes heartBeat {
            0% {
                transform: scale(1);
            }

            30% {
                transform: scale(1.4);
            }

            60% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1.2);
            }
        }

        /* 3D Carousel Styles Equivalent for Hero Banner */
        .banner-swiper {
            perspective: 1200px;
            transform-style: preserve-3d;
        }

        .banner-swiper .swiper-slide {
            transform-origin: bottom;
            transform: scale(0.95) rotateX(8deg);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.6s ease;
            opacity: 0.6;
        }

        .banner-swiper .swiper-slide-active {
            transform: scale(1) rotateX(0deg);
            opacity: 1;
            z-index: 10;
        }

        .banner-swiper .swiper-slide-active .slide-overlay {
            opacity: 0;
        }

        .banner-swiper .swiper-slide-active .slide-content {
            opacity: 1;
            visibility: visible;
        }

        .banner-swiper .swiper-slide:not(.swiper-slide-active) .slide-content {
            opacity: 0;
            visibility: hidden;
        }
    </style>

    @php
        $agendaData = [];
        $calendarAgendaSource = $calendarAgendas ?? $agendas ?? collect();

        if ($calendarAgendaSource->count()) {
            $agendaData = $calendarAgendaSource->map(function ($agenda) {
                return [
                    'date' => \Carbon\Carbon::parse($agenda->schedule)->format('Y-m-d'),
                    'title' => $agenda->caption ?? 'Agenda',
                    'time' => \Carbon\Carbon::parse($agenda->schedule)->format('H:i'),
                    'location' => $agenda->location ?? 'Lokasi belum ditentukan',
                    'description' => $agenda->description ?? '',
                ];
            })->all();
        }
    @endphp

    <script>
        const agendaData = <?php echo json_encode($agendaData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

        document.addEventListener('DOMContentLoaded', function () {
            const calGrid = document.getElementById('cal-grid');
            if (!calGrid) return;

            const calMonthYear = document.getElementById('cal-month-year');
            const calPrev = document.getElementById('cal-prev');
            const calNext = document.getElementById('cal-next');

            let currentDate = new Date();
            const todayStr = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`;
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            function renderCalendar(date) {
                calGrid.innerHTML = '';
                const year = date.getFullYear();
                const month = date.getMonth();

                calMonthYear.textContent = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                let startingDay = firstDay === 0 ? 6 : firstDay - 1;

                for (let i = 0; i < startingDay; i++) {
                    calGrid.innerHTML += `<div class="p-1"></div>`;
                }

                for (let i = 1; i <= daysInMonth; i++) {
                    let currentLoopDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                    const hasAgenda = agendaData.some(a => a.date === currentLoopDate);
                    const agendaDot = hasAgenda ? '<div class="w-1.5 h-1.5 bg-red-500 rounded-full mx-auto mt-0.5"></div>' : '';
                    const isToday = currentLoopDate === todayStr;
                    const activeClass = isToday ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-primary-light text-slate-700';

                    calGrid.innerHTML += `
                        <div class="p-1">
                            <button onclick="showAgenda('${currentLoopDate}')"
                                class="w-full aspect-square flex flex-col items-center justify-center rounded-xl text-[11px] font-bold transition-all duration-300 ${activeClass}">
                                ${i}
                                ${agendaDot}
                            </button>
                        </div>
                    `;
                }
            }

            window.showAgenda = function (dateStr) {
                const agendaBox = document.getElementById('cal-agenda-info');
                const agendaList = document.getElementById('cal-agenda-list');
                const agendaDate = document.getElementById('cal-agenda-date');
                const filtered = agendaData.filter(a => a.date === dateStr);

                if (filtered.length > 0) {
                    agendaBox.classList.remove('hidden');
                    const d = new Date(dateStr);
                    agendaDate.textContent = `${d.getDate()} ${monthNames[d.getMonth()]}`;

                    agendaList.innerHTML = filtered.map(function (a) {
                        const descriptionHtml = a.description ? '<p class="mt-2 text-[9px] text-slate-500 leading-relaxed">' + a.description + '</p>' : '';

                        return `
                            <div class="bg-slate-50 p-3 rounded-xl border-l-4 border-red-500 shadow-sm">
                                <p class="capitalize text-[11px] font-black text-slate-800 leading-tight mb-1">${a.title}</p>
                                
                                <div class="flex items-center gap-1 text-[9px] text-slate-500 font-semibold leading-snug">
                                    <svg class="w-3 h-3  shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="capitalize">${a.location}</span>
                                </div>
                                ${descriptionHtml}
                            </div>
                        `;
                    }).join('');
                } else {
                    agendaBox.classList.add('hidden');
                }
            };

            calPrev.onclick = () => { currentDate.setMonth(currentDate.getMonth() - 1); renderCalendar(currentDate); };
            calNext.onclick = () => { currentDate.setMonth(currentDate.getMonth() + 1); renderCalendar(currentDate); };

            renderCalendar(currentDate);
        });
    </script>

@endpush