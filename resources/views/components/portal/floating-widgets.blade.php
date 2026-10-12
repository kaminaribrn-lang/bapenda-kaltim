{{-- Floating Widgets: Popup Selalu Muncul --}}
@props(['identity' => null])
@php
    // Normalisasi nomor telepon ke format internasional untuk WhatsApp
    $waNumber = $identity?->whatsapp ?? $identity?->phone ?? '08115545000'; // Default number as fallback
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
    // Hapus karakter non-numerik
    $waNumber = preg_replace('/[^0-9]/', '', $waNumber);
@endphp

<div class="fixed z-[110] pointer-events-none inset-0">
    
    {{-- Layanan Disabilitas (Kiri Bawah) --}}
    <div class="absolute bottom-6 left-6 pointer-events-auto">
        <button aria-label="Buka menu aksesibilitas"
                class="accessibility-trigger w-12 h-12 md:w-14 md:h-14 bg-secondary text-white rounded-full flex items-center justify-center shadow-lg hover:bg-secondary-dark hover:scale-110 transition-all duration-300 group relative cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="16" cy="4" r="1" />
                <path d="m18 19 1-7-6 1" />
                <path d="m5 8 3-3 5.5 3-2.36 3.5" />
                <path d="M4.24 14.5a5 5 0 0 0 6.88 6" />
                <path d="M13.76 17.5a5 5 0 0 0-6.88-6" />
            </svg>
            {{-- Tooltip --}}
            <span class="absolute left-full ml-3 px-3 py-1.5 bg-navy text-surface text-xs font-bold rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                Layanan Disabilitas
            </span>
        </button>
    </div>

    {{-- WhatsApp Pelayanan (Kanan Bawah) --}}
    @if($waNumber)
    <div class="absolute bottom-6 right-6 pointer-events-auto">
        <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="block hover:scale-110 transition-all duration-300 group relative cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded-full">
            <img src="{{ asset('images/simc-hubungi-kami-scaled.png') }}" alt="Hubungi Kami" class="w-20 h-20 md:w-32 md:h-32 object-contain portal-pulse hover:animate-none drop-shadow-xl">
            {{-- Tooltip --}}
            <span class="absolute right-full mr-4 top-1/2 -translate-y-1/2 px-4 py-2 bg-navy text-surface text-sm font-bold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-lg">
                Samsat Information Center
            </span>
        </a>
    </div>
    @endif

</div>
