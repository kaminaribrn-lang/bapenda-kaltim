@extends('layouts.portal')
@section('title', 'Permohonan Informasi PPID')
@section('meta_desc', 'Ajukan permohonan informasi publik ke PPID Bapenda Kaltim. Respons dalam 10 hari kerja sesuai UU KIP.')

@section('content')

{{-- PAGE HERO --}}
@php
    $breadcrumbs = [
        ['label' => 'Beranda', 'url' => route('portal.beranda', $website->slug)],
        ['label' => 'PPID', 'url' => route('portal.ppid.index', $website->slug)],
        ['label' => 'Form Permohonan', 'url' => null]
    ];
@endphp
<x-portal.page-header title="Form Permohonan Informasi" :breadcrumbs="$breadcrumbs">
    <p class="text-surface/80 text-lg max-w-2xl mx-auto font-body">
        Sesuai UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik. Permohonan akan diproses dalam <strong class="text-surface font-bold">10 hari kerja</strong>.
    </p>
</x-portal.page-header>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 mt-16 md:mt-20">

    {{-- Success State --}}
    @if(session('success'))
    <div class="mb-10 p-6 rounded-3xl bg-blue-50 border border-blue-200 flex flex-col md:flex-row items-start gap-6 reveal">
        <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 border border-blue-200 shadow-sm">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div>
            <h3 class="font-heading font-black text-xl text-blue-800 mb-2">Permohonan Berhasil Terkirim!</h3>
            <p class="font-body text-blue-700 leading-relaxed mb-4">{{ session('success') }}</p>
            @if(session('kode_tracking'))
            <div class="inline-flex flex-col items-start p-5 rounded-2xl bg-surface border-2 border-blue-300 shadow-sm">
                <div class="text-xs text-text-muted font-bold uppercase tracking-widest mb-1">Nomor Tracking Anda</div>
                <div class="text-3xl font-heading font-black tracking-[0.2em] text-text-base">{{ session('kode_tracking') }}</div>
            </div>
            <p class="text-sm text-blue-700 mt-3 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Simpan nomor ini untuk memantau status permohonan Anda.
            </p>
            @endif
        </div>
    </div>
    @endif

    {{-- Info Alert --}}
    <div class="mb-10 p-6 rounded-3xl border-l-4 border-primary bg-primary-light/50 flex items-start gap-4 reveal">
        <svg class="w-6 h-6 text-primary mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-sm md:text-base text-text-base font-body leading-relaxed">
            <strong class="font-heading font-black text-text-base block mb-1">Panduan Pengisian:</strong>
            Isi formulir dengan lengkap dan jelas. PPID berhak menolak permohonan yang tidak memenuhi ketentuan atau menyangkut informasi yang dikecualikan.
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-surface rounded-3xl shadow-sm border border-border-base overflow-hidden reveal">

        {{-- Progress Indicator --}}
        <div class="bg-bg-base border-b border-border-base px-6 py-5 md:px-10">
            <div class="flex items-center justify-between gap-3 relative">
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-border-base z-0"></div>
                <div class="flex items-center gap-3 bg-bg-base z-10 px-2 relative">
                    <div class="w-8 h-8 rounded-full bg-primary text-surface text-sm font-bold flex items-center justify-center shadow-sm">1</div>
                    <span class="text-sm font-heading font-black text-primary hidden sm:block">Data Pemohon</span>
                </div>
                <div class="flex items-center gap-3 bg-bg-base z-10 px-2 relative">
                    <div class="w-8 h-8 rounded-full bg-surface border border-border-base text-text-muted text-sm font-bold flex items-center justify-center shadow-sm">2</div>
                    <span class="text-sm font-heading font-medium text-text-muted hidden sm:block">Detail Permohonan</span>
                </div>
                <div class="flex items-center gap-3 bg-bg-base z-10 px-2 relative">
                    <div class="w-8 h-8 rounded-full bg-surface border border-border-base text-text-muted text-sm font-bold flex items-center justify-center shadow-sm">3</div>
                    <span class="text-sm font-heading font-medium text-text-muted hidden sm:block">Selesai</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('portal.ppid.permohonan.store', $website->slug) }}" class="p-6 md:p-10">
            @csrf

            {{-- STEP 1: Data Pemohon --}}
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary-light text-primary text-base font-black flex items-center justify-center border border-primary/20">1</div>
                    <h2 class="text-xl font-heading font-black text-text-base">Data Pemohon</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap"
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('nama_lengkap') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('nama_lengkap')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">NIK <span class="text-text-muted font-normal text-xs">(opsional)</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK"
                               class="w-full px-4 py-3 rounded-xl border border-border-base bg-surface font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition">
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="alamat@email.com"
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('email') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('email')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="08xx-xxxx-xxxx"
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('no_telepon') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('no_telepon')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Contoh: Mahasiswa, Wiraswasta"
                               class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition @error('pekerjaan') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">
                        @error('pekerjaan')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" placeholder="Alamat lengkap pemohon"
                                  class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition resize-none @error('alamat') border-red-300 bg-red-50 @else border-border-base bg-surface @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="h-px w-full bg-border-base my-10 relative">
                <div class="absolute left-1/2 -translate-x-1/2 -top-3 bg-surface px-4 text-text-muted">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </div>
            </div>

            {{-- STEP 2: Detail Permohonan --}}
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary-light text-primary text-base font-black flex items-center justify-center border border-primary/20">2</div>
                    <h2 class="text-xl font-heading font-black text-text-base">Detail Permohonan</h2>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Rincian Informasi yang Diminta <span class="text-red-500">*</span></label>
                        <textarea name="rincian_informasi" rows="4" placeholder="Tuliskan secara spesifik informasi apa yang Anda butuhkan, termasuk periode waktu jika relevan..."
                                  class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition resize-none @error('rincian_informasi') border-red-300 bg-red-50 @else border-border-base bg-surface @endif">{{ old('rincian_informasi') }}</textarea>
                        @error('rincian_informasi')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Tujuan Penggunaan Informasi <span class="text-red-500">*</span></label>
                        <textarea name="tujuan_penggunaan" rows="3" placeholder="Jelaskan tujuan Anda membutuhkan informasi ini (penelitian, keperluan pribadi, dll.)"
                                  class="w-full px-4 py-3 rounded-xl border font-body text-sm text-text-base placeholder-text-muted focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition resize-none @error('tujuan_penggunaan') border-red-300 bg-red-50 @else border-border-base bg-surface @endif">{{ old('tujuan_penggunaan') }}</textarea>
                        @error('tujuan_penggunaan')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Cara Mendapatkan Informasi <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="cara_mendapatkan"
                                    class="w-full px-4 py-3.5 rounded-xl border font-body text-sm text-text-base focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition cursor-pointer appearance-none @error('cara_mendapatkan') border-red-300 bg-red-50 @else border-border-base bg-surface @endif">
                                <option value="">Pilih cara mendapatkan informasi...</option>
                                <option value="Melihat / Membaca" @selected(old('cara_mendapatkan') === 'Melihat / Membaca')>Melihat / Membaca</option>
                                <option value="Mendapatkan Salinan" @selected(old('cara_mendapatkan') === 'Mendapatkan Salinan')>Mendapatkan Salinan / Fotokopi</option>
                                <option value="Mendapat Penjelasan" @selected(old('cara_mendapatkan') === 'Mendapat Penjelasan')>Mendapat Penjelasan Langsung</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-text-muted">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('cara_mendapatkan')<p class="text-xs font-bold text-red-500 mt-2 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-heading font-bold text-text-base mb-2">Cara Memperoleh Informasi <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="cara_memperoleh"
                                    class="w-full px-4 py-3.5 rounded-xl border font-body text-sm text-text-base focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-light transition cursor-pointer appearance-none @error('cara_memperoleh') border-red-300 bg-red-50 @else border-border-base bg-surface @endif">
                                <option value="">Pilih cara memperoleh informasi...</option>
                                <option value="Mengambil Langsung" @selected(old('cara_memperoleh') === 'Mengambil Langsung')>Mengambil Langsung</option>
                                <option value="Email" @selected(old('cara_memperoleh') === 'Email')>Email</option>
                                <option value="Kurir" @selected(old('cara_memperoleh') === 'Kurir')>Kurir</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-text-muted">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('cara_memperoleh')<p class="text-xs font-bold text-red-500 mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Submit Actions --}}
            <div class="flex flex-col-reverse sm:flex-row items-center gap-4 pt-6 border-t border-border-base mt-10">
                <a href="{{ route('portal.ppid.index', $website->slug) }}"
                   class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-border-base bg-bg-base text-text-base font-bold text-sm hover:bg-border-base transition-colors focus:outline-none focus:ring-2 focus:ring-primary">
                    Kembali
                </a>
                <button type="submit"
                        class="w-full sm:flex-1 py-3.5 rounded-xl bg-primary hover:bg-primary-dark text-surface font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Permohonan PPID
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
