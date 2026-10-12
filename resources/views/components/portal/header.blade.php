@php use Illuminate\Support\Str; @endphp
@props(['website', 'identity', 'menus' => null])
<header x-data="{ scrolled: false }" 
        @scroll.window="scrolled = window.scrollY > 40" 
        :class="scrolled ? 'shadow-lg' : ''" 
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-slate-200" 
        style="background-image: url('{{ asset('images/ornamen dayak/batik.jpg') }}'); background-size: cover; background-position: center;"
        id="main-header"
        role="banner">
    <!-- Overlay for 30% background image visibility -->
    <div class="absolute inset-0 bg-white" style="opacity:0.5; pointer-events:none; z-index:1;"></div>
    <!-- Overlay for better contrast (WCAG) -->
    <div class="absolute inset-0 transition-all duration-300" aria-hidden="true" :class="scrolled ? 'bg-white/95 backdrop-blur-md' : 'bg-white/0 backdrop-blur-none'" style="z-index:2;"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16 md:h-20">
        {{-- Left Side: Bapenda Logo & Text --}}
        <div class="flex items-center gap-1">
            <a href="{{ route('portal.beranda', $website->slug) }}" 
               class="flex items-center gap-3 group focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 rounded-lg p-1"
               aria-label="Beranda Portal Bapenda Provinsi Kalimantan Timur">
               <img src="{{ asset('images/ornamen dayak/logo-kaltim.png') }}" alt="Logo Pemerintah Provinsi Kalimantan Timur" class="h-12 md:h-14 w-auto object-contain">
                <img src="{{ asset('images/bapendalogo.svg') }}" alt="Logo Bapenda Kaltim" class="h-10 md:h-16 w-auto object-contain ">
            </a>
        </div>

        {{-- Right Side: Secondary Logos --}}
        <div class="flex items-center gap-4 md:gap-6">
                      <img src="{{ asset('images/logo_berakhlak.webp') }}" 
                          alt="Logo BerAKHLAK" 
                          class="h-8 md:h-10 w-auto object-contain opacity-90 hover:opacity-100 transition-opacity"
                          onerror="this.style.display='none'">
                      <img src="{{ asset('images/logo_ppid.png') }}" 
                          alt="Logo PPID" 
                          class="h-10 md:h-12 w-auto object-contain opacity-90 hover:opacity-100 transition-opacity"
                          onerror="this.style.display='none'">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Logo_ASN_Berakhlak.png" 
                 alt="Logo Core Values ASN BerAKHLAK" 
                 class="h-8 md:h-10 w-auto object-contain opacity-90 hover:opacity-100 transition-opacity"
                 onerror="this.style.display='none'">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Logo_Bangga_Melayani_Bangsa.png/640px-Logo_Bangga_Melayani_Bangsa.png" 
                 alt="Logo Employer Branding Bangga Melayani Bangsa" 
                 class="h-8 md:h-10 w-auto object-contain opacity-90 hover:opacity-100 transition-opacity"
                 onerror="this.style.display='none'">
        </div>
    </div>
</header>
