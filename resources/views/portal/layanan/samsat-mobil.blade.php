@extends('layouts.portal')
@section('title', 'Samsat Mobil / Keliling')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => route('portal.layanan.index', $website->slug)],
        ['label' => 'Samsat Keliling', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Samsat Keliling" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 reveal">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                Layanan Jemput Bola
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                Samsat Mobil / Keliling
            </h1>
            
            <div class="h-px bg-border-base mb-10 w-full"></div>

            <div class="portal-prose max-w-none text-text-base font-body leading-relaxed md:text-lg space-y-6">
                
                <p>
                    <strong>Samsat Keliling</strong> (Samsat Mobil) adalah wujud nyata pelayanan "jemput bola" Bapenda Provinsi Kalimantan Timur yang beroperasi dengan menggunakan armada kendaraan khusus (bus/minibus) yang didesain menjadi loket layanan Samsat berjalan.
                </p>

                <p>
                    Armada ini ditempatkan di lokasi-lokasi strategis yang jauh dari Kantor Samsat Induk, berpindah-pindah dari satu kecamatan ke kecamatan lainnya, atau di pusat keramaian tertentu berdasarkan jadwal yang telah ditetapkan secara berkala.
                </p>

                <div class="bg-bg-base p-6 md:p-8 rounded-2xl border border-border-base my-8 border-l-4 border-l-primary">
                    <h3 class="text-xl font-heading font-bold text-primary mb-2">Persyaratan Pengurusan:</h3>
                    <ul class="list-disc list-inside mt-4 space-y-2 text-sm md:text-base">
                        <li>KTP Asli / Tanda Pengenal Asli yang sesuai dengan nama pada STNK.</li>
                        <li>STNK Asli.</li>
                        <li>SKPD (Notice Pajak) Asli tahun lalu.</li>
                        <li><strong>Ketentuan Tambahan:</strong> Sama seperti Samsat Corner/Drive Thru, Samsat Keliling hanya melayani pembayaran Pajak Tahunan, tidak melayani Perpanjangan 5 Tahun (Ganti Plat) maupun Balik Nama.</li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div class="p-6 bg-surface border border-border-base rounded-2xl shadow-sm hover:border-primary/40 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-primary-light text-primary flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="font-heading font-bold text-lg mb-2">Jadwal & Lokasi</h4>
                        <p class="text-sm text-text-muted">Untuk mengetahui jadwal operasional dan titik lokasi berhentinya Samsat Keliling terdekat di kota Anda, pantau terus akun Instagram resmi <strong>@bapendakaltim</strong> atau akun media sosial Samsat (UPTD) setempat.</p>
                    </div>
                    <div class="p-6 bg-surface border border-border-base rounded-2xl shadow-sm hover:border-primary/40 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-primary-light text-primary flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-heading font-bold text-lg mb-2">Kecepatan Layanan</h4>
                        <p class="text-sm text-text-muted">Proses validasi hingga pencetakan notice pajak sangat cepat karena terhubung secara langsung (online) dengan server database induk Bapenda Kaltim.</p>
                    </div>
                </div>

            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.layanan.partials.sidebar')

    </div>
</div>

@endsection
