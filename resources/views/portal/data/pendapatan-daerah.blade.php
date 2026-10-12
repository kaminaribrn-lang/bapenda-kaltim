@extends('layouts.portal')
@section('title', 'Pendapatan Daerah')

@section('content')

@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Data', 'url' => '#'],
        ['label' => 'Pendapatan Daerah', 'url' => null],
    ];
@endphp
<x-portal.page-header title="Pendapatan Daerah" :breadcrumbs="$breadcrumbs" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
    <article class="reveal">
        <div class="bg-surface rounded-3xl shadow-sm border border-border-base p-6 md:p-12">
            <div class="text-center py-16 bg-bg-base rounded-2xl border border-border-base border-dashed">
                <div class="w-16 h-16 rounded-full bg-surface text-text-muted flex items-center justify-center mx-auto mb-4 shadow-sm border border-border-base">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-6h13v6M9 17H4v-6h5m0 6V7a2 2 0 012-2h4a2 2 0 012 2v10"/></svg>
                </div>
                <h3 class="font-heading font-bold text-lg text-text-base mb-2">Data Sedang Disiapkan</h3>
                <p class="font-body text-text-muted text-sm max-w-md mx-auto">Data pendapatan daerah akan segera tersedia di halaman ini.</p>
            </div>
        </div>
    </article>
</div>

@endsection
