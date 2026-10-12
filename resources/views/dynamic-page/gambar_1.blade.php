@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@push('styles')
    <style>
        .struktur-content img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: .75rem;
        }

        .struktur-content p {
            margin: 0;
        }

        .struktur-content {
            line-height: 0;
        }
    </style>
@endpush

@section('content')
    <section class="relative min-h-screen overflow-hidden flex items-center bg-[#0c1e33]">
        <img src="{{ asset('images/background.jpg') }}"
            class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none scale-110 opacity-10" alt="Background">
        <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#00c458]/5 rounded-full blur-[120px]"></div>

        <div class="container mx-auto px-6 relative z-10 pt-32 pb-16">
            <!-- Page Title -->
            <div class="text-center mb-12 reveal">
                @if($page->hero_badge)
                    <span
                        class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-6 tracking-[0.2em] uppercase">
                        {{ $page->hero_badge }}
                    </span>
                @endif
                @php
                    $titleWordsG1 = explode(' ', $page->title);
                    $lastWordG1 = array_pop($titleWordsG1);
                    $firstWordsG1 = implode(' ', $titleWordsG1);
                @endphp
                <h2
                    class="text-4xl md:text-6xl font-black text-white px-2 font-montserrat uppercase tracking-tight leading-[1.1] mb-4">
                    {{ $firstWordsG1 }}
                    @if($lastWordG1)
                        <span class="text-[#00c458]">{{ $lastWordG1 }}</span>
                    @endif
                </h2>
                @if(!empty($content['subtitle']))
                    <p class="text-white/60 text-sm md:text-base max-w-xl mx-auto">{{ $content['subtitle'] }}</p>
                @endif
            </div>

            <!-- Image Card -->
            @if(!empty($content['image']))
                <div class="reveal max-w-5xl mx-auto" style="animation-delay: 0.2s;">
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-[#00c458]/10 rounded-[2.5rem] blur-xl opacity-50 group-hover:opacity-75 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-white/10 backdrop-blur-xl rounded-[2rem] p-4 md:p-6 border border-white/20 hover:border-emerald-400/40 transition-all duration-500 shadow-2xl shadow-black/20 overflow-hidden">
                            <div
                                class="absolute -top-32 -right-32 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                            </div>
                            <div class="relative rounded-2xl overflow-hidden bg-white p-3 md:p-4 shadow-inner">
                                <div
                                    class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-gradient-to-r from-transparent via-emerald-500 to-transparent rounded-full">
                                </div>
                                <div class="struktur-content w-full">
                                    <img src="{{ asset('storage/' . $content['image']) }}" alt="{{ $page->title }}"
                                        class="w-full h-auto rounded-xl">
                                </div>
                            </div>
                            @if(!empty($content['caption']))
                                <div class="mt-6 text-center">
                                    <div class="inline-flex items-center gap-3">
                                        <div class="w-8 h-0.5 bg-gradient-to-r from-transparent to-emerald-400/50 rounded-full">
                                        </div>
                                        <p class="text-sm text-white/70 font-inter font-medium">{{ $content['caption'] }}</p>
                                        <div class="w-8 h-0.5 bg-gradient-to-l from-transparent to-emerald-400/50 rounded-full">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20 text-white/40">
                    <p class="font-bold uppercase tracking-widest">Gambar belum diunggah.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
