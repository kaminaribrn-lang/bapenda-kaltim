@extends('layouts.portal')
@section('title', 'Hubungi Kami')
@section('meta_desc', 'Kontak dan informasi Badan Pendapatan Daerah Provinsi Kalimantan Timur. Kami siap membantu Anda.')

@section('content')
{{-- Page Hero --}}
<section class="relative bg-[#042f2e] overflow-hidden pt-24 md:pt-40">
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-16 md:py-20">
        <nav class="flex items-center gap-2 text-xs text-emerald-300/70 mb-6 font-medium">
            <a href="{{ route('portal.beranda', $website->slug) }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Kontak</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-widest mb-4 border border-emerald-500/30">
            Hubungi Kami
        </div>
        <h1 class="text-3xl md:text-5xl font-black text-white" style="font-family: 'Montserrat', sans-serif;">
            Kontak <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Bapenda</span>
        </h1>
        <p class="text-emerald-100/70 mt-4 max-w-xl">Kami siap membantu menjawab pertanyaan dan menerima masukan terkait layanan perpajakan daerah.</p>
    </div>
</section>

{{-- KONTAK CONTENT --}}
<div class="max-w-7xl mx-auto px-4 py-16 -mt-16 relative z-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- INFO CARDS & MAPS --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Info Kontak --}}
            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-slate-800 mb-6" style="font-family: 'Montserrat', sans-serif;">Info Bapenda</h3>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Alamat Utama</h4>
                            <p class="text-gray-500 text-sm mt-1">Jl. Mayjend. M.T Haryono, Samarinda - 75124, Kalimantan Timur</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Email</h4>
                            <p class="text-gray-500 text-sm mt-1">bapenda@kaltimprov.go.id<br>sekretariat@dispenda-kaltimprov.org</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Telepon</h4>
                            <p class="text-gray-500 text-sm mt-1">(0541) 734969<br>(0541) 734972</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Jam Layanan --}}
            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-slate-800 mb-4" style="font-family: 'Montserrat', sans-serif;">Jam Layanan</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex justify-between border-b border-gray-50 pb-2"><span>Senin - Kamis</span><span class="font-medium text-emerald-600">08.00 - 14.00 WITA</span></li>
                    <li class="flex justify-between border-b border-gray-50 pb-2"><span>Jumat</span><span class="font-medium text-emerald-600">08.00 - 11.30 WITA</span></li>
                    <li class="flex justify-between pb-2"><span>Sabtu</span><span class="font-medium text-emerald-600">08.00 - 12.00 WITA</span></li>
                </ul>
            </div>
        </div>

        {{-- FORM KONTAK --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8 md:p-10 h-full">
                <h3 class="text-2xl font-bold text-slate-800 mb-2" style="font-family: 'Montserrat', sans-serif;">Kirim Pesan / Pengaduan</h3>
                <p class="text-gray-500 mb-8">Gunakan formulir di bawah ini untuk mengirimkan pertanyaan, keluhan, atau saran langsung ke tim Bapenda Kaltim.</p>
                
                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all" placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all" placeholder="alamat@email.com">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subjek / Kategori</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all bg-white">
                            <option>Pertanyaan Umum</option>
                            <option>Pengaduan Layanan Samsat</option>
                            <option>Kendala E-Samsat</option>
                            <option>Informasi Pajak Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Pesan</label>
                        <textarea rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all" placeholder="Tuliskan pesan atau pengaduan Anda di sini secara detail..."></textarea>
                    </div>

                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-full shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        Kirim Pesan
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

{{-- FULL WIDTH MAP --}}
<div class="max-w-6xl mx-auto px-4 pb-16">
    <div class="w-full h-[420px] rounded-3xl overflow-hidden shadow-lg border border-slate-200 bg-slate-100">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6582539655513!2d117.1517094!3d-0.5021061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f394437a3c3%3A0x6b8f35213d2a0!2sBadan%20Pendapatan%20Daerah%20Provinsi%20Kalimantan%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%" height="100%" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                class="grayscale hover:grayscale-0 transition-all duration-700"></iframe>
    </div>
</div>
@endsection
