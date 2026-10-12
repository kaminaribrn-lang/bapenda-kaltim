<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi — Bapenda Provinsi Kalimantan Timur</title>
    <meta name="description" content="Portal resmi Badan Pendapatan Daerah Provinsi Kalimantan Timur. Akses layanan SIMPATOR, PPID, Website, dan informasi UPTD wilayah.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Interactive SVG Map CSS --}}
    <style>
        .svg-map-container {
            width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #0f172a;
        }
        .svg-region {
            cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); stroke: rgba(255, 255, 255, 0.15); stroke-width: 1; outline: none;
        }
        .svg-region:hover {
            stroke: rgba(255, 255, 255, 0.8); stroke-width: 1.5; filter: drop-shadow(0 0 12px var(--hover-glow-color, rgba(16, 185, 129, 0.5)));
        }
        .svg-region-label {
            pointer-events: none; font-family: 'Montserrat', sans-serif; font-size: 10px; font-weight: 800;
            fill: rgba(255, 255, 255, 0.85); text-anchor: middle; dominant-baseline: middle; text-transform: uppercase;
            text-shadow: 0 1px 3px rgba(0,0,0,0.9), 0 0 6px rgba(0,0,0,0.8);
            letter-spacing: 0.05em;
        }
        .svg-region-label.kota { font-size: 7.5px; font-weight: 900; fill: rgba(255, 255, 255, 0.95); }
        * { font-family: 'Inter', sans-serif; }

        /* ── Animations ── */
        @keyframes float {
            0%   { transform: translate(0, 0) scale(1); }
            33%  { transform: translate(30px, -50px) scale(1.1); }
            66%  { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.3); opacity: 0.7; }
        }

        .animate-float         { animation: float 15s infinite ease-in-out; }
        .animate-float-delayed { animation: float 18s infinite ease-in-out reverse; }
        .animate-float-slow    { animation: float 20s infinite ease-in-out 5s; }
        .anim-up   { animation: fadeInUp 0.7s ease-out both; }
        .anim-up-2 { animation: fadeInUp 0.7s 0.15s ease-out both; }
        .anim-up-3 { animation: fadeInUp 0.7s 0.30s ease-out both; }
        .anim-up-4 { animation: fadeInUp 0.7s 0.45s ease-out both; }

        /* Grid background pattern */
        .grid-pattern {
            background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        /* ── Stat Bar ── */
        .stat-bar { border-top: 1px solid rgba(255,255,255,0.08); }
        .stat-item {
            flex: 1; text-align: center; padding: 20px 8px;
            border-right: 1px solid rgba(255,255,255,0.08);
        }
        .stat-item:last-child { border-right: none; }
        .stat-number { font-size: 2rem; font-weight: 800; color: #fff; line-height: 1; font-family: 'Montserrat', sans-serif; }
        .stat-label  { font-size: 9px; font-weight: 600; letter-spacing: 0.14em; color: rgba(255,255,255,0.45); text-transform: uppercase; margin-top: 4px; }

        /* ── Portal Card ── */
        .portal-card {
            position: relative; padding: 2rem; border-radius: 2rem;
            overflow: hidden; transition: all 0.5s;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
            min-height: 280px; display: flex; flex-direction: column; justify-content: space-between;
            text-decoration: none;
        }
        .portal-card:hover { transform: translateY(-6px); }

        /* ── UPTD Grid ── */
        .uptd-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
        @media (max-width: 640px) { .uptd-grid { grid-template-columns: repeat(2,1fr); } }

        .uptd-pill {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; padding: 12px 14px;
            text-decoration: none; transition: all 0.25s;
        }
        .uptd-pill:hover { background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.25); transform: translateY(-2px); }
        .uptd-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

        /* ── Info strip ── */
        .info-strip {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(8px); border-radius: 14px; padding: 16px 18px;
            display: flex; align-items: center; gap: 14px; text-decoration: none;
            transition: background 0.2s;
        }
        .info-strip:hover { background: rgba(255,255,255,0.1); }
        .info-icon {
            width: 40px; height: 40px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
    </style>
</head>
<body style="margin:0; background:#020617; min-height:100vh; display:flex; flex-direction:column;">

    {{-- ── Animated Background ── --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 grid-pattern opacity-20"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-emerald-600/20 blur-[100px] animate-float"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] rounded-full bg-violet-600/15 blur-[100px] animate-float-delayed"></div>
        <div class="absolute top-[40%] left-[40%] w-[30vw] h-[30vw] rounded-full bg-teal-500/10 blur-[80px] animate-float-slow"></div>
    </div>

    {{-- ── CONTENT WRAPPER ── --}}
    <div class="relative z-10 flex-grow w-full max-w-5xl mx-auto px-5 py-8 md:py-12">
        @php $mainWebsite = \App\Models\Website::where('status', true)->first(); @endphp

        {{-- ═══════════════════════════════════════ --}}
        {{-- S1: HEADER                             --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="text-center mb-8 anim-up">

            {{-- Badges --}}
            <div class="flex flex-wrap justify-center items-center gap-3 mb-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border border-white/20 bg-white/5 backdrop-blur-md text-emerald-300 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400" style="animation: pulse-dot 2s infinite;"></span>
                    Portal Resmi e-Gov · Bapenda Kaltim
                </div>
                <a href="{{ $mainWebsite ? route('portal.beranda', $mainWebsite->slug) : '#' }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest border border-emerald-500/30 bg-emerald-500/10 backdrop-blur-md text-emerald-300 hover:bg-emerald-500/20 hover:border-emerald-500/50 hover:text-white transition-all duration-300 shadow-sm shadow-emerald-500/10">
                    Ke Website Utama
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Logos --}}
            <div class="flex items-center justify-center gap-4 mb-6">
                <a href="{{ $mainWebsite ? route('portal.beranda', $mainWebsite->slug) : '#' }}" class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 p-2 hover:bg-white/20 transition-all hover:scale-105 active:scale-95 duration-300 shadow-lg shadow-black/30">
                    <img src="/images/ornamen%20dayak/logo-kaltim.png" alt="Logo Pemprov Kaltim" class="w-full h-full object-contain"
                         onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23fff%22 stroke-width=%222%22><circle cx=%2212%22 cy=%2212%22 r=%2210%22/></svg>'">
                </a>
                <div class="w-px h-10 bg-white/20"></div>
                <a href="{{ $mainWebsite ? route('portal.beranda', $mainWebsite->slug) : '#' }}" class="w-50 h-16 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 p-2 hover:bg-white/20 transition-all hover:scale-105 active:scale-95 duration-300 shadow-lg shadow-black/30">
                    <img src="/images/bapendalogo.svg" alt="Logo Bapenda" class="w-full h-full object-contain"
                         onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23fff%22 stroke-width=%222%22><circle cx=%2212%22 cy=%2212%22 r=%2210%22/></svg>'">
                </a>
            </div>

            {{-- Title --}}
            <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tighter mb-3" style="font-family:'Montserrat',sans-serif;">
                Badan Pendapatan Daerah<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">
                    Provinsi Kalimantan Timur
                </span>
            </h1>
            <p class="text-slate-400 text-sm max-w-md mx-auto leading-relaxed">
                Mewujudkan pengelolaan pendapatan daerah yang inovatif, transparan, dan akuntabel.
            </p>
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- S2: STATISTIK BAR                      --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="stat-bar bg-white/5 backdrop-blur-md rounded-2xl mb-10 anim-up-2" style="border:1px solid rgba(255,255,255,0.08);">
            <div style="display:flex;">
                <div class="stat-item">
                    <div class="stat-number">9</div>
                    <div class="stat-label">Wilayah UPTD</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Layanan Utama</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4+</div>
                    <div class="stat-label">Aplikasi Digital</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Online</div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- S3: LAYANAN DIGITAL KOMPAK              --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="mb-8 anim-up-2">
            <a href="{{ $mainWebsite ? route('portal.layanan.index', $mainWebsite->slug) : '#' }}"
               class="group relative flex flex-col md:flex-row md:items-center justify-between p-6 rounded-[2rem] bg-white/5 border border-white/10 hover:border-blue-500/40 backdrop-blur-md transition-all duration-500 shadow-lg hover:shadow-blue-500/10 overflow-hidden">
                
                <!-- Floating Background Glow -->
                <div class="absolute -right-16 -top-16 w-32 h-32 bg-blue-500/10 rounded-full blur-[40px] pointer-events-none group-hover:bg-blue-500/20 transition-all duration-500"></div>
                <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-indigo-500/5 rounded-full blur-[40px] pointer-events-none"></div>
                
                <!-- Left Side: Icon + Text -->
                <div class="relative z-10 flex items-center gap-5">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20 shrink-0 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[9px] font-extrabold tracking-[0.2em] text-blue-400 uppercase font-heading">Layanan Elektronik</span>
                        <h2 class="text-base font-black text-white leading-tight uppercase font-heading mt-0.5" style="font-family:'Montserrat',sans-serif;">E-SAMSAT & SIMPATOR</h2>
                        <p class="text-slate-400 text-xs mt-0.5 leading-relaxed max-w-xl">Bayar pajak kendaraan, cek tagihan, dan akses kemudahan layanan digital secara mandiri.</p>
                    </div>
                </div>
                
                <!-- Right Side: CTA Button -->
                <div class="relative z-10 mt-4 md:mt-0 flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-500 group-hover:bg-blue-600 text-white text-[9px] font-black uppercase tracking-widest transition-all duration-300 shadow-md shadow-blue-500/20 shrink-0" style="font-family:'Montserrat',sans-serif;">
                    Akses Layanan Digital
                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </a>
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- S4: PETA INTERAKTIF UPTD KALTIM         --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="mb-10 anim-up-3">
            {{-- Section Header --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                <div class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Layanan UPTD PPRD Wilayah</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                </div>
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
            </div>

            {{-- Map + Info Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
                {{-- Map Container --}}
                <div class="lg:col-span-3">
                    <div id="kaltim-map-container" class="svg-map-container relative" style="height: 520px; border-radius: 1.5rem; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); z-index: 1;">
                        <svg id="kaltim-svg" viewBox="25 25 650 630" class="w-full h-full p-1" style="background: #0f172a;">
                            <!-- Paths and labels will be dynamically injected here to avoid token limit errors -->
                        </svg>
                    </div>
                </div>

                {{-- Info Panel --}}
                <div class="lg:col-span-2 flex flex-col gap-4">
                    {{-- Quick Links Grid --}}
                    <div class="rounded-[1.5rem] bg-white/5 border border-white/10 p-4 backdrop-blur-md anim-up-3">
                        <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mb-3" style="font-family:'Montserrat',sans-serif;">Akses Cepat</div>
                        <div class="grid grid-cols-3 gap-1.5">
                            @php
                            $uptdQuickLinks = [
                                ['slug' => 'samarinda', 'name' => 'Samarinda', 'color' => '#7c3aed'],
                                ['slug' => 'balikpapan', 'name' => 'Balikpapan', 'color' => '#0891b2'],
                                ['slug' => 'bontang', 'name' => 'Bontang', 'color' => '#d946ef'],
                                ['slug' => 'kutai-kartanegara', 'name' => 'Kukar', 'color' => '#2563eb'],
                                ['slug' => 'kutai-timur', 'name' => 'Kutim', 'color' => '#ea580c'],
                                ['slug' => 'kutai-barat', 'name' => 'Kubar', 'color' => '#dc2626'],
                                ['slug' => 'berau', 'name' => 'Berau', 'color' => '#16a34a'],
                                ['slug' => 'paser', 'name' => 'Paser', 'color' => '#059669'],
                                ['slug' => 'penajam-paser-utara', 'name' => 'PPU', 'color' => '#0d9488'],
                            ];
                            @endphp
                            @foreach($uptdQuickLinks as $ql)
                            <button class="uptd-quick-btn px-2 py-2 rounded-lg text-[9px] font-bold text-slate-400 uppercase tracking-wider border border-white/10 hover:border-emerald-400/40 hover:bg-emerald-500/20 hover:text-emerald-300 transition-all duration-200 truncate"
                                    data-slug="{{ $ql['slug'] }}" data-color="{{ $ql['color'] }}"
                                    onclick="highlightRegion('{{ $ql['slug'] }}')">
                                {{ $ql['name'] }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Default State --}}
                    <div id="map-default-info" class="flex-1 flex flex-col items-center justify-center text-center p-6 rounded-[1.5rem] bg-white/5 border border-white/10 backdrop-blur-md transition-all duration-300 anim-up-3">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </div>
                        <h4 class="text-sm font-black text-white uppercase tracking-tight mb-1" style="font-family:'Montserrat',sans-serif;">Pilih Wilayah</h4>
                        <p class="text-slate-400 text-[11px] leading-relaxed mb-4">Klik wilayah pada peta atau tombol Akses Cepat di atas untuk melihat informasi UPTD.</p>
                        <div class="space-y-1.5 w-full text-left px-2">
                            <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500/70 border border-white/20"></span><span class="text-[10px] text-slate-500 font-semibold uppercase">Kabupaten</span></div>
                            <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-red-500/70 border border-white/20"></span><span class="text-[10px] text-slate-500 font-semibold uppercase">Kota</span></div>
                        </div>
                    </div>

                    {{-- Active Region Info (hidden by default) --}}
                    <div id="map-active-info" class="hidden flex-1 flex flex-col rounded-[1.5rem] bg-white/10 border border-white/20 overflow-hidden backdrop-blur-xl transition-all duration-300 anim-up-3">
                        <div class="px-5 pt-5 pb-3 border-b border-white/10" id="map-card-header">
                            <div class="flex items-center justify-between mb-2">
                                <div class="w-9 h-9 rounded-xl bg-emerald-500/30 border border-emerald-400/50 flex items-center justify-center" id="map-card-icon">
                                    <svg class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span id="map-card-badge" class="px-2.5 py-0.5 rounded-full text-[8px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-400/20 uppercase tracking-widest">UPTD AKTIF</span>
                            </div>
                            <h3 id="map-card-title" class="font-black text-white text-base leading-tight uppercase tracking-tight" style="font-family:'Montserrat',sans-serif;"></h3>
                        </div>
                        <div class="px-5 py-3.5 flex flex-col gap-2.5 flex-1" id="map-card-body">
                            <div class="flex items-start gap-2 text-xs text-slate-300">
                                <svg class="w-4 h-4 shrink-0 text-emerald-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span id="map-card-address" class="leading-relaxed text-[11px]"></span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-slate-300">
                                <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span id="map-card-phone" class="text-[11px]"></span>
                            </div>
                            <div class="flex items-start gap-2 text-[9px] text-slate-400 font-medium">
                                <svg class="w-3.5 h-3.5 shrink-0 text-emerald-400/50 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span id="map-card-hours"></span>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <a id="map-card-link" href="#" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 text-white text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all duration-300" style="font-family:'Montserrat',sans-serif; text-decoration:none;">
                                Kunjungi UPTD
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════ --}}
        {{-- S5: INFO STRIP                         --}}
        {{-- ═══════════════════════════════════════ --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 anim-up-4">

            {{-- Jam Pelayanan --}}
            <div class="info-strip">
                <div class="info-icon" style="background:rgba(59,130,246,0.2);">
                    <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jam Pelayanan</div>
                    <div class="text-sm font-semibold text-white">Senin – Jumat, 08:00–16:00 WITA</div>
                </div>
            </div>

            {{-- Survey --}}
            <a href="#" class="info-strip">
                <div class="info-icon" style="background:rgba(16,185,129,0.2);">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"/>
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Survey Kepuasan</div>
                    <div class="text-sm font-semibold text-white">Beri Nilai Layanan Kami</div>
                </div>
            </a>

            {{-- WBS --}}
            <a href="{{ $mainWebsite ? route('portal.wbs.index', $mainWebsite->slug) : '#' }}" class="info-strip">
                <div class="info-icon" style="background:rgba(245,158,11,0.2);">
                    <svg class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Laporan WBS</div>
                    <div class="text-sm font-semibold text-white">Whistleblowing System</div>
                </div>
            </a>

        </div>

    </div>

    {{-- ── FOOTER ── --}}
    <footer class="relative z-10 w-full py-5 text-center border-t border-white/5 bg-black/20 backdrop-blur-md">
        <p class="text-xs text-slate-400">
            &copy; {{ date('Y') }} Badan Pendapatan Daerah Provinsi Kalimantan Timur. Hak Cipta Dilindungi.<br>
            <a href="/site-admin" class="hover:text-white transition mt-1 inline-block">Login Admin</a>
        </p>
    </footer>

{{-- Interactive SVG Map Script --}}
<script>
(function() {
    const svgEl = document.getElementById('kaltim-svg');
    if (!svgEl) return;

    const mainSlug = '{{ $mainWebsite->slug ?? "bapenda" }}';
    const baseUrl = '{{ url("/") }}';

    // UPTD data
    const uptdData = {
        'samarinda': { name: 'Samarinda', address: 'Jl. Rapak Indah No.99, Loa Bakung, Samarinda, Kalimantan Timur 75243', phone: '(0541) 734969', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#7c3aed', type: 'kota' },
        'balikpapan': { name: 'Balikpapan', address: 'Jl. Jend. Sudirman No.22, Balikpapan Kota, Kalimantan Timur 76112', phone: '(0542) 421234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#0891b2', type: 'kota' },
        'bontang': { name: 'Bontang', address: 'Jl. MH. Thamrin No.05, Bontang, Kalimantan Timur 75311', phone: '(0548) 21234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#d946ef', type: 'kota' },
        'kutai-kartanegara': { name: 'Kutai Kartanegara', address: 'Jl. Wolter Monginsidi, Tenggarong, Kutai Kartanegara, Kalimantan Timur', phone: '(0541) 661100', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#2563eb', type: 'kabupaten' },
        'kutai-timur': { name: 'Kutai Timur', address: 'Jl. A.W Syahrani, Sangatta, Kutai Timur, Kalimantan Timur', phone: '(0549) 21234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#ea580c', type: 'kabupaten' },
        'kutai-barat': { name: 'Kutai Barat', address: 'Sendawar, Kutai Barat, Kalimantan Timur', phone: '(0545) 41234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#dc2626', type: 'kabupaten' },
        'berau': { name: 'Berau', address: 'Tanjung Redeb, Berau, Kalimantan Timur 77311', phone: '(0554) 21234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#16a34a', type: 'kabupaten' },
        'paser': { name: 'Paser', address: 'Tanah Grogot, Paser, Kalimantan Timur', phone: '(0543) 21234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#059669', type: 'kabupaten' },
        'penajam-paser-utara': { name: 'Penajam Paser Utara', address: 'Penajam, Penajam Paser Utara, Kalimantan Timur', phone: '(0542) 71234', hours: 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30', color: '#0d9488', type: 'kabupaten' },
        'mahakam-ulu': { name: 'Mahakam Ulu', address: '-', phone: '-', hours: '-', color: '#64748b', type: 'kabupaten', noUptd: true }
    };

    let activeSlug = null;

    // Show info panel
    function showInfoPanel(slug) {
        const d = uptdData[slug];
        if (!d || d.noUptd) return;

        activeSlug = slug;
        document.getElementById('map-default-info').classList.add('hidden');
        const info = document.getElementById('map-active-info');
        info.classList.remove('hidden');

        document.getElementById('map-card-title').textContent = 'UPTD ' + d.name;
        document.getElementById('map-card-address').textContent = d.address;
        document.getElementById('map-card-phone').textContent = d.phone;
        document.getElementById('map-card-hours').textContent = d.hours;
        document.getElementById('map-card-header').style.background = 'linear-gradient(135deg, ' + d.color + '20, transparent)';
        document.getElementById('map-card-link').href = baseUrl + '/' + mainSlug + '/uptd/' + slug;

        // Sync quick access buttons
        document.querySelectorAll('.uptd-quick-btn').forEach(b => {
            b.classList.remove('border-emerald-400/40', 'bg-emerald-500/20', 'text-emerald-300');
            if (b.dataset.slug === slug) b.classList.add('border-emerald-400/40', 'bg-emerald-500/20', 'text-emerald-300');
        });

        // Sync SVG paths opacity and stroke
        document.querySelectorAll('.svg-region').forEach(p => {
            const pSlug = p.getAttribute('data-slug');
            const pD = uptdData[pSlug];
            if (pSlug === slug) {
                p.setAttribute('fill-opacity', '0.65');
                p.setAttribute('stroke', 'rgba(255, 255, 255, 0.9)');
                p.setAttribute('stroke-width', '1.8');
            } else {
                p.setAttribute('fill-opacity', pD && pD.noUptd ? '0.1' : '0.25');
                p.setAttribute('stroke', 'rgba(255, 255, 255, 0.15)');
                p.setAttribute('stroke-width', '1');
            }
        });
    }

    // Fetch and build the SVG map dynamically
    fetch(baseUrl + '/data/kaltim-svg-paths.json')
        .then(res => res.json())
        .then(pathsData => {
            Object.entries(pathsData).forEach(([slug, region]) => {
                const d = uptdData[slug];
                const fillCol = d ? d.color : '#64748b';
                const opacity = d && d.noUptd ? '0.1' : '0.25';

                // 1. Create Path element
                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', region.d);
                path.setAttribute('class', 'svg-region');
                path.setAttribute('id', 'region-' + slug);
                path.setAttribute('data-slug', slug);
                path.setAttribute('fill', fillCol);
                path.setAttribute('fill-opacity', opacity);
                path.style.setProperty('--hover-glow-color', fillCol);
                
                // Hover & Click Events
                path.addEventListener('mouseenter', () => {
                    if (slug !== activeSlug) {
                        path.setAttribute('fill-opacity', '0.45');
                        path.setAttribute('stroke', 'rgba(255, 255, 255, 0.5)');
                        path.setAttribute('stroke-width', '1.5');
                    }
                });
                path.addEventListener('mouseleave', () => {
                    if (slug !== activeSlug) {
                        path.setAttribute('fill-opacity', opacity);
                        path.setAttribute('stroke', 'rgba(255, 255, 255, 0.15)');
                        path.setAttribute('stroke-width', '1');
                    }
                });
                path.addEventListener('click', () => {
                    if (d && !d.noUptd) {
                        showInfoPanel(slug);
                    }
                });
                
                svgEl.appendChild(path);

                // 2. Create Label element
                const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                text.setAttribute('x', region.labelX);
                text.setAttribute('y', region.labelY);
                text.setAttribute('class', 'svg-region-label' + (region.type === 'Kota' ? ' kota' : ''));
                
                // Abbreviate long names
                let displayName = region.name;
                if (displayName === 'Penajam Paser Utara') displayName = 'PPU';
                else if (displayName === 'Kutai Kartanegara') displayName = 'Kukar';
                else if (displayName === 'Kutai Timur') displayName = 'Kutim';
                else if (displayName === 'Kutai Barat') displayName = 'Kubar';
                
                text.textContent = displayName;
                svgEl.appendChild(text);
            });
        })
        .catch(err => console.error('Error loading Kaltim SVG map paths:', err));

    // Quick btn highlight
    window.highlightRegion = function(slug) {
        showInfoPanel(slug);
    };

    // Quick btn hover sync
    document.querySelectorAll('.uptd-quick-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            const slug = this.dataset.slug;
            if (slug === activeSlug) return;
            const p = document.getElementById('region-' + slug);
            if (p) {
                p.setAttribute('fill-opacity', '0.45');
                p.setAttribute('stroke', 'rgba(255, 255, 255, 0.5)');
                p.setAttribute('stroke-width', '1.5');
            }
        });
        btn.addEventListener('mouseleave', function() {
            const slug = this.dataset.slug;
            if (slug === activeSlug) return;
            const p = document.getElementById('region-' + slug);
            const d = uptdData[slug];
            if (p && d) {
                p.setAttribute('fill-opacity', d.noUptd ? '0.1' : '0.25');
                p.setAttribute('stroke', 'rgba(255, 255, 255, 0.15)');
                p.setAttribute('stroke-width', '1');
            }
        });
    });
})();
</script>

</body>
</html>
