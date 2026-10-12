@extends('layouts.portal')
@section('title', 'Tentang Bapenda')

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
                Sejarah Singkat
            </span>
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-heading uppercase tracking-tight leading-[1.1] mb-4 reveal">
                Tentang <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Bapenda</span>
            </h2>
            <p class="text-white/60 text-sm md:text-base font-body max-w-xl mx-auto reveal">
                Mengenal lebih dekat profil, peran, dan tugas Badan Pendapatan Daerah Provinsi Kalimantan Timur.
            </p>
        </div>

        <div class="max-w-5xl mx-auto reveal">
            <!-- PANEL UTAMA -->
            <article class="bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 p-6 md:p-12 shadow-2xl">
                
                <div class="portal-prose max-w-none text-white/90 font-body leading-relaxed md:text-lg space-y-6">
                    
                    <p>
                        Badan Pendapatan Daerah (Bapenda) Provinsi Kalimantan Timur dibentuk berdasarkan Peraturan Daerah Provinsi Kalimantan Timur Nomor 9 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah Provinsi Kalimantan Timur, dan dijabarkan lebih lanjut dengan Peraturan Gubernur Kalimantan Timur.
                    </p>

                    <p>
                        Bapenda memiliki peran strategis sebagai unsur pelaksana urusan pemerintahan di bidang pendapatan daerah yang menjadi kewenangan daerah provinsi. Tugas utama Bapenda meliputi perumusan kebijakan, koordinasi, pelaksanaan, pembinaan, pengawasan, dan pelaporan penyelenggaraan pendapatan daerah.
                    </p>

                    <div class="bg-gradient-to-r from-emerald-500/20 to-transparent p-6 md:p-8 rounded-2xl border-l-4 border-emerald-400 my-8 relative overflow-hidden">
                        <!-- Decorative bg logo -->
                        <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-emerald-400/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        
                        <p class="font-heading font-black text-xl text-emerald-400 mb-3 relative z-10">Tugas Pokok</p>
                        <p class="text-white/90 m-0 relative z-10 leading-relaxed">Melaksanakan fungsi penunjang urusan pemerintahan di bidang pendapatan daerah yang menjadi kewenangan Daerah meliputi pemungutan, penagihan, dan pengawasan pajak dan retribusi daerah, serta pendapatan lain-lain yang sah.</p>
                    </div>

                    <p>
                        Dalam menjalankan tugasnya, Badan Pendapatan Daerah didukung oleh beberapa Unit Pelaksana Teknis Daerah (UPTD) Pelayanan Pajak dan Retribusi Daerah (PPRD) yang tersebar di wilayah kabupaten/kota se-Kalimantan Timur untuk mempermudah dan mendekatkan pelayanan kepada masyarakat dalam memenuhi kewajiban perpajakan daerahnya.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                        <div class="bg-white/5 rounded-2xl p-6 border border-white/10 shadow-lg hover:border-emerald-400/40 hover:bg-white/10 transition-colors group">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-white mb-3">Pajak Daerah</h3>
                            <p class="text-sm text-white/70 leading-relaxed">Mengelola Pajak Kendaraan Bermotor (PKB), Bea Balik Nama Kendaraan Bermotor (BBNKB), Pajak Bahan Bakar Kendaraan Bermotor (PBBKB), Pajak Air Permukaan (PAP), dan Pajak Rokok.</p>
                        </div>
                        <div class="bg-white/5 rounded-2xl p-6 border border-white/10 shadow-lg hover:border-emerald-400/40 hover:bg-white/10 transition-colors group">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-white mb-3">Retribusi Daerah</h3>
                            <p class="text-sm text-white/70 leading-relaxed">Mengkoordinasikan dan mengoptimalkan penerimaan daerah yang bersumber dari retribusi jasa umum, jasa usaha, dan perizinan tertentu.</p>
                        </div>
                    </div>

                </div>
            </article>
        </div>
    </div>
</section>

@endsection
