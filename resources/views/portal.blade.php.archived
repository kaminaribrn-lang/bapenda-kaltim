<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi BAPENDA Kaltim – Badan Pendapatan Daerah Provinsi Kalimantan Timur</title>
    <meta name="description" content="Portal resmi Badan Pendapatan Daerah Provinsi Kalimantan Timur. Akses layanan SIMPATOR, PPID, Website, dan informasi UPTD wilayah.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- SVG Map: no external library needed --}}
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ──── Animasi ──── */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.3); opacity: 0.7; }
        }

        .anim-down  { animation: fadeInDown 0.7s ease-out forwards; }
        .anim-up    { animation: fadeInUp  0.7s ease-out forwards; }
        .anim-up-2  { animation: fadeInUp  0.7s 0.15s ease-out both; }
        .anim-up-3  { animation: fadeInUp  0.7s 0.30s ease-out both; }
        .anim-up-4  { animation: fadeInUp  0.7s 0.45s ease-out both; }

        /* ──── Hero ──── */
        .hero-bg {
            background: linear-gradient(160deg, #0d3d2e 0%, #145a3c 40%, #0a3028 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            top: -20%; left: -10%;
            width: 55%; height: 70%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(20,90,60,0.5) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            bottom: -20%; right: -5%;
            width: 45%; height: 60%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(180,20,20,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ──── Logo Box ──── */
        .logo-box {
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
        }

        /* ──── Badge Portal Resmi ──── */
        .badge-official {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 999px;
            padding: 4px 14px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.75);
            backdrop-filter: blur(6px);
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #4ade80;
            animation: pulse-dot 2s infinite;
        }

        /* ──── Stat Bar ──── */
        .stat-bar {
            background: rgba(0,0,0,0.25);
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .stat-item {
            flex: 1;
            text-align: center;
            padding: 18px 8px;
            border-right: 1px solid rgba(255,255,255,0.08);
        }
        .stat-item:last-child { border-right: none; }
        .stat-number {
            font-size: 2rem; font-weight: 800;
            color: #fff;
            line-height: 1;
        }
        .stat-label {
            font-size: 9px; font-weight: 600;
            letter-spacing: 0.14em;
            color: rgba(255,255,255,0.45);
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* ──── Body / Card ──── */
        .portal-body {
            background: #f4f6f5;
            min-height: calc(100vh - 320px);
        }

        /* ──── Section header ──── */
        .section-header {
            display: flex; align-items: baseline; justify-content: space-between;
            margin-bottom: 14px;
        }
        .section-title {
            font-size: 12px; font-weight: 700;
            letter-spacing: 0.12em;
            color: #1a2e25;
            text-transform: uppercase;
        }
        .section-count {
            font-size: 11px; color: #4ade80; font-weight: 500;
        }

        /* ──── Service Card ──── */
        .service-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px 16px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1.5px solid #e8f0ec;
            transition: transform 0.22s, box-shadow 0.22s, border-color 0.22s;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .service-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .service-card.green::before  { background: linear-gradient(90deg, #16a34a, #4ade80); }
        .service-card.teal::before   { background: linear-gradient(90deg, #0d9488, #34d399); }
        .service-card.red::before    { background: linear-gradient(90deg, #dc2626, #f87171); }
        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.10);
            border-color: #b6d9c5;
        }
        .service-icon-wrap {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 12px;
        }
        .service-name {
            font-size: 13px; font-weight: 700;
            color: #1a2e25;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }
        .service-desc {
            font-size: 10px; color: #6b7280; line-height: 1.45;
        }

        /* ──── UPTD Section ──── */
        .uptd-section {
            background: #fff;
            border-radius: 14px;
            padding: 16px 18px;
            border: 1.5px solid #e8f0ec;
        }
        .uptd-divider {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 14px;
        }
        .uptd-divider-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        }
        .uptd-label {
            font-size: 9px; font-weight: 700;
            letter-spacing: 0.15em;
            color: #1a2e25;
            white-space: nowrap;
        }
        .uptd-dot { width: 6px; height: 6px; border-radius: 50%; background: #dc2626; }
        .uptd-pill {
            display: inline-flex; align-items: center; gap: 5px;
            background: #f0f7f3;
            border: 1px solid #d1fae5;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 11px; font-weight: 500;
            color: #1a2e25;
            text-decoration: none;
            transition: background 0.18s, border-color 0.18s, color 0.18s;
        }
        .uptd-pill:hover {
            background: #16a34a;
            border-color: #16a34a;
            color: #fff;
        }
        .uptd-pill svg { color: #16a34a; transition: color 0.18s; }
        .uptd-pill:hover svg { color: #fff; }

        /* ──── App Card ──── */
        .app-card {
            background: #fff;
            border-radius: 14px;
            border: 1.5px solid #e8f0ec;
            padding: 16px 18px;
            display: flex; align-items: center; gap: 14px;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .app-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.09);
        }
        .app-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .app-info { flex: 1; min-width: 0; }
        .app-name {
            font-size: 13px; font-weight: 700;
            color: #1a2e25; margin-bottom: 2px;
        }
        .app-desc { font-size: 10px; color: #6b7280; }
        .app-arrow { color: #9ca3af; }

        /* ──── Footer ──── */
        .portal-footer {
            background: #f4f6f5;
            border-top: 1px solid #e5e7eb;
            padding: 16px 20px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 10px;
        }
        .footer-copyright {
            font-size: 10px; color: #6b7280;
        }
        .footer-badges { display: flex; gap: 8px; }
        .footer-badge {
            display: inline-flex; align-items: center; gap: 5px;
            border-radius: 999px;
            padding: 5px 12px;
            font-size: 10px; font-weight: 600;
            border: 1px solid;
        }
        .badge-verified {
            background: #f0f9ff;
            border-color: #bae6fd;
            color: #0369a1;
        }
        .badge-official-site {
            background: #fff0f0;
            border-color: #fecaca;
            color: #dc2626;
        }

        /* ──── SVG Map ──── */
        .reg {
            fill: #d4edda;
            stroke: #fff;
            stroke-width: 2;
            transition: fill 0.3s ease;
        }
        .reg.active-kota      { fill: #dc2626; }
        .reg.active-kabupaten { fill: #16a34a; }
        .uptd-marker { cursor: pointer; }
        .marker-circle {
            transition: r 0.2s;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }
        .uptd-marker:hover .marker-circle { r: 15px; }
        .uptd-marker.is-active .marker-circle { r: 16px; }
        @keyframes markerIn {
            from { opacity:0; transform:scale(0) translateY(6px); }
            to   { opacity:1; transform:scale(1) translateY(0); }
        }
        .uptd-marker { animation: markerIn 0.35s ease-out both; }
        /* Detail Panel */
        .uptd-detail-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid #e8f0ec;
            animation: fadeInUp 0.3s ease-out;
        }
        .uptd-detail-header {
            background: linear-gradient(135deg, #1a2e25 0%, #145a3c 100%);
            padding: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .uptd-detail-body {
            padding: 14px 16px;
            background: #fff;
            display: flex;
            flex-direction: column;
            gap: 9px;
        }
        .uptd-info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 11px;
            color: #4b5563;
        }
        .uptd-info-row svg { flex-shrink: 0; margin-top: 1px; }
    </style>
</head>
<body style="margin:0;background:#f4f6f5;">

    {{-- ─────────────── HERO SECTION ─────────────── --}}
    <section class="hero-bg">
        <div style="max-width:960px;margin:0 auto;padding:36px 20px 0;text-align:center;" class="anim-down">

            {{-- Logo --}}
            <div style="display:flex;justify-content:center;margin-bottom:14px;">
                <div class="logo-box">
                    {{-- Icon Gedung / Institusi --}}
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.85)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="22" x2="21" y2="22"/>
                        <rect x="2" y="10" width="20" height="12"/>
                        <polygon points="12,2 2,10 22,10"/>
                        <line x1="12" y1="2" x2="12" y2="10"/>
                        <rect x="9" y="14" width="3" height="5"/>
                        <rect x="13" y="14" width="3" height="5"/>
                    </svg>
                </div>
            </div>

            {{-- Badge Official --}}
            <div style="display:flex;justify-content:center;margin-bottom:16px;">
                <span class="badge-official">
                    <span class="badge-dot"></span>
                    PORTAL RESMI PEMERINTAH DAERAH
                </span>
            </div>

            {{-- Judul --}}
            <h1 style="font-size:clamp(1.6rem,5vw,2.4rem);font-weight:800;color:#fff;margin:0 0 8px;line-height:1.15;">
                Badan Pendapatan Daerah
            </h1>
            <p style="font-size:clamp(0.85rem,2.5vw,1rem);font-weight:500;color:#4ade80;margin:0 0 8px;letter-spacing:0.02em;">
                Provinsi Kalimantan Timur
            </p>
            {{-- Dekoratif strip --}}
            <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:0;">
                <div style="width:32px;height:2px;background:rgba(255,255,255,0.2);border-radius:2px;"></div>
                <div style="width:6px;height:6px;border-radius:50%;background:#dc2626;"></div>
                <div style="width:32px;height:2px;background:rgba(255,255,255,0.2);border-radius:2px;"></div>
            </div>
        </div>

        {{-- ─── Stat Bar ─── --}}
        <div class="stat-bar" style="margin-top:28px;">
            <div style="max-width:960px;margin:0 auto;display:flex;">
                <div class="stat-item">
                    <div class="stat-number">9</div>
                    <div class="stat-label">Wilayah UPTD</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Layanan Utama</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Aplikasi Digital</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────── BODY ─────────────── --}}
    <div class="portal-body">
        <div style="max-width:960px;margin:0 auto;padding:24px 24px 32px;">

            {{-- ─── Layanan Utama ─── --}}
            <div class="anim-up-2">
                <div class="section-header">
                    <span class="section-title">Layanan Utama</span>
                    <span class="section-count">3 layanan</span>
                </div>

                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:20px;">

                    {{-- SIMPATOR --}}
                    <a href="#" class="service-card green">
                        <div class="service-icon-wrap" style="background:#f0fdf4;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"/>
                                <path d="M16 8h4l3 3v5h-7V8z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </div>
                        <div class="service-name">SIMPATOR</div>
                        <div class="service-desc">Sistem Informasi Pajak Kendaraan Bermotor</div>
                    </a>

                    {{-- WEBSITE --}}
                    <a href="#" class="service-card teal">
                        <div class="service-icon-wrap" style="background:#f0fdfa;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                        </div>
                        <div class="service-name">WEBSITE</div>
                        <div class="service-desc">Website Utama BAPENDA Kaltim</div>
                    </a>

                    {{-- PPID --}}
                    <a href="#" class="service-card red">
                        <div class="service-icon-wrap" style="background:#fff5f5;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <div class="service-name">PPID</div>
                        <div class="service-desc">Pejabat Pengelola Informasi &amp; Dokumentasi</div>
                    </a>

                </div>
            </div>

            {{-- ─── UPTD Wilayah (Interactive Map) ─── --}}
            <div class="uptd-section anim-up-3" style="margin-bottom:20px;">
                {{-- Divider label --}}
                <div class="uptd-divider">
                    <div class="uptd-divider-line"></div>
                    <div class="uptd-dot"></div>
                    <span class="uptd-label">LAYANAN UPTD PPRD WILAYAH</span>
                    <div class="uptd-dot"></div>
                    <div class="uptd-divider-line"></div>
                </div>

                {{-- SVG Map + Detail Panel --}}
                <div style="display:grid;grid-template-columns:3fr 2fr;gap:14px;">

                    {{-- SVG Map --}}
                    <div style="position:relative;">
                        <div style="border-radius:12px;border:1.5px solid #e8f0ec;overflow:hidden;background:linear-gradient(135deg,#e8f5e9,#f0f7f3);height:320px;position:relative;">
                            <svg id="kaltim-svg" viewBox="0 0 480 520" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;display:block;">
                                {{-- Region paths (Kalimantan Timur) --}}
                                <path id="reg-berau" class="reg" data-id="berau" d="M192.0,15.3 L194.5,15.4 L196.7,15.0 L198.7,14.1 L200.7,13.8 L202.7,14.2 L204.8,14.0 L207.2,13.2 L209.7,12.7 L212.5,12.3 L215.1,12.1 L217.6,11.9 L220.0,12.0 L222.4,12.4 L225.0,12.6 L227.7,12.6 L230.1,12.6 L232.2,12.6 L234.5,12.3 L237.1,11.8 L239.5,11.7 L241.6,12.0 L244.1,12.1 L247.0,11.7 L249.4,11.6 L251.4,11.7 L253.9,11.5 L257.0,11.1 L259.3,11.3 L261.0,11.9 L263.1,12.1 L265.7,11.9 L268.2,12.0 L270.6,12.5 L273.4,12.7 L276.6,12.7 L279.1,13.1 L281.0,13.8 L283.4,14.1 L286.3,13.9 L288.7,14.3 L290.6,15.3 L292.9,15.8 L295.8,15.7 L298.1,15.9 L299.7,16.6 L301.7,17.1 L304.1,17.6 L306.5,18.0 L308.7,18.4 L311.1,18.9 L313.8,19.4 L316.2,20.0 L318.6,20.4 L320.9,20.9 L323.2,21.4 L325.1,22.1 L326.5,23.0 L328.4,24.2 L330.5,25.6 L333.0,26.6 L335.6,27.1 L337.7,27.8 L339.2,28.7 L341.1,29.6 L343.6,30.6 L346.0,31.4 L348.1,32.1 L350.1,32.9 L352.0,34.0 L353.6,35.0 L354.7,35.9 L356.6,36.8 L359.1,37.7 L361.0,38.9 L362.3,40.2 L363.8,41.5 L365.5,42.6 L367.2,43.8 L369.0,44.9 L371.1,46.1 L373.6,47.4 L375.7,48.7 L377.5,50.0 L379.1,51.4 L380.6,53.1 L382.2,54.5 L383.8,55.6 L385.3,56.8 L386.8,58.0 L388.3,59.3 L389.6,60.5 L391.1,61.9 L392.6,63.4 L393.8,64.6 L394.7,65.4 L396.2,66.5 L398.4,67.7 L400.2,69.3 L401.6,71.2 L402.9,73.0 L404.1,74.7 L405.5,76.0 L407.0,77.0 L408.2,77.9 L409.0,78.9 L410.2,80.4 L411.9,82.6 L412.9,84.3 L413.3,85.5 L414.4,86.7 L416.0,87.7 L417.4,89.1 L418.3,91.0 L419.1,92.5 L419.6,93.8 L420.8,95.3 L422.6,97.1 L423.9,98.6 L424.6,99.9 L425.1,101.2 L425.4,102.5 L426.1,103.8 L427.1,105.0 L428.2,106.3 L429.3,107.7 L430.4,109.2 L431.5,110.8 L432.5,112.1 L433.5,113.4 L434.1,114.8 L434.3,116.5 L434.7,117.7 L435.5,118.5 L436.0,119.9 L436.4,121.9 L436.7,123.2 L437.0,123.9 L437.3,125.2 L437.6,127.2 L438.1,128.9 L438.7,130.2 L438.7,131.0 L437.9,131.5 L437.9,132.4 L438.7,133.7 L438.9,135.1 L438.6,136.8 L438.2,138.5 L437.8,140.0 L437.3,141.2 L436.7,142.1 L436.0,142.9 L435.2,143.6 L434.5,144.9 L434.1,146.7 L433.5,148.0 L432.7,148.8 L431.9,149.7 L431.0,150.8 L430.3,151.9 L429.8,153.1 L429.1,154.1 L428.1,155.1 L426.9,156.0 L425.5,156.9 L424.4,157.9 L423.6,159.1 L422.7,159.8 L421.7,160.0 L420.6,160.8 L419.4,162.1 L417.9,162.5 L416.1,162.2 L415.1,162.6 L414.8,163.7 L413.7,164.3 L411.7,164.3 L410.5,164.4 L409.8,164.5 L408.5,164.8 L406.6,165.3 L405.0,165.3 L403.6,164.8 L402.4,165.0 L401.5,165.7 L400.2,166.0 L398.5,165.9 L397.1,165.7 L396.0,165.4 L394.6,165.2 L393.0,165.1 L391.2,164.6 L389.0,163.4 L387.1,162.7 L385.3,162.3 L383.7,162.1 L382.4,162.1 L381.0,162.1 L379.5,162.2 L378.2,162.1 L377.1,161.6 L376.0,161.4 L374.9,161.3 L373.2,161.4 L370.9,161.7 L369.1,161.8 L367.7,161.6 L366.6,161.1 L366.0,160.4 L364.8,160.4 L363.2,161.2 L361.5,161.5 L359.6,161.1 L358.0,161.3 L356.6,162.1 L355.5,162.4 L354.7,162.3 L353.7,162.2 L352.3,162.3 L350.7,162.6 L348.9,163.1 L347.4,163.3 L346.2,163.3 L345.0,163.5 L343.8,163.8 L342.7,164.2 L341.7,164.6 L340.6,164.9 L339.3,164.9 L338.2,165.4 L337.3,166.3 L336.1,166.8 L334.6,166.8 L333.4,167.1 L332.4,167.6 L331.2,167.8 L329.8,167.6 L328.2,167.6 L326.4,167.8 L324.9,167.6 L323.7,167.0 L322.7,167.0 L321.9,167.6 L321.1,167.7 L320.2,167.6 L318.7,167.3 L316.8,166.8 L315.4,166.9 L314.6,167.8 L313.3,167.8 L311.4,166.9 L309.8,166.8 L308.7,167.2 L307.8,167.3 L307.3,166.9 L306.0,166.6 L304.0,166.2 L302.5,165.8 L301.6,165.3 L300.5,164.8 L299.1,164.3 L297.6,164.2 L296.0,164.6 L295.1,164.9 L294.8,165.2 L294.0,165.0 L292.7,164.4 L291.3,164.1 L289.5,164.0 L288.1,164.2 L286.9,164.4 L285.7,164.5 L284.4,164.4 L282.9,164.0 L281.1,163.5 L280.1,163.6 L279.9,164.3 L279.1,164.5 L277.8,164.2 L276.5,164.0 L275.0,163.8 L273.7,164.1 L272.7,164.8 L271.1,165.1 L268.9,164.9 L267.6,165.1 L267.1,165.7 L265.9,165.8 L263.9,165.6 L262.8,166.0 L262.4,166.9 L261.5,167.3 L260.1,167.3 L258.9,167.5 L257.7,167.9 L256.3,167.8 L254.6,167.3 L253.1,167.5 L251.6,168.1 L250.5,168.4 L249.6,168.4 L248.5,168.4 L247.1,168.6 L245.7,168.6 L244.2,168.6 L242.7,168.6 L241.3,168.5 L240.3,168.5 L239.8,168.5 L238.7,168.5 L237.1,168.5 L235.4,168.4 L233.8,168.1 L232.6,167.7 L232.0,167.1 L231.1,166.6 L229.8,166.2 L228.2,166.1 L226.5,166.3 L225.2,166.0 L224.4,165.2 L223.2,164.8 L221.5,164.8 L220.4,165.0 L219.8,165.3 L218.5,165.1 L216.4,164.2 L214.8,163.8 L213.8,163.8 L213.0,163.9 L212.1,164.2 L210.9,164.0 L209.2,163.5 L207.5,163.2 L205.7,163.1 L204.3,162.9 L203.5,162.5 L202.4,162.4 L201.0,162.5 L199.6,162.7 L198.2,163.0 L197.0,163.0 L195.9,162.9 L194.4,162.9 L192.6,163.0 L191.0,163.3 L189.5,163.7 L188.1,163.9 L186.8,163.9 L185.6,163.9 L184.5,163.8 L183.2,163.9 L181.7,163.9 L180.3,164.1 L179.0,164.3 L177.9,164.2 L177.0,164.0 L175.9,163.6 L174.7,163.0 L173.3,162.9 L171.7,163.3 L170.5,163.3 L169.7,163.0 L168.5,162.8 L166.9,162.8 L165.4,162.7 L163.9,162.6 L162.9,162.5 L162.5,162.4 L161.6,162.1 L160.3,161.7 L159.4,161.2 L158.8,160.6 L158.1,160.1 L157.3,159.7 L156.2,159.3 L155.1,159.0 L153.8,158.3 L152.5,157.3 L151.4,156.5 L150.7,156.2 L150.4,155.6 L150.4,154.8 L149.7,153.8 L148.3,152.7 L147.7,151.9 L147.8,151.5 L147.4,150.9 L146.4,149.9 L145.7,149.2 L145.3,148.5 L144.8,147.7 L143.9,146.7 L143.1,145.8 L142.2,145.0 L141.7,144.3 L141.5,143.7 L140.8,143.0 L139.8,142.1 L138.8,141.1 L137.8,139.9 L137.1,138.8 L136.8,137.7 L136.6,136.6 L136.6,135.5 L135.9,134.4 L134.7,133.4 L133.8,132.7 L133.2,132.3 L132.7,131.4 L132.4,129.9 L132.2,128.7 L132.0,127.7 L131.5,126.7 L130.4,125.5 L129.6,124.2 L128.9,122.8 L128.6,121.8 L128.6,121.2 L128.3,120.2 L127.4,118.7 L127.1,117.4 L127.3,116.1 L127.0,114.9 L126.3,113.9 L125.9,112.4 L125.9,110.5 L126.0,109.2 L126.2,108.5 L126.1,107.5 L125.7,106.1 L125.2,104.9 L124.6,104.0 L124.7,103.0 L125.5,101.7 L125.9,100.1 L126.0,98.3 L125.7,96.7 L125.1,95.3 L125.1,93.9 L125.6,92.5 L126.0,91.3 L126.1,90.4 L126.4,89.0 L126.8,87.3 L126.9,85.6 L126.7,83.8 L126.7,82.4 L127.1,81.5 L127.7,80.6 L128.5,79.7 L128.9,78.1 L128.9,75.9 L129.1,74.3 L129.4,73.4 L129.5,72.3 L129.5,71.0 L129.9,69.4 L130.6,67.6 L131.4,66.0 L132.1,64.5 L132.8,63.1 L133.5,61.7 L133.7,60.7 L133.6,59.9 L134.0,58.6 L135.0,56.9 L135.7,55.4 L136.0,54.2 L136.3,53.0 L136.7,51.9 L137.1,50.6 L137.6,49.0 L138.2,47.8 L139.0,46.9 L140.0,45.6 L141.1,43.9 L142.0,42.7 L142.7,41.9 L143.2,40.7 L143.3,39.2 L143.8,37.9 L144.7,37.0 L145.7,35.9 L146.7,34.7 L148.0,33.6 L149.5,32.6 L150.6,31.7 L151.3,31.1 L152.3,30.0 L153.6,28.4 L155.0,27.2 L156.7,26.4 L158.2,25.6 L159.6,24.7 L161.2,23.9 L162.8,23.2 L164.4,22.6 L166.1,22.4 L167.8,21.5 L169.6,20.0 L171.1,19.3 L172.2,19.3 L173.8,19.0 L175.9,18.6 L178.0,18.1 L179.9,17.5 L182.1,17.1 L184.4,16.9 L186.9,16.4 L189.5,15.6 Z" />
                                <path id="reg-kutim" class="reg" data-id="kutim" d="M304.7,165.6 L305.9,166.7 L307.4,167.3 L308.9,167.5 L310.0,167.4 L310.5,167.1 L311.6,167.0 L313.3,167.0 L314.9,167.4 L316.4,168.1 L317.5,168.2 L318.2,167.7 L319.2,167.4 L320.3,167.3 L321.6,167.3 L322.9,167.4 L324.4,167.2 L325.9,166.9 L327.3,166.9 L328.4,167.4 L329.4,167.2 L330.2,166.5 L331.2,166.3 L332.6,166.6 L334.0,166.7 L335.6,166.6 L336.9,166.5 L338.1,166.5 L339.5,166.2 L341.2,165.5 L342.3,165.1 L342.6,165.0 L343.6,164.9 L345.4,164.7 L346.7,164.2 L347.4,163.3 L348.6,162.6 L350.1,162.1 L351.7,161.7 L353.3,161.5 L354.9,161.3 L356.6,161.1 L358.0,161.1 L358.9,161.3 L360.2,161.1 L361.9,160.7 L363.3,160.8 L364.4,161.6 L365.6,161.9 L366.8,161.7 L367.9,161.3 L369.0,160.8 L370.5,160.8 L372.3,161.3 L374.0,161.8 L375.4,162.2 L377.0,162.2 L378.6,161.6 L380.2,161.7 L381.7,162.2 L383.3,162.8 L385.1,163.5 L386.7,163.8 L388.2,163.8 L389.4,163.9 L390.5,164.2 L391.7,164.3 L393.1,164.2 L394.6,164.4 L396.1,165.1 L397.6,165.6 L399.2,165.8 L401.0,166.0 L402.9,166.1 L404.3,165.9 L405.3,165.5 L406.7,165.3 L408.4,165.4 L409.5,165.1 L410.1,164.6 L411.1,164.1 L412.5,163.8 L413.9,163.2 L415.4,162.4 L416.9,161.8 L418.4,161.4 L419.8,160.8 L420.9,160.0 L421.6,159.4 L421.8,159.1 L423.0,158.7 L424.9,158.1 L426.4,157.5 L427.5,156.9 L428.4,155.8 L429.2,154.1 L429.9,152.6 L430.5,151.3 L431.1,150.3 L431.6,149.8 L432.4,149.1 L433.5,148.1 L434.6,147.5 L435.7,147.2 L436.5,146.9 L436.8,146.6 L437.6,146.4 L438.9,146.3 L440.1,146.1 L441.1,145.8 L441.7,145.5 L441.9,145.2 L442.1,145.2 L442.6,145.5 L443.4,145.7 L444.7,145.8 L445.4,146.3 L445.5,147.3 L445.9,148.0 L446.6,148.7 L447.4,149.7 L448.3,151.1 L449.1,152.0 L449.7,152.5 L450.2,153.2 L450.7,154.3 L450.9,155.9 L451.0,158.0 L451.4,159.6 L452.0,160.7 L452.2,162.3 L451.9,164.4 L452.2,166.2 L453.1,167.7 L453.5,169.3 L453.4,170.7 L453.5,172.2 L454.0,173.5 L454.4,175.1 L454.8,176.8 L455.2,178.5 L455.5,180.1 L455.7,182.3 L455.5,185.0 L456.0,187.4 L457.1,189.3 L457.6,191.1 L457.4,192.8 L457.3,194.4 L457.1,195.8 L457.4,197.8 L458.0,200.5 L458.4,202.6 L458.6,204.1 L458.8,205.9 L459.3,208.1 L459.3,210.4 L458.9,212.9 L458.9,215.2 L459.5,217.4 L459.6,219.2 L459.3,220.6 L458.9,222.7 L458.5,225.4 L458.6,227.5 L459.4,229.1 L459.7,230.8 L459.3,232.8 L459.0,235.0 L459.0,237.4 L458.7,239.4 L458.2,240.9 L457.9,243.0 L458.0,245.6 L457.6,247.9 L456.9,249.7 L456.6,251.5 L456.9,253.1 L456.6,254.7 L455.8,256.2 L455.2,258.1 L455.0,260.4 L454.8,262.2 L454.4,263.3 L454.2,264.7 L454.0,266.2 L453.5,268.0 L452.8,270.0 L452.0,271.6 L451.1,272.9 L450.2,274.4 L449.3,276.0 L448.5,277.2 L447.8,277.9 L447.3,279.0 L447.0,280.4 L446.5,281.9 L446.1,283.3 L445.6,284.7 L445.0,286.1 L444.1,287.5 L442.8,288.9 L441.6,290.1 L440.7,291.2 L439.9,292.4 L439.2,293.7 L438.6,294.9 L437.9,295.9 L437.1,297.4 L435.9,299.1 L434.9,300.5 L433.9,301.3 L433.0,302.0 L432.1,302.6 L430.9,303.6 L429.2,305.0 L428.0,306.1 L427.4,306.8 L426.7,308.0 L425.8,309.4 L424.5,310.7 L422.6,311.6 L421.4,312.6 L421.0,313.5 L420.1,314.6 L418.8,315.9 L417.3,316.6 L415.8,316.8 L414.4,317.7 L413.1,319.3 L411.8,320.3 L410.6,320.9 L409.8,321.3 L409.4,321.5 L408.6,321.7 L407.5,321.9 L406.4,322.5 L405.5,323.5 L404.3,324.3 L403.0,324.9 L401.5,325.1 L399.7,325.0 L398.6,325.1 L398.1,325.3 L397.4,325.8 L396.5,326.6 L395.5,326.9 L394.6,326.9 L393.5,326.9 L392.3,326.8 L391.1,326.8 L389.7,326.7 L388.4,326.3 L387.2,325.4 L386.4,325.0 L386.0,325.1 L385.2,325.1 L383.8,325.1 L382.7,324.8 L381.8,324.2 L380.5,323.5 L379.0,322.9 L377.7,322.4 L376.8,321.8 L376.1,321.4 L375.5,321.2 L374.5,320.9 L373.1,320.3 L372.3,319.9 L372.0,319.6 L371.2,319.2 L369.8,318.6 L368.7,318.0 L367.9,317.3 L366.9,316.4 L365.5,315.5 L364.7,314.7 L364.3,313.9 L363.4,313.0 L362.0,312.1 L360.8,311.3 L359.8,310.6 L359.1,309.5 L358.9,308.0 L358.1,306.6 L356.7,305.3 L355.8,304.4 L355.5,303.8 L354.9,302.9 L354.0,301.6 L353.1,300.8 L352.2,300.3 L351.5,299.2 L350.9,297.3 L349.8,296.1 L348.1,295.6 L347.1,294.8 L346.8,293.7 L346.1,292.7 L345.2,291.8 L344.4,290.7 L343.8,289.2 L342.7,287.9 L341.1,286.8 L340.0,285.9 L339.4,285.1 L338.9,284.4 L338.5,283.6 L337.4,282.6 L335.6,281.2 L334.4,280.2 L333.8,279.5 L333.1,278.7 L332.3,277.8 L331.4,277.1 L330.4,276.5 L329.6,275.5 L329.0,274.0 L328.3,272.9 L327.4,272.2 L326.3,271.4 L325.1,270.7 L324.0,270.2 L323.1,269.8 L322.6,268.8 L322.5,267.1 L321.7,266.2 L320.3,266.0 L319.2,265.4 L318.4,264.5 L317.4,263.4 L315.9,262.0 L315.2,261.1 L315.3,260.7 L314.4,259.7 L312.5,258.4 L311.2,257.4 L310.5,256.7 L310.0,256.1 L309.7,255.4 L308.9,254.4 L307.5,253.2 L306.4,252.3 L305.6,251.7 L304.6,250.8 L303.6,249.6 L302.4,248.6 L300.9,247.7 L300.0,247.0 L299.6,246.6 L298.7,246.0 L297.2,245.1 L296.1,244.2 L295.4,243.2 L294.5,242.1 L293.6,240.8 L292.5,239.8 L291.1,239.1 L290.4,237.9 L290.2,236.4 L289.3,235.2 L287.8,234.2 L286.7,233.6 L286.0,233.2 L285.3,232.4 L284.6,231.2 L284.1,229.9 L283.8,228.4 L283.4,227.6 L282.7,227.5 L281.6,226.5 L280.2,224.8 L279.2,223.8 L278.7,223.6 L278.2,222.9 L277.7,221.7 L276.9,220.6 L275.9,219.7 L275.2,218.5 L274.8,216.9 L274.3,215.5 L273.8,214.3 L273.5,213.6 L273.3,213.2 L272.9,212.3 L272.4,210.7 L272.0,209.5 L271.6,208.7 L271.1,207.8 L270.5,207.0 L270.2,205.7 L270.4,204.1 L270.2,203.3 L269.6,203.2 L269.4,202.5 L269.5,201.2 L269.4,199.9 L269.1,198.4 L269.2,197.1 L269.6,195.9 L269.8,195.1 L269.7,194.7 L269.9,193.8 L270.4,192.3 L270.7,191.0 L270.9,189.9 L271.1,188.7 L271.4,187.4 L271.3,186.4 L270.8,185.5 L271.1,184.9 L272.1,184.6 L272.9,183.5 L273.5,181.8 L273.8,180.6 L273.9,180.0 L274.2,179.3 L274.8,178.6 L275.5,177.8 L276.5,176.9 L277.4,175.7 L278.2,174.2 L278.9,173.2 L279.7,172.9 L280.6,172.1 L281.8,170.7 L282.7,170.0 L283.3,170.0 L283.7,169.6 L283.8,169.0 L284.4,168.4 L285.7,167.8 L286.7,167.4 L287.6,167.2 L288.7,166.9 L290.1,166.6 L291.1,166.2 L291.8,165.9 L292.7,165.4 L293.8,164.8 L295.1,164.7 L296.8,165.4 L298.1,165.8 L299.1,166.1 L299.9,165.9 L300.3,165.2 L301.4,165.0 L303.2,165.1 Z" />
                                <path id="reg-bontang" class="reg" data-id="bontang" d="M418.8,327.9 L419.6,327.8 L420.7,327.5 L422.1,327.1 L423.0,326.9 L423.5,327.1 L424.5,327.1 L426.0,326.8 L427.4,327.0 L428.7,327.8 L429.5,328.1 L429.7,328.1 L430.3,328.5 L431.3,329.1 L432.1,329.3 L432.8,328.9 L433.7,328.9 L434.8,329.2 L435.3,329.6 L435.3,330.3 L435.4,331.1 L435.9,332.3 L436.4,333.0 L436.9,333.4 L437.5,333.8 L438.0,334.2 L438.7,334.8 L439.4,335.5 L439.5,336.5 L439.0,337.7 L439.2,338.6 L440.2,339.2 L440.5,340.1 L440.0,341.5 L439.9,342.8 L440.3,344.0 L440.3,345.2 L440.0,346.3 L440.0,347.2 L440.5,347.7 L440.6,348.2 L440.2,348.9 L439.9,350.0 L439.7,351.5 L439.2,352.2 L438.4,352.1 L438.1,352.7 L438.3,353.9 L438.3,354.9 L437.9,355.7 L437.6,356.3 L437.2,356.5 L436.4,356.9 L435.3,357.4 L434.7,358.1 L434.6,358.8 L434.2,359.6 L433.6,360.3 L433.0,360.6 L432.3,360.6 L431.3,361.1 L429.8,361.9 L429.0,362.5 L428.7,362.7 L428.1,363.0 L427.2,363.2 L426.0,363.6 L424.5,364.1 L423.4,364.4 L422.8,364.4 L421.8,364.3 L420.3,363.8 L419.2,364.1 L418.3,365.2 L417.6,365.6 L417.0,365.6 L416.1,365.5 L415.0,365.3 L414.4,365.1 L414.2,364.7 L413.5,364.6 L412.2,364.7 L411.4,364.6 L411.3,364.4 L410.7,364.2 L409.5,364.0 L408.5,363.5 L407.6,362.9 L406.8,362.7 L406.1,362.9 L405.1,362.7 L403.7,362.0 L402.9,361.5 L402.8,361.0 L402.5,360.6 L401.9,360.4 L400.8,360.0 L399.1,359.4 L397.9,358.9 L397.2,358.3 L396.7,357.6 L396.3,356.5 L396.0,355.9 L395.8,355.7 L395.1,355.4 L394.0,355.0 L393.0,354.3 L392.3,353.3 L391.5,352.7 L390.6,352.4 L390.1,352.0 L390.0,351.7 L389.7,350.8 L389.2,349.3 L388.3,348.4 L387.0,348.3 L386.5,348.1 L386.7,347.8 L386.1,347.1 L384.6,346.0 L383.7,345.3 L383.5,344.9 L383.4,344.6 L383.5,344.5 L383.1,344.2 L382.2,343.7 L381.3,343.0 L380.3,342.2 L379.9,341.4 L379.9,340.8 L379.8,340.0 L379.6,339.1 L379.2,338.8 L378.7,339.1 L378.4,338.9 L378.4,338.1 L377.9,337.3 L376.8,336.4 L376.4,336.0 L376.7,336.3 L376.7,336.1 L376.6,335.2 L376.7,334.5 L377.0,333.9 L377.2,333.4 L377.4,333.0 L377.9,332.7 L378.8,332.8 L379.4,332.6 L379.7,332.2 L379.7,332.2 L379.4,332.6 L379.7,332.5 L380.6,332.1 L381.4,332.0 L382.2,332.2 L382.8,332.2 L383.3,332.0 L383.8,331.6 L384.3,330.9 L385.2,330.5 L386.6,330.4 L387.6,330.4 L388.3,330.5 L388.9,330.4 L389.4,330.0 L390.5,330.0 L392.2,330.4 L393.5,330.4 L394.6,329.8 L395.5,329.6 L396.2,329.6 L397.0,329.7 L398.0,330.0 L398.8,329.8 L399.4,329.3 L400.5,329.0 L402.2,328.8 L403.3,329.0 L403.7,329.7 L404.8,329.7 L406.4,329.1 L407.7,328.7 L408.7,328.3 L409.8,328.4 L411.0,328.9 L412.0,328.8 L412.7,328.0 L413.6,327.6 L414.9,327.6 L416.2,327.7 L417.6,327.9 Z" />
                                <path id="reg-kukar" class="reg" data-id="kukar" d="M181.6,163.4 L183.0,163.1 L184.7,163.0 L186.6,163.0 L187.9,162.9 L188.5,162.7 L189.8,162.7 L191.8,163.1 L193.5,163.5 L194.9,163.8 L196.0,163.7 L196.8,163.3 L198.1,163.0 L200.1,162.8 L201.5,162.7 L202.3,162.7 L203.6,163.0 L205.4,163.6 L206.7,163.8 L207.6,163.8 L208.8,163.9 L210.6,163.9 L212.0,163.8 L213.0,163.4 L214.4,163.7 L216.2,164.5 L217.7,164.6 L218.9,164.2 L220.0,164.4 L220.9,165.2 L221.9,165.7 L223.3,165.7 L224.5,165.9 L225.7,166.2 L226.8,166.5 L227.9,166.7 L228.8,166.9 L229.7,167.1 L231.2,167.5 L233.2,168.2 L234.6,168.9 L235.2,169.5 L235.9,169.9 L236.6,170.0 L237.6,170.3 L238.8,170.6 L239.7,171.2 L240.4,172.1 L241.4,172.8 L242.5,173.2 L243.4,173.7 L244.1,174.4 L245.2,175.0 L246.7,175.6 L247.8,175.7 L248.5,175.5 L248.9,175.8 L249.1,176.7 L249.6,177.7 L250.3,178.8 L251.2,179.6 L252.3,180.0 L253.3,180.4 L254.3,180.9 L255.0,181.7 L255.4,183.0 L255.7,184.2 L256.0,185.3 L256.8,186.1 L258.2,186.8 L258.9,187.4 L259.0,188.0 L259.6,188.7 L260.7,189.5 L261.4,190.2 L261.7,190.8 L262.0,191.7 L262.4,192.8 L262.7,193.5 L262.9,194.0 L263.2,194.9 L263.8,196.4 L264.5,197.4 L265.6,198.1 L266.3,198.9 L266.9,199.9 L267.4,200.9 L268.1,201.9 L268.5,203.0 L268.8,204.1 L269.3,204.9 L269.9,205.3 L270.6,206.1 L271.5,207.2 L271.8,208.3 L271.4,209.2 L271.8,210.4 L273.0,211.7 L274.0,213.0 L274.6,214.3 L274.7,215.6 L274.5,216.9 L274.8,217.7 L275.6,218.0 L276.4,218.7 L277.1,219.7 L277.6,221.0 L278.1,222.6 L278.6,223.5 L279.3,223.9 L280.0,224.7 L280.9,225.9 L281.7,227.1 L282.6,228.3 L283.3,229.5 L284.0,230.8 L284.7,231.9 L285.4,232.8 L286.4,233.6 L287.7,234.3 L288.4,235.1 L288.4,235.9 L288.9,236.7 L289.8,237.3 L290.8,238.0 L291.7,238.9 L292.8,240.1 L294.0,241.6 L295.0,242.8 L295.9,243.8 L297.1,244.5 L298.7,245.1 L299.7,246.1 L300.0,247.7 L300.7,248.9 L301.7,249.6 L302.8,250.3 L303.9,251.0 L305.3,251.8 L306.8,252.7 L308.0,253.9 L308.9,255.2 L309.8,256.2 L310.6,257.0 L311.1,257.8 L311.4,258.7 L312.3,259.4 L313.8,259.7 L314.9,260.6 L315.6,262.1 L316.3,262.9 L316.7,263.0 L317.7,263.9 L319.1,265.6 L320.1,266.7 L320.7,267.2 L321.7,267.9 L323.2,268.7 L324.1,269.7 L324.4,270.9 L325.0,271.7 L325.9,272.1 L327.1,272.7 L328.4,273.5 L329.3,274.6 L329.8,275.8 L330.4,276.8 L331.0,277.5 L331.5,278.5 L331.9,279.8 L332.6,280.9 L333.6,281.9 L334.0,283.1 L333.8,284.5 L333.8,286.0 L333.8,287.7 L334.3,289.4 L335.1,291.2 L335.8,292.6 L336.2,293.6 L336.0,294.9 L335.2,296.3 L335.1,297.8 L335.5,299.6 L335.8,301.5 L336.0,303.6 L336.0,305.2 L335.8,306.5 L335.7,308.0 L335.8,309.8 L335.5,311.8 L335.0,314.0 L334.4,316.3 L333.7,318.7 L333.4,320.7 L333.5,322.1 L333.3,324.1 L332.8,326.7 L332.1,328.8 L331.3,330.4 L330.5,332.1 L329.8,333.9 L329.5,335.5 L329.5,336.9 L329.1,338.8 L328.4,341.3 L327.7,343.2 L327.0,344.7 L326.4,346.0 L325.7,347.1 L325.1,348.6 L324.7,350.4 L324.2,352.1 L323.7,353.6 L323.0,355.0 L322.3,356.2 L321.6,357.6 L321.2,359.0 L320.3,360.5 L319.0,362.1 L318.2,363.6 L318.1,364.9 L317.7,366.3 L316.9,367.6 L315.7,368.7 L314.1,369.8 L312.9,370.8 L312.1,371.7 L311.4,373.1 L310.7,374.7 L310.2,376.0 L310.0,376.7 L309.4,377.5 L308.2,378.2 L307.1,379.3 L306.0,380.7 L305.2,381.6 L304.8,382.0 L304.2,382.6 L303.2,383.4 L302.2,384.3 L301.1,385.6 L300.0,386.8 L299.0,387.9 L298.0,388.7 L296.9,389.2 L295.8,389.6 L294.5,389.9 L293.7,390.6 L293.3,391.5 L292.4,392.5 L290.8,393.5 L289.5,394.1 L288.3,394.1 L287.0,394.7 L285.8,395.8 L284.6,396.4 L283.6,396.5 L282.7,397.0 L281.9,397.8 L281.1,398.4 L280.1,398.8 L279.2,399.3 L278.4,399.9 L277.4,400.3 L276.2,400.5 L274.9,400.9 L273.6,401.6 L272.3,402.0 L271.0,402.2 L270.2,402.1 L269.9,401.6 L269.3,401.8 L268.2,402.8 L267.2,402.9 L266.4,402.2 L265.2,402.1 L263.8,402.6 L262.6,402.8 L261.7,402.8 L260.7,403.1 L259.7,403.6 L258.3,403.9 L256.6,403.9 L255.5,403.8 L255.0,403.4 L254.1,403.0 L252.9,402.5 L252.1,402.1 L251.6,402.0 L250.7,401.9 L249.4,401.7 L248.3,401.4 L247.5,401.0 L246.2,401.1 L244.4,401.6 L243.4,401.7 L243.0,401.4 L242.0,401.1 L240.4,400.9 L239.0,400.3 L237.7,399.2 L236.9,398.8 L236.4,399.2 L235.4,399.1 L234.1,398.5 L233.2,397.6 L233.0,396.5 L232.2,396.1 L231.0,396.3 L229.9,395.9 L229.1,394.8 L227.9,394.0 L226.3,393.5 L224.9,392.9 L223.8,392.4 L222.8,392.2 L221.9,392.1 L221.0,391.8 L220.0,391.2 L219.2,390.6 L218.7,390.0 L217.6,389.2 L215.9,388.3 L214.9,387.7 L214.5,387.5 L213.5,386.7 L211.7,385.2 L210.4,384.2 L209.5,383.8 L208.8,383.5 L208.5,383.2 L207.7,382.4 L206.4,381.0 L205.2,380.2 L204.0,380.1 L202.9,379.7 L201.8,378.9 L200.9,377.9 L200.1,376.5 L199.0,375.4 L197.6,374.5 L196.5,373.8 L195.7,373.3 L195.0,372.6 L194.5,371.5 L193.8,370.6 L192.9,369.9 L191.8,368.8 L190.4,367.4 L189.2,366.2 L188.2,365.2 L187.2,364.4 L186.3,363.5 L185.6,362.4 L185.4,361.0 L184.7,360.0 L183.8,359.4 L182.6,358.6 L181.4,357.4 L180.3,356.3 L179.4,355.3 L178.2,353.9 L176.9,352.2 L176.1,350.7 L175.9,349.5 L175.4,348.4 L174.7,347.5 L173.9,346.0 L172.9,343.9 L171.9,342.1 L170.9,340.6 L170.2,339.0 L169.6,337.5 L169.1,335.8 L168.7,334.2 L168.0,333.0 L167.0,332.3 L166.2,331.0 L165.7,329.0 L165.2,327.0 L164.7,325.0 L163.9,323.0 L162.7,320.9 L162.1,319.4 L161.9,318.5 L161.4,317.1 L160.6,315.0 L159.7,312.9 L158.7,310.6 L158.4,308.8 L158.7,307.5 L158.2,306.0 L156.9,304.3 L156.4,302.3 L156.7,300.0 L156.5,297.9 L155.9,296.0 L155.4,294.0 L155.1,291.9 L154.8,290.3 L154.4,289.0 L153.9,287.6 L153.3,286.0 L152.9,284.2 L152.6,282.0 L152.4,280.1 L152.3,278.5 L152.1,276.5 L152.0,274.2 L151.6,272.6 L151.1,271.5 L150.7,269.8 L150.4,267.3 L150.4,265.1 L150.7,263.3 L150.8,261.6 L150.8,259.8 L150.5,257.9 L150.0,255.8 L149.5,253.8 L149.0,252.0 L148.8,250.6 L149.0,249.5 L149.1,247.9 L149.0,245.7 L148.8,243.5 L148.7,241.3 L148.9,239.4 L149.3,237.8 L149.7,235.9 L150.0,233.9 L150.3,231.7 L150.7,229.3 L150.6,227.3 L149.9,225.6 L149.7,223.7 L149.9,221.7 L150.3,219.8 L151.0,218.1 L151.2,216.3 L151.0,214.6 L151.2,212.3 L152.0,209.6 L152.5,207.4 L152.7,206.0 L153.2,204.1 L154.0,201.9 L154.5,199.5 L154.6,196.8 L154.6,194.8 L154.4,193.5 L155.0,191.7 L156.2,189.3 L157.2,187.3 L158.0,185.8 L158.6,184.6 L158.9,183.6 L159.1,182.2 L159.1,180.3 L159.8,178.5 L161.1,176.6 L162.2,175.1 L163.2,174.0 L164.3,173.1 L165.3,172.4 L166.1,171.5 L166.6,170.3 L167.2,169.2 L168.0,168.2 L168.9,167.7 L169.7,167.8 L171.0,167.3 L172.6,166.2 L174.0,165.3 L175.3,164.5 L176.7,164.1 L178.3,164.0 L179.5,163.9 L180.4,163.7 Z" />
                                <path id="reg-samarinda" class="reg" data-id="samarinda" d="M316.9,383.2 L317.4,383.0 L318.3,383.0 L319.7,383.1 L320.6,382.9 L320.9,382.5 L321.7,382.2 L323.0,382.0 L323.8,381.9 L324.3,381.7 L325.2,381.8 L326.7,382.2 L327.8,382.0 L328.5,381.3 L329.0,381.0 L329.1,381.0 L329.8,381.5 L331.2,382.5 L332.0,383.1 L332.1,383.4 L332.4,383.4 L332.9,383.1 L333.7,383.0 L334.8,383.2 L335.5,383.7 L335.5,384.6 L336.0,385.4 L336.8,386.3 L337.5,386.6 L338.0,386.5 L338.5,386.9 L339.0,387.8 L339.5,388.4 L340.0,388.6 L340.8,389.1 L341.7,389.9 L342.3,390.7 L342.5,391.6 L342.4,392.5 L342.2,393.6 L342.1,394.4 L342.2,394.9 L342.6,395.3 L343.1,395.5 L343.4,396.2 L343.6,397.4 L343.9,398.3 L344.3,398.8 L344.4,399.2 L344.2,399.6 L343.9,400.1 L343.4,400.8 L343.1,401.4 L342.9,402.1 L342.7,402.7 L342.5,403.2 L342.1,403.9 L341.6,404.7 L340.9,405.7 L340.2,406.7 L339.7,407.4 L339.5,407.8 L339.3,408.5 L339.2,409.6 L338.9,410.2 L338.3,410.4 L337.3,410.8 L336.0,411.3 L335.0,411.8 L334.3,412.4 L333.7,412.8 L333.2,413.0 L332.8,413.4 L332.7,414.1 L332.3,414.7 L331.6,415.2 L330.8,415.7 L329.8,416.3 L328.8,416.8 L327.6,417.1 L326.8,417.1 L326.2,416.8 L325.6,416.8 L325.0,417.0 L324.0,417.6 L322.6,418.6 L321.3,418.9 L320.1,418.4 L319.3,418.3 L318.9,418.6 L318.4,418.8 L317.8,418.8 L316.9,418.7 L315.8,418.3 L314.6,418.5 L313.5,419.3 L312.2,419.4 L310.8,418.7 L309.9,418.4 L309.6,418.3 L308.6,418.5 L307.0,418.9 L306.0,418.9 L305.7,418.3 L304.8,418.0 L303.4,418.0 L302.1,417.6 L301.0,416.9 L300.2,416.5 L299.7,416.5 L299.2,416.6 L298.6,416.9 L298.1,416.5 L297.8,415.4 L297.0,415.0 L295.7,415.5 L294.5,415.4 L293.6,414.8 L292.9,414.3 L292.5,413.9 L292.2,413.2 L291.9,412.3 L291.6,411.9 L291.1,412.0 L290.5,411.6 L289.7,410.6 L289.0,409.8 L288.5,409.1 L288.3,408.7 L288.4,408.5 L288.3,408.3 L288.0,408.0 L287.4,407.3 L286.4,406.3 L286.2,405.5 L286.5,404.7 L286.7,404.1 L286.6,403.6 L286.3,403.3 L285.8,403.1 L285.7,402.9 L286.1,402.7 L286.3,402.3 L286.5,401.7 L286.4,400.9 L286.1,400.0 L285.9,399.7 L285.9,400.1 L286.0,399.8 L286.3,399.0 L286.5,398.3 L286.7,397.8 L286.9,397.4 L287.4,397.4 L287.8,397.1 L288.2,396.5 L289.1,396.2 L290.4,395.9 L291.3,395.6 L291.9,395.3 L292.4,394.6 L292.8,393.7 L293.3,393.3 L294.0,393.5 L294.5,393.5 L294.8,393.2 L295.4,392.6 L296.0,391.7 L296.9,391.1 L297.9,390.8 L298.8,390.2 L299.5,389.4 L300.1,388.9 L300.6,388.6 L301.2,388.6 L301.7,388.9 L302.4,388.9 L303.1,388.6 L304.3,388.4 L305.8,388.1 L306.8,387.6 L307.3,386.9 L307.9,386.2 L308.7,385.7 L309.3,385.4 L309.8,385.3 L310.8,385.2 L312.5,385.2 L313.4,385.1 L313.6,384.9 L314.4,384.4 L316.0,383.7 Z" />
                                <path id="reg-kubar" class="reg" data-id="kubar" d="M113.5,188.4 L115.0,187.8 L116.5,187.7 L117.9,188.1 L119.5,188.1 L121.4,187.9 L122.6,187.3 L123.3,186.2 L124.6,185.8 L126.7,186.1 L128.0,186.2 L128.4,186.1 L129.3,185.6 L130.5,184.6 L131.7,184.0 L132.8,183.7 L134.1,183.7 L135.7,183.8 L137.1,183.5 L138.3,183.0 L139.1,182.3 L139.5,181.5 L140.1,181.1 L140.9,180.9 L142.1,180.3 L143.7,179.1 L144.5,178.2 L144.7,177.6 L145.1,177.4 L145.7,177.4 L146.5,177.1 L147.5,176.4 L148.3,175.8 L149.0,175.4 L149.9,174.5 L151.1,173.2 L151.9,172.6 L152.2,172.7 L152.4,172.7 L152.6,172.7 L153.0,172.9 L153.6,173.1 L154.1,173.2 L154.6,173.1 L154.9,173.3 L155.1,173.6 L155.4,174.3 L155.9,175.4 L155.9,176.2 L155.5,176.7 L155.6,177.5 L156.2,178.5 L156.5,179.3 L156.6,179.9 L156.4,180.7 L156.1,181.8 L155.8,183.5 L155.5,185.7 L155.2,187.1 L154.8,187.8 L154.7,189.2 L154.8,191.2 L154.7,193.3 L154.6,195.3 L154.1,197.5 L153.3,199.8 L153.0,201.9 L153.2,203.7 L152.8,205.5 L152.0,207.3 L151.4,209.6 L151.3,212.3 L151.2,214.4 L151.2,216.2 L151.0,218.0 L150.7,219.8 L150.6,221.6 L150.7,223.3 L150.8,225.5 L150.7,228.3 L150.4,230.4 L149.9,231.6 L149.7,233.3 L150.0,235.5 L150.2,237.6 L150.4,239.5 L150.0,241.2 L149.0,242.7 L148.7,244.8 L149.1,247.6 L149.5,249.8 L150.1,251.6 L150.2,253.3 L149.9,255.1 L149.9,256.8 L150.1,258.5 L150.1,260.3 L150.1,262.2 L150.2,264.2 L150.4,266.3 L150.5,267.7 L150.4,268.5 L150.3,270.0 L150.0,272.1 L149.7,273.9 L149.4,275.1 L149.6,276.7 L150.4,278.5 L150.4,280.5 L149.7,282.6 L149.3,284.4 L149.3,286.1 L149.0,287.4 L148.4,288.3 L148.1,289.3 L148.3,290.5 L148.1,292.0 L147.6,294.0 L147.2,295.5 L146.9,296.5 L146.3,298.0 L145.6,299.9 L145.2,301.3 L145.2,302.1 L144.7,303.3 L144.0,304.8 L143.1,306.4 L142.3,308.0 L141.5,309.0 L141.0,309.4 L140.2,310.5 L139.0,312.1 L138.2,313.4 L137.5,314.3 L137.0,315.0 L136.5,315.6 L136.1,316.3 L135.7,317.0 L134.6,317.8 L133.1,318.5 L132.2,319.5 L132.2,320.7 L131.4,321.6 L130.0,322.4 L129.2,322.9 L129.1,323.4 L128.4,323.8 L127.0,324.3 L125.9,324.8 L125.1,325.4 L124.1,326.1 L122.9,326.8 L122.0,327.1 L121.7,327.0 L121.0,327.1 L120.2,327.3 L119.2,327.3 L118.2,327.3 L117.0,327.3 L115.7,327.5 L114.7,327.5 L114.0,327.4 L113.1,327.3 L112.1,327.2 L111.3,327.1 L110.9,326.9 L110.3,327.2 L109.6,327.9 L108.7,328.1 L107.6,327.8 L106.7,327.4 L106.0,326.9 L104.8,326.6 L103.0,326.5 L102.1,325.9 L102.0,324.6 L101.3,323.9 L99.8,323.7 L98.5,323.6 L97.3,323.6 L96.7,323.4 L96.5,322.8 L95.6,321.7 L93.9,320.2 L92.8,319.4 L92.3,319.4 L91.8,318.9 L91.5,318.0 L90.6,317.2 L89.2,316.6 L88.1,315.5 L87.4,313.9 L86.7,312.9 L85.9,312.5 L84.9,311.7 L83.5,310.5 L82.8,309.3 L82.7,308.2 L82.2,307.4 L81.3,306.9 L80.3,305.7 L79.1,303.8 L78.2,302.2 L77.4,301.1 L77.1,300.4 L77.2,300.1 L76.8,298.9 L76.0,296.8 L75.2,295.5 L74.4,295.0 L74.0,293.8 L74.0,291.9 L73.6,290.5 L72.8,289.7 L72.3,288.3 L72.0,286.4 L71.5,285.1 L70.8,284.4 L70.5,283.3 L70.3,282.0 L70.4,280.1 L70.5,277.8 L70.3,276.1 L70.0,275.2 L69.7,274.0 L69.4,272.6 L69.5,271.0 L70.1,269.1 L70.2,267.6 L69.8,266.4 L69.7,265.2 L69.7,264.0 L69.5,262.4 L68.8,260.4 L68.8,258.9 L69.4,257.9 L69.6,256.3 L69.3,254.1 L69.3,252.4 L69.4,251.1 L69.6,250.0 L69.7,249.0 L69.9,247.9 L70.1,246.8 L70.3,245.4 L70.3,243.6 L70.2,242.1 L69.9,241.1 L70.0,239.9 L70.7,238.3 L70.7,237.0 L70.1,235.9 L70.3,234.7 L71.3,233.4 L71.9,232.3 L72.1,231.5 L71.9,230.6 L71.4,229.6 L71.4,228.4 L71.9,226.9 L72.2,225.6 L72.4,224.6 L72.9,223.6 L73.8,222.7 L74.0,221.8 L73.6,221.1 L73.7,220.4 L74.1,219.7 L74.4,218.9 L74.6,217.9 L75.1,216.9 L75.9,215.8 L76.3,214.9 L76.1,214.1 L76.2,213.2 L76.3,212.0 L76.8,211.1 L77.5,210.4 L78.4,209.7 L79.4,209.1 L79.7,208.2 L79.4,207.1 L79.5,206.2 L80.0,205.2 L80.6,204.6 L81.2,204.3 L81.8,203.6 L82.5,202.5 L83.3,202.0 L84.3,202.0 L85.1,201.4 L85.8,200.1 L86.3,199.3 L86.7,198.9 L87.3,198.3 L88.1,197.6 L88.9,197.2 L89.7,197.4 L90.4,197.0 L90.9,196.2 L91.3,195.4 L91.8,194.6 L92.6,194.0 L93.5,193.7 L94.4,193.5 L95.3,193.5 L96.4,193.0 L97.9,192.1 L99.3,191.8 L100.7,192.2 L102.1,191.8 L103.4,190.7 L104.5,190.2 L105.3,190.4 L106.4,190.6 L107.7,190.6 L109.2,190.5 L110.6,190.0 L111.7,189.5 L112.4,189.0 Z" />
                                <path id="reg-ppu" class="reg" data-id="ppu" d="M217.6,389.6 L218.5,390.3 L219.4,390.8 L220.4,390.9 L221.8,391.4 L223.7,392.0 L224.8,392.7 L225.1,393.5 L225.7,393.9 L226.6,394.0 L227.6,394.7 L228.8,396.0 L230.0,396.9 L231.3,397.2 L232.4,397.3 L233.3,397.1 L234.1,397.3 L234.9,397.9 L235.8,398.7 L236.9,399.5 L238.1,399.8 L239.4,399.7 L240.8,399.9 L242.3,400.5 L243.5,400.8 L244.7,400.7 L245.7,401.0 L246.5,401.8 L247.1,402.0 L247.7,401.6 L248.6,401.7 L249.7,402.4 L251.1,402.6 L252.6,402.2 L253.5,402.3 L253.5,402.8 L254.4,403.0 L256.2,402.9 L257.5,403.0 L258.4,403.4 L259.2,403.3 L260.0,402.8 L260.9,402.6 L261.9,402.8 L262.6,403.0 L262.9,403.4 L263.4,403.6 L264.1,403.8 L265.0,404.1 L266.0,404.4 L267.0,404.5 L267.8,404.4 L268.6,404.1 L269.3,403.5 L270.1,403.4 L270.9,403.7 L271.4,403.6 L271.7,402.9 L272.2,402.9 L272.9,403.5 L273.6,403.4 L274.3,402.6 L274.3,402.6 L273.9,403.3 L274.3,403.3 L275.7,402.6 L276.5,402.3 L276.6,402.2 L276.8,402.1 L277.0,402.0 L277.3,401.8 L277.9,401.4 L278.6,401.1 L279.3,401.1 L279.8,401.5 L280.0,402.5 L280.1,403.0 L280.2,403.1 L280.8,403.2 L281.9,403.3 L282.2,403.2 L281.8,402.7 L282.0,402.6 L282.7,402.9 L283.4,403.5 L284.1,404.5 L284.4,405.1 L284.2,405.2 L284.6,405.5 L285.4,405.8 L285.8,406.2 L285.6,406.7 L286.0,407.2 L287.2,407.8 L288.0,408.3 L288.6,408.9 L288.8,409.1 L288.8,408.9 L288.8,409.3 L288.9,410.2 L289.5,411.2 L290.6,412.4 L290.8,413.2 L290.1,413.6 L290.1,413.9 L290.5,414.0 L290.9,414.3 L291.1,414.8 L291.3,415.7 L291.5,417.0 L291.4,417.8 L290.9,418.2 L290.9,418.7 L291.4,419.3 L291.3,420.2 L290.6,421.6 L290.2,422.7 L290.2,423.5 L290.3,424.6 L290.7,425.8 L290.4,426.5 L289.5,426.6 L289.2,427.4 L289.6,428.9 L289.1,430.1 L287.8,431.0 L287.0,432.1 L286.8,433.3 L286.6,434.4 L286.5,435.3 L285.9,436.3 L284.8,437.3 L283.9,438.1 L283.1,438.7 L282.5,439.6 L281.9,440.7 L281.3,441.5 L280.8,441.8 L280.5,442.4 L280.3,443.2 L279.8,444.0 L279.1,444.7 L278.2,445.6 L277.2,446.6 L276.6,447.6 L276.3,448.5 L275.7,449.1 L274.9,449.4 L274.1,450.0 L273.4,450.8 L272.4,451.7 L271.1,452.6 L270.2,453.6 L269.6,454.9 L268.7,455.5 L267.4,455.6 L266.3,456.2 L265.4,457.2 L264.9,458.0 L264.8,458.7 L263.9,459.1 L262.4,459.3 L261.2,459.7 L260.2,460.5 L259.3,461.3 L258.6,462.2 L257.7,462.7 L256.5,462.8 L255.4,463.1 L254.4,463.7 L253.6,464.2 L253.1,464.7 L252.2,464.9 L250.9,464.8 L249.8,465.1 L248.8,465.8 L248.1,466.2 L247.5,466.3 L247.0,466.7 L246.3,467.5 L245.3,468.1 L243.7,468.7 L242.9,469.0 L242.7,469.1 L242.0,469.3 L240.6,469.7 L239.4,470.1 L238.4,470.4 L237.6,470.8 L237.0,471.2 L236.4,471.5 L235.9,471.7 L234.7,471.8 L233.0,471.8 L232.1,471.8 L231.9,471.8 L231.3,472.0 L230.2,472.2 L229.3,472.6 L228.6,473.0 L227.9,473.2 L227.1,473.0 L226.3,472.8 L225.5,472.7 L224.4,472.7 L223.1,472.7 L222.0,472.7 L221.3,472.6 L220.6,472.1 L220.1,471.4 L219.3,471.0 L218.3,471.0 L217.5,471.1 L216.8,471.2 L215.8,470.8 L214.4,469.8 L213.2,469.4 L212.3,469.6 L211.7,469.0 L211.4,467.7 L210.4,467.0 L208.8,466.9 L207.8,466.4 L207.3,465.3 L206.4,464.7 L205.0,464.5 L203.9,464.0 L203.1,463.3 L202.7,462.8 L202.7,462.5 L202.3,462.1 L201.3,461.6 L200.1,460.8 L198.8,459.7 L198.0,458.9 L197.8,458.5 L197.4,457.8 L196.8,457.0 L195.8,456.4 L194.5,455.8 L193.9,455.3 L194.1,455.0 L193.5,454.1 L192.2,452.8 L191.5,452.0 L191.5,451.5 L191.2,451.0 L190.6,450.2 L190.2,449.7 L189.9,449.4 L189.2,448.7 L188.1,447.7 L187.5,446.9 L187.6,446.3 L187.3,445.7 L186.8,445.1 L186.5,444.5 L186.6,443.9 L186.0,443.0 L184.8,441.6 L184.5,440.8 L185.1,440.6 L185.0,440.0 L184.2,439.1 L183.6,437.9 L183.4,436.5 L183.6,435.3 L184.4,434.2 L184.3,433.2 L183.6,432.3 L183.6,431.3 L184.5,430.0 L184.6,428.8 L183.9,427.6 L183.8,426.4 L184.4,425.0 L184.7,423.8 L184.5,422.8 L184.8,421.6 L185.5,420.3 L185.9,418.8 L186.1,417.1 L186.8,415.8 L188.2,414.9 L188.9,413.4 L189.0,411.4 L189.3,409.8 L190.0,408.7 L190.7,407.3 L191.6,405.9 L192.1,404.4 L192.3,402.8 L192.9,401.1 L193.7,399.3 L194.7,398.1 L195.8,397.4 L196.9,396.1 L197.8,394.2 L198.4,393.1 L198.6,392.9 L199.4,392.4 L200.7,391.4 L201.8,390.7 L202.7,390.3 L203.5,389.6 L204.2,388.6 L204.8,388.1 L205.2,388.1 L206.1,387.8 L207.4,387.1 L208.2,386.9 L208.6,387.2 L209.4,387.4 L210.6,387.5 L211.8,387.7 L213.2,388.0 L214.5,388.0 L215.6,387.6 L216.4,387.9 L216.9,388.8 Z" />
                                <path id="reg-balikpapan" class="reg" data-id="balikpapan" d="M294.7,445.9 L296.2,445.8 L297.3,445.4 L298.0,445.0 L298.8,444.6 L299.8,444.3 L300.8,444.5 L301.7,445.2 L302.4,445.4 L302.8,445.2 L303.6,445.0 L304.8,444.6 L305.8,444.7 L306.6,445.1 L307.3,445.4 L307.9,445.6 L309.0,445.6 L310.6,445.3 L311.5,445.5 L311.5,446.4 L312.0,446.9 L313.2,447.1 L313.8,447.5 L313.9,447.8 L314.5,448.0 L315.5,448.1 L316.5,448.5 L317.5,449.4 L317.9,449.9 L317.9,449.9 L318.4,450.2 L319.5,450.7 L319.9,451.6 L319.6,452.9 L319.8,453.6 L320.2,453.8 L321.0,454.5 L322.0,455.5 L322.7,456.2 L323.1,456.6 L323.1,457.2 L322.7,458.0 L322.8,458.7 L323.3,459.2 L323.7,459.9 L324.0,460.9 L324.3,461.6 L324.7,462.1 L324.7,462.6 L324.4,463.1 L324.2,463.5 L324.1,463.9 L324.0,464.7 L323.9,465.9 L323.9,466.9 L323.9,467.8 L323.7,468.5 L323.4,469.0 L322.8,469.5 L321.8,469.9 L321.1,470.6 L320.9,471.8 L320.8,473.0 L321.0,474.2 L320.6,475.1 L319.6,475.9 L319.0,476.4 L318.7,476.7 L318.2,477.3 L317.7,478.1 L316.9,479.0 L316.0,479.8 L315.5,480.5 L315.4,481.1 L314.9,481.8 L313.9,482.6 L313.0,482.9 L312.2,482.8 L311.5,482.9 L310.7,483.2 L310.3,483.4 L310.2,483.7 L309.6,484.3 L308.4,485.0 L307.4,485.3 L306.6,485.3 L305.8,485.4 L304.9,485.8 L304.1,485.7 L303.4,485.4 L302.5,485.2 L301.2,485.2 L300.2,485.0 L299.3,484.8 L298.6,484.7 L298.2,484.8 L297.3,484.8 L296.0,484.7 L294.9,484.3 L294.0,483.7 L292.9,483.8 L291.8,484.5 L290.9,484.3 L290.2,483.3 L289.2,482.7 L287.9,482.5 L286.8,482.5 L286.0,482.8 L285.1,482.7 L283.9,482.0 L283.2,481.6 L283.1,481.4 L282.4,480.9 L281.2,480.2 L280.4,479.8 L280.1,479.9 L279.2,479.5 L278.0,478.6 L277.1,478.2 L276.8,478.4 L276.4,478.2 L275.9,477.8 L275.2,477.3 L274.4,476.8 L273.5,476.3 L272.7,475.7 L271.8,475.1 L271.1,474.5 L270.7,474.0 L270.7,473.6 L270.6,473.2 L270.4,472.9 L269.8,472.3 L268.7,471.4 L268.3,470.7 L268.6,470.2 L268.3,469.6 L267.5,468.7 L267.2,468.0 L267.5,467.5 L267.2,467.3 L266.0,467.4 L265.8,467.0 L266.3,465.9 L266.7,465.4 L266.9,465.4 L266.8,465.2 L266.5,464.9 L266.3,464.1 L266.2,462.8 L266.5,462.0 L267.2,461.4 L267.3,460.9 L266.7,460.3 L266.8,459.8 L267.6,459.2 L268.3,458.7 L268.9,458.2 L269.0,458.2 L268.7,458.6 L268.9,458.3 L269.5,457.1 L270.0,456.5 L270.4,456.5 L271.2,456.3 L272.3,456.0 L272.9,455.5 L273.1,454.8 L273.8,454.1 L275.1,453.5 L275.9,453.0 L276.1,452.7 L276.5,452.5 L276.9,452.3 L277.6,451.8 L278.7,450.9 L279.9,450.6 L281.3,450.7 L282.4,450.7 L283.1,450.7 L283.6,450.3 L283.8,449.6 L284.5,449.1 L285.6,449.0 L286.7,448.9 L287.5,448.9 L288.6,448.6 L289.7,448.1 L290.6,447.5 L291.1,446.9 L292.0,446.4 L293.3,446.1 Z" />
                                <path id="reg-paser" class="reg" data-id="paser" d="M114.2,327.5 L116.0,327.7 L117.3,327.7 L118.1,327.5 L118.6,327.5 L118.8,327.8 L119.5,328.2 L120.6,328.8 L121.7,329.0 L122.8,328.9 L123.9,328.8 L125.0,328.5 L125.6,328.6 L125.7,328.9 L126.2,329.3 L127.3,329.7 L128.2,330.0 L129.0,329.9 L130.0,330.4 L131.3,331.3 L132.3,331.6 L133.0,331.4 L133.6,331.7 L134.1,332.5 L134.7,333.1 L135.4,333.5 L135.9,334.3 L136.3,335.3 L137.0,336.0 L137.9,336.2 L138.8,336.6 L139.6,337.2 L140.6,337.7 L141.9,338.1 L142.9,338.5 L143.5,338.8 L143.8,339.7 L143.8,341.2 L144.3,342.1 L145.4,342.3 L146.1,342.5 L146.6,342.7 L147.0,343.6 L147.3,345.1 L147.9,346.0 L148.7,346.4 L149.4,346.9 L150.2,347.4 L151.2,347.7 L152.4,347.7 L153.2,348.4 L153.5,349.9 L154.0,350.8 L154.6,351.2 L155.2,351.5 L155.9,351.7 L156.7,352.3 L157.5,353.4 L158.4,353.9 L159.3,353.9 L160.0,354.6 L160.5,356.0 L161.0,356.8 L161.3,356.9 L161.8,357.2 L162.6,357.9 L163.2,358.5 L163.6,359.3 L164.1,360.0 L164.6,360.7 L165.4,361.4 L166.5,362.0 L167.0,362.8 L167.1,363.8 L167.6,364.5 L168.4,364.9 L168.8,365.6 L168.7,366.4 L169.1,367.4 L169.9,368.6 L170.5,369.3 L171.0,369.6 L171.3,370.0 L171.5,370.5 L171.9,371.2 L172.4,372.1 L173.0,373.0 L173.7,373.9 L173.9,375.1 L173.6,376.6 L173.7,377.6 L174.1,378.2 L174.6,379.0 L175.4,380.1 L175.9,380.9 L176.1,381.4 L176.2,382.4 L176.2,383.8 L176.2,384.7 L176.2,385.2 L176.6,386.0 L177.4,387.3 L177.7,388.2 L177.6,388.8 L177.4,389.8 L177.2,391.2 L177.1,392.1 L177.3,392.6 L177.8,393.6 L178.7,395.2 L179.1,396.5 L178.9,397.6 L178.9,398.6 L179.1,399.5 L179.1,400.1 L178.8,400.4 L179.1,401.3 L179.9,402.7 L180.1,403.7 L179.5,404.4 L179.4,405.6 L179.6,407.5 L179.6,408.6 L179.4,408.9 L179.3,409.8 L179.4,411.3 L179.6,412.6 L179.8,413.7 L180.1,414.5 L180.6,414.9 L180.8,416.1 L180.7,418.0 L180.6,419.2 L180.5,419.8 L180.5,420.8 L180.5,422.4 L180.4,423.6 L180.2,424.4 L180.2,425.0 L180.2,425.2 L180.7,426.1 L181.5,427.8 L181.8,429.0 L181.6,430.0 L181.8,430.8 L182.3,431.6 L182.6,432.3 L182.7,433.1 L182.8,433.7 L182.9,434.0 L183.1,434.8 L183.4,436.2 L183.7,437.2 L183.9,437.8 L183.9,438.4 L183.7,439.1 L184.1,439.8 L185.2,440.4 L185.8,441.3 L185.9,442.4 L186.1,443.2 L186.4,443.6 L186.5,444.4 L186.6,445.4 L186.7,446.5 L187.0,447.5 L187.3,448.0 L187.7,448.0 L188.1,448.8 L188.6,450.3 L188.9,451.2 L188.8,451.4 L188.6,452.2 L188.3,453.5 L188.2,454.3 L188.5,454.4 L188.7,454.9 L188.9,455.9 L188.7,456.9 L188.3,457.9 L188.4,458.9 L188.8,460.0 L188.6,460.7 L188.0,461.1 L187.5,462.0 L187.4,463.4 L187.1,464.4 L186.7,464.9 L186.5,465.5 L186.5,466.2 L186.4,467.2 L186.2,468.2 L185.7,469.1 L184.7,469.8 L183.9,470.6 L183.2,471.5 L183.0,472.7 L183.4,474.2 L183.1,475.4 L182.0,476.1 L181.1,476.8 L180.2,477.4 L179.8,478.1 L179.9,478.8 L179.5,479.4 L178.4,479.8 L177.8,480.7 L177.6,482.1 L176.8,482.8 L175.2,482.8 L174.4,483.5 L174.4,484.9 L174.1,485.8 L173.3,486.3 L172.2,486.8 L170.7,487.4 L169.5,487.7 L168.6,487.6 L168.2,488.1 L168.2,489.1 L167.6,489.7 L166.4,489.8 L165.5,489.9 L165.0,490.1 L163.8,490.9 L162.1,492.2 L161.0,492.9 L160.4,493.2 L159.8,493.6 L159.2,494.0 L158.0,494.4 L156.2,494.6 L155.0,494.4 L154.2,493.8 L153.6,493.6 L152.9,493.9 L151.8,494.3 L150.1,494.7 L149.0,495.3 L148.5,496.0 L147.6,496.1 L146.2,495.5 L145.1,495.2 L144.1,495.1 L143.0,495.5 L141.7,496.4 L140.4,496.6 L139.3,496.3 L138.3,496.1 L137.5,496.0 L136.4,496.1 L135.2,496.3 L134.1,496.4 L133.2,496.2 L132.4,496.1 L131.5,496.1 L130.1,495.6 L128.2,494.5 L126.8,494.0 L125.9,493.9 L124.7,493.7 L123.1,493.4 L122.1,493.2 L121.8,493.2 L120.9,492.9 L119.3,492.5 L118.2,491.8 L117.3,490.9 L116.4,490.5 L115.2,490.7 L113.9,490.2 L112.4,489.1 L111.3,488.7 L110.8,488.9 L109.9,488.5 L108.8,487.6 L107.7,486.8 L106.7,486.3 L105.5,485.3 L104.2,484.0 L103.2,483.0 L102.6,482.4 L101.7,481.5 L100.7,480.6 L99.9,479.9 L99.1,479.6 L98.4,478.9 L97.8,477.7 L96.9,476.8 L95.6,476.0 L94.7,475.0 L94.2,473.6 L93.2,472.2 L91.6,470.9 L90.8,469.9 L90.7,469.0 L90.2,467.9 L89.2,466.7 L88.2,465.6 L87.3,464.8 L86.4,463.7 L85.6,462.3 L85.1,461.4 L85.1,460.9 L84.7,460.1 L84.1,459.0 L83.4,457.5 L82.7,455.6 L82.1,454.2 L81.8,453.2 L81.1,452.2 L80.2,451.0 L79.7,450.0 L79.7,449.3 L79.3,448.4 L78.4,447.3 L77.8,446.2 L77.5,445.2 L77.2,443.8 L77.0,442.1 L76.4,440.8 L75.4,440.0 L75.0,438.6 L75.0,436.6 L75.0,435.1 L75.0,434.0 L74.8,432.9 L74.6,432.0 L73.9,430.6 L72.7,428.9 L72.3,427.8 L72.6,427.4 L72.6,426.2 L72.3,424.5 L72.2,422.9 L72.2,421.5 L71.9,420.0 L71.4,418.6 L71.0,417.6 L70.5,417.0 L70.0,415.9 L69.6,414.3 L69.6,412.8 L70.1,411.4 L70.3,410.2 L70.1,409.3 L69.7,408.3 L69.0,407.1 L68.8,406.1 L69.0,405.1 L69.1,403.9 L69.2,402.5 L69.1,400.9 L68.8,399.0 L68.9,397.6 L69.5,396.7 L69.3,395.7 L68.5,394.6 L68.2,393.4 L68.3,391.8 L68.5,390.3 L68.8,388.7 L68.6,387.5 L68.2,386.8 L68.1,385.8 L68.5,384.6 L68.5,383.3 L68.3,381.9 L68.5,380.8 L69.2,380.0 L69.4,378.9 L68.9,377.4 L68.9,376.2 L69.2,375.2 L69.4,373.9 L69.6,372.2 L69.4,370.9 L68.9,369.9 L68.8,368.3 L69.4,366.3 L69.5,365.0 L69.2,364.4 L69.2,363.5 L69.4,362.1 L69.6,360.7 L69.7,359.3 L69.8,357.9 L70.0,356.7 L70.1,355.5 L70.1,354.3 L70.7,353.5 L71.6,352.9 L71.8,352.1 L71.3,351.2 L71.5,349.9 L72.3,348.3 L73.1,347.0 L74.1,346.1 L74.7,345.5 L75.0,345.1 L75.4,344.6 L75.8,343.8 L76.2,342.8 L76.7,341.7 L76.9,340.6 L76.9,339.4 L77.5,338.7 L78.7,338.6 L79.8,338.3 L80.8,338.0 L81.3,337.6 L81.4,337.2 L81.8,336.3 L82.5,335.0 L83.2,334.5 L83.9,334.8 L85.0,334.9 L86.4,334.7 L87.7,334.3 L88.8,333.6 L89.5,333.3 L89.5,333.2 L90.3,332.9 L91.6,332.2 L92.8,331.6 L93.9,331.1 L94.7,330.8 L95.3,330.6 L96.0,330.3 L97.0,330.1 L97.9,330.0 L98.9,330.1 L99.6,329.9 L100.1,329.4 L101.0,329.1 L102.3,328.9 L103.3,328.5 L104.0,328.0 L104.9,328.1 L106.0,328.8 L106.8,328.8 L107.4,328.1 L108.1,328.0 L109.0,328.4 L109.9,328.6 L110.9,328.6 L111.8,328.3 L112.8,327.7 Z" />
                                {{-- Markers injected by JS --}}
                            </svg>
                        </div>
                        {{-- Legend --}}
                        <div style="position:absolute;bottom:10px;left:10px;display:flex;gap:6px;">
                            <span style="background:rgba(255,255,255,0.92);border-radius:20px;padding:3px 10px;font-size:10px;font-weight:600;color:#1a2e25;border:1px solid #e8f0ec;display:flex;align-items:center;gap:4px;backdrop-filter:blur(4px);">
                                <span style="width:8px;height:8px;border-radius:50%;background:#16a34a;display:inline-block;"></span> Kabupaten
                            </span>
                            <span style="background:rgba(255,255,255,0.92);border-radius:20px;padding:3px 10px;font-size:10px;font-weight:600;color:#1a2e25;border:1px solid #e8f0ec;display:flex;align-items:center;gap:4px;backdrop-filter:blur(4px);">
                                <span style="width:8px;height:8px;border-radius:50%;background:#dc2626;display:inline-block;"></span> Kota
                            </span>
                        </div>
                    </div>

                    {{-- Detail Panel --}}
                    <div id="uptd-panel-wrap" style="display:flex;flex-direction:column;justify-content:center;min-height:320px;">
                        <div id="uptd-empty-state" style="text-align:center;padding:24px 16px;">
                            <div style="width:56px;height:56px;border-radius:50%;background:#f0f7f3;border:2px solid #d1fae5;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <p style="font-size:11px;font-weight:600;color:#6b7280;margin:0 0 4px;">Peta Wilayah UPTD</p>
                            <p style="font-size:10px;color:#9ca3af;margin:0;line-height:1.5;">Klik ikon pada peta<br>untuk melihat detail UPTD</p>
                        </div>
                        <div id="uptd-detail-content" style="display:none;"></div>
                    </div>

                </div>
            </div>

            {{-- ─── Aplikasi Layanan Digital ─── --}}
            <div class="anim-up-4">
                <div class="section-header" style="margin-bottom:12px;">
                    <span class="section-title">Aplikasi Layanan Digital</span>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">

                    {{-- E-WAPUPBBKB --}}
                    <a href="#" class="app-card">
                        <div class="app-icon" style="background:#dc2626;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <div class="app-info">
                            <div class="app-name">E-WAPUPBBKB</div>
                            <div class="app-desc">Pajak Bahan Bakar Kendaraan</div>
                        </div>
                        <div class="app-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </div>
                    </a>

                    {{-- E-PAP --}}
                    <a href="#" class="app-card">
                        <div class="app-icon" style="background:#1a2e25;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                                <path d="M7 8h10M7 12h6"/>
                            </svg>
                        </div>
                        <div class="app-info">
                            <div class="app-name">E-PAP</div>
                            <div class="app-desc">Portal Administrasi Pajak</div>
                        </div>
                        <div class="app-arrow">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

    {{-- ─────────────── FOOTER ─────────────── --}}
    <footer class="portal-footer">
        <p class="footer-copyright">
            &copy; {{ date('Y') }} Badan Pendapatan Daerah Provinsi Kalimantan Timur. Hak Cipta Dilindungi.
        </p>
        <div class="footer-badges">
            <span class="footer-badge badge-verified">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Terverifikasi
            </span>
            <span class="footer-badge badge-official-site">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="2" y1="12" x2="22" y2="12"/>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
                Situs Resmi
            </span>
        </div>
    </footer>

<script>
(function () {
    /* ── Data UPTD + posisi ikon SVG (ix,iy dalam viewBox 480x520) ── */
    const uptdData = [
        { id:'berau',      name:'UPTD PPRD Wilayah Berau',               region:'Kab. Berau',               type:'kabupaten', address:'Jl. Pemuda No. 15, Tanjung Redeb',          phone:'(0554) 212100', hours:'Sen–Jum 08.00–16.00 WITA', ix:270, iy:111  },
        { id:'kutim',      name:'UPTD PPRD Wilayah Kutai Timur',         region:'Kab. Kutai Timur',         type:'kabupaten', address:'Jl. Sangatta Baru No. 1, Sangatta',         phone:'(0549) 232100', hours:'Sen–Jum 08.00–16.00 WITA', ix:368, iy:225 },
        { id:'bontang',    name:'UPTD PPRD Wilayah Bontang',             region:'Kota Bontang',             type:'kota',      address:'Jl. Awang Long No. 12, Bontang',            phone:'(0548) 21500',  hours:'Sen–Jum 08.00–16.00 WITA', ix:408, iy:343 },
        { id:'kukar',      name:'UPTD PPRD Wilayah Kutai Kartanegara',   region:'Kab. Kutai Kartanegara',   type:'kabupaten', address:'Jl. Wolter Monginsidi, Tenggarong',         phone:'(0541) 66100',  hours:'Sen–Jum 08.00–16.00 WITA', ix:240, iy:283 },
        { id:'samarinda',  name:'UPTD PPRD Wilayah Samarinda',           region:'Kota Samarinda',           type:'kota',      address:'Jl. Juanda No. 1, Samarinda',               phone:'(0541) 741234', hours:'Sen–Jum 08.00–16.00 WITA', ix:314, iy:400 },
        { id:'kubar',      name:'UPTD PPRD Wilayah Kutai Barat',         region:'Kab. Kutai Barat',         type:'kabupaten', address:'Jl. Sendawar, Barong Tongkok',              phone:'(0545) 212100', hours:'Sen–Jum 08.00–16.00 WITA', ix:113, iy:247 },
        { id:'ppu',        name:'UPTD PPRD Wilayah Penajam Paser Utara', region:'Kab. Penajam Paser Utara', type:'kabupaten', address:'Jl. Provinsi No. 3, Penajam',               phone:'(0542) 732100', hours:'Sen–Jum 08.00–16.00 WITA', ix:240, iy:428 },
        { id:'balikpapan', name:'UPTD PPRD Wilayah Balikpapan',          region:'Kota Balikpapan',          type:'kota',      address:'Jl. Jend. Sudirman No. 5, Balikpapan',     phone:'(0542) 421567', hours:'Sen–Jum 08.00–16.00 WITA', ix:295, iy:464 },
        { id:'paser',      name:'UPTD PPRD Wilayah Paser',               region:'Kab. Paser',               type:'kabupaten', address:'Jl. Imam Bonjol No. 8, Tana Paser',         phone:'(0543) 212100', hours:'Sen–Jum 08.00–16.00 WITA', ix:130, iy:409 },
    ];

    const svg = document.getElementById('kaltim-svg');
    const NS  = 'http://www.w3.org/2000/svg';
    let activeId = null;

    /* ── Tambah Markers ke SVG ── */
    uptdData.forEach(function(u, idx) {
        const color = u.type === 'kota' ? '#dc2626' : '#16a34a';
        const g = document.createElementNS(NS, 'g');
        g.setAttribute('class', 'uptd-marker');
        g.setAttribute('id', 'marker-' + u.id);
        g.style.animationDelay = (idx * 0.07) + 's';

        /* Lingkaran luar (glow) */
        const glow = document.createElementNS(NS, 'circle');
        glow.setAttribute('cx', u.ix); glow.setAttribute('cy', u.iy);
        glow.setAttribute('r', '18'); glow.setAttribute('fill', color);
        glow.setAttribute('opacity', '0.18');

        /* Lingkaran utama */
        const circle = document.createElementNS(NS, 'circle');
        circle.setAttribute('cx', u.ix); circle.setAttribute('cy', u.iy);
        circle.setAttribute('r', '13'); circle.setAttribute('fill', color);
        circle.setAttribute('class', 'marker-circle');
        circle.setAttribute('stroke', '#fff'); circle.setAttribute('stroke-width', '2');

        /* Icon bintang di dalam */
        const icon = document.createElementNS(NS, 'path');
        const s = u.ix, t = u.iy;
        icon.setAttribute('d', `M${s},${t-6} l1.5,3 3.2,0.4 -2.3,2.2 0.5,3.2 -2.9-1.5 -2.9,1.5 0.5-3.2 -2.3-2.2 3.2-0.4 Z`);
        icon.setAttribute('fill', '#fff'); icon.setAttribute('opacity', '0.95');

        g.appendChild(glow); g.appendChild(circle); g.appendChild(icon);

        /* Tooltip text */
        const title = document.createElementNS(NS, 'title');
        title.textContent = u.name;
        g.appendChild(title);

        g.addEventListener('click', function() { activateUptd(u); });
        svg.appendChild(g);
    });

    /* ── Aktifkan UPTD: highlight region + tampil panel ── */
    function activateUptd(u) {
        /* Reset region sebelumnya */
        if (activeId) {
            const prevPath = document.getElementById('reg-' + activeId);
            if (prevPath) { prevPath.classList.remove('active-kota', 'active-kabupaten'); }
            const prevMarker = document.getElementById('marker-' + activeId);
            if (prevMarker) { prevMarker.classList.remove('is-active'); }
        }
        activeId = u.id;

        /* Highlight region */
        const regPath = document.getElementById('reg-' + u.id);
        if (regPath) {
            regPath.classList.add(u.type === 'kota' ? 'active-kota' : 'active-kabupaten');
        }

        /* Aktifkan marker */
        const marker = document.getElementById('marker-' + u.id);
        if (marker) marker.classList.add('is-active');

        showDetail(u);
    }

    /* ── Tampilkan Detail Panel ── */
    function showDetail(u) {
        const isKota  = u.type === 'kota';
        const label   = isKota ? 'Kota' : 'Kabupaten';
        const color   = isKota ? '#dc2626' : '#16a34a';
        const bg      = isKota ? '#fff5f5' : '#f0fdf4';
        const border  = isKota ? '#fecaca' : '#bbf7d0';

        document.getElementById('uptd-empty-state').style.display = 'none';
        const el = document.getElementById('uptd-detail-content');
        el.style.display = 'block';
        el.innerHTML = `
            <div class="uptd-detail-card">
                <div class="uptd-detail-header">
                    <div style="width:46px;height:46px;background:rgba(255,255,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(255,255,255,0.2);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="22" x2="21" y2="22"/><rect x="2" y="10" width="20" height="12"/><polygon points="12,2 2,10 22,10"/><rect x="9" y="14" width="3" height="5"/><rect x="13" y="14" width="3" height="5"/></svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <span style="display:inline-block;background:${bg};color:${color};border:1px solid ${border};border-radius:999px;padding:2px 10px;font-size:9px;font-weight:700;letter-spacing:0.1em;margin-bottom:5px;">${label}</span>
                        <div style="font-size:11.5px;font-weight:700;color:#fff;line-height:1.35;">${u.name}</div>
                    </div>
                </div>
                <div class="uptd-detail-body">
                    <div class="uptd-info-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        <span style="font-weight:600;color:#1a2e25;">${u.region}</span>
                    </div>
                    <div class="uptd-info-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>${u.address}</span>
                    </div>
                    <div class="uptd-info-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.17h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.78a16 16 0 0 0 6 6l.87-.87a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16a.92.92 0 0 1 .27.92z"/></svg>
                        <span>${u.phone}</span>
                    </div>
                    <div class="uptd-info-row">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>${u.hours}</span>
                    </div>
                    <div style="margin-top:6px;padding-top:10px;border-top:1px solid #f3f4f6;">
                        <a href="#" style="display:inline-flex;align-items:center;gap:6px;background:${color};color:#fff;border-radius:8px;padding:7px 14px;font-size:11px;font-weight:600;text-decoration:none;transition:opacity 0.18s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 8 16 12 12 16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                            Kunjungi Layanan
                        </a>
                    </div>
                </div>
            </div>`;
    }
})();
</script>

</body>
</html>
