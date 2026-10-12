@extends('layouts.portal')
@section('title', 'Peraturan Gubernur (Pergub)')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Regulasi', 'url' => '#'],
        ['label' => 'Peraturan Gubernur', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Peraturan Gubernur" :breadcrumbs="$breadcrumbs" />

{{-- KONTEN & SIDEBAR --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">

        {{-- PANEL UTAMA --}}
        <article class="reveal">
            
            <div class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12 mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-light text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Produk Hukum
                </div>

                <h1 class="text-3xl md:text-4xl font-heading font-black leading-tight text-text-base mb-8">
                    Peraturan Gubernur (Pergub)
                </h1>
                
                <div class="h-px bg-border-base mb-10 w-full"></div>

                <div class="text-center py-16 bg-bg-base rounded-2xl border border-border-base border-dashed">
                    <div class="w-16 h-16 rounded-full bg-surface text-text-muted flex items-center justify-center mx-auto mb-4 shadow-sm border border-border-base">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-text-base mb-2">Dokumen Sedang Disiapkan</h3>
                    <p class="font-body text-text-muted text-sm max-w-md mx-auto">Dokumen produk hukum terkait Peraturan Gubernur akan segera tersedia untuk dapat diunduh.</p>
                </div>
            </div>

        </article>

        {{-- SIDEBAR NAVIGASI --}}
        @include('portal.informasi.partials.sidebar')

    </div>
</div>

@endsection
