@extends('layouts.portal')
@section('title', 'Samsat Corner / Mall')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => route('portal.layanan.index', $website->slug)],
        ['label' => 'Samsat Corner', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Samsat Corner" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 reveal">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Layanan Ekstra
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                Samsat Corner / Mall
            </h1>
            
            <div class="h-px bg-border-base mb-10 w-full"></div>

            <div class="portal-prose max-w-none text-text-base font-body leading-relaxed md:text-lg space-y-6">
                
                <p>
                    <strong>Samsat Corner</strong> (juga sering disebut Samsat Mall) adalah gerai layanan pengesahan STNK tahunan dan pembayaran Pajak Kendaraan Bermotor (PKB) yang ditempatkan di pusat perbelanjaan atau tempat-tempat publik strategis.
                </p>

                <p>
                    Layanan ini merupakan bentuk "jemput bola" Bapenda Provinsi Kalimantan Timur dan Ditlantas Polda Kaltim untuk memberikan kenyamanan ekstra kepada masyarakat. Dengan Samsat Corner, Anda dapat menunaikan kewajiban pajak sembari berbelanja atau bersantai bersama keluarga di akhir pekan.
                </p>

                <div class="bg-bg-base p-6 md:p-8 rounded-2xl border border-border-base my-8 border-l-4 border-l-primary">
                    <h3 class="text-xl font-heading font-bold text-primary mb-2">Persyaratan Persyaratan Layanan:</h3>
                    <ul class="list-disc list-inside mt-4 space-y-2 text-sm md:text-base">
                        <li>KTP Asli / Identitas Diri Asli yang sah sesuai dengan data STNK.</li>
                        <li>STNK Asli.</li>
                        <li>SKPD (Surat Ketetapan Pajak Daerah) Asli tahun terakhir.</li>
                        <li><strong>Catatan:</strong> Hanya melayani Pajak Tahunan. Untuk perpanjangan 5 tahun (Ganti Plat/STNK) wajib dilakukan di Samsat Induk karena memerlukan Cek Fisik Kendaraan.</li>
                    </ul>
                </div>

                <h3 class="text-xl font-heading font-bold text-text-base mb-4 mt-8">Keunggulan Samsat Corner</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 bg-surface border border-border-base rounded-2xl shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-primary-light text-primary flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-heading font-bold text-base mb-1">Jam Operasional Fleksibel</h4>
                        <p class="text-sm text-text-muted">Mengikuti jam buka tutup operasional Mall, seringkali tetap buka pada hari Sabtu/Minggu.</p>
                    </div>
                    <div class="p-5 bg-surface border border-border-base rounded-2xl shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-primary-light text-primary flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <h4 class="font-heading font-bold text-base mb-1">Suasana Nyaman</h4>
                        <p class="text-sm text-text-muted">Proses tunggu di area pusat perbelanjaan ber-AC yang nyaman dan menyenangkan.</p>
                    </div>
                </div>

            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.layanan.partials.sidebar')

    </div>
</div>

@endsection
