@extends('layouts.portal')
@section('title', 'Samsat Online (E-Samsat)')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => route('portal.layanan.index', $website->slug)],
        ['label' => 'Samsat Online', 'url' => null]
    ];
@endphp
<x-portal.page-header title="E-Samsat Kaltim" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 reveal">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-black uppercase tracking-widest mb-8 border border-blue-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Layanan Digital
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                Samsat Online (E-Samsat)
            </h1>
            
            <div class="h-px bg-border-base mb-10 w-full"></div>

            <div class="portal-prose max-w-none text-text-base font-body leading-relaxed md:text-lg space-y-6">
                
                <p>
                    <strong>E-Samsat Kalimantan Timur</strong> adalah inovasi layanan pembayaran Pajak Kendaraan Bermotor (PKB) dan pengesahan STNK tahunan secara elektronik yang dapat dilakukan di mana saja dan kapan saja.
                </p>

                <p>
                    Layanan ini hadir untuk mempermudah masyarakat Wajib Pajak di Provinsi Kalimantan Timur agar tidak perlu lagi datang dan antri ke kantor Samsat. Pembayaran dapat dilakukan melalui berbagai kanal mitra Bapenda.
                </p>

                <div class="bg-bg-base p-6 md:p-8 rounded-2xl border border-border-base my-8">
                    <h3 class="text-xl font-heading font-bold text-primary mb-4 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Kanal Pembayaran Resmi
                    </h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Aplikasi SIGNAL (Samsat Digital Nasional)</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> ATM / Mobile Banking Bankaltimtara</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Aplikasi Tokopedia</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Aplikasi GoPay / GoTagihan</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Indomaret / Ceriamart</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Alfamart / Alfamidi</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Kantor Pos Indonesia</li>
                        <li class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-primary"></div> Pegadaian</li>
                    </ul>
                </div>

                <h3 class="text-xl font-heading font-bold text-text-base mb-4 border-l-4 border-l-primary pl-4">Alur Penggunaan Aplikasi SIGNAL</h3>
                <ol class="space-y-4 list-decimal list-inside ml-2">
                    <li>Unduh aplikasi <strong>SIGNAL</strong> di Google Play Store atau Apple App Store.</li>
                    <li>Lakukan registrasi pengguna dan verifikasi e-KTP beserta swafoto wajah.</li>
                    <li>Tambahkan Data Kendaraan Bermotor (milik sendiri atau dalam satu Kartu Keluarga).</li>
                    <li>Pilih menu <strong>Pendaftaran Pengesahan STNK</strong>.</li>
                    <li>Sistem akan menampilkan rincian Pajak Kendaraan Bermotor (PKB) dan Sumbangan Wajib Dana Kecelakaan Lalu Lintas Jalan (SWDKLLJ).</li>
                    <li>Pilih metode pengiriman TBPKP (Tanda Bukti Pelunasan Kewajiban Pembayaran) melalui PT Pos Indonesia atau ambil sendiri di Samsat terdekat.</li>
                    <li>Lakukan pembayaran melalui bank atau kanal digital yang tersedia.</li>
                    <li>Selesai! TBPKP fisik akan dikirimkan ke alamat Anda. TBPKP digital (e-TBPKP) langsung tersedia di aplikasi.</li>
                </ol>

            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.layanan.partials.sidebar')

    </div>
</div>

@endsection
