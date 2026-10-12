@extends('layouts.portal')
@section('title', 'Cek Status Pengaduan')
@section('meta_desc', 'Pantau perkembangan laporan pengaduan Anda menggunakan kode tracking yang diterima saat mengirim laporan.')

@section('content')

{{-- ============================
     PAGE HERO
     ============================ --}}
<section class="relative bg-[#042f2e] overflow-hidden pt-24 md:pt-40">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-14 md:py-16 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-5 border border-emerald-500/30">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Lacak Status
        </div>
        <h1 class="text-3xl md:text-4xl font-black text-white mb-3" style="font-family: 'Montserrat', sans-serif;">
            Cek Status <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Pengaduan</span>
        </h1>
        <p class="text-white/60 text-sm max-w-md mx-auto">Masukkan kode tracking yang Anda terima saat mengirim laporan pengaduan.</p>
    </div>
</section>

<div class="max-w-2xl mx-auto px-4 py-12">

    {{-- FORM CEK --}}
    <form method="POST" action="{{ route('portal.pengaduan.cek.hasil', $website->slug) }}"
          class="flex gap-2 mb-10">
        @csrf
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="kode_laporan" value="{{ $kodeCari ?? '' }}"
                   placeholder="Masukkan kode tracking (contoh: ABCXYZ)"
                   class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-200 text-sm font-mono uppercase tracking-widest text-slate-700 placeholder-slate-300 placeholder-normal focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition bg-white shadow-sm">
        </div>
        <button type="submit"
                class="px-6 py-3.5 rounded-2xl bg-[#059669] hover:bg-emerald-700 text-white font-bold text-sm transition-colors cursor-pointer shadow-sm whitespace-nowrap">
            Cek Status
        </button>
    </form>

    {{-- HASIL --}}
    @if(isset($kodeCari))

        @if($pengaduan)
        {{-- STATUS CARD --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-md overflow-hidden">

            {{-- Header card --}}
            <div class="bg-gradient-to-r from-[#042f2e] to-[#063a38] px-7 py-5 flex items-center justify-between">
                <div>
                    <div class="text-xs text-emerald-300/70 font-bold uppercase tracking-widest mb-1">Kode Laporan</div>
                    <div class="text-2xl font-black tracking-[0.3em] text-white font-mono">{{ $pengaduan->kode_laporan }}</div>
                </div>
                @php
                    $statusConfig = [
                        'menunggu'  => ['bg' => 'bg-amber-100 text-amber-700', 'dot' => 'bg-amber-400', 'label' => 'Menunggu Verifikasi'],
                        'diproses'  => ['bg' => 'bg-blue-100 text-blue-700',   'dot' => 'bg-blue-400',   'label' => 'Sedang Diproses'],
                        'selesai'   => ['bg' => 'bg-emerald-100 text-emerald-700', 'dot' => 'bg-emerald-400', 'label' => 'Selesai'],
                        'ditolak'   => ['bg' => 'bg-red-100 text-red-700',     'dot' => 'bg-red-400',    'label' => 'Ditolak'],
                    ];
                    $sConfig = $statusConfig[$pengaduan->status] ?? ['bg' => 'bg-slate-100 text-slate-600', 'dot' => 'bg-slate-400', 'label' => ucfirst($pengaduan->status ?? '-')];
                @endphp
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold {{ $sConfig['bg'] }}">
                    <span class="w-2 h-2 rounded-full {{ $sConfig['dot'] }} {{ $pengaduan->status === 'diproses' ? 'animate-pulse' : '' }}"></span>
                    {{ $pengaduan->status_label ?? $sConfig['label'] }}
                </span>
            </div>

            {{-- Progress Timeline --}}
            <div class="px-7 py-5 border-b border-slate-100">
                <div class="flex items-center gap-0">
                    @foreach([
                        ['key' => 'menunggu',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Diterima'],
                        ['key' => 'diproses',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Diproses'],
                        ['key' => 'selesai',   'icon' => 'M5 13l4 4L19 7', 'label' => 'Selesai'],
                    ] as $i => $step)
                    @php
                        $statusOrder = ['menunggu' => 0, 'diproses' => 1, 'selesai' => 2, 'ditolak' => 2];
                        $currentOrder = $statusOrder[$pengaduan->status] ?? 0;
                        $stepOrder = $statusOrder[$step['key']] ?? 0;
                        $isDone = $currentOrder >= $stepOrder;
                        $isCurrent = $pengaduan->status === $step['key'];
                    @endphp
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $isDone ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400' }} transition-colors">
                            <svg class="w-4.5 h-4.5 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $isDone ? '2.5' : '2' }}" d="{{ $step['icon'] }}"/></svg>
                        </div>
                        <p class="text-[10px] font-bold mt-1.5 {{ $isDone ? 'text-emerald-600' : 'text-slate-400' }}">{{ $step['label'] }}</p>
                    </div>
                    @if($i < 2)
                    <div class="flex-1 h-0.5 {{ $currentOrder > $stepOrder ? 'bg-emerald-400' : 'bg-slate-200' }} -mt-4 mx-1 transition-colors"></div>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- Detail Info --}}
            <div class="px-7 py-6 space-y-3">
                <div class="grid grid-cols-[140px_1fr] gap-2 text-sm">
                    <span class="text-slate-400 font-medium">Judul Laporan</span>
                    <span class="font-semibold text-slate-800">{{ $pengaduan->judul_laporan }}</span>
                </div>
                <div class="grid grid-cols-[140px_1fr] gap-2 text-sm">
                    <span class="text-slate-400 font-medium">Kategori</span>
                    <span class="text-slate-700">{{ $pengaduan->kategori }}</span>
                </div>
                <div class="grid grid-cols-[140px_1fr] gap-2 text-sm">
                    <span class="text-slate-400 font-medium">Tanggal Laporan</span>
                    <span class="text-slate-700">{{ $pengaduan->created_at->translatedFormat('d F Y') }}</span>
                </div>
                <div class="grid grid-cols-[140px_1fr] gap-2 text-sm">
                    <span class="text-slate-400 font-medium">Tanggal Kejadian</span>
                    <span class="text-slate-700">{{ $pengaduan->tanggal_kejadian->translatedFormat('d F Y') }}</span>
                </div>
                @if($pengaduan->handled_at)
                <div class="grid grid-cols-[140px_1fr] gap-2 text-sm">
                    <span class="text-slate-400 font-medium">Ditangani Pada</span>
                    <span class="text-slate-700">{{ $pengaduan->handled_at->translatedFormat('d F Y') }}</span>
                </div>
                @endif

                {{-- Respons Admin --}}
                @if($pengaduan->respon_publik)
                <div class="mt-4 p-5 rounded-2xl bg-blue-50 border border-blue-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-6 h-6 rounded-lg bg-blue-100 text-blue-500 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wide text-blue-600">Respons Admin</span>
                    </div>
                    <p class="text-slate-700 text-sm leading-relaxed">{{ $pengaduan->respon_publik }}</p>
                </div>
                @endif
            </div>

            {{-- Footer aksi --}}
            <div class="px-7 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('portal.pengaduan.index', $website->slug) }}"
                   class="text-sm text-slate-400 hover:text-emerald-600 transition-colors font-medium">
                    ← Buat Laporan Baru
                </a>
                <button onclick="window.print()" class="text-sm text-slate-400 hover:text-slate-700 flex items-center gap-1.5 transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak
                </button>
            </div>
        </div>

        @else
        {{-- NOT FOUND --}}
        <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-400 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-700 mb-2">Kode Tidak Ditemukan</h3>
            <p class="text-slate-400 text-sm mb-1">Kode tracking <code class="font-mono font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">{{ $kodeCari }}</code> tidak ditemukan.</p>
            <p class="text-slate-400 text-sm">Pastikan kode yang Anda masukkan benar (tidak peka huruf besar/kecil).</p>
        </div>
        @endif

    @else
    {{-- INITIAL STATE (belum search) --}}
    <div class="text-center py-16 bg-slate-50 rounded-3xl border border-slate-200">
        <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-300 flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
        </div>
        <h3 class="font-bold text-slate-600 mb-2">Masukkan Kode Tracking</h3>
        <p class="text-slate-400 text-sm">Kode tracking dikirimkan saat Anda mengirimkan laporan pengaduan.</p>
    </div>
    @endif

    {{-- Link ke form baru --}}
    <div class="mt-6 flex items-center justify-center gap-6 text-sm">
        <a href="{{ route('portal.pengaduan.index', $website->slug) }}" class="text-slate-400 hover:text-emerald-600 transition-colors font-medium">
            + Buat Pengaduan Baru
        </a>
        <span class="text-slate-200">|</span>
        <a href="{{ route('portal.wbs.index', $website->slug) }}" class="text-slate-400 hover:text-blue-600 transition-colors font-medium">
            Buka WBS
        </a>
    </div>

</div>

@endsection
