@extends('layouts.app')

@section('title', 'FAQ - ' . ($identity->name ?? $website->name ?? 'Bapenda Provinsi Kalimantan Timur'))

@section('content')
<section class="relative min-h-[360px] overflow-hidden bg-[#0c1e33]">
    <img src="{{ asset('images/background.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none opacity-10"
         alt="Background FAQ">
    <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    <div class="absolute top-12 left-8 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-20 right-8 w-72 h-72 bg-[#36a36d]/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="absolute inset-0 flex items-center justify-center px-4 pt-16">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-4 tracking-[0.2em] uppercase">
                PUSAT BANTUAN
            </span>
            <h1 class="text-3xl md:text-5xl font-black text-white font-montserrat uppercase tracking-tight leading-[1.1]">
                Pertanyaan
                <span class="text-[#00c458]">Umum</span>
            </h1>
            <p class="mt-4 text-sm md:text-base text-white/75 max-w-2xl mx-auto font-medium leading-relaxed">
                Temukan jawaban cepat terkait layanan dan informasi pada
                {{ $identity->name ?? $website->name ?? 'website ini' }}.
            </p>
        </div>
    </div>
</section>

<section class="relative bg-white py-12 lg:py-16 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center gap-5">
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="w-1.5 h-8 bg-emerald-500 rounded-full"></div>
                    <h2 class="font-black text-slate-800 text-lg uppercase tracking-tight">Daftar FAQ</h2>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider rounded-full">
                        {{ $faqs->count() }} item
                    </span>
                </div>

                <div class="relative w-full md:w-96 group">
                    <input type="text" id="faqSearch" placeholder="Cari pertanyaan..."
                        class="w-full pl-14 pr-12 py-4 bg-white border border-gray-200 rounded-[1.5rem] text-sm font-bold text-slate-700 shadow-sm focus:outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400 placeholder:font-medium">
                    <div class="absolute top-1/2 left-5 -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div id="faqList" class="space-y-4">
                @forelse ($faqs as $index => $faq)
                    <article class="faq-item bg-white rounded-3xl border border-gray-100 shadow-[0_12px_30px_-12px_rgba(0,0,0,0.08)] overflow-hidden transition-all duration-300 hover:shadow-[0_20px_45px_-20px_rgba(0,0,0,0.14)]" data-question="{{ strtolower(strip_tags($faq->question)) }}" data-answer="{{ strtolower(strip_tags($faq->answer)) }}">
                        <button type="button"
                            class="faq-toggle w-full text-left px-6 md:px-8 py-5 md:py-6 flex items-start gap-4 md:gap-5"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">

                            <div class="mt-0.5 flex-shrink-0 w-8 h-8 rounded-full {{ $faq->is_featured ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600' }} font-black text-xs flex items-center justify-center">
                                {{ $index + 1 }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    @if($faq->is_featured)
                                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-wider rounded-full">Unggulan</span>
                                    @endif
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-wider rounded-full">FAQ</span>
                                </div>
                                <h3 class="faq-question text-base md:text-lg font-black text-slate-900 leading-snug">
                                    {{ $faq->question }}
                                </h3>
                            </div>

                            <span class="faq-icon mt-1 flex-shrink-0 w-8 h-8 rounded-full border border-slate-200 bg-white text-slate-500 flex items-center justify-center transition-transform duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div class="faq-answer-wrapper {{ $index === 0 ? '' : 'hidden' }}">
                            <div class="px-6 md:px-8 pb-6 md:pb-7 pl-[4.75rem] md:pl-[5.5rem]">
                                <div class="faq-answer prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm md:text-[15px]">
                                    {!! \App\Support\RichContent::html($faq->answer) !!}
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="bg-white rounded-[2rem] p-14 text-center border border-dashed border-gray-200">
                        <p class="text-slate-500 font-bold uppercase tracking-widest text-sm">Belum ada FAQ yang ditayangkan.</p>
                    </div>
                @endforelse
            </div>

            <div id="faqNotFound" class="hidden bg-white rounded-[2rem] p-14 text-center border border-dashed border-gray-200 mt-5">
                <p class="text-slate-500 font-bold uppercase tracking-widest text-sm">Tidak ada pertanyaan yang cocok dengan pencarian.</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(() => {
    const list = document.getElementById('faqList');
    const items = Array.from(document.querySelectorAll('.faq-item'));
    const searchInput = document.getElementById('faqSearch');
    const noResult = document.getElementById('faqNotFound');

    const toggleItem = (item, forceOpen = null) => {
        const button = item.querySelector('.faq-toggle');
        const answer = item.querySelector('.faq-answer-wrapper');
        const icon = item.querySelector('.faq-icon');
        const expanded = button.getAttribute('aria-expanded') === 'true';
        const nextState = forceOpen === null ? !expanded : forceOpen;

        button.setAttribute('aria-expanded', nextState ? 'true' : 'false');
        answer.classList.toggle('hidden', !nextState);
        icon.style.transform = nextState ? 'rotate(180deg)' : 'rotate(0deg)';
    };

    items.forEach((item, idx) => {
        if (idx === 0) {
            toggleItem(item, true);
        }

        item.querySelector('.faq-toggle')?.addEventListener('click', () => {
            const isExpanded = item.querySelector('.faq-toggle').getAttribute('aria-expanded') === 'true';
            items.forEach((other) => {
                if (other !== item) {
                    toggleItem(other, false);
                }
            });
            toggleItem(item, !isExpanded);
        });
    });

    searchInput?.addEventListener('input', (e) => {
        const q = (e.target.value || '').toLowerCase().trim();
        let visibleCount = 0;

        items.forEach((item) => {
            const question = item.dataset.question || '';
            const answer = item.dataset.answer || '';
            const visible = q === '' || question.includes(q) || answer.includes(q);
            item.classList.toggle('hidden', !visible);

            if (visible) {
                visibleCount += 1;
            }
        });

        noResult?.classList.toggle('hidden', visibleCount > 0 || q === '');

        if (q === '') {
            items.forEach((item, idx) => toggleItem(item, idx === 0));
            return;
        }

        const firstVisible = items.find((item) => !item.classList.contains('hidden'));
        items.forEach((item) => toggleItem(item, item === firstVisible));
    });
})();
</script>
@endpush
@endsection
