@extends('layouts.portal')
@section('title', 'Inovasi Layanan — Bapenda Kaltim')
@section('meta_desc', 'Inovasi digital Bapenda Kaltim: Simpator, E-WAPUPBBKB, PAP, dan Sipropenda — solusi cerdas pembayaran pajak kendaraan dan pajak daerah Kalimantan Timur.')

@section('content')

@php
    $apps = [
        [
            'name'        => 'SIMPATOR',
            'kepanjangan' => 'Sistem Manajemen Pajak Terpadu Online Regional',
            'url'         => 'http://simpator.kaltimprov.go.id/',
            'desc'        => 'Platform terintegrasi untuk pengelolaan dan pemantauan data pajak daerah Kalimantan Timur secara real-time dan terpusat.',
            'badge'       => 'Pajak Daerah',
            'color'       => 'emerald',
            'icon'        => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        ],
        [
            'name'        => 'E-WAPUPBBKB',
            'kepanjangan' => 'e-Wajib Pajak Usaha Pajak Bahan Bakar Kendaraan Bermotor',
            'url'         => 'https://e-wapupbbkb.kaltimprov.go.id/',
            'desc'        => 'Layanan digital untuk wajib pajak dalam pengelolaan dan pelaporan Pajak Bahan Bakar Kendaraan Bermotor (PBBKB) secara online.',
            'badge'       => 'Kendaraan Bermotor',
            'color'       => 'blue',
            'icon'        => 'M9 3v10.586a1 1 0 01-.293.707l-5 5a1 1 0 000 1.414A1 1 0 004 21h16a1 1 0 00.707-1.707l-5-5A1 1 0 0115 13.586V3m-6 0h6M9 3a1 1 0 000-2h6a1 1 0 000 2',
        ],
        [
            'name'        => 'PAP',
            'kepanjangan' => 'Portal Administrasi Pajak',
            'url'         => 'https://pap.kaltimprov.go.id/login',
            'desc'        => 'Portal administrasi terpadu bagi wajib pajak dan petugas untuk pengelolaan, pelaporan, dan verifikasi pajak daerah Kaltim secara digital.',
            'badge'       => 'Administrasi Pajak',
            'color'       => 'violet',
            'icon'        => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        ],
        [
            'name'        => 'SIPROPENDA',
            'kepanjangan' => 'Sistem Informasi Pendapatan Daerah',
            'url'         => 'https://sipropenda.kaltimprov.go.id/',
            'desc'        => 'Sistem informasi komprehensif untuk monitoring dan analisis data pendapatan daerah Kalimantan Timur dari seluruh sumber dan sektor pajak.',
            'badge'       => 'Pendapatan Daerah',
            'color'       => 'red',
            'icon'        => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
    ];
@endphp

{{-- Clean & Corporate Wrapper --}}
<div class="relative min-h-[calc(100vh-80px)] w-full bg-slate-50/50 flex flex-col justify-center py-10 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    {{-- Soft Background Decorations --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-50">
        <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-emerald-50 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[600px] h-[600px] bg-blue-50 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col items-center">
        
        {{-- Clean Header --}}
        <div class="text-center mb-10 w-full reveal">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white border border-slate-200 text-slate-500 text-[10px] font-bold uppercase tracking-widest shadow-sm mb-4">
                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Layanan Digital
            </span>
            <h1 class="text-3xl md:text-5xl font-heading font-black text-slate-800 tracking-tight mb-4">
                Inovasi <span class="text-emerald-600">Pelayanan Terpadu</span>
            </h1>
            <p class="text-slate-500 text-sm md:text-base max-w-2xl mx-auto font-body leading-relaxed">
                Akses berbagai layanan pajak dan pendapatan daerah secara mudah, cepat, dan transparan melalui platform digital resmi Pemerintah Provinsi Kalimantan Timur.
            </p>
        </div>

        {{-- Professional Flip Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full perspective-1000">
            @foreach($apps as $i => $app)
                @php
                    $colorMap = [
                        'emerald' => ['icon_bg' => 'bg-emerald-50 text-emerald-600', 'back_bg' => 'bg-emerald-600', 'btn' => 'bg-white text-emerald-700 hover:bg-emerald-50', 'ring' => 'hover:ring-emerald-600/20'],
                        'blue'    => ['icon_bg' => 'bg-blue-50 text-blue-600', 'back_bg' => 'bg-blue-600', 'btn' => 'bg-white text-blue-700 hover:bg-blue-50', 'ring' => 'hover:ring-blue-600/20'],
                        'violet'  => ['icon_bg' => 'bg-violet-50 text-violet-600', 'back_bg' => 'bg-violet-600', 'btn' => 'bg-white text-violet-700 hover:bg-violet-50', 'ring' => 'hover:ring-violet-600/20'],
                        'red'     => ['icon_bg' => 'bg-red-50 text-red-600', 'back_bg' => 'bg-red-600', 'btn' => 'bg-white text-red-700 hover:bg-red-50', 'ring' => 'hover:ring-red-600/20'],
                    ];
                    $c = $colorMap[$app['color']];
                @endphp
                <div class="group relative w-full h-[320px] cursor-pointer reveal" style="animation-delay: {{ $i * 100 }}ms;">
                    <div class="absolute inset-0 w-full h-full transition-transform duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        
                        {{-- Front Face --}}
                        <div class="absolute inset-0 w-full h-full [backface-visibility:hidden] bg-white rounded-3xl border border-slate-200 shadow-sm group-hover:shadow-lg flex flex-col p-6 text-center ring-4 ring-transparent {{ $c['ring'] }} transition-all duration-300">
                            
                            {{-- Top Color Line --}}
                            <div class="absolute top-0 left-8 right-8 h-1 {{ $c['back_bg'] }} rounded-b-md opacity-20"></div>

                            <div class="w-16 h-16 mx-auto rounded-2xl {{ $c['icon_bg'] }} flex items-center justify-center mb-5 mt-2 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $app['icon'] }}"/>
                                </svg>
                            </div>

                            <span class="inline-block px-3 py-1 bg-slate-50 border border-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest rounded-full mx-auto mb-3">
                                {{ $app['badge'] }}
                            </span>

                            <h3 class="font-heading font-black text-2xl text-slate-800 tracking-tight mb-1">
                                {{ $app['name'] }}
                            </h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-snug">
                                {{ $app['kepanjangan'] }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-center gap-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                Balik untuk penjelasan
                                <svg class="w-3.5 h-3.5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>

                        {{-- Back Face --}}
                        <div class="absolute inset-0 w-full h-full [backface-visibility:hidden] [transform:rotateY(180deg)] {{ $c['back_bg'] }} rounded-3xl shadow-xl flex flex-col p-7 text-center text-white overflow-hidden">
                            
                            {{-- Faint Icon Background --}}
                            <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $app['icon'] }}"/>
                            </svg>

                            <div class="relative z-10 flex-1 flex flex-col justify-center">
                                <h3 class="font-heading font-black text-2xl mb-3 tracking-tight">
                                    {{ $app['name'] }}
                                </h3>
                                <p class="text-sm text-white/90 font-body leading-relaxed max-w-[95%] mx-auto drop-shadow-sm">
                                    {{ $app['desc'] }}
                                </p>
                            </div>

                            <a href="{{ $app['url'] }}" target="_blank" rel="noopener noreferrer" 
                               class="relative z-10 group/btn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl {{ $c['btn'] }} text-[11px] font-black uppercase tracking-widest transition-transform duration-300 hover:-translate-y-1 shadow-md w-full">
                                Buka Portal Aplikasi
                                <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Professional Trust Indicator --}}
        <div class="mt-12 flex flex-col sm:flex-row items-center gap-4 px-6 py-4 rounded-2xl bg-white border border-slate-200 shadow-sm reveal" style="animation-delay: 400ms;">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="text-center sm:text-left">
                <p class="text-sm font-bold text-slate-800 font-heading mb-0.5">Keamanan Terjamin</p>
                <p class="text-xs text-slate-500 font-body">
                    Seluruh layanan di atas terhubung secara aman dengan domain resmi instansi <strong>kaltimprov.go.id</strong>.
                </p>
            </div>
        </div>

    </div>
</div>

@push('styles')
<style>
/* Reveal Animation */
.reveal {
    opacity: 0;
    transform: translateY(20px);
    animation: reveal-up 0.8s ease-out forwards;
}
@keyframes reveal-up {
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush
@endsection
