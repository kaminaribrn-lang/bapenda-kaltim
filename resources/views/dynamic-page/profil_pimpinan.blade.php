@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@section('content')
<section class="relative min-h-screen font-inter text-white pb-24 bg-[#0c1e33]">
    <!-- Background -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/background.jpg') }}" class="w-full h-full object-cover opacity-10" alt="">
        <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    </div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-40 right-10 w-96 h-96 bg-[#00c458]/5 rounded-full blur-[120px]"></div>

    <div class="container mx-auto px-4 relative z-10 pt-32">

        <!-- Page Header -->
        <div class="text-center mb-16 relative">
            @if($page->hero_badge)
            <span class="inline-block px-5 py-1.5 bg-white/5 border border-white/10 rounded-full text-[10px] md:text-xs text-white/80 uppercase font-bold tracking-[0.2em] mb-6">
                {{ $page->hero_badge }}
            </span>
            @endif
            @php
                $titleWords = explode(' ', $page->title);
                $lastWord = array_pop($titleWords);
                $firstWords = implode(' ', $titleWords);
            @endphp
            <h2 class="text-4xl md:text-6xl font-black text-white px-2 font-montserrat uppercase tracking-tight leading-[1.1] mb-4">
                {{ $firstWords }}
                @if($lastWord)
                    <span class="text-[#00c458]">{{ $lastWord }}</span>
                @endif
            </h2>
            @if(!empty($content['subtitle']))
            <p class="text-white/60 text-sm md:text-base font-inter max-w-xl mx-auto">
                {{ $content['subtitle'] }}
            </p>
            @endif
        </div>

        @if(empty($content['leaders']))
            {{-- Fallback jika belum ada data --}}
            <div class="max-w-xl mx-auto text-center py-16">
                <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="text-white/50 italic">Data profil pimpinan belum tersedia. Silakan isi form di Admin Panel.</p>
            </div>
        @else
            {{-- Loop semua pimpinan --}}
            @foreach($content['leaders'] as $index => $leader)
            @php
                $photo = !empty($leader['photo'])
                    ? asset('storage/' . $leader['photo'])
                    : asset('images/kepala inspektorat.png');
                $isFirst = $index === 0;
            @endphp

            {{-- Card Pimpinan --}}
            <div class="max-w-4xl mx-auto {{ $isFirst ? 'mb-16' : 'mb-12' }}">
                <div class="bg-white/10 backdrop-blur-xl rounded-[2rem] border border-white/20 overflow-hidden shadow-2xl">
                    <div class="flex flex-col lg:flex-row {{ $index % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">

                        {{-- Foto --}}
                        <div class="lg:w-2/5 relative">
                            <div class="aspect-[3/4] lg:aspect-auto lg:h-full min-h-[320px]">
                                <img src="{{ $photo }}"
                                     alt="{{ $leader['name'] ?? '' }}"
                                     class="w-full h-full object-cover object-top"
                                     onerror="this.src='{{ asset('images/kepala inspektorat.png') }}'">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                            </div>
                            {{-- Badge label --}}
                            @if(!empty($leader['label']))
                            <div class="absolute top-4 left-4">
                                <div class="bg-emerald-500/90 backdrop-blur-md px-4 py-2 rounded-xl">
                                    <span class="text-white text-[10px] font-black uppercase tracking-widest">{{ $leader['label'] }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="lg:w-3/5 p-6 md:p-10 flex flex-col justify-center">
                            <div class="mb-6">
                                <h3 class="text-2xl md:text-3xl font-black text-white font-montserrat uppercase tracking-tight mb-1">
                                    {{ $leader['name'] ?? 'Data Kosong' }}
                                </h3>
                                <p class="text-[#00c458] text-sm font-bold uppercase tracking-widest mb-4">
                                    {{ $leader['position'] ?? '' }}
                                </p>
                                <div class="w-16 h-1 bg-[#00c458] rounded-full"></div>
                            </div>

                            {{-- Detail: NIP, Pangkat, Golongan, Pendidikan --}}
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                @if(!empty($leader['nip']))
                                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                    <span class="text-emerald-400/70 text-[10px] font-bold uppercase tracking-widest">NIP</span>
                                    <p class="text-white font-semibold mt-1 text-sm">{{ $leader['nip'] }}</p>
                                </div>
                                @endif
                                @if(!empty($leader['pangkat']))
                                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                    <span class="text-emerald-400/70 text-[10px] font-bold uppercase tracking-widest">Pangkat</span>
                                    <p class="text-white font-semibold mt-1 text-sm">{{ $leader['pangkat'] }}</p>
                                </div>
                                @endif
                                @if(!empty($leader['golongan']))
                                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                    <span class="text-emerald-400/70 text-[10px] font-bold uppercase tracking-widest">Golongan</span>
                                    <p class="text-white font-semibold mt-1 text-sm">{{ $leader['golongan'] }}</p>
                                </div>
                                @endif
                                @if(!empty($leader['pendidikan']))
                                <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                    <span class="text-emerald-400/70 text-[10px] font-bold uppercase tracking-widest">Pendidikan</span>
                                    <p class="text-white font-semibold mt-1 text-sm">{{ $leader['pendidikan'] }}</p>
                                </div>
                                @endif
                            </div>



                            {{-- Quote/Motto --}}
                            @if(!empty($leader['quote']))
                            @php
                                $cleanQuote = trim($leader['quote']);
                                $cleanQuote = preg_replace('/^\*+|\*+$/', '', $cleanQuote); // strip ** markers
                                $cleanQuote = trim($cleanQuote, '"\''); // strip existing quotes
                                $cleanQuote = trim($cleanQuote);
                            @endphp
                            <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 rounded-xl p-5 border border-emerald-400/20 relative">
                                <svg class="absolute top-3 left-3 w-7 h-7 text-emerald-500/30" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                <p class="text-white/80 text-sm italic leading-relaxed pl-7">
                                    "{{ $cleanQuote }}"
                                </p>
                                @if(!empty($leader['name']))
                                <p class="text-[#00c458] text-xs font-semibold mt-3 pl-7">— {{ $leader['name'] }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Riwayat Jabatan (timeline) --}}
                @if(!empty($leader['histories']) && count($leader['histories']) > 0)
                <div class="mt-8 bg-white/5 backdrop-blur-md rounded-[1.5rem] border border-white/10 p-6 md:p-8">
                    <h4 class="text-lg font-black text-white font-montserrat uppercase tracking-tight mb-8 text-center">
                        Riwayat <span class="text-emerald-400">Jabatan</span>
                    </h4>

                    <div class="relative">
                        {{-- Garis timeline --}}
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-emerald-500/30 transform md:-translate-x-1/2"></div>

                        <div class="space-y-6">
                            @foreach(collect($leader['histories'])->sortByDesc('year_start') as $hi => $history)
                            @php $isLeft = $hi % 2 === 0; @endphp
                            <div class="relative flex items-start gap-6 md:gap-0">
                                {{-- Dot --}}
                                <div class="absolute left-4 md:left-1/2 w-3 h-3 rounded-full transform md:-translate-x-1/2 mt-1.5 ring-4 ring-slate-900
                                    {{ !empty($history['is_current']) && $history['is_current'] ? 'bg-emerald-400' : 'bg-emerald-600/60' }}"></div>

                                {{-- Konten (kiri/kanan berselang-seling di desktop) --}}
                                <div class="ml-12 md:ml-0
                                    {{ $isLeft ? 'md:w-1/2 md:pr-12 md:text-right' : 'md:w-1/2 md:ml-auto md:pl-12' }}">
                                    <span class="text-emerald-400 text-xs font-bold">
                                        {{ $history['year_start'] ?? '' }}{{ !empty($history['year_end']) ? ' - ' . $history['year_end'] : ' - Sekarang' }}
                                    </span>
                                    <h5 class="text-white font-bold mt-0.5">{{ $history['position'] ?? '' }}</h5>
                                    @if(!empty($history['institution']))
                                    <p class="text-white/60 text-sm mt-0.5">{{ $history['institution'] }}</p>
                                    @endif
                                    @if(!empty($history['description']))
                                    <p class="text-white/50 text-xs mt-1 italic">{{ $history['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        @endif

    </div>
</section>

<style>
    .font-inter { font-family: 'Inter', sans-serif; }
    html, body { overflow-y: auto !important; height: auto !important; position: static !important; background-color: #0c1e33; }
</style>
@endsection
