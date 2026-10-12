@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', 'Aparatur - Bapenda Provinsi Kalimantan Timur')

@section('content')
    <!-- 1. HERO SECTION (Dark Navy matching Bapenda Website) -->
    <section class="relative h-[450px] overflow-hidden flex flex-col items-center justify-center bg-[#0c1e33]">
        <!-- Subtle gradient overlay to give depth -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>

        <!-- Decorative Subtle Blur Elements (Green accents like the website) -->
        <div class="absolute top-10 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[80px] pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#00c458]/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="relative z-10 text-center px-4 -mt-16 reveal">
            @if($page->hero_badge)
                <span
                    class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-6 tracking-[0.2em] uppercase">
                    {{ $page->hero_badge }}
                </span>
            @endif
            @php
                $titleWordsAp = explode(' ', $page->title);
                $lastWordAp = array_pop($titleWordsAp);
                $firstWordsAp = implode(' ', $titleWordsAp);
            @endphp
            <h2
                class="text-4xl md:text-6xl font-black text-white px-2 font-montserrat tracking-tight leading-[1.1] mb-4 drop-shadow-md">
                {{ $firstWordsAp }}
                @if($lastWordAp)
                    <span class="text-[#00c458]">{{ $lastWordAp }}</span>
                @endif
            </h2>
            @if(!empty($content['subtitle']))
                <p class="text-slate-300 text-sm md:text-base font-inter max-w-xl mx-auto">
                    {{ $content['subtitle'] }}
                </p>
            @endif
        </div>
    </section>

    <!-- 2. CONTENT SECTION (Clean White Background) -->
    <section class="relative font-inter pb-24 bg-[#fafbfc]">
        
        <div class="container mx-auto px-4 relative z-10 -mt-24 flex flex-col items-center">

            @php
                $mainLeader = $content['main_leader'] ?? [];
                $aparaturs = $content['aparaturs'] ?? [];
            @endphp

            <!-- THE CHART AREA -->
            <div class="w-full max-w-5xl py-4">

                <!-- 1. TOP LEADER -->
                <div class="flex flex-col items-center mb-16 px-4">
                    @php
                        $hasLeaderPhoto = !empty($mainLeader['photo']);
                        $leaderName = !empty($mainLeader['name']) ? $mainLeader['name'] : ($identity->name ?? 'Pimpinan Bapenda');
                    @endphp
                    <!-- Card lifted up into the hero -->
                    <div class="bg-white p-3 rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-slate-100/50 overflow-hidden hover:shadow-[0_20px_40px_rgba(0,196,88,0.1)] hover:-translate-y-2 transition-all duration-300 group"
                        style="width: 290px;">
                        <div class="w-full bg-slate-50 rounded-xl overflow-hidden relative border border-slate-100/50">

                            @if($hasLeaderPhoto)
                                <img src="{{ asset('storage/' . $mainLeader['photo']) }}" alt="{{ $leaderName }}"
                                    class="w-full h-56 object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('images/no-photo.png') }}" alt="{{ $leaderName }}"
                                    class="w-full h-56 object-cover object-center opacity-40 group-hover:scale-105 transition-transform duration-500">
                            @endif

                            <div class="bg-gradient-to-t from-white via-white/95 to-transparent p-5 pt-12 relative z-10 -mt-10">
                                <h3 class="text-base font-black uppercase text-[#0c1e33] leading-tight text-center mb-1">
                                    {{ $leaderName }}
                                </h3>
                                @if(!empty($mainLeader['nip']))
                                    <p class="text-slate-400 text-[10px] text-center mb-2 font-semibold">NIP: {{ $mainLeader['nip'] }}</p>
                                @endif
                                <div class="w-10 h-1 bg-[#00c458] mx-auto my-3 rounded-full"></div>
                                <p class="text-sm text-[#00c458] font-black tracking-wider uppercase text-center">
                                    {{ !empty($mainLeader['position']) ? $mainLeader['position'] : 'KEPALA BAPENDA' }}
                                </p>
                                @if(!empty($mainLeader['pangkat']))
                                    <p class="text-slate-500 text-xs text-center mt-2 font-medium">Pangkat: {{ $mainLeader['pangkat'] }}</p>
                                @endif
                                @if(!empty($mainLeader['golongan']))
                                    <p class="text-slate-500 text-xs text-center font-medium">Golongan: {{ $mainLeader['golongan'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. STAFF GRID -->
                @if(count($aparaturs) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full max-w-7xl px-4 pb-12">
                        @foreach($aparaturs as $ap)
                            @php
                                $hasApPhoto = !empty($ap['photo']);
                                $apName = $ap['name'] ?? '-';
                            @endphp
                            <div class="flex justify-center">
                                <div class="bg-white p-2.5 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-slate-100/50 hover:border-[#00c458]/20 transition-all duration-300 overflow-hidden w-full max-w-[260px] hover:shadow-[0_15px_30px_rgba(0,196,88,0.08)] hover:-translate-y-1 group">
                                    <div class="w-full bg-slate-50 rounded-xl overflow-hidden relative border border-slate-50">

                                        @if($hasApPhoto)
                                            <img src="{{ asset('storage/' . $ap['photo']) }}"
                                                class="w-full h-44 object-cover object-top group-hover:scale-105 transition-transform duration-500" alt="{{ $apName }}">
                                        @else
                                            <img src="{{ asset('images/no-photo.png') }}" alt="{{ $apName }}"
                                                class="w-full h-44 object-cover object-center opacity-40 group-hover:scale-105 transition-transform duration-500">
                                        @endif

                                        <div class="bg-gradient-to-t from-white via-white/95 to-transparent p-4 pt-8 relative z-10 -mt-6">
                                            <h4 class="text-sm font-bold text-[#0c1e33] leading-tight text-center mb-1">{{ $apName }}</h4>
                                            <div class="w-8 h-0.5 bg-[#00c458]/60 mx-auto my-2 rounded-full"></div>
                                            @if(!empty($ap['position']))
                                                <p class="text-[11px] text-[#00c458] font-black uppercase text-center mb-3">
                                                    {{ $ap['position'] }}</p>
                                            @endif
                                            <div class="space-y-1 text-center text-[10px]">
                                                @if(!empty($ap['pangkat']))
                                                    <p class="text-slate-500 font-medium"><span class="text-slate-400">Pangkat:</span> {{ $ap['pangkat'] }}</p>
                                                @endif
                                                @if(!empty($ap['golongan']))
                                                    <p class="text-slate-500 font-medium"><span class="text-slate-400">Golongan:</span> {{ $ap['golongan'] }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Placeholder if no data -->
                    <div class="col-span-full text-center py-20 text-slate-400">
                        <p class="font-bold uppercase tracking-widest">Belum ada data staf aparatur yang ditambahkan.</p>
                    </div>
                @endif
            </div>

            <!-- Footer Info -->
            <div class="mt-12 text-center opacity-40">
                <p class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-500">Struktur Organisasi &bull; Bapenda Provinsi Kalimantan Timur</p>
            </div>

        </div>
    </section>

    <style>
        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            overflow-y: auto !important;
            height: auto !important;
            position: static !important;
            background-color: #fafbfc;
        }
    </style>
@endsection
