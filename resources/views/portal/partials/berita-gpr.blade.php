{{--
    Section "Kabar Terkini" + GPR Komdigi — dipakai beranda utama dan semua beranda UPTD agar layoutnya sama.
    Variabel: $website, $beritaTerbaru (opsional), $newsLimit (opsional, bawaan 3).
--}}
@php
    $newsArray = [];
    // Gambar pengganti bila berita tidak punya thumbnail atau file-nya hilang dari penyimpanan.
    $newsFallbackImage = asset('images/gedung-bapenda-hero.jpg');
    if (isset($beritaTerbaru) && $beritaTerbaru->count() > 0) {
        foreach ($beritaTerbaru->take($newsLimit ?? 3) as $post) {
            $newsArray[] = [
                'title' => $post->title,
                'category' => $post->category->name ?? 'Berita',
                'date' => \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M Y'),
                'image' => ($post->file && Storage::disk('public')->exists($post->file->path)) ? Storage::url($post->file->path) : $newsFallbackImage,
                'excerpt' => Str::limit(strip_tags($post->content), 120),
                'slug' => $post->slug,
                'url' => route('portal.berita.show', [$post->website?->slug ?? $website->slug, $post->slug])
            ];
        }
    } else {
        // Fallback Dummy Data
        $dummyNewsData = [
            [
                'cat' => 'Berita',
                'title' => 'Bapenda Kaltim Perkuat Pemahaman OPD terhadap Perubahan Regulasi Pajak dan Retribusi Daerah',
                'img' => 'https://snow-hyena-855969.hostingersite.com/berita1.jpeg',
                'excerpt' => 'Bapenda Kaltim terus memperkuat sinergi pengelolaan pendapatan daerah melalui sosialisasi',
                'date' => '18 Mei 2026'
            ],
            [
                'cat' => 'Berita',
                'title' => 'Bapenda Kaltim Serahkan Arsip Statis, Wujud Komitmen Jaga Akuntabilitas',
                'img' => 'https://snow-hyena-855969.hostingersite.com/berita2.jpeg',
                'excerpt' => 'Bapenda Kaltim melaksanakan kegiatan Penyerahan Arsip Statis kepada Lembaga Kearsipan Daerah melalui Dinas Perpustakaan dan Kearsipan Prov Kaltim',
                'date' => '12 Mei 2026'
            ],
            [
                'cat' => 'Berita',
                'title' => 'Pemprov Kaltim Perkuat Pengawasan Pajak Daerah, Fokus pada Sektor Perkebunan dan Pertambangan',
                'img' => 'https://snow-hyena-855969.hostingersite.com/berita3.jpeg',
                'excerpt' => 'Bapenda Kaltim menggelar rapat persiapan pelaksanaan pemeriksaan dan pendataan sektor perkebunan serta pertambangan',
                'date' => '12 Mei 2026'
            ],
            [
                'cat' => 'Berita',
                'title' => 'Bapenda Kaltim Bahas Kendaraan Operasional di Area Tambang yang Belum Teregistrasi',
                'img' => 'https://snow-hyena-855969.hostingersite.com/berita4.jpeg',
                'excerpt' => 'Bapenda Kaltim menggelar rapat pembahasan terkait kendaraan bermotor yang beroperasi di luar jalan umum',
                'date' => '13 Mei 2026'
            ]
        ];
        foreach ($dummyNewsData as $dn) {
            $newsArray[] = [
                'title' => $dn['title'],
                'category' => $dn['cat'],
                'date' => $dn['date'],
                'image' => $dn['img'],
                'excerpt' => $dn['excerpt'],
                'slug' => '#',
                'url' => '#'
            ];
        }
    }
@endphp

<section id="berita" class="py-24 relative overflow-hidden bg-slate-50 reveal border-t border-gray-100" style="--news-shade: color-mix(in srgb, var(--color-primary) 30%, #020617);" x-data="{
                activeIndex: 0,
                news: {{ json_encode($newsArray) }},
                get activeNews() { return this.news[this.activeIndex]; },
                prev() { this.activeIndex = (this.activeIndex - 1 + this.news.length) % this.news.length; },
                next() { this.activeIndex = (this.activeIndex + 1) % this.news.length; },
                transitionKey: 0
            }" x-effect="transitionKey = activeIndex">
    {{-- Decorative Accent: Blobs & Pattern --}}
    <div class="ui-blob primary w-[600px] h-[600px] -left-64 top-0 opacity-20 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: radial-gradient(var(--color-primary) 1px, transparent 1px); background-size: 20px 20px;"></div>

    <div class="container mx-auto px-4 max-w-7xl relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span
                    class="inline-block px-4 py-1.5 bg-primary-light text-primary text-[10px] font-black rounded-full mb-4 tracking-[0.2em] uppercase font-heading">Berita
                    &amp; Informasi</span>
                <h2 class="font-heading font-black text-4xl text-slate-900 tracking-tighter uppercase leading-none">
                    Kabar <span class="text-primary">Terkini</span>
                </h2>
                <div class="w-16 h-1.5 bg-secondary rounded-full mt-4"></div>
            </div>
            <a href="{{ route('portal.berita.index', ($beritaTerbaru ?? collect())->first()?->website?->slug ?? $website->slug) }}"
                class="group flex items-center gap-2 font-heading font-black text-xs tracking-widest uppercase text-primary hover:text-primary-dark transition-all px-6 py-3 rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:scale-105 active:scale-95">
                Lihat Semua Berita <span
                    class="text-lg leading-none group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        <!-- Interactive News Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">

            <!-- LEFT: Slider + Thumbnail (2/3 width) -->
            <div class="lg:col-span-2 flex flex-col gap-4">

                <!-- Featured News Slider -->
                <div
                    class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-300/15 aspect-video w-full group bg-slate-900 flex-shrink-0">

                    <!-- Cover Images -->
                    <template x-for="(item, index) in news" :key="index">
                        <div class="absolute inset-0 transform-gpu overflow-hidden" x-show="activeIndex === index"
                            x-transition:enter="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-10"
                            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                            x-transition:leave="transition-transform duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] z-0"
                            x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full">
                            <div class="absolute inset-0 bg-slate-950 z-0"></div>
                            <div class="absolute inset-0">
                                <img :src="item.image" :alt="item.title"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ $newsFallbackImage }}'">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[color:var(--news-shade)] via-slate-900/60 to-transparent">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-r from-[color:var(--news-shade)]/40 to-transparent"></div>
                        </div>
                    </template>

                    <!-- Content Overlay -->
                    <div class="absolute inset-0 z-20 flex flex-col justify-end p-6 md:p-8 pointer-events-none">
                        <div class="mb-3">
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full bg-secondary text-white text-[10px] font-black uppercase tracking-wider shadow-md pointer-events-auto"
                                x-text="activeNews.category"></span>
                        </div>
                        <h3 class="font-heading font-black text-xl text-white leading-tight mb-2 max-w-2xl drop-shadow-lg transition-all duration-500 pointer-events-auto"
                            :key="'title-' + activeIndex" x-text="activeNews.title"
                            style="text-shadow: 0 4px 20px rgba(0,0,0,0.6)"></h3>
                        <p class="text-slate-200 text-xs md:text-sm mb-4 max-w-2xl leading-relaxed transition-all duration-500 line-clamp-2 pointer-events-auto"
                            :key="'excerpt-' + activeIndex" x-text="activeNews.excerpt"></p>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pointer-events-auto">
                            <div class="flex items-center text-slate-300 text-xs font-semibold">
                                <svg class="w-4 h-4 mr-2 text-primary-light" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span x-text="activeNews.date"></span>
                            </div>
                            <a :href="activeNews.url"
                                class="inline-flex items-center px-5 py-2.5 bg-primary text-white text-xs font-black uppercase tracking-wider rounded-xl shadow-md hover:bg-primary hover:scale-[1.02] active:scale-95 transition-all duration-300 w-fit group font-heading">
                                Selengkapnya
                                <span
                                    class="ml-2 text-lg leading-none group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        </div>

                        <!-- Slider Controls -->
                        <div
                            class="absolute top-4 right-4 md:top-6 md:right-6 flex items-center gap-2 z-30 pointer-events-auto">
                            <button @click="prev()"
                                class="w-10 h-10 rounded-xl bg-slate-900/40 backdrop-blur-md border border-white/10 flex items-center justify-center text-white hover:bg-primary hover:border-primary hover:scale-110 active:scale-90 transition-all duration-300 shadow-sm"
                                aria-label="Slide Sebelumnya">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <span
                                class="text-white/90 text-xs font-black tabular-nums bg-slate-900/40 backdrop-blur-md px-3 py-2 rounded-xl border border-white/10">
                                <span class="text-primary-light" x-text="activeIndex + 1"></span>/<span
                                    x-text="news.length"></span>
                            </span>
                            <button @click="next()"
                                class="w-10 h-10 rounded-xl bg-slate-900/40 backdrop-blur-md border border-white/10 flex items-center justify-center text-white hover:bg-primary hover:border-primary hover:scale-110 active:scale-90 transition-all duration-300 shadow-sm"
                                aria-label="Slide Selanjutnya">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                <div class="relative flex-shrink-0 mt-4 z-30">
                    <div class="flex gap-3 overflow-x-auto pt-2 pb-2 px-1 scrollbar-thin scrollbar-thumb-slate-200">
                        <template x-for="(item, index) in news" :key="'thumb-' + index">
                            <button @click="activeIndex = index"
                                class="flex-1 min-w-[150px] sm:min-w-0 rounded-[1.5rem] overflow-hidden border-2 transition-all duration-300 group text-left bg-white shadow-sm transform-gpu"
                                :class="activeIndex === index ? 'border-primary shadow-[0_4px_10px_-2px_color-mix(in_srgb,var(--color-primary)_30%,transparent)] ring-2 ring-primary-light -translate-y-1.5' : 'border-slate-100 hover:border-primary-light hover:shadow-md hover:-translate-y-0.5 opacity-80 hover:opacity-100'">
                                <div class="relative overflow-hidden aspect-[16/10]">
                                    <img :src="item.image" :alt="item.title"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ $newsFallbackImage }}'">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent">
                                    </div>
                                    <span
                                        class="absolute top-2 left-2 px-2.5 py-1 rounded-lg text-[8px] font-black uppercase tracking-wider shadow-sm"
                                        :class="activeIndex === index ? 'bg-secondary text-white' : 'bg-black/60 text-white/90'"
                                        x-text="item.category"></span>
                                    <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-primary transition-opacity duration-300"
                                        :class="activeIndex === index ? 'opacity-100' : 'opacity-0'"></div>
                                </div>
                                <div class="p-3">
                                    <p class="text-[11px] font-bold leading-snug line-clamp-2 transition-colors duration-300 font-heading"
                                        :class="activeIndex === index ? 'text-primary-dark' : 'text-slate-700 group-hover:text-primary'"
                                        x-text="item.title"></p>
                                    <span class="hidden sm:block text-[9px] text-slate-400 font-semibold mt-1.5"
                                        x-text="item.date"></span>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

            </div>

            <!-- RIGHT: GPR Komdigi (stretches to match height) -->
            <div class="lg:col-span-1 relative min-h-[480px] lg:min-h-0">
                <!-- Di desktop: absolute inset-0 agar mengikuti tinggi kolom kiri. Di mobile: tinggi otomatis -->
                <div class="lg:absolute lg:inset-0 lg:pb-1 h-full">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 hover:shadow-2xl transition-shadow duration-300 w-full h-full flex flex-col pt-1 gpr-custom-wrapper relative overflow-hidden">
                        <!-- Custom Overlay Header -->
                        <div class="absolute top-0 left-0 right-0 bg-primary px-6 py-5 z-10 flex flex-col pointer-events-none"
                            style="height: 80px;">
                            <h3
                                class="font-heading font-black text-white text-sm tracking-wider uppercase flex items-center gap-2">
                                <svg class="w-5 h-5 text-white/80" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                GPR Komdigi
                            </h3>
                            <p
                                class="text-primary-light text-[10px] font-semibold mt-1 ml-7 uppercase tracking-wider font-body">
                                Government Public Relations</p>
                        </div>

                        <!-- Widget Container -->
                        <div class="w-full flex-1 flex flex-col min-h-0 pt-[80px]"
                            style="background: rgb(255, 255, 255) !important;">
                            <script type="text/javascript"
                                src="https://widget.komdigi.go.id/gpr-widget-kominfo.min.js"></script>
                            <div id="gpr-kominfo-widget-container" class="w-full flex-1 flex flex-col min-h-0"
                                style="background: rgb(255, 255, 255) !important;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- JS: Force white background and premium styles on GPR container -->
    <script>
        (function () {
            var WHITE = '#ffffff';
            var TEXT = '#334155';

            function forceWhite(el) {
                if (!el) return;
                el.style.setProperty('background-color', WHITE, 'important');
                el.style.setProperty('background', WHITE, 'important');
                el.style.setProperty('color', TEXT, 'important');
                el.style.removeProperty('border-radius');
                el.style.setProperty('border', 'none', 'important');
                el.style.setProperty('box-shadow', 'none', 'important');
                el.style.setProperty('outline', 'none', 'important');
            }

            function cleanWidget() {
                var ids = ['gpr-kominfo-widget-container',
                    'gpr-kominfo-widget-header',
                    'gpr-kominfo-widget-body',
                    'gpr-kominfo-widget-footer'];
                ids.forEach(function (id) { forceWhite(document.getElementById(id)); });

                // Stretch body to fill card height
                var body = document.getElementById('gpr-kominfo-widget-body');
                if (body) {
                    body.style.setProperty('flex', '1 1 auto', 'important');
                    body.style.setProperty('height', '100%', 'important');
                    body.style.setProperty('max-height', 'none', 'important');
                    body.style.setProperty('overflow-y', 'auto', 'important');
                    body.style.setProperty('display', 'flex', 'important');
                    body.style.setProperty('flex-direction', 'column', 'important');

                    // Find the ul list inside and remove its fixed max-height of 450px
                    var ul = body.querySelector('ul');
                    if (ul) {
                        ul.style.setProperty('flex', '1 1 auto', 'important');
                        ul.style.setProperty('max-height', 'none', 'important');
                        ul.style.setProperty('height', '100%', 'important');
                        ul.style.setProperty('margin', '0', 'important');
                        ul.style.setProperty('padding-bottom', '10px', 'important');
                        ul.style.setProperty('scrollbar-width', 'thin', 'important');
                    }
                }

                // Hide widget's own header
                var wHeader = document.getElementById('gpr-kominfo-widget-header');
                if (wHeader) {
                    wHeader.style.setProperty('display', 'none', 'important');
                    wHeader.style.setProperty('height', '0', 'important');
                }

                // Replace placeholder icons with premium Unsplash background image
                var gprImages = document.querySelectorAll('#gpr-kominfo-widget-body ul li img');
                var defaultImgUrl = 'https://images.unsplash.com/photo-1577962917302-cd874462e648?q=80&w=400&auto=format&fit=crop';
                gprImages.forEach(function (img) {
                    if (img.src !== defaultImgUrl) {
                        img.src = defaultImgUrl;
                    }
                    img.style.setProperty('width', '56px', 'important');
                    img.style.setProperty('height', '56px', 'important');
                    img.style.setProperty('object-fit', 'cover', 'important');
                    img.style.setProperty('border-radius', '12px', 'important');
                    img.style.setProperty('padding', '0', 'important');
                    img.style.setProperty('margin-right', '12px', 'important');

                    var parent = img.parentElement;
                    if (parent && (parent.tagName.toLowerCase() === 'a' || parent.tagName.toLowerCase() === 'div')) {
                        parent.style.setProperty('background', 'transparent', 'important');
                        parent.style.setProperty('padding', '0', 'important');
                        parent.style.setProperty('border-radius', '0', 'important');
                    }
                });

                // Scan all child elements for dark backgrounds
                var container = document.getElementById('gpr-kominfo-widget-container');
                if (container) {
                    container.querySelectorAll('*').forEach(function (el) {
                        if (el.tagName.toLowerCase() === 'img') return;
                        var bg = el.style.backgroundColor || window.getComputedStyle(el).backgroundColor;
                        if (!bg) return;
                        var m = bg.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/);
                        if (m) {
                            var r = +m[1], g = +m[2], b = +m[3], total = r + g + b;
                            if (total < 350 && b >= r && b >= g) forceWhite(el);
                        }
                    });
                }
            }

            // Run repeatedly to clean widget elements as they load
            cleanWidget();
            [100, 500, 1000, 2000, 3500, 5000, 8000].forEach(function (ms) {
                setTimeout(cleanWidget, ms);
            });

            // MutationObserver on attributes of container itself
            var container = document.getElementById('gpr-kominfo-widget-container');
            if (container) {
                new MutationObserver(cleanWidget).observe(container, {
                    attributes: true,
                    attributeFilter: ['style'],
                    childList: true,
                    subtree: true
                });
            }
        })();
    </script>
</section>
