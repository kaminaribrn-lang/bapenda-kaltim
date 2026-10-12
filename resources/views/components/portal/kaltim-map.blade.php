{{-- 
    Peta Interaktif Kalimantan Timur — Leaflet.js + GeoJSON
    Menampilkan batas wilayah administratif 10 Kab/Kota
    dengan data UPTD overlay
--}}
@props(['website', 'uptds' => []])

@php
$uptdConfig = [
    'samarinda' => ['lat' => -0.4948, 'lng' => 117.1436, 'color' => '#7c3aed', 'type' => 'kota'],
    'balikpapan' => ['lat' => -1.2654, 'lng' => 116.8529, 'color' => '#0891b2', 'type' => 'kota'],
    'bontang' => ['lat' => 0.1233, 'lng' => 117.4995, 'color' => '#d946ef', 'type' => 'kota'],
    'kutai-kartanegara' => ['lat' => -0.4100, 'lng' => 116.9800, 'color' => '#2563eb', 'type' => 'kabupaten'],
    'kutai-timur' => ['lat' => 0.5530, 'lng' => 117.5780, 'color' => '#ea580c', 'type' => 'kabupaten'],
    'kutai-barat' => ['lat' => -0.1350, 'lng' => 115.6550, 'color' => '#dc2626', 'type' => 'kabupaten'],
    'berau' => ['lat' => 2.1600, 'lng' => 117.4900, 'color' => '#16a34a', 'type' => 'kabupaten'],
    'paser' => ['lat' => -1.8700, 'lng' => 116.1800, 'color' => '#059669', 'type' => 'kabupaten'],
    'penajam-paser-utara' => ['lat' => -1.4600, 'lng' => 116.4800, 'color' => '#0d9488', 'type' => 'kabupaten'],
    'mahakam-ulu' => ['lat' => 0.4000, 'lng' => 115.5000, 'color' => '#64748b', 'type' => 'kabupaten'],
];
@endphp

<div id="uptd-map-section" class="w-full">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
        
        {{-- LEFT: Leaflet Map (2/3) --}}
        <div class="lg:col-span-2">
            <div id="kaltim-map" class="w-full h-[400px] md:h-[500px] rounded-[2rem] overflow-hidden border border-white/20 shadow-2xl" style="z-index: 1;"></div>
        </div>

        {{-- RIGHT: Info Panel (1/3) --}}
        <div class="lg:col-span-1 flex flex-col gap-4" id="map-info-panel">
            
            {{-- Default State --}}
            <div id="map-default-info" class="bg-white/5 backdrop-blur-xl rounded-[2rem] border border-white/10 p-8 text-center transition-all duration-300">
                <!-- <div class="w-16 h-12 mx-auto mb-6 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div> -->
                <h4 class="text-lg font-black text-white uppercase tracking-tight font-heading mb-2">Pilih Wilayah</h4>
                <p class="text-white/50 text-sm font-body leading-relaxed">Klik salah satu wilayah pada peta untuk melihat informasi UPTD Pelayanan Pajak.</p>
                
                {{-- Legend --}}
                <div class="mt-8 space-y-3 grid grid-cols-1">
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-4 h-4 rounded bg-emerald-500/70 shrink-0 border border-white/20"></div>
                        <span class="text-xs text-white/60 font-body">Kabupaten (ada UPTD)</span>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-4 h-4 rounded-full bg-violet-500/70 shrink-0 border border-white/20"></div>
                        <span class="text-xs text-white/60 font-body">Kota (ada UPTD)</span>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-4 h-4 rounded bg-slate-500/50 shrink-0 border border-white/20 border-dashed"></div>
                        <span class="text-xs text-white/60 font-body">Belum ada UPTD</span>
                    </div>
                </div>
            </div>

            {{-- Active Region Info (hidden by default, shown via JS) --}}
            <div id="map-active-info" class="hidden bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 overflow-hidden shadow-2xl transition-all duration-300">
                {{-- Card Header --}}
                <div class="px-8 pt-8 pb-6 border-b border-white/10" id="map-card-header">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-emerald-500/30 border border-emerald-400/50" id="map-card-icon">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span id="map-card-badge" class="px-3 py-1 rounded-full text-[10px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-400/20 uppercase tracking-widest">UPTD AKTIF</span>
                    </div>
                    <h3 id="map-card-title" class="font-black text-white text-xl leading-tight uppercase tracking-tight font-heading"></h3>
                </div>

                {{-- Card Body --}}
                <div class="px-8 py-6 flex flex-col gap-4" id="map-card-body">
                    <div class="flex items-start gap-3 text-sm text-white/70 font-body">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span id="map-card-address" class="leading-relaxed"></span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-white/70 font-body">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span id="map-card-phone"></span>
                    </div>
                    <div class="flex items-start gap-3 text-xs text-white/50 font-body">
                        <svg class="w-5 h-5 shrink-0 text-emerald-400/50 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span id="map-card-hours"></span>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="px-8 pb-8" id="map-card-footer">
                    <a id="map-card-link" href="#" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-emerald-500 text-white text-xs font-black uppercase tracking-widest hover:bg-emerald-600 hover:shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 font-heading group">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Kunjungi Beranda UPTD
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="bg-white/5 backdrop-blur-md rounded-[2rem] border border-white/10 p-6">
                <h4 class="text-xs font-black text-center text-white uppercase tracking-widest mb-4 font-heading">Akses Cepat</h4>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($uptds as $slug => $uptdItem)
                    <a href="{{ url($website->slug . '/uptd/' . $slug) }}"
                       class="uptd-quick-btn px-2 py-2.5 rounded-xl text-[10px] font-black text-white/70 uppercase tracking-wider border border-white/10 hover:border-emerald-400/40 hover:bg-emerald-500/20 hover:text-emerald-300 transition-all duration-300 truncate text-center"
                       data-slug="{{ $slug }}">
                        {{ $uptdItem['name'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('head')
{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #kaltim-map {
        background: #0f172a;
    }
    #kaltim-map .leaflet-control-zoom a {
        background: rgba(15, 23, 42, 0.9);
        color: #10b981;
        border-color: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
    }
    #kaltim-map .leaflet-control-zoom a:hover {
        background: #059669;
        color: white;
    }
    #kaltim-map .leaflet-control-attribution {
        background: rgba(15, 23, 42, 0.8) !important;
        color: rgba(255,255,255,0.4) !important;
        font-size: 9px;
        backdrop-filter: blur(8px);
    }
    #kaltim-map .leaflet-control-attribution a {
        color: rgba(16, 185, 129, 0.6) !important;
    }
    .leaflet-popup-content-wrapper {
        background: rgba(15, 23, 42, 0.95) !important;
        color: white !important;
        border-radius: 1rem !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        backdrop-filter: blur(12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4) !important;
    }
    .leaflet-popup-tip {
        background: rgba(15, 23, 42, 0.95) !important;
    }
    .leaflet-popup-content {
        margin: 12px 16px !important;
    }
    .uptd-popup-title {
        font-weight: 900;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }
    .uptd-popup-desc {
        font-size: 11px;
        color: rgba(255,255,255,0.6);
    }
    .uptd-popup-link {
        display: inline-block;
        margin-top: 8px;
        padding: 6px 14px;
        background: #059669;
        color: white;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .uptd-popup-link:hover {
        background: #047857;
        transform: translateY(-1px);
    }
</style>
@endpush

@push('scripts')
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapEl = document.getElementById('kaltim-map');
    if (!mapEl) return;

    // Data UPTD dari PHP
    const uptdData = @json($uptds);
    const websiteSlug = '{{ $website->slug }}';
    const baseUrl = '{{ url('/') }}';

    // Config per wilayah (koordinat pusat & warna)
    const regionConfig = @json($uptdConfig);

    // Inisialisasi peta
    const map = L.map('kaltim-map', {
        center: [0.0, 116.5],
        zoom: 7,
        minZoom: 6,
        maxZoom: 12,
        zoomControl: true,
        scrollWheelZoom: true,
        attributionControl: true
    });

    // Dark map tile layer (CartoDB Dark Matter - gratis)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);

    // Fungsi untuk menampilkan info panel
    function showInfoPanel(slug) {
        const data = uptdData[slug];
        const config = regionConfig[slug];
        if (!data) return;

        document.getElementById('map-default-info').classList.add('hidden');
        document.getElementById('map-active-info').classList.remove('hidden');

        document.getElementById('map-card-title').textContent = 'UPTD ' + data.name;
        document.getElementById('map-card-address').textContent = data.address;
        document.getElementById('map-card-phone').textContent = data.phone;
        document.getElementById('map-card-hours').textContent = data.hours;

        const link = document.getElementById('map-card-link');
        link.href = baseUrl + '/' + websiteSlug + '/uptd/' + slug;

        const badge = document.getElementById('map-card-badge');
        badge.textContent = 'UPTD AKTIF';
        badge.className = 'px-3 py-1 rounded-full text-[10px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-400/20 uppercase tracking-widest';

        const header = document.getElementById('map-card-header');
        header.style.background = `linear-gradient(135deg, ${config.color}20, transparent)`;

        document.getElementById('map-card-body').classList.remove('hidden');
        document.getElementById('map-card-footer').classList.remove('hidden');

        // Highlight quick link
        document.querySelectorAll('.uptd-quick-btn').forEach(btn => {
            btn.classList.remove('border-emerald-400/40', 'bg-emerald-500/20', 'text-emerald-300');
            if (btn.dataset.slug === slug) {
                btn.classList.add('border-emerald-400/40', 'bg-emerald-500/20', 'text-emerald-300');
            }
        });
    }

    function resetInfoPanel() {
        document.getElementById('map-default-info').classList.remove('hidden');
        document.getElementById('map-active-info').classList.add('hidden');
        document.querySelectorAll('.uptd-quick-btn').forEach(btn => {
            btn.classList.remove('border-emerald-400/40', 'bg-emerald-500/20', 'text-emerald-300');
        });
    }

    // Fetch GeoJSON dari API Overpass / gunakan batas administratif
    // Sumber: GeoJSON administratif level 2 (kabupaten/kota) dari API
    const geoJsonUrl = 'https://raw.githubusercontent.com/superpikar/indonesia-geojson/master/indonesia-province-simple.json';

    // Karena GeoJSON provinsi penuh mungkin berat, kita gunakan marker + circle overlay
    // untuk setiap kabupaten/kota dengan data dari controller

    // Tambahkan marker UPTD per wilayah
    const markers = {};
    const circles = {};

    Object.entries(regionConfig).forEach(([slug, config]) => {
        const data = uptdData[slug];
        const hasUptd = !!data;
        const name = data ? data.name : slug.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
        const radius = config.type === 'kota' ? 12000 : 35000;

        // Circle overlay untuk wilayah
        const circle = L.circle([config.lat, config.lng], {
            color: config.color,
            fillColor: config.color,
            fillOpacity: hasUptd ? 0.25 : 0.1,
            weight: hasUptd ? 2 : 1,
            dashArray: hasUptd ? null : '6 4',
            radius: radius
        }).addTo(map);

        circles[slug] = circle;

        // Popup content
        let popupContent = `<div class="uptd-popup-title" style="color:${config.color}">${name}</div>`;
        if (hasUptd) {
            popupContent += `<div class="uptd-popup-desc">${data.address}</div>`;
            popupContent += `<a class="uptd-popup-link" href="${baseUrl}/${websiteSlug}/uptd/${slug}">Kunjungi UPTD →</a>`;
        } else {
            popupContent += `<div class="uptd-popup-desc">Belum ada UPTD</div>`;
        }

        circle.bindPopup(popupContent, { closeButton: false, className: 'uptd-popup' });

        // Event handlers
        circle.on('mouseover', function() {
            this.setStyle({ fillOpacity: hasUptd ? 0.45 : 0.2, weight: 3 });
        });
        circle.on('mouseout', function() {
            this.setStyle({ fillOpacity: hasUptd ? 0.25 : 0.1, weight: hasUptd ? 2 : 1 });
        });
        circle.on('click', function() {
            if (hasUptd) {
                showInfoPanel(slug);
            }
        });

        // Label marker (nama wilayah)
        const label = L.divIcon({
            className: 'uptd-label',
            html: `<div style="
                color: white;
                font-size: ${config.type === 'kota' ? '10px' : '11px'};
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                text-shadow: 0 2px 8px rgba(0,0,0,0.8), 0 0 20px rgba(0,0,0,0.5);
                white-space: nowrap;
                text-align: center;
                pointer-events: none;
            ">${name}</div>`,
            iconSize: [120, 20],
            iconAnchor: [60, 10]
        });

        L.marker([config.lat, config.lng], { icon: label, interactive: false }).addTo(map);

        // Dot marker for cities
        if (config.type === 'kota') {
            const dot = L.circleMarker([config.lat, config.lng], {
                radius: 6,
                color: 'white',
                fillColor: config.color,
                fillOpacity: 1,
                weight: 2
            }).addTo(map);
            
            dot.on('click', function() {
                if (hasUptd) {
                    showInfoPanel(slug);
                    circle.openPopup();
                }
            });
        }
    });

    // Quick link hover → highlight pada peta
    document.querySelectorAll('.uptd-quick-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            const slug = this.dataset.slug;
            const circle = circles[slug];
            if (circle) {
                circle.setStyle({ fillOpacity: 0.5, weight: 3 });
                map.panTo(circle.getLatLng(), { animate: true, duration: 0.5 });
            }
        });
        btn.addEventListener('mouseleave', function() {
            const slug = this.dataset.slug;
            const circle = circles[slug];
            if (circle) {
                circle.setStyle({ fillOpacity: 0.25, weight: 2 });
            }
        });
    });

    // Fit bounds to show all circles
    const allLatLngs = Object.values(regionConfig).map(c => [c.lat, c.lng]);
    map.fitBounds(allLatLngs, { padding: [30, 30] });
});
</script>
@endpush
