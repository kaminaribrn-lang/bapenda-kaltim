@extends('layouts.portal')
@section('title', 'Maklumat Layanan')

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
                Komitmen Kami
            </span>
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-heading uppercase tracking-tight leading-[1.1] mb-4 reveal">
                Maklumat <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Pelayanan</span>
            </h2>
            <p class="text-white/60 text-sm md:text-base font-body max-w-xl mx-auto reveal">
                Janji dan komitmen kuat kami untuk memberikan pelayanan publik yang berkualitas, transparan, dan akuntabel.
            </p>
        </div>

        <div class="max-w-5xl mx-auto reveal">
            <!-- PANEL UTAMA -->
            <article class="bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 p-6 md:p-12 shadow-2xl">
                
                <div class="portal-prose max-w-none text-white/90 font-body leading-relaxed md:text-lg">
                    
                    <div class="relative bg-gradient-to-br from-emerald-600 to-teal-700 text-white rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl shadow-emerald-900/50 transform transition-transform hover:scale-[1.01] duration-500 border border-emerald-400/30">
                        {{-- Decorative background --}}
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/20 rounded-full blur-3xl"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <svg class="w-16 h-16 text-emerald-200 mb-6 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>

                            <h2 class="text-2xl md:text-3xl font-heading font-black mb-8 leading-relaxed drop-shadow-md">
                                DENGAN INI KAMI MENYATAKAN SANGGUP MENYELENGGARAKAN PELAYANAN SESUAI STANDAR PELAYANAN YANG TELAH DITETAPKAN, DAN APABILA TIDAK MENEPATI JANJI INI, KAMI SIAP MENERIMA SANKSI SESUAI PERATURAN PERUNDANG-UNDANGAN YANG BERLAKU.
                            </h2>

                            <div class="w-20 h-1.5 bg-emerald-300 rounded-full mb-8 shadow-[0_0_10px_rgba(110,231,183,0.5)]"></div>

                            <p class="font-body text-lg font-medium text-white/90">
                                Kepala Badan Pendapatan Daerah<br>Provinsi Kalimantan Timur
                            </p>
                        </div>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center hover:bg-white/10 hover:border-emerald-400/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="font-heading font-bold text-white mb-2">Tepat Waktu</h3>
                            <p class="text-sm text-white/60 font-body">Berkomitmen menyelesaikan layanan sesuai dengan waktu yang telah ditentukan.</p>
                        </div>
                        <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center hover:bg-white/10 hover:border-emerald-400/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="font-heading font-bold text-white mb-2">Akurat & Pasti</h3>
                            <p class="text-sm text-white/60 font-body">Memberikan informasi dan hasil layanan yang akurat sesuai ketentuan perundangan.</p>
                        </div>
                        <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center hover:bg-white/10 hover:border-emerald-400/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="font-heading font-bold text-white mb-2">Ramah & Profesional</h3>
                            <p class="text-sm text-white/60 font-body">Melayani dengan senyum, sapa, salam, sopan, dan santun dalam bingkai integritas.</p>
                        </div>
                    </div>

                </div>
            </article>
        </div>
    </div>
</section>

@endsection
