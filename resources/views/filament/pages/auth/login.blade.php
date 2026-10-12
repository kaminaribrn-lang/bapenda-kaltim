<div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: #ffffff; z-index: 99999; display: flex; font-family: 'Poppins', sans-serif; overflow: hidden;" class="login-wrapper">
    
    <!-- Left Side: Login Form -->
    <div class="login-left" style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; background: #ffffff; overflow-y: auto; position: relative; z-index: 20;">
        <div style="width: 100%; max-width: 420px; position: relative;">
            
            <!-- Abstract subtle glow behind form -->
            <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: #34d399; filter: blur(120px); opacity: 0.15; z-index: -1; border-radius: 50%;"></div>

            <!-- Welcome Header -->
            <div class="animate-fade-up" style="--delay: 0.1s; margin-bottom: 45px;">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                     <div style="background: white; padding: 6px; border-radius: 14px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.01); border: 1px solid #f8fafc;">
                         <!-- Jika ada logo bapenda bisa diganti src-nya -->
                         <img src="{{ asset('images/kaltimlogo.png') }}" onerror="this.style.display='none'" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
                     </div>
                     <div>
                        <h2 style="margin: 0; font-size: 19px; font-weight: 800; color: #064e3b; letter-spacing: -0.5px; line-height: 1.1;">BAPENDA</h2>
                        <span style="font-size: 12px; color: #059669; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Admin Panel</span>
                     </div>
                </div>
                <h1 style="font-size: 36px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0; letter-spacing: -1.2px; line-height: 1.2;">Selamat Datang!</h1>
            </div>

            <!-- Form -->
            <div class="custom-filament-form animate-fade-up" style="--delay: 0.25s; position: relative;">
                <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 24px;">
                    {{ $this->form }}

                    <div style="display: flex; justify-content: flex-end; margin-top: -12px;">
                        @if (filament()->hasPasswordReset())
                            <a href="{{ filament()->getRequestPasswordResetUrl() }}" class="hover-link" style="font-size: 13px; font-weight: 700; color: #059669; text-decoration: none; transition: all 0.3s ease;">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <div class="btn-container" style="padding-top: 16px;">
                        <button type="submit" class="submit-btn" style="width: 100%; position: relative; overflow: hidden; background: linear-gradient(135deg, #36a36d 0%, #298256 100%); color: white; border: none; padding: 16px; border-radius: 16px; font-size: 16px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 12px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 25px -5px rgba(54, 163, 109, 0.4), 0 8px 10px -6px rgba(54, 163, 109, 0.1);">
                            <span style="position: relative; z-index: 2;">Masuk Sekarang</span>
                            <svg class="btn-icon" width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2; transition: transform 0.4s ease;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            <div class="btn-glow" style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.6s ease; z-index: 1;"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="animate-fade-up" style="--delay: 0.4s; margin-top: 80px; text-align: center; font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.8;">
                © 2026 BADAN PENDAPATAN DAERAH PROVINSI KALIMANTAN TIMUR.
            </div>
        </div>
    </div>

    <!-- Right Side: Visual Panel -->
    <div class="login-right hide-mobile" style="flex: 1.2; position: relative; background: #022c22; display: flex; flex-direction: column; justify-content: center; align-items: center; overflow: hidden;">
        
        <!-- Premium Aurora Background / Mesh Gradient (Pure CSS Animated) -->
        <div style="position: absolute; inset: 0; background: #1e3a8a; z-index: 0;"></div>
        <div class="aurora-css aurora-1" style="position: absolute; top: -20%; left: -10%; width: 70%; height: 70%; background: #36a36d; filter: blur(120px); border-radius: 50%; opacity: 0.5; z-index: 1;"></div>
        <div class="aurora-css aurora-2" style="position: absolute; bottom: -20%; right: -10%; width: 60%; height: 60%; background: #a33636; filter: blur(140px); border-radius: 50%; opacity: 0.4; z-index: 1;"></div>
        <div class="aurora-css aurora-3" style="position: absolute; top: 30%; right: 20%; width: 50%; height: 50%; background: #3b82f6; filter: blur(100px); border-radius: 50%; opacity: 0.6; z-index: 1;"></div>
        
        <!-- Elegant Grid Pattern -->
        <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.15) 1px, transparent 1px); background-size: 40px 40px; z-index: 2; opacity: 0.5;"></div>
        
        <!-- Content Container -->
        <div class="panel-content animate-right-panel" style="position: relative; z-index: 10; padding: 60px; text-align: center; max-width: 600px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            
            <!-- Floating Logo Box -->
            <div style="margin-bottom: 50px; display: inline-flex; position: relative;">
                <div class="logo-glow animate-pulse-slow" style="position: absolute; inset: -20px; background: rgba(52, 211, 153, 0.4); filter: blur(40px); border-radius: 50%; z-index: -1;"></div>
                <div class="css-floating-logo" style="position: relative; width: 140px; height: 140px; background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); border-radius: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 30px 60px -15px rgba(0,0,0,0.6), inset 0 0 20px rgba(255,255,255,0.05);">
                    <img class="logo-img" src="{{ asset('images/kaltimlogo.png') }}" onerror="this.style.display='none'" alt="Logo Large" style="height: 90px; width: auto; filter: drop-shadow(0 15px 15px rgba(0,0,0,0.3));">
                    <!-- Glass reflection -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 50%; background: linear-gradient(180deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%); border-radius: 40px 40px 0 0; pointer-events: none;"></div>
                </div>
            </div>

            <!-- Typography -->
            <h2 class="animate-fade-up" style="--delay: 0.2s; font-size: 48px; font-weight: 900; color: white; line-height: 1.15; margin: 0 0 24px 0; letter-spacing: -1.5px; text-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                Pendapatan Daerah<br>
                <span style="background: linear-gradient(135deg, #6ee7b7 0%, #34d399 50%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">Inovatif & Transparan</span>
            </h2>
            
            <p class="animate-fade-up" style="--delay: 0.3s; font-size: 18px; color: rgba(255,255,255,0.85); line-height: 1.7; font-weight: 500; margin-bottom: 60px; max-width: 500px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                Sistem Panel Terpusat Badan Pendapatan Daerah Provinsi Kalimantan Timur untuk pengelolaan seluruh UPTD secara terintegrasi.
            </p>

            <div class="hero-divider animate-divider" style="display: flex; align-items: center; gap: 20px; width: 80%; opacity: 0.5;">
                <div style="height: 1px; flex: 1; background: linear-gradient(to right, transparent, rgba(255,255,255,0.8));"></div>
                <div style="width: 8px; height: 8px; background: white; border-radius: 50%; box-shadow: 0 0 15px white;"></div>
                <div style="height: 1px; flex: 1; background: linear-gradient(to left, transparent, rgba(255,255,255,0.8));"></div>
            </div>
        </div>
    </div>

    <style>
        /* Lock body - Prevent Filament dark mode dari mengubah background */
        html, body {
            background: white !important;
            color: #1e293b !important;
            margin: 0;
            padding: 0;
        }

        /* Override CSS variables Filament dark mode */
        :root, html.dark {
            --fi-color-gray-950: #1e293b;
            --fi-color-gray-900: #1e293b;
        }

        .fi-simple-main, .fi-simple-main-ctn, .fi-simple-layout {
            all: unset !important;
            display: contents !important;
        }
        .fi-simple-header, .fi-simple-footer { display: none !important; }

        /* ========================================================= */
        /* PURE CSS ULTRA FAST ANIMATIONS (NO JS, 0ms DELAY)         */
        /* ========================================================= */
        
        /* 1. Left Panel Slide In */
        .login-left {
            animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideInLeft {
            0% { transform: translateX(-30px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        /* 2. Right Panel Fade In */
        .login-right {
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* 3. Staggered Fade Up for Content Elements */
        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: var(--delay, 0s);
        }
        @keyframes fadeUp {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* 4. Smooth Floating Logo */
        .css-floating-logo {
            animation: floatLogo 6s ease-in-out infinite;
        }
        @keyframes floatLogo {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-15px) rotate(2deg) scale(1.02); }
        }

        /* 5. Slow Aurora Movement (Hardware Accelerated) */
        .aurora-1 { animation: auroraMove1 15s ease-in-out infinite alternate; }
        .aurora-2 { animation: auroraMove2 20s ease-in-out infinite alternate; }
        .aurora-3 { animation: auroraMove3 18s ease-in-out infinite alternate; }
        
        @keyframes auroraMove1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(10%, 15%) scale(1.2); }
        }
        @keyframes auroraMove2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-15%, -10%) scale(1.1); }
        }
        @keyframes auroraMove3 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(10%, -15%) scale(1.3); }
        }

        /* 6. Divider Expanding Line */
        .animate-divider {
            width: 0%;
            opacity: 0;
            animation: expandDivider 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: 0.6s;
        }
        @keyframes expandDivider {
            0% { width: 0%; opacity: 0; }
            100% { width: 80%; opacity: 0.5; }
        }

        /* Custom slow pulse animation for logo shadow */
        @keyframes customPulse {
            0% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.1); opacity: 0.6; }
            100% { transform: scale(1); opacity: 0.4; }
        }
        .animate-pulse-slow {
            animation: customPulse 4s ease-in-out infinite;
        }


        /* ========================================================= */
        /* FORMS & COMPONENTS STYLING                                */
        /* ========================================================= */

        /* LABEL */
        label,
        label.fi-fo-field-label,
        [class*="fi-fo-field-label"],
        .fi-fo-field-wrp label,
        .fi-form label,
        .custom-filament-form label {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #334155 !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            margin-bottom: 8px !important;
            letter-spacing: -0.2px;
            transition: color 0.3s ease;
        }

        .fi-fo-field-wrp:focus-within label {
            color: #059669 !important;
        }

        /* Sembunyikan asterisk required (*) */
        label sup,
        label .fi-required,
        [class*="fi-fo-field-label"] sup,
        [class*="fi-fo-field-label"] [class*="required"],
        .fi-fo-field-label-required,
        label > span[class*="required"],
        label > sup,
        .fi-fo-field-wrp-label-required {
            display: none !important;
        }

        /* Input wrapper */
        .fi-input-wrp {
            border-radius: 16px !important;
            background: #f8fafc !important;
            border: 2px solid transparent !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02) inset !important;
            overflow: hidden !important;
        }
        
        .fi-input-wrp:hover {
            border-color: #cbd5e1 !important;
            background: #ffffff !important;
        }

        .fi-input-wrp:focus-within {
            border-color: #059669 !important;
            background: white !important;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.15), 0 2px 6px rgba(0,0,0,0.02) inset !important;
        }

        /* Input element */
        .fi-input-wrp input {
            background: transparent !important;
            color: #0f172a !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            padding: 14px 16px !important;
        }

        /* Prefix icon */
        .fi-input-wrp-prefix {
            padding-left: 18px !important;
        }
        .fi-input-wrp-prefix svg {
            width: 22px !important;
            height: 22px !important;
            color: #94a3b8 !important;
            transition: color 0.3s ease !important;
        }
        .fi-input-wrp:focus-within .fi-input-wrp-prefix svg {
            color: #059669 !important;
        }

        /* Checkbox Override */
        input[type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            border-radius: 6px !important;
            border: 2px solid #cbd5e1 !important;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        input[type="checkbox"]:checked {
            background-color: #059669 !important;
            border-color: #059669 !important;
        }

        /* Field & error spacing */
        .fi-fo-field-wrp { margin-bottom: 4px !important; }
        .fi-fo-field-wrp-error-message {
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #e11d48 !important;
            margin-top: 6px !important;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .fi-fo-field-wrp-error-message::before {
            content: "•";
            font-size: 16px;
        }

        /* Custom Hover Effects */
        .hover-link:hover {
            color: #047857 !important;
            text-shadow: 0 0 10px rgba(5, 150, 105, 0.2);
            transform: translateX(2px);
        }

        .submit-btn:hover {
            transform: translateY(-2px) scale(1.01) !important;
            box-shadow: 0 15px 30px -5px rgba(5, 150, 105, 0.4), 0 10px 15px -6px rgba(5, 150, 105, 0.2) !important;
        }
        
        .submit-btn:hover .btn-icon {
            transform: translateX(4px) !important;
        }
        
        .submit-btn:hover .btn-glow {
            left: 100% !important;
        }

        .submit-btn:active {
            transform: translateY(1px) scale(0.98) !important;
        }

        @media (max-width: 1023px) {
            .hide-mobile { display: none !important; }
            .login-left { padding: 30px 20px !important; }
        }
    </style>
</div>
