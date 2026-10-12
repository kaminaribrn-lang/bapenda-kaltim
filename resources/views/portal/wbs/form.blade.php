@extends('layouts.portal')
@section('title', 'WBS — Whistle Blowing System')
@section('meta_desc', 'Laporkan pelanggaran integritas secara aman dan anonim. Semua laporan dijamin kerahasiaannya.')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'WBS', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Whistle Blowing System" :breadcrumbs="$breadcrumbs">
    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface/10 text-surface text-xs font-bold uppercase tracking-widest mb-4 border border-surface/20">
        <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>
        Sistem Pelaporan Aman & Terenkripsi
    </div>
    <p class="text-surface/80 text-lg max-w-2xl mx-auto font-body">
        Sarana pelaporan pelanggaran integritas secara <strong class="text-surface font-bold">rahasia dan aman</strong>. Semua laporan dijamin kerahasiaannya dan akan ditindaklanjuti.
    </p>
</x-portal.page-header>

{{-- 3 JAMINAN KEAMANAN --}}
<div class="bg-surface border-b border-border-base">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'color' => 'blue', 'title' => 'Identitas Anonim', 'desc' => 'Identitas pelapor sepenuhnya dilindungi. Tidak ada data pribadi yang dicatat.'],
                ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'color' => 'primary', 'title' => 'Laporan Terenkripsi', 'desc' => 'Semua data laporan diproses secara terenkripsi dan hanya dapat diakses oleh pihak berwenang.'],
                ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'amber', 'title' => 'Pasti Ditindaklanjuti', 'desc' => 'Setiap laporan akan ditindaklanjuti oleh tim integritas dan dapat dipantau statusnya.'],
            ] as $jaminan)
            <div class="flex items-start gap-4 p-5 rounded-2xl bg-bg-base border border-border-base">
                @php 
                    $bgClass = $jaminan['color'] === 'primary' ? 'bg-primary-light text-primary' : ($jaminan['color'] === 'blue' ? 'bg-blue-50 text-blue-600' : 'bg-amber-50 text-amber-600');
                @endphp
                <div class="w-12 h-12 rounded-xl {{ $bgClass }} flex items-center justify-center shrink-0 border border-border-base">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $jaminan['icon'] }}"/></svg>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-text-base text-base mb-1">{{ $jaminan['title'] }}</h3>
                    <p class="text-text-muted text-sm leading-relaxed font-body">{{ $jaminan['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- KONTEN UTAMA WBS --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 mt-6">

    {{-- Success State --}}
    @if(session('success'))
    <div class="mb-12 bg-blue-50 border border-blue-200 rounded-3xl p-8 md:p-12 text-center reveal shadow-sm">
        <div class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-6 border border-blue-200 shadow-sm">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="text-2xl font-heading font-black text-blue-900 mb-3">Laporan Berhasil Dikirim!</h3>
        <p class="text-blue-700 text-base font-body mb-8">{{ session('success') }}</p>
        
        @if(session('kode_laporan'))
        <div class="inline-flex flex-col items-center p-6 bg-surface rounded-2xl border-2 border-blue-300 shadow-sm mb-6 w-full sm:w-auto">
            <div class="text-xs text-text-muted font-bold uppercase tracking-widest mb-2">Kode Laporan Anda</div>
            <div class="text-3xl md:text-5xl font-heading font-black tracking-[0.3em] text-text-base">{{ session('kode_laporan') }}</div>
        </div>
        <p class="text-base font-body text-blue-700 flex flex-col sm:flex-row items-center justify-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Simpan kode ini. Gunakan untuk cek status di
            <a href="{{ route('portal.pengaduan.cek', $website->slug) }}" class="font-bold underline hover:text-blue-800 transition-colors">Cek Status Pengaduan</a>.
        </p>
        @endif
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-10">

        {{-- FORM WBS --}}
        <div class="order-2 lg:order-1 reveal">
            <div class="bg-surface rounded-3xl shadow-sm border border-border-base overflow-hidden">
                <div class="bg-bg-base border-b border-border-base px-6 py-6 md:px-10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary-light text-primary flex items-center justify-center shrink-0 border border-primary/20">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-heading font-black text-text-base text-xl">Form Pelaporan WBS</h2>
                            <p class="text-sm font-body text-text-muted mt-1">Semua kolom dengan tanda <span class="text-red-500 font-bold">*</span> wajib diisi</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('portal.wbs.store', $website->slug) }}" class="p-6 md:p-10 space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Unit Kerja yang Dilaporkan</label>
                        <input type="text" name="unit_kerja" value="{{ old('unit_kerja') }}"
                               placeholder="Nama unit kerja / bidang / bagian..."
                               class="w-full px-4 py-3 rounded-xl border border-border-base bg-bg-base font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition">
                    </div>

                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Judul Laporan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}"
                               placeholder="Ringkasan singkat pelanggaran yang dilaporkan..."
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('judul_laporan') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('judul_laporan')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Tanggal Kejadian <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}"
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('tanggal_kejadian') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('tanggal_kejadian')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Kronologi Pelanggaran <span class="text-red-500">*</span></label>
                        <textarea name="kronologis" rows="8"
                                  placeholder="Ceritakan secara detail:&#10;• Apa yang terjadi?&#10;• Kapan dan di mana kejadian berlangsung?&#10;• Siapa yang terlibat?&#10;• Bukti atau indikasi apa yang Anda miliki?"
                                  class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition resize-none @error('kronologis') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">{{ old('kronologis') }}</textarea>
                        @error('kronologis')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>

                    {{-- Alert anonim --}}
                    <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <p class="text-sm font-body text-amber-800 leading-relaxed pt-1">
                            Laporan ini bersifat <strong class="font-bold">anonim sepenuhnya</strong>. Identitas Anda <strong class="font-bold">tidak dicatat</strong> oleh sistem. Anda akan menerima kode unik untuk memantau status laporan.
                        </p>
                    </div>

                    <button type="submit"
                            class="w-full mt-4 py-4 rounded-xl bg-primary hover:bg-primary-dark text-surface font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Laporan WBS dengan Aman
                    </button>
                </form>
            </div>
        </div>

        {{-- SIDEBAR INFO --}}
        <aside class="order-1 lg:order-2 space-y-6 reveal">

            {{-- Tentang WBS --}}
            @if($wbsAbout)
            <div class="bg-surface rounded-3xl border border-border-base shadow-sm overflow-hidden">
                @if($wbsAbout->image)
                <img src="{{ Storage::url($wbsAbout->image) }}" alt="{{ $wbsAbout->title }}" class="w-full object-cover max-h-48 border-b border-border-base">
                @endif
                <div class="p-6">
                    <h3 class="font-heading font-black text-text-base text-lg mb-3">{{ $wbsAbout->title }}</h3>
                    @if($wbsAbout->description)
                    <div class="portal-prose text-sm text-text-muted font-body leading-relaxed">{!! \App\Support\RichContent::html($wbsAbout->description) !!}</div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Alert Anonimitas --}}
            <div class="p-6 rounded-3xl bg-blue-50 border border-blue-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500 text-surface flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h4 class="font-heading font-black text-blue-900 text-base">Jaminan Kerahasiaan</h4>
                </div>
                <ul class="text-sm font-body text-blue-800 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Identitas pelapor terlindungi sepenuhnya.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Laporan diproses secara rahasia dan terenkripsi.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Tidak ada pembalasan terhadap pelapor (Non-Retaliation).</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Ditindaklanjuti oleh tim integritas independen.</span>
                    </li>
                </ul>
            </div>

            {{-- Link Cek Status --}}
            <a href="{{ route('portal.pengaduan.cek', $website->slug) }}"
               class="flex items-center justify-between p-5 rounded-2xl border border-border-base bg-surface hover:border-primary hover:shadow-md transition-all group">
                <div>
                    <p class="text-base font-heading font-black text-text-base">Punya Kode Laporan?</p>
                    <p class="text-sm font-body text-text-muted mt-1">Pantau status laporan WBS Anda</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-bg-base flex items-center justify-center group-hover:bg-primary group-hover:text-surface transition-colors border border-border-base">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
        </aside>

    </div>
</div>

@endsection
