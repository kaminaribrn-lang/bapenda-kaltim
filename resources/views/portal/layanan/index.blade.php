@extends('layouts.portal')
@section('title', 'Peta Layanan Samsat')
@section('meta_desc', 'Peta interaktif lokasi dan jenis layanan SAMSAT se-Kalimantan Timur — cari SAMSAT terdekat berdasarkan wilayah dan jenis layanan.')

@section('content')
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'Layanan', 'url' => null],
    ];
@endphp

<x-portal.page-header title="Peta Layanan Samsat" :breadcrumbs="$breadcrumbs">
    <p class="text-surface/80 text-lg max-w-2xl mx-auto font-body">
        Cari lokasi dan jenis layanan SAMSAT terdekat di seluruh Kalimantan Timur — Samsat Induk, Pembantu, Payment Point, Drive Thru, MPP, hingga Keliling.
    </p>
</x-portal.page-header>

<section class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 pb-24 reveal">
    <x-portal.peta-layanan-samsat :locations="$samsatLocations" />
</section>
@endsection
