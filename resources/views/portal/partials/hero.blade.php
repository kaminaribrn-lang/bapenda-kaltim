{{-- ============================================================ --}}
{{-- S1: HERO SECTION                                           --}}
{{-- Berisi: Background gedung, overlay, judul, slider carousel --}}
{{-- ============================================================ --}}
<section class="relative min-h-[600px] md:min-h-[750px] overflow-hidden flex flex-col items-center justify-center pt-24"
         style="background: url('{{ asset('images/gedung-bapenda-hero.jpg') }}') center/cover no-repeat;">

    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full max-w-7xl px-4 text-center">

        {{-- Judul Utama --}}
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white leading-tight uppercase tracking-tight font-heading mb-8 drop-shadow-2xl">
            Membangun Kaltim
            Untuk Semua<br>
            <span class="text-emerald-400">Sejahtera & Berdaulat</span>
        </h1>

        {{-- Slider Carousel (centered) --}}
        <div class="w-full max-w-6xl mx-auto">
            <div class="swiper banner-swiper w-full py-4 overflow-visible">
                <div class="swiper-wrapper">

                    {{-- Data slide: dari DB atau fallback default --}}
                    @php
                        $slides = isset($sliders) && $sliders->count()
                            ? $sliders->map(fn($s) => [
                                'img'   => $s->file ? Storage::url($s->file->storage_path ?? $s->file->path ?? '') : null,
                                'title' => $s->caption,
                              ])->toArray()
                            : [
                                ['img' => asset('images/slider berita/Home-2.png'),                    'title' => 'Layanan Bapenda'],
                                ['img' => asset('images/slider berita/Home-8.png'),                    'title' => 'Inovasi Pajak'],
                                ['img' => asset('images/slider berita/Bapenda-Imlek.png'),             'title' => 'Selamat Imlek'],
                                ['img' => asset('images/slider berita/Slider-BAPENDA-Kaltim-puasa.png'), 'title' => 'Ramadhan'],
                                ['img' => asset('images/slider berita/Bunda-KORMI.png'),               'title' => 'Kegiatan KORMI'],
                              ];
                    @endphp

                    @foreach($slides as $sl)
                        @if($sl['img'])
                            <div class="swiper-slide rounded-[2rem] overflow-hidden cursor-pointer aspect-video md:aspect-[21/9] shadow-2xl border border-white/10"
                                 onclick="openLightbox('{{ $sl['img'] }}', '{{ $sl['title'] }}')">

                                <img src="{{ $sl['img'] }}" alt="{{ $sl['title'] }}" class="w-full h-full object-cover">

                                {{-- Overlay (aktif = transparan, non-aktif = gelap) --}}
                                <div class="slide-overlay absolute inset-0 bg-black/50 transition-opacity duration-500 rounded-[2rem]"></div>

                                {{-- Caption di bawah --}}
                                <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                    <p class="text-white font-heading font-bold text-sm leading-snug line-clamp-2">
                                        {{ $sl['title'] }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="swiper-pagination !-bottom-10"></div>
            </div>
        </div>

    </div>
</section>
