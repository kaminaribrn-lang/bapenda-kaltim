@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@push('styles')
<style>
/* ===== PROSE CONTENT TYPOGRAPHY ===== */
.prose-editor {
    font-size: 1rem;
    line-height: 1.8;
    color: #334155;
}
.prose-editor img {
    max-width: 100%;
    height: auto;
    border-radius: 0.875rem;
    margin: 1.75rem auto;
    display: block;
    box-shadow: 0 4px 20px rgba(0,0,0,0.10);
}
.prose-editor h1, .prose-editor h2, .prose-editor h3, .prose-editor h4 {
    font-weight: 800;
    font-family: 'Montserrat', sans-serif;
    color: #0f172a;
    line-height: 1.3;
    margin-top: 2em;
    margin-bottom: 0.6em;
}
.prose-editor h1 { font-size: 2.25rem; }
.prose-editor h2 {
    font-size: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e2e8f0;
}
.prose-editor h3 { font-size: 1.2rem; color: #1e293b; }
.prose-editor p {
    margin-bottom: 1.35em;
    color: #475569;
}
.prose-editor a {
    color: #059669;
    font-weight: 600;
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: color 0.2s;
}
.prose-editor a:hover { color: #047857; }
.prose-editor ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5em 0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.prose-editor ul li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #475569;
    line-height: 1.6;
}
.prose-editor ul li::before {
    content: '';
    flex-shrink: 0;
    margin-top: 0.55em;
    width: 0.4rem;
    height: 0.4rem;
    border-radius: 50%;
    background-color: #10b981;
}
.prose-editor ol {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5em 0;
    counter-reset: prose-counter;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.prose-editor ol li {
    counter-increment: prose-counter;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #475569;
    line-height: 1.6;
}
.prose-editor ol li::before {
    content: counter(prose-counter);
    flex-shrink: 0;
    min-width: 1.6rem;
    height: 1.6rem;
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 800;
    border-radius: 0.35rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 0.1em;
}
.prose-editor blockquote {
    border: none;
    background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
    border-left: 4px solid #10b981;
    border-radius: 0 1rem 1rem 0;
    padding: 1.25rem 1.5rem;
    font-style: italic;
    color: #0f766e;
    margin: 1.5em 0;
    font-weight: 500;
}
.prose-editor table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5em;
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 1px 6px rgba(0,0,0,0.06);
}
.prose-editor thead tr { background: linear-gradient(135deg, #0f766e, #059669); }
.prose-editor thead th { color: #fff; font-weight: 700; padding: 0.75rem 1rem; text-align: left; font-size: 0.875rem; }
.prose-editor tbody tr:nth-child(odd) { background-color: #f8fafc; }
.prose-editor tbody tr:nth-child(even) { background-color: #ffffff; }
.prose-editor tbody td { padding: 0.75rem 1rem; color: #475569; font-size: 0.9rem; border-bottom: 1px solid #f1f5f9; }
.prose-editor strong { color: #1e293b; font-weight: 700; }
.prose-editor hr {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent, #10b981, transparent);
    margin: 2.5em 0;
    border-radius: 2px;
}

/* ===== HERO ===== */
.blank-hero {
    position: relative;
    height: 380px;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    background-color: #0c1e33;
}
.blank-hero-content {
    position: relative;
    z-index: 10;
    text-align: center;
    padding: 0 1.5rem 3.5rem;
}
</style>
@endpush

@section('content')

@php
    $titleWords = explode(' ', $page->title);
    $lastWord = array_pop($titleWords);
    $restTitle = implode(' ', $titleWords);
@endphp

{{-- ===== HERO BANNER ===== --}}
<section class="blank-hero">
    {{-- BG Image --}}
    <img src="{{ asset('images/background.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none scale-105 opacity-20" alt="Background">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    {{-- Glow accents --}}
    <div class="absolute top-10 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#00c458]/5 rounded-full blur-[100px] pointer-events-none"></div>

    {{-- Text --}}
    <div class="blank-hero-content">
        @if($page->hero_badge)
        <span class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-5 tracking-[0.2em] uppercase">
            {{ $page->hero_badge }}
        </span>
        @endif

        <h2 class="text-3xl md:text-5xl font-black font-montserrat uppercase tracking-tight leading-tight drop-shadow-md">
            <span class="text-white">{{ $restTitle }}</span>@if($restTitle) @endif<span class="text-[#00c458]">{{ $lastWord }}</span>
        </h2>
    </div>
</section>

{{-- ===== CONTENT ===== --}}
<section class="relative bg-[#fafbfc] pb-20">
    <div class="container mx-auto px-4 md:px-6 relative z-10">

        {{-- Card --}}
        <div class="max-w-4xl mx-auto -mt-10 relative">
            {{-- Card shadow glow --}}
            <div class="absolute inset-x-4 -bottom-3 h-10 bg-[#00c458]/10 blur-xl rounded-full"></div>

            <div class="relative bg-white rounded-3xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-slate-100/80">

                {{-- Top accent border --}}
                <div class="h-1 w-full bg-gradient-to-r from-[#0c1e33] via-[#00c458] to-[#0c1e33]"></div>

                {{-- Corner dots decoration --}}
                <div class="absolute top-5 left-5 w-2 h-2 rounded-full bg-[#00c458]/40"></div>
                <div class="absolute top-5 right-5 w-2 h-2 rounded-full bg-[#00c458]/40"></div>

                {{-- Content Area --}}
                <div class="px-6 py-10 md:px-14 md:py-14">
                    <article class="prose-editor font-inter">
                        {!! filled($content['editor'] ?? null) ? \App\Support\RichContent::html($content['editor']) : '<p class="text-slate-400 text-sm italic text-center py-12">Konten halaman belum diisi.</p>' !!}
                    </article>
                </div>


            </div>
        </div>

    </div>
</section>

@endsection
