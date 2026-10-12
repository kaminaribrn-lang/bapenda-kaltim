{{--
    Komponen Peta Layanan Samsat (Leaflet.js) — dipakai di halaman /layanan (peta penuh)
    dan disisipkan di section "Layanan Unggulan" pada beranda.

    Props:
    - locations : Collection|array daftar lokasi, tiap item berbentuk
                  {wilayah, nama, alamat, latitude, longitude, jenis, wa}
                  (lihat App\Models\SamsatLocation::toMapArray()).
    - height    : tinggi CSS untuk kontainer peta (default menyesuaikan viewport).
--}}
@props([
    'locations' => [],
    'height' => 'min(78vh, 720px)',
])

@once
    @push('head')
    {{-- Leaflet.js (peta interaktif) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
      #psm-app{
        --psm-navy:#16324a;
        --psm-paper:#f5f2ea;
        --psm-gold:#b8863a;
        --psm-line:#d8d2c2;
        --psm-ink:#22201b;
        --psm-ink-soft:#5c5850;
        --psm-card:#ffffff;
        --psm-green:#2f7a4f;
        font-family:'Source Sans 3', sans-serif;
        color:var(--psm-ink);
        display:grid;
        grid-template-columns:360px 1fr;
        height:var(--psm-app-height, min(78vh, 720px));
        min-height:480px;
        background:var(--psm-card);
        border-radius:1.75rem;
        overflow:hidden;
        border:1px solid var(--psm-line);
        box-shadow:0 25px 60px -25px rgba(15,23,42,0.35);
      }
      @media (max-width:900px){
        #psm-app{ grid-template-columns:1fr; grid-template-rows:auto 420px; height:auto; }
      }

      #psm-app h1,#psm-app h2,#psm-app h3,#psm-app h4{ font-family:'Fraunces',serif; font-weight:600; margin:0; }

      .psm-side{ background:var(--psm-card); display:flex; flex-direction:column; overflow:hidden; border-right:1px solid var(--psm-line); }
      @media (max-width:900px){ .psm-side{ max-height:44vh; } }

      .psm-controls{ padding:18px 20px; border-bottom:1px solid var(--psm-line); display:flex; flex-direction:column; gap:10px; background:#fbfaf6; }
      .psm-controls input[type=text]{ width:100%; padding:9px 12px; border:1px solid var(--psm-line); border-radius:6px; font-size:0.92rem; font-family:inherit; background:#fff; }
      .psm-controls select{ width:100%; padding:8px 10px; border:1px solid var(--psm-line); border-radius:6px; font-size:0.85rem; font-family:inherit; background:#fff; }
      .psm-row-2{ display:grid; grid-template-columns:1fr 1fr; gap:8px; }
      .psm-filechip{ display:flex; align-items:center; justify-content:space-between; gap:8px; font-size:0.75rem; color:var(--psm-ink-soft); flex-wrap:wrap; }
      .psm-filechip label{ cursor:pointer; color:var(--psm-gold); border:1px solid var(--psm-gold); padding:4px 9px; border-radius:6px; font-size:0.72rem; white-space:nowrap; }
      .psm-filechip input[type=file]{ display:none; }
      .psm-reset-btn{ cursor:pointer; color:var(--psm-navy); border:1px solid var(--psm-line); background:#fff; padding:4px 9px; border-radius:6px; font-size:0.72rem; font-family:inherit; white-space:nowrap; }
      .psm-count{ font-size:0.76rem; color:var(--psm-ink-soft); }

      .psm-list{ flex:1; overflow-y:auto; padding:6px 0 20px; }

      .psm-wgroup{ border-bottom:1px solid var(--psm-line); }
      .psm-wgroup-head{ display:flex; align-items:center; justify-content:space-between; gap:8px; padding:12px 20px; cursor:pointer; background:#faf8f2; }
      .psm-wgroup-head:hover{ background:#f2ede0; }
      .psm-wgroup-head h4{ font-size:0.9rem; color:var(--psm-navy); }
      .psm-wgroup-meta{ display:flex; align-items:center; gap:8px; flex-shrink:0; }
      .psm-wgroup-count{ font-size:0.7rem; color:var(--psm-ink-soft); white-space:nowrap; }
      .psm-wgroup-arrow{ font-size:0.68rem; color:var(--psm-gold); transition:transform .15s; }
      .psm-wgroup.open .psm-wgroup-arrow{ transform:rotate(90deg); }
      .psm-wgroup-body{ display:none; padding:2px 0 6px; }
      .psm-wgroup.open .psm-wgroup-body{ display:block; }

      .psm-entry{ padding:10px 20px 10px 28px; border-top:1px solid #f0ece1; cursor:pointer; transition:background .15s; }
      .psm-entry:hover{ background:#f0ece1; }
      .psm-entry.active{ background:#eee5cf; }
      .psm-entry h3{ font-size:0.9rem; line-height:1.25; font-family:'Source Sans 3',sans-serif; font-weight:700; }
      .psm-entry .psm-entry-addr{ font-size:0.74rem; color:var(--psm-ink-soft); margin-top:3px; line-height:1.4; }
      .psm-entry .psm-tags{ margin-top:6px; display:flex; flex-wrap:wrap; gap:5px; }
      .psm-entry .psm-tag{ display:inline-block; font-size:0.68rem; padding:2px 8px; border-radius:10px; color:#fff; }

      #psm-map{ width:100%; height:100%; }
      .psm-map-wrap{ position:relative; height:100%; }
      @media (max-width:900px){ .psm-map-wrap{ height:420px; } }

      .psm-popup-title{ font-family:'Fraunces',serif; font-weight:600; font-size:1rem; margin:0 0 2px; }
      .psm-popup-sub{ font-size:0.8rem; color:#fff; margin:0 0 8px; }
      .psm-popup-service{ padding:6px 0; }
      .psm-popup-service + .psm-popup-service{ border-top:1px dashed var(--psm-line); }
      .psm-popup-address{ font-size:0.84rem; color:#fff; margin:5px 0 0; }
      .psm-popup-tag{ display:inline-block; font-size:0.68rem; padding:2px 8px; border-radius:10px; color:#fff; }
      .psm-wa-btn{ display:inline-block; margin-top:6px; background:var(--psm-green); color:#fff !important; text-decoration:none; padding:5px 10px; border-radius:4px; font-size:0.75rem; font-weight:600; }
      .psm-empty{ padding:26px 20px; color:#fff; font-size:0.86rem; }

      .leaflet-tooltip.psm-tip{ background:var(--psm-navy); color:#fff; border:none; border-radius:4px; font-family:'Source Sans 3',sans-serif; padding:6px 9px; box-shadow:0 2px 6px rgba(0,0,0,0.25); }
      .leaflet-tooltip.psm-tip::before{ border-top-color:var(--psm-navy); }
      .psm-tip-name{ font-weight:600; font-size:0.8rem; }
      .psm-tip-jenis{ font-size:0.72rem; color:#cfe0d6; margin-top:2px; }

      .psm-legend{ position:absolute; bottom:16px; left:16px; z-index:500; background:var(--psm-card); border:1px solid var(--psm-line); border-radius:8px; padding:10px 14px; font-size:0.76rem; max-width:220px; max-height:34vh; overflow-y:auto; box-shadow:0 2px 10px rgba(0,0,0,0.15); }
      .psm-legend h4{ font-family:'Fraunces',serif; font-size:0.8rem; margin:0 0 6px; color:var(--psm-navy); }
      .psm-legend-item{ display:flex; align-items:center; gap:7px; margin:4px 0; }
      .psm-legend-dot{ width:10px; height:10px; border-radius:50%; flex-shrink:0; border:1.5px solid rgba(0,0,0,0.2); }
      @media (max-width:900px){ .psm-legend{ left:10px; bottom:10px; max-width:160px; } }

      .psm-marker{ display:flex; align-items:center; justify-content:center; }
      .psm-marker-dot{ width:22px; height:22px; border-radius:50%; border:2px solid #fff; box-shadow:0 1px 4px rgba(0,0,0,0.35); display:flex; align-items:center; justify-content:center; position:relative; }
      .psm-marker-badge{ position:absolute; top:-7px; right:-7px; background:var(--psm-navy); color:#fff; font-size:0.6rem; font-weight:700; border-radius:50%; width:16px; height:16px; display:flex; align-items:center; justify-content:center; border:1.5px solid #fff; }
    </style>
    @endpush
@endonce

<div id="psm-app" style="--psm-app-height: {{ $height }};">
    <div class="psm-side">
        <div class="psm-controls">
            <input type="text" id="psm-search" placeholder="Cari nama SAMSAT, wilayah, atau alamat...">
            <div class="psm-row-2">
                <select id="psm-filter-wilayah"><option value="">Semua wilayah</option></select>
                <select id="psm-filter-jenis"><option value="">Semua jenis layanan</option></select>
            </div>
            <div class="psm-filechip">
                <span class="psm-count" id="psm-count-label">Memuat data…</span>
                <div style="display:flex; gap:6px;">
                    <button type="button" class="psm-reset-btn" id="psm-reset-btn">Data default</button>
                    <label for="psm-csv-input">Muat CSV lain</label>
                    <input type="file" id="psm-csv-input" accept=".csv">
                </div>
            </div>
        </div>
        <div class="psm-list" id="psm-list"></div>
    </div>

    <div class="psm-map-wrap">
        <div id="psm-map"></div>
        <div class="psm-legend" id="psm-legend">
            <h4>Jenis Layanan</h4>
            <div id="psm-legend-items"></div>
        </div>
    </div>
</div>

@push('scripts')
{{-- Leaflet.js + PapaParse (parser CSV) --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
<script>
(function () {
  'use strict';

  const DEFAULT_LOCATIONS = @json($locations);

  function escapeHtml(str) {
    return (str ?? '').toString()
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
  }

  // ---------- Kolom yang dikenali saat memuat CSV lain secara manual ----------
  const COLMAP = {
    wilayah: ['wilayah'],
    nama: ['nama samsat', 'nama_samsat'],
    layanan: ['nama layanan', 'nama_layanan'],
    x: ['alamat x', 'alamat_x', 'longitude', 'lng', 'bujur'],
    y: ['alamat y', 'alamat_y', 'latitude', 'lat', 'lintang'],
    jenis: ['jenis layanan', 'jenis_layanan'],
    wa: ['no wa', 'wa', 'whatsapp'],
  };

  function findKey(headers, keywords) {
    return headers.find((h) => keywords.some((k) => h.toLowerCase().trim().includes(k)));
  }

  // ---------- Kategori jenis layanan diturunkan dari teks "Nama Layanan Samsat" ----------
  const JENIS_RULES = [
    ['drive thru', 'Drive Thru'],
    ['keliling', 'Keliling'],
    ['terapung', 'Keliling'],
    ['jelajah', 'Keliling'],
    ['payment point', 'Payment Point'],
    ['mall pelayanan publik', 'MPP'],
    ['mpp', 'MPP'],
    ['pelita', 'Pelita'],
    ['paten', 'Paten'],
    ['mall', 'Mall / Gerai'],
    ['corner', 'Mall / Gerai'],
    ['pembantu', 'Pembantu'],
    ['penuh', 'Penuh'],
    ['induk', 'Induk'],
  ];

  function deriveJenis(text) {
    const t = (text || '').toLowerCase();
    for (const [kw, label] of JENIS_RULES) {
      if (t.includes(kw)) return label;
    }
    return 'Lainnya';
  }

  function isValidKaltimCoord(lat, lng) {
    return isFinite(lat) && isFinite(lng) && lat >= -6 && lat <= 6 && lng >= 108 && lng <= 126;
  }

  let allData = [];
  let markers = [];

  // Struktur internal: x = longitude, y = latitude (konvensi standar Leaflet [lat,lng] = [y,x])
  function normalize(d) {
    return {
      wilayah: d.wilayah || '-',
      nama: d.nama || '-',
      layanan: d.layanan || '-',
      x: parseFloat(d.x),
      y: parseFloat(d.y),
      jenis: d.jenis || '-',
      wa: (d.wa || '').toString().replace(/[^0-9]/g, ''),
    };
  }

  // Data dari database (Panel Admin » Peta Layanan Samsat) sudah dalam bentuk
  // {wilayah, nama, alamat, latitude, longitude, jenis, wa} — tinggal dipetakan
  // ke struktur internal (x = longitude, y = latitude).
  function normalizeDbRow(row) {
    const lat = row.latitude === null || row.latitude === undefined ? NaN : parseFloat(row.latitude);
    const lng = row.longitude === null || row.longitude === undefined ? NaN : parseFloat(row.longitude);
    const valid = isValidKaltimCoord(lat, lng);

    return normalize({
      wilayah: row.wilayah,
      nama: row.nama,
      layanan: row.alamat && row.alamat.trim() !== '' ? row.alamat : 'Alamat belum tersedia',
      jenis: row.jenis || deriveJenis(row.nama),
      x: valid ? lng : NaN,
      y: valid ? lat : NaN,
      wa: row.wa || '',
    });
  }

  // ---------- Peta (dibatasi hanya area Kalimantan Timur) ----------
  const KALTIM_BOUNDS = L.latLngBounds([-3.0, 113.3], [3.2, 119.8]);

  const map = L.map('psm-map', {
    zoomControl: true,
    maxBounds: KALTIM_BOUNDS.pad(0.08),
    maxBoundsViscosity: 1.0,
    minZoom: 6,
  });
  map.fitBounds(KALTIM_BOUNDS);

  L.tileLayer('/tiles/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 19,
    noWrap: true,
    bounds: KALTIM_BOUNDS.pad(0.2),
  }).addTo(map);

  const markerLayer = L.layerGroup().addTo(map);

  window.addEventListener('load', () => setTimeout(() => map.invalidateSize(), 300));

  // ---------- Warna per jenis layanan ----------
  const PALETTE = ['#b8863a', '#2f7a4f', '#a8433a', '#3a6ea5', '#6a4c93', '#c98a2c', '#4c8c7f', '#8c4c6a'];
  let jenisColorMap = {};

  function buildJenisColors(data) {
    const jenises = [...new Set(data.map((d) => d.jenis))].sort();
    jenisColorMap = {};
    jenises.forEach((j, i) => { jenisColorMap[j] = PALETTE[i % PALETTE.length]; });
    renderLegend(jenises);
  }
  function colorFor(jenis) { return jenisColorMap[jenis] || '#888'; }

  function textColorFor(bgHex) {
    const c = (bgHex || '').replace('#', '');
    if (c.length !== 6) return '#ffffff';
    const r = parseInt(c.substr(0, 2), 16), g = parseInt(c.substr(2, 2), 16), b = parseInt(c.substr(4, 2), 16);
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    return luminance > 0.6 ? '#1c1a16' : '#ffffff';
  }

  function renderLegend(jenises) {
    const el = document.getElementById('psm-legend-items');
    el.innerHTML = jenises.map((j) => `
      <div class="psm-legend-item">
        <span class="psm-legend-dot" style="background:${colorFor(j)}"></span>
        <span>${escapeHtml(j)}</span>
      </div>
    `).join('');
  }

  function waLink(wa) {
    if (!wa) return null;
    const num = wa.startsWith('62') ? wa : ('62' + wa.replace(/^0/, ''));
    return `https://wa.me/${num}`;
  }

  // ---------- Kelompokkan baris data per lokasi fisik (nama+koordinat) ----------
  function groupByLocation(rows) {
    const map = new Map();
    rows.forEach((d) => {
      const key = `${d.wilayah}|${d.nama}|${d.x}|${d.y}`;
      if (!map.has(key)) {
        map.set(key, { wilayah: d.wilayah, nama: d.nama, x: d.x, y: d.y, services: [] });
      }
      map.get(key).services.push({ layanan: d.layanan, jenis: d.jenis, wa: d.wa });
    });
    return [...map.values()];
  }

  function popupHTML(group) {
    const rows = group.services.map((s) => {
      const link = waLink(s.wa);
      return `
        <div class="psm-popup-service">
          <span class="psm-popup-tag" style="background:${colorFor(s.jenis)};color:${textColorFor(colorFor(s.jenis))}">${escapeHtml(s.jenis)}</span>
          <p class="psm-popup-address">${escapeHtml(s.layanan)}</p>
          ${link ? `<div><a class="psm-wa-btn" href="${link}" target="_blank" rel="noopener">Chat via WhatsApp</a></div>` : ''}
        </div>`;
    }).join('');
    return `
      <div class="psm-popup-title">${escapeHtml(group.nama)}</div>
      <div class="psm-popup-sub">${escapeHtml(group.wilayah)}</div>
      ${rows}
    `;
  }

  function makeIcon(group) {
    const count = group.services.length;
    const bg = count === 1 ? colorFor(group.services[0].jenis) : '#16324a';
    const badge = count > 1 ? `<span class="psm-marker-badge">${count}</span>` : '';
    return L.divIcon({
      className: 'psm-marker',
      html: `<div class="psm-marker-dot" style="background:${bg}">${badge}</div>`,
      iconSize: [24, 24],
      iconAnchor: [12, 12],
    });
  }

  let currentGroups = [];

  function renderMarkers(groups) {
    markerLayer.clearLayers();
    markers = [];
    groups.forEach((g, i) => {
      if (isNaN(g.x) || isNaN(g.y)) return;
      const m = L.marker([g.y, g.x], { icon: makeIcon(g) }).bindPopup(popupHTML(g));
      const jenisList = [...new Set(g.services.map((s) => s.jenis))];
      m.bindTooltip(
        `<div class="psm-tip-name">${escapeHtml(g.nama)}</div><div class="psm-tip-jenis">${jenisList.length > 1 ? jenisList.length + ' jenis layanan' : escapeHtml(jenisList[0])}</div>`,
        { className: 'psm-tip', direction: 'top', offset: [0, -10], opacity: 1 }
      );
      m.on('click', () => setActive(i));
      m.addTo(markerLayer);
      markers.push(m);
    });
  }

  function renderList(groups) {
    const list = document.getElementById('psm-list');
    const totalWithCoord = groups.filter((g) => !isNaN(g.x) && !isNaN(g.y)).length;
    document.getElementById('psm-count-label').innerHTML = `${groups.length} lokasi &middot; ${totalWithCoord} di peta`;

    if (groups.length === 0) {
      list.innerHTML = `<div class="psm-empty">Tidak ada lokasi yang cocok dengan filter/pencarian ini.</div>`;
      return;
    }

    const byWilayah = new Map();
    groups.forEach((g, i) => {
      if (!byWilayah.has(g.wilayah)) byWilayah.set(g.wilayah, []);
      byWilayah.get(g.wilayah).push({ g, i });
    });

    const wilayahNames = [...byWilayah.keys()].sort();
    list.innerHTML = wilayahNames.map((w, wi) => {
      const items = byWilayah.get(w);
      const openAttr = wilayahNames.length <= 2 ? 'open' : '';
      return `
        <div class="psm-wgroup ${openAttr}" data-w="${wi}">
          <div class="psm-wgroup-head" data-toggle="${wi}">
            <h4>${escapeHtml(w)}</h4>
            <div class="psm-wgroup-meta">
              <span class="psm-wgroup-count">${items.length} lokasi</span>
              <span class="psm-wgroup-arrow">&#9656;</span>
            </div>
          </div>
          <div class="psm-wgroup-body">
            ${items.map(({ g, i }) => `
              <div class="psm-entry" data-i="${i}">
                <h3>${escapeHtml(g.nama)}</h3>
                <div class="psm-entry-addr">${escapeHtml(g.services[0]?.layanan || '')}</div>
                <div class="psm-tags">
                  ${[...new Set(g.services.map((s) => s.jenis))].map((j) => `<span class="psm-tag" style="background:${colorFor(j)};color:${textColorFor(colorFor(j))}">${escapeHtml(j)}</span>`).join('')}
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    }).join('');

    list.querySelectorAll('.psm-wgroup-head').forEach((el) => {
      el.addEventListener('click', () => { el.closest('.psm-wgroup').classList.toggle('open'); });
    });
    list.querySelectorAll('.psm-entry').forEach((el) => {
      el.addEventListener('click', (e) => { e.stopPropagation(); setActive(parseInt(el.dataset.i, 10)); });
    });
  }

  function setActive(i) {
    const g = currentGroups[i];
    if (!g) return;
    document.querySelectorAll('.psm-entry').forEach((el) => el.classList.remove('active'));
    const el = document.querySelector(`.psm-entry[data-i="${i}"]`);
    if (el) {
      el.classList.add('active');
      el.closest('.psm-wgroup') && el.closest('.psm-wgroup').classList.add('open');
      el.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }
    if (!isNaN(g.x) && !isNaN(g.y)) {
      map.setView([g.y, g.x], 14, { animate: true });
      markers[i] && markers[i].openPopup();
    }
  }

  function refreshJenisAndFilters(data) {
    buildJenisColors(data);
    populateFilters(data);
  }

  function populateFilters(data) {
    const wilSel = document.getElementById('psm-filter-wilayah');
    const jenisSel = document.getElementById('psm-filter-jenis');
    const prevWil = wilSel.value;
    const prevJenis = jenisSel.value;
    const wilayahs = [...new Set(data.map((d) => d.wilayah))].sort();
    const jenises = [...new Set(data.map((d) => d.jenis))].sort();
    wilSel.innerHTML = '<option value="">Semua wilayah</option>' + wilayahs.map((w) => `<option value="${escapeHtml(w)}">${escapeHtml(w)}</option>`).join('');
    jenisSel.innerHTML = '<option value="">Semua jenis layanan</option>' + jenises.map((j) => `<option value="${escapeHtml(j)}">${escapeHtml(j)}</option>`).join('');
    if (wilayahs.includes(prevWil)) wilSel.value = prevWil;
    if (jenises.includes(prevJenis)) jenisSel.value = prevJenis;
  }

  function applyFilters() {
    const q = document.getElementById('psm-search').value.trim().toLowerCase();
    const wil = document.getElementById('psm-filter-wilayah').value;
    const jenis = document.getElementById('psm-filter-jenis').value;
    const filteredRows = allData.filter((d) => {
      const matchQ = !q || d.nama.toLowerCase().includes(q) || d.wilayah.toLowerCase().includes(q) || d.layanan.toLowerCase().includes(q);
      const matchWil = !wil || d.wilayah === wil;
      const matchJenis = !jenis || d.jenis === jenis;
      return matchQ && matchWil && matchJenis;
    });
    currentGroups = groupByLocation(filteredRows);
    renderList(currentGroups);
    renderMarkers(currentGroups);
  }

  document.getElementById('psm-search').addEventListener('input', applyFilters);
  document.getElementById('psm-filter-wilayah').addEventListener('change', applyFilters);
  document.getElementById('psm-filter-jenis').addEventListener('change', applyFilters);

  // ---------- Muat data default dari database (dikelola via Panel Admin) ----------
  function loadDefaultData() {
    if (!Array.isArray(DEFAULT_LOCATIONS) || DEFAULT_LOCATIONS.length === 0) {
      allData = [];
      refreshJenisAndFilters(allData);
      applyFilters();
      document.getElementById('psm-list').innerHTML = '<div class="psm-empty">Belum ada data lokasi Samsat. Silakan tambahkan melalui Panel Admin &raquo; Peta Layanan Samsat.</div>';
      document.getElementById('psm-count-label').textContent = '0 lokasi';
      return;
    }

    allData = DEFAULT_LOCATIONS
      .map(normalizeDbRow)
      .filter((d) => d.nama && d.nama !== '-');
    refreshJenisAndFilters(allData);
    applyFilters();
  }

  // ---------- Unggah CSV lain secara manual (opsional) ----------
  document.getElementById('psm-csv-input').addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;
    Papa.parse(file, {
      header: true,
      skipEmptyLines: true,
      complete: (results) => {
        const headers = results.meta.fields;
        const kWil = findKey(headers, COLMAP.wilayah);
        const kNama = findKey(headers, COLMAP.nama);
        const kLayanan = findKey(headers, COLMAP.layanan);
        const kX = findKey(headers, COLMAP.x);
        const kY = findKey(headers, COLMAP.y);
        const kJenis = findKey(headers, COLMAP.jenis);
        const kWa = findKey(headers, COLMAP.wa);

        if (!kX || !kY) {
          alert('Kolom koordinat (Longitude/Latitude) tidak ditemukan di file CSV. Pastikan nama kolom sesuai format.');
          return;
        }

        allData = results.data.map((row) => normalize({
          wilayah: row[kWil],
          nama: row[kNama],
          layanan: row[kLayanan],
          x: row[kX],
          y: row[kY],
          jenis: row[kJenis],
          wa: row[kWa],
        })).filter((d) => !isNaN(d.x) && !isNaN(d.y));

        refreshJenisAndFilters(allData);
        applyFilters();
        if (allData.length) {
          const bounds = L.latLngBounds(allData.map((d) => [d.y, d.x]));
          map.fitBounds(bounds, { padding: [30, 30] });
        }
      },
      error: () => alert('Gagal membaca file CSV.'),
    });
  });

  document.getElementById('psm-reset-btn').addEventListener('click', () => {
    document.getElementById('psm-csv-input').value = '';
    document.getElementById('psm-search').value = '';
    map.fitBounds(KALTIM_BOUNDS);
    loadDefaultData();
  });

  // ---------- Init ----------
  loadDefaultData();
})();
</script>
@endpush
