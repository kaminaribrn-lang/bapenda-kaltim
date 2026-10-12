@extends('layouts.portal')
@section('title', 'Maklumat Pelayanan UPTD')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => '#'],
        ['label' => 'Maklumat Pelayanan UPTD', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Maklumat Pelayanan UPTD" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 reveal">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Pelayanan Samsat
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                Maklumat Pelayanan UPTD PPRD
            </h1>
            
            <div class="h-px bg-border-base mb-10 w-full"></div>

            <div class="relative bg-primary text-surface rounded-3xl p-8 md:p-12 overflow-hidden shadow-lg transform transition-transform hover:scale-[1.01] duration-500">
                {{-- Decorative background --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col items-center text-center">
                    <svg class="w-16 h-16 text-primary-light mb-6 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>

                    <h2 class="text-2xl md:text-3xl font-heading font-black mb-8 leading-relaxed">
                        KAMI SEGENAP JAJARAN UPTD PPRD BAPENDA PROVINSI KALIMANTAN TIMUR SANGGUP MENYELENGGARAKAN PELAYANAN SAMSAT SESUAI STANDAR PELAYANAN YANG TELAH DITETAPKAN, RAMAH, CEPAT, TEPAT, DAN AKURAT.
                    </h2>

                    <div class="w-20 h-1.5 bg-primary-light rounded-full mb-8"></div>

                    <p class="font-body text-lg font-medium text-surface/90">
                        Kepala UPTD PPRD se-Kalimantan Timur
                    </p>
                </div>
            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.informasi.partials.sidebar')

    </div>
</div>

@endsection
