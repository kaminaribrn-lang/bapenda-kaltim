@extends('layouts.portal')
@section('title', 'Struktur Organisasi')

@section('content')

<section class="relative min-h-screen font-body text-white pb-24 overflow-x-hidden pt-[70px]">
    <!-- Modern Gradient Background with Decorative Elements -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/gedung-bapenda-hero.jpg') }}" class="w-full h-full object-cover" alt="Background">
        <div class="absolute inset-0 bg-gradient-to-br from-teal-950/95 via-slate-900/90 to-emerald-950/95"></div>
    </div>
    
    <!-- Decorative Blur Elements -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-40 right-10 w-96 h-96 bg-teal-400/10 rounded-full blur-[120px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-600/5 rounded-full blur-[150px]"></div>
    
    <!-- Subtle Dot Pattern -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(rgba(16, 185, 129, 0.5) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="container mx-auto px-4 relative z-10 pt-16 md:pt-24">
        
        <!-- Page Header -->
        <div class="text-center mb-12 md:mb-16">
            <span class="inline-block px-6 py-2 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-[10px] md:text-xs text-emerald-300 uppercase font-black tracking-[0.2em] mb-6 reveal">
                Hierarki Instansi
            </span>
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-heading uppercase tracking-tight leading-[1.1] mb-4 reveal">
                Struktur <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Organisasi</span>
            </h2>
            <p class="text-white/60 text-sm md:text-base font-body max-w-xl mx-auto reveal">
                Susunan organisasi Badan Pendapatan Daerah Provinsi Kalimantan Timur berdasarkan kedudukan dan fungsinya.
            </p>
        </div>

        <div class="max-w-5xl mx-auto reveal">
            <!-- PANEL UTAMA -->
            <article class="bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 p-6 md:p-12 shadow-2xl">
                
                <div class="portal-prose max-w-none text-white/90 font-body leading-relaxed md:text-lg">
                    <p class="mb-8">
                        Susunan Organisasi Badan Pendapatan Daerah Provinsi Kalimantan Timur ditetapkan berdasarkan Peraturan Gubernur Kalimantan Timur yang mengatur tentang kedudukan, susunan organisasi, tugas dan fungsi, serta tata kerja perangkat daerah.
                    </p>

                    {{-- Bagan Struktur Organisasi --}}
                    <div class="bg-white/5 p-4 rounded-3xl border border-white/10 overflow-hidden relative group mb-10">
                        <div class="absolute top-4 right-4 z-10">
                            <span class="px-3 py-1 bg-black/40 backdrop-blur-md text-white/80 text-xs font-bold rounded-full border border-white/20 shadow-sm opacity-0 group-hover:opacity-100 transition-opacity cursor-default">
                                Bagan Utama
                            </span>
                        </div>
                        
                        <div class="aspect-video bg-white/5 rounded-2xl flex flex-col items-center justify-center border border-dashed border-white/20 relative overflow-hidden">
                            <svg class="w-16 h-16 text-emerald-400/50 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-white/60 font-heading font-bold">Gambar Struktur Organisasi</p>
                            
                            <img src="{{ asset('img/struktur-organisasi.png') }}" alt="Bagan Struktur Organisasi" class="absolute inset-0 w-full h-full object-contain bg-white/10 backdrop-blur-sm z-10" onerror="this.style.display='none';">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-xl font-heading font-bold text-white border-l-4 border-emerald-400 pl-4">Susunan Bidang</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-5 rounded-2xl border border-white/10 bg-white/5 hover:border-emerald-400/40 hover:bg-white/10 transition-colors">
                                <div class="font-heading font-bold text-emerald-400 mb-1">Sekretariat</div>
                                <p class="text-sm text-white/70">Membawahi Sub Bagian Perencanaan Program, Sub Bagian Keuangan, dan Sub Bagian Umum & Kepegawaian.</p>
                            </div>
                            <div class="p-5 rounded-2xl border border-white/10 bg-white/5 hover:border-emerald-400/40 hover:bg-white/10 transition-colors">
                                <div class="font-heading font-bold text-emerald-400 mb-1">Bidang Pajak Daerah</div>
                                <p class="text-sm text-white/70">Mengelola pemungutan dan administrasi pajak daerah Provinsi (PKB, BBNKB, PBBKB, dll).</p>
                            </div>
                            <div class="p-5 rounded-2xl border border-white/10 bg-white/5 hover:border-emerald-400/40 hover:bg-white/10 transition-colors">
                                <div class="font-heading font-bold text-emerald-400 mb-1">Bidang Retribusi dan PAD Lainnya</div>
                                <p class="text-sm text-white/70">Mengkoordinasikan pungutan retribusi daerah dan pendapatan asli daerah lainnya yang sah.</p>
                            </div>
                            <div class="p-5 rounded-2xl border border-white/10 bg-white/5 hover:border-emerald-400/40 hover:bg-white/10 transition-colors">
                                <div class="font-heading font-bold text-emerald-400 mb-1">Bidang Pengendalian dan Evaluasi</div>
                                <p class="text-sm text-white/70">Melakukan monitoring, evaluasi, dan pengendalian penerimaan pajak dan retribusi daerah.</p>
                            </div>
                            <div class="p-5 rounded-2xl border border-white/10 bg-white/5 hover:border-emerald-400/40 hover:bg-white/10 transition-colors md:col-span-2">
                                <div class="font-heading font-bold text-emerald-400 mb-1">Unit Pelaksana Teknis Daerah (UPTD)</div>
                                <p class="text-sm text-white/70">Pelaksana operasional pelayanan di Kabupaten/Kota se-Kalimantan Timur (Samsat).</p>
                            </div>
                        </div>
                    </div>

                </div>
            </article>
        </div>
    </div>
</section>

@endsection
