<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', $identity->seo_title ?? $identity->name ?? $website->name) | {{ $identity->name ?? $website->name }}</title>
    <meta name="description" content="@yield('meta_desc', $identity->seo_description ?? $identity->description ?? '')">
    @if($identity?->seo_keywords)
    <meta name="keywords" content="{{ $identity->seo_keywords }}">
    @endif

    {{-- Favicon --}}
    @if($identity?->favicon)
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($identity->favicon) }}">
    @endif

    {{-- Google Fonts: Inter (body), Montserrat (heading), Outfit & Work Sans (UI) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700&family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>

    {{-- Swiper.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
    @stack('styles')
</head>
<body class="font-sans bg-bg-base text-text-muted antialiased">

    {{-- Topbar Utilities --}}
    <x-portal.topbar :identity="$identity" />

    {{-- Header (Logo + Topbar, tanpa menu desktop — navigasi via Floating Navbar) --}}
    <x-portal.header :website="$website" :identity="$identity" :menus="$menus" />

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-portal.footer :website="$website" :identity="$identity" :menus="$menus" />

    {{-- Floating Bottom Navbar --}}
    <x-portal.floating-navbar :website="$website" :menus="$menus" />

    {{-- Floating Widgets (Popups) --}}
    <x-portal.floating-widgets :identity="$identity" />

    {{-- Swiper.js --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Scroll Reveal & Accessibility Trigger --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Reveal on scroll
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            reveals.forEach(el => observer.observe(el));

            // Custom Accessibility Trigger for UserWay
            document.addEventListener('click', (e) => {
                const trigger = e.target.closest('.accessibility-trigger');
                if (trigger) {
                    e.preventDefault();
                    if (typeof UserWay !== 'undefined') {
                        UserWay.widgetOpen();
                    }
                }
            });
        });
    </script>

    @php
        $userwayAccountId = null;
        if (isset($identity)) {
            $userwayAccountId = $identity->userway_account_id;
        }
        if (is_null($userwayAccountId)) {
            $userwayAccountId = config('services.userway.account_id') ?? env('USERWAY_ACCOUNT_ID', 'n3T9RkU4t7');
        }
    @endphp

    @if($userwayAccountId)
        <!-- UserWay Accessibility Widget -->
        <script src="https://cdn.userway.org/widget.js" data-account="{{ $userwayAccountId }}" data-trigger=".accessibility-trigger" defer></script>
    @endif

    @stack('scripts')
</body>
</html>
