@extends('layouts.portal')
@section('title', 'FAQ UPTD — Bapenda Kaltim')

@section('content')
<div class="container mx-auto max-w-3xl py-16 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">FAQ UPTD: {{ strtoupper($slug) }}</h1>
    @if($faqs->count())
        <div class="space-y-4" x-data="{ open: null }">
            @foreach($faqs as $i => $faq)
                <div :class="open === {{ $i }} ? 'shadow-2xl border-primary/60 ring-2 ring-primary/20' : 'shadow-sm border-gray-200'" class="border rounded-xl bg-white overflow-hidden transition-all duration-300">
                    <button type="button"
                        class="w-full flex items-center justify-between text-left font-semibold text-lg px-6 py-5 focus:outline-none hover:bg-primary/5 focus:bg-primary/10 transition group"
                        @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                        :aria-expanded="open === {{ $i }} ? 'true' : 'false'"
                        :aria-controls="'faq-panel-{{ $i }}'"
                    >
                        <span class="transition-colors duration-200 group-hover:text-primary group-focus:text-primary">{{ $faq->question }}</span>
                        <svg :class="open === {{ $i }} ? 'rotate-180 text-primary' : 'text-gray-400'" class="w-7 h-7 ml-4 transition-transform duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq-panel-{{ $i }}"
                        x-show="open === {{ $i }}"
                        x-transition:enter="transition-all ease-out duration-400"
                        x-transition:enter-start="opacity-0 max-h-0 scale-y-75"
                        x-transition:enter-end="opacity-100 max-h-96 scale-y-100"
                        x-transition:leave="transition-all ease-in duration-300"
                        x-transition:leave-start="opacity-100 max-h-96 scale-y-100"
                        x-transition:leave-end="opacity-0 max-h-0 scale-y-75"
                        class="px-6 pb-5 text-gray-700 text-base bg-gray-50 border-t border-gray-100 origin-top"
                        style="display: none; overflow: hidden;"
                    >
                        <div class="animate-fadein">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada FAQ untuk UPTD ini.</p>
    @endif
</div>
@endsection

{{-- Pastikan variabel $identity dan $menus dikirim dari controller agar layout tidak error --}}
@php /** @var \App\Models\WebsiteIdentity|null $identity */ @endphp
@php /** @var \Illuminate\Support\Collection|array|null $menus */ @endphp
