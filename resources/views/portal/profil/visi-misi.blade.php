@extends('layouts.portal')
@section('title', 'Visi & Misi')

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
        <div class="text-center mb-16 reveal active">
            <span class="inline-block px-5 py-2 bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 text-emerald-400 text-[10px] md:text-xs font-black rounded-full mb-6 tracking-[0.3em] uppercase shadow-lg shadow-emerald-500/10">
                Profil Instansi
            </span>
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-heading uppercase tracking-tight leading-[1.1] mb-4">
                Visi & <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Misi</span>
            </h2>
            <p class="text-white/60 text-sm md:text-base font-body max-w-xl mx-auto">
                Arah kebijakan dan tujuan utama Badan Pendapatan Daerah Provinsi Kalimantan Timur
            </p>
        </div>

        <!-- Two Boxes Layout -->
        <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Visi Box -->
            <div class="reveal group active">
                <div class="relative bg-white/10 backdrop-blur-xl rounded-[2rem] p-8 md:p-10 border border-white/20 hover:border-emerald-400/40 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/10 overflow-hidden h-full flex flex-col justify-center">
                    <!-- Glow Effect on Hover -->
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-emerald-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <h3 class="text-2xl md:text-3xl font-black text-white font-heading uppercase tracking-tight mb-6 text-center">
                        Visi
                    </h3>
                    
                    <div class="w-16 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full mx-auto mb-8"></div>
                    
                    <p class="text-white/90 text-2xl md:text-4xl leading-snug font-heading font-bold text-center italic drop-shadow-lg">
                        "Berani untuk Kalimantan Timur Berdaulat"
                    </p>
                </div>
            </div>

            <!-- Misi Box -->
            <div class="reveal group active" style="animation-delay: 0.2s;">
                <div class="relative bg-white/10 backdrop-blur-xl rounded-[2rem] p-8 md:p-10 border border-white/20 hover:border-emerald-400/40 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/10 overflow-hidden h-full">
                    <!-- Glow Effect on Hover -->
                    <div class="absolute -top-20 -left-20 w-40 h-40 bg-teal-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <h3 class="text-2xl md:text-3xl font-black text-white font-heading uppercase tracking-tight mb-6 text-center">
                        Misi
                    </h3>
                    
                    <div class="w-16 h-1 bg-gradient-to-r from-teal-400 to-emerald-400 rounded-full mx-auto mb-8"></div>
                    
                    <ul class="space-y-4 rounded-[1.5rem] bg-white p-6 md:p-8 shadow-xl shadow-slate-950/10">
                        <li class="flex gap-4 items-start">
                            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-black flex items-center justify-center shrink-0 mt-0.5 text-xs">1</span>
                            <p class="text-slate-900 text-sm md:text-base leading-relaxed font-body">Berdaulat dalam pembangunan sumber daya manusia yang berakhlak mulia dan berdaya saing, terutama perempuan, pemuda dan penyandang disabilitas.</p>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-black flex items-center justify-center shrink-0 mt-0.5 text-xs">2</span>
                            <p class="text-slate-900 text-sm md:text-base leading-relaxed font-body">Berdaulat dalam pemberdayaan ekonomi wilayah dan ekonomi kerakyatan yang berkeadilan.</p>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-black flex items-center justify-center shrink-0 mt-0.5 text-xs">3</span>
                            <p class="text-slate-900 text-sm md:text-base leading-relaxed font-body">Berdaulat dalam memenuhi kebutuhan infrastruktur kewilayahan.</p>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-black flex items-center justify-center shrink-0 mt-0.5 text-xs">4</span>
                            <p class="text-slate-900 text-sm md:text-base leading-relaxed font-body">Berdaulat dalam pengelolaan sumber daya alam yang berkelanjutan.</p>
                        </li>
                        <li class="flex gap-4 items-start">
                            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-black flex items-center justify-center shrink-0 mt-0.5 text-xs">5</span>
                            <p class="text-slate-900 text-sm md:text-base leading-relaxed font-body">Berdaulat dalam mewujudkan birokrasi pemerintahan yang bersih, profesional dan berorientasi pelayanan publik.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
