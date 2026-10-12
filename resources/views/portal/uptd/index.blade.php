@extends('layouts.portal')
@section('title', 'UPTD Pelayanan Pajak')
@section('meta_desc', 'Unit Pelaksana Teknis Daerah Bapenda Kaltim di seluruh kabupaten dan kota se-Kalimantan Timur.')

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
                Jaringan Layanan
            </span>
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-heading uppercase tracking-tight leading-[1.1] mb-4 reveal">
                UPTD <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Pelayanan Pajak</span>
            </h2>
            <p class="text-white/60 text-sm md:text-base font-body max-w-xl mx-auto reveal">
                Unit Pelaksana Teknis Daerah Badan Pendapatan Daerah di seluruh kabupaten dan kota se-Kalimantan Timur.
            </p>
        </div>

        <div class="max-w-6xl mx-auto reveal">
            {{-- STATS ROW --}}
            <div class="grid grid-cols-3 gap-4 text-center mb-12">
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                    <div class="text-2xl md:text-4xl font-black text-emerald-400">{{ count($allUptds) }}</div>
                    <div class="text-[10px] md:text-xs text-white/50 font-bold uppercase tracking-widest mt-1">Unit UPTD</div>
                </div>
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                    <div class="text-2xl md:text-4xl font-black text-emerald-400">10</div>
                    <div class="text-[10px] md:text-xs text-white/50 font-bold uppercase tracking-widest mt-1">Kab/Kota</div>
                </div>
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                    <div class="text-2xl md:text-4xl font-black text-emerald-400">1</div>
                    <div class="text-[10px] md:text-xs text-white/50 font-bold uppercase tracking-widest mt-1">Provinsi</div>
                </div>
            </div>


            {{-- GRID UPTD CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($allUptds as $uptd)
                <div class="bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 overflow-hidden shadow-2xl hover:shadow-emerald-500/10 hover:border-emerald-400/40 transition-all duration-500 group flex flex-col">
                    {{-- Card Header --}}
                    <div class="px-6 pt-6 pb-4 border-b border-white/10 bg-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-400/20 uppercase tracking-widest">UPTD</span>
                        </div>
                        <h3 class="font-black text-white text-lg leading-tight group-hover:text-emerald-400 transition-colors uppercase tracking-tight">
                            UPTD {{ $uptd['name'] }}
                        </h3>
                    </div>

                    {{-- Card Body --}}
                    <div class="px-6 py-5 flex flex-col gap-4 flex-grow">
                        <div class="flex items-start gap-3 text-sm text-white/70 font-body">
                            <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="leading-relaxed">{{ $uptd['address'] }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-white/70 font-body">
                            <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            @if ($uptd['phone'] !== '-')
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $uptd['phone']) }}" class="hover:text-emerald-400 transition-colors">{{ $uptd['phone'] }}</a>
                            @else
                                <span>{{ $uptd['phone'] }}</span>
                            @endif
                        </div>
                        <div class="flex items-start gap-3 text-xs text-white/50 font-body">
                            <svg class="w-5 h-5 shrink-0 text-emerald-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $uptd['hours'] }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="px-6 pb-6">
                        <a href="{{ route('portal.uptd.show', ['website' => $website->slug, 'slug' => $uptd['slug']]) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-white/5 border border-white/10 text-white/80 text-xs font-black uppercase tracking-widest hover:bg-emerald-500 hover:text-white hover:border-emerald-400 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Kunjungi Beranda
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
