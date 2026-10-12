@extends('layouts.portal')
@section('title', 'Sampaikan Pengaduan')
@section('meta_desc', 'Sampaikan pengaduan dan aspirasi Anda kepada Bapenda Kaltim. Laporan akan ditindaklanjuti secara serius.')

@section('content')

{{-- ============================
     PAGE HERO
     ============================ --}}
<section class="relative bg-[#042f2e] overflow-hidden pt-24 md:pt-40">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-16 md:py-20">
        <nav class="flex items-center gap-2 text-xs text-emerald-300/70 mb-6 font-medium">
            <a href="{{ route('portal.beranda', $website->slug) }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Pengaduan</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-4 border border-emerald-500/30">
                    Aspirasi Masyarakat
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white" style="font-family: 'Montserrat', sans-serif;">
                    Sampaikan <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Pengaduan</span>
                </h1>
                <p class="text-white/60 mt-4 text-sm max-w-lg">Pengaduan Anda akan diproses dan ditindaklanjuti. Anda dapat melaporkan secara anonim.</p>
            </div>
            <a href="{{ route('portal.pengaduan.cek', $website->slug) }}"
               class="shrink-0 flex items-center gap-2 px-5 py-3 rounded-xl border border-white/20 text-white/80 text-sm font-semibold hover:bg-white/10 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cek Status Laporan
            </a>
        </div>
    </div>
</section>

{{-- ============================
     ALUR PENGADUAN (Steps)
     ============================ --}}
<div class="bg-white border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-0 sm:gap-0 relative">
            {{-- Connector line --}}
            <div class="hidden sm:block absolute left-0 right-0 top-5 h-0.5 bg-slate-100 z-0 mx-[calc(12.5%+2rem)]"></div>

            @foreach([
                ['step' => '01', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', 'color' => 'emerald', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data pengaduan dengan jelas'],
                ['step' => '02', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'blue', 'title' => 'Verifikasi', 'desc' => 'Laporan diterima & diverifikasi admin'],
                ['step' => '03', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'color' => 'amber', 'title' => 'Diproses', 'desc' => 'Ditindaklanjuti oleh tim terkait'],
                ['step' => '04', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'color' => 'purple', 'title' => 'Respons', 'desc' => 'Jawaban disampaikan via kode tracking'],
            ] as $step)
            <div class="relative z-10 flex sm:flex-col items-center sm:items-center gap-4 sm:gap-2 flex-1 text-center py-2 sm:py-0">
                <div class="w-10 h-10 rounded-xl bg-{{ $step['color'] }}-100 text-{{ $step['color'] }}-600 flex items-center justify-center shrink-0 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $step['icon'] }}"/></svg>
                </div>
                <div class="text-left sm:text-center">
                    <p class="font-bold text-slate-800 text-sm">{{ $step['title'] }}</p>
                    <p class="text-slate-400 text-xs mt-0.5 hidden sm:block">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ============================
     FORM PENGADUAN
     ============================ --}}
<div class="max-w-3xl mx-auto px-4 py-12">

    {{-- Success State --}}
    @if(session('success'))
    <div class="mb-8 bg-emerald-50 border border-emerald-200 rounded-3xl p-8 text-center">
        <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="text-xl font-black text-emerald-800 mb-2">Pengaduan Berhasil Dikirim!</h3>
        <p class="text-emerald-700 text-sm mb-5">{{ session('success') }}</p>
        @if(session('kode_laporan'))
        <div class="inline-flex flex-col items-center p-5 bg-white rounded-2xl border-2 border-emerald-300 shadow-sm mb-4">
            <div class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-2">Kode Tracking Anda</div>
            <div class="text-4xl font-black tracking-[0.4em] text-[#042f2e] font-mono">{{ session('kode_laporan') }}</div>
        </div>
        <p class="text-sm text-emerald-700 mt-2">📌 Simpan kode ini untuk memantau perkembangan laporan.</p>
        @endif
    </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="bg-slate-50 border-b border-slate-100 px-7 py-5">
            <h2 class="font-black text-slate-800 text-base">Form Pengaduan Masyarakat</h2>
            <p class="text-xs text-slate-400 mt-1">Kolom bertanda <span class="text-red-500 font-bold">*</span> wajib diisi</p>
        </div>

        <form method="POST" action="{{ route('portal.pengaduan.store', $website->slug) }}"
              x-data="{ anon: false }" class="p-7 space-y-5">
            @csrf

            {{-- Toggle Anonim --}}
            <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div>
                    <p class="font-bold text-slate-800 text-sm">Laporkan secara Anonim</p>
                    <p class="text-xs text-slate-400 mt-0.5">Identitas Anda tidak akan dicatat oleh sistem</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_anonymous" x-model="anon" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-emerald-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </label>
            </div>

            {{-- Identitas (hanya muncul jika tidak anonim) --}}
            <div x-show="!anon" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama lengkap Anda"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                    @error('nama_lengkap')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIK <span class="text-slate-400 font-normal text-xs">(opsional)</span></label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="alamat@email.com"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                    @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Telepon <span class="text-slate-400 font-normal text-xs">(opsional)</span></label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08xx-xxxx-xxxx"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                </div>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-slate-100"></div>

            {{-- Detail Laporan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 bg-white focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition cursor-pointer">
                        <option value="">Pilih Kategori Pengaduan</option>
                        <option value="Pelayanan Publik" @selected(old('kategori')==='Pelayanan Publik')>Pelayanan Publik</option>
                        <option value="Korupsi/Pungli" @selected(old('kategori')==='Korupsi/Pungli')>Korupsi / Pungutan Liar</option>
                        <option value="Infrastruktur" @selected(old('kategori')==='Infrastruktur')>Infrastruktur & Fasilitas</option>
                        <option value="Kepegawaian" @selected(old('kategori')==='Kepegawaian')>Kepegawaian</option>
                        <option value="Lainnya" @selected(old('kategori')==='Lainnya')>Lainnya</option>
                    </select>
                    @error('kategori')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Kejadian <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                    @error('tanggal_kejadian')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Laporan <span class="text-red-500">*</span></label>
                <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}" placeholder="Ringkasan singkat pengaduan Anda..."
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition">
                @error('judul_laporan')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kronologi Kejadian <span class="text-red-500">*</span></label>
                <textarea name="kronologis" rows="6" placeholder="Ceritakan kronologi kejadian secara rinci. Semakin detail, semakin mudah untuk ditindaklanjuti."
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition resize-none">{{ old('kronologis') }}</textarea>
                @error('kronologis')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full py-4 rounded-2xl bg-[#059669] hover:bg-emerald-700 text-white font-bold text-sm transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer shadow-lg shadow-emerald-900/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                Kirim Pengaduan
            </button>
        </form>
    </div>

    {{-- Link WBS --}}
    <div class="mt-6 p-5 rounded-2xl border border-slate-200 bg-white flex items-center justify-between hover:border-blue-300 hover:shadow-sm transition-all group">
        <div>
            <p class="text-sm font-bold text-slate-700">Ingin melaporkan pelanggaran integritas?</p>
            <p class="text-xs text-slate-400 mt-0.5">Gunakan WBS untuk laporan anonim terenkripsi</p>
        </div>
        <a href="{{ route('portal.wbs.index', $website->slug) }}"
           class="shrink-0 flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
            Buka WBS
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

</div>

@endsection
