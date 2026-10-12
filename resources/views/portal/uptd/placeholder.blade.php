@extends('layouts.portal')

@section('title', 'UPTD PPRD Wilayah ' . $uptd['name'])
@section('meta_desc', 'Halaman UPTD ' . $uptd['name'] . ' sedang disiapkan.')

@section('content')
<section class="min-h-[60vh] flex items-center justify-center px-6 py-20">
    <div class="max-w-2xl text-center">
        <p class="text-sm font-bold uppercase tracking-[0.2em] text-primary">UPTD PPRD Wilayah {{ $uptd['name'] }}</p>
        <h1 class="mt-4 text-3xl md:text-5xl font-black text-text-base">Halaman sedang disiapkan</h1>
        <p class="mt-5 text-base text-text-muted">
            Informasi dan layanan wilayah ini akan diperbarui setelah data resminya tersedia.
        </p>
    </div>
</section>
@endsection
