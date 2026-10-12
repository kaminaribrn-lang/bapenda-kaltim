@extends('layouts.portal')
@section('title', 'Samsat Drive Thru')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => route('portal.layanan.index', $website->slug)],
        ['label' => 'Samsat Drive Thru', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Samsat Drive Thru" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 reveal">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Layanan Cepat
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                Samsat Drive Thru
            </h1>
            
            <div class="h-px bg-border-base mb-10 w-full"></div>

            <div class="portal-prose max-w-none text-text-base font-body leading-relaxed md:text-lg space-y-6">
                
                <p>
                    <strong>Samsat Drive Thru</strong> merupakan inovasi pelayanan prima yang memungkinkan Wajib Pajak melakukan transaksi pembayaran Pajak Kendaraan Bermotor (PKB) dan pengesahan STNK tahunan tanpa harus turun dari kendaraannya (mobil maupun motor).
                </p>

                <p>
                    Dengan proses yang dirancang seminimal mungkin, penyelesaian administrasi rata-rata hanya memakan waktu 3 sampai 5 menit per kendaraan. Hal ini sangat efektif bagi Anda yang memiliki mobilitas tinggi dan keterbatasan waktu.
                </p>

                <div class="bg-bg-base p-6 md:p-8 rounded-2xl border border-border-base my-8 border-l-4 border-l-primary">
                    <h3 class="text-xl font-heading font-bold text-primary mb-2">Persyaratan Pengesahan STNK:</h3>
                    <ul class="list-disc list-inside mt-4 space-y-2 text-sm md:text-base">
                        <li>KTP Asli / Identitas Diri Asli atas nama pemilik kendaraan.</li>
                        <li>STNK Asli.</li>
                        <li>SKPD (Surat Ketetapan Pajak Daerah) Asli / Notis Pajak tahun terakhir.</li>
                        <li>Kendaraan bermotor yang bersangkutan <strong>wajib dibawa</strong> saat melakukan transaksi Drive Thru.</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-heading font-bold text-text-base mb-4 border-b border-border-base pb-2">Alur Pelayanan Drive Thru</h3>
                    <ol class="space-y-4 list-decimal list-inside ml-2">
                        <li><strong>Loket Pendaftaran:</strong> Pengendara (Wajib Pajak) menyerahkan berkas persyaratan (KTP asli dan STNK asli) dari jendela kendaraan.</li>
                        <li><strong>Proses Identifikasi & Penetapan:</strong> Petugas menetapkan besaran pajak yang harus dibayarkan.</li>
                        <li><strong>Loket Pembayaran:</strong> Pengendara membayar nominal pajak yang ditetapkan dan menerima kembali KTP asli, STNK asli yang telah disahkan, beserta SKPD/Notis pajak yang baru.</li>
                        <li><strong>Selesai:</strong> Pengendara dapat langsung melanjutkan perjalanan.</li>
                    </ol>
                </div>

            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.layanan.partials.sidebar')

    </div>
</div>

@endsection
