@php
    $statusClasses = $statusClass ?? 'bg-slate-100 text-slate-700 ring-slate-200';
    $statusLabel = $statusLabel ?? '-';
    $plannedUploadAt = $plannedUploadAt ?? '-';
    $channelBadges = $channelBadges ?? '<span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">-</span>';
    $referenceLink = $referenceLink ?? '-';
    $referenceUrl = $referenceUrl ?? null;
    $verifierNotes = $verifierNotes ?? '<span class="text-slate-400">-</span>';
    $approvalNotes = $approvalNotes ?? '<span class="text-slate-400">-</span>';
@endphp

<div class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_30px_80px_-30px_rgba(15,23,42,0.45)] dark:border-slate-800 dark:bg-slate-950">
    <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-cyan-700 px-6 py-6 text-white">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="max-w-3xl">
                <p class="text-[11px] font-black uppercase tracking-[0.32em] text-cyan-200">{{ __('Detail Usulan Konten') }}</p>
                <h3 class="mt-2 text-2xl font-black leading-tight md:text-3xl">{{ $record->title }}</h3>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-200">{{ __('Tampilan dibangun seperti form readonly modern agar informasi cepat dipindai dan tetap terasa premium.') }}</p>
            </div>
            <span class="inline-flex items-center rounded-full px-4 py-2 text-xs font-black uppercase tracking-[0.22em] ring-1 {{ $statusClasses }}">
                {{ $statusLabel }}
            </span>
        </div>

        <div class="mt-5 grid gap-3 md:grid-cols-3">
            <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 backdrop-blur">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-cyan-100">{{ __('Diajukan Ke') }}</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $record->website?->name ?? '-' }}</p>
            </div>
            <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 backdrop-blur">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-cyan-100">{{ __('Pengusul') }}</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $record->proposer?->name ?? '-' }}</p>
            </div>
            <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 backdrop-blur">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-cyan-100">{{ __('Rencana Upload') }}</p>
                <p class="mt-2 text-sm font-semibold text-white">{{ $plannedUploadAt }}</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 p-6 lg:grid-cols-12">
        <div class="space-y-6 lg:col-span-7">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Informasi Utama') }}</p>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Tampilan readonly agar rapi, hemat ruang, dan mudah dipindai.') }}</p>
                    </div>
                    <span class="rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-black uppercase tracking-wide text-cyan-700 ring-1 ring-cyan-200 dark:bg-cyan-950 dark:text-cyan-200 dark:ring-cyan-800">Readonly</span>
                </div>

                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Diajukan Ke') }}</p>
                        <div class="mt-2 text-sm font-bold leading-relaxed text-slate-900 dark:text-slate-100">{{ $record->website?->name ?? '-' }}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Pengusul') }}</p>
                        <div class="mt-2 text-sm font-bold leading-relaxed text-slate-900 dark:text-slate-100">{{ $record->proposer?->name ?? '-' }}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Rencana Upload') }}</p>
                        <div class="mt-2 text-sm font-bold leading-relaxed text-slate-900 dark:text-slate-100">{{ $plannedUploadAt }}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Status') }}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-black uppercase tracking-wide ring-1 {{ $statusClasses }}">{{ $statusLabel }}</span>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800 md:col-span-2">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Platform Upload') }}</p>
                        <div class="mt-3 flex flex-wrap gap-2">{!! $channelBadges !!}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm ring-1 ring-slate-100 dark:border-slate-800 dark:bg-slate-950 dark:ring-slate-800 md:col-span-2">
                        <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Link Cek / Referensi') }}</p>
                        <div class="mt-2 text-sm font-semibold leading-relaxed text-slate-900 dark:text-slate-100">{!! $referenceLink !!}</div>
                        @if ($referenceUrl)
                            <div class="mt-4">
                                <a href="{{ $referenceUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2 text-xs font-black uppercase tracking-wider text-white shadow-sm transition hover:bg-slate-700">
                                    {{ __('Buka Link') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-[11px] font-black uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">{{ __('Deskripsi / Keterangan') }}</p>
                <div class="mt-4 min-h-40 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-[15px] leading-8 text-slate-700 dark:border-slate-800 dark:bg-slate-800 dark:text-slate-200">{!! nl2br(e((string) ($record->description ?? '-'))) !!}</div>
            </div>
        </div>

        <div class="space-y-6 lg:col-span-5">
            <div class="rounded-3xl border border-emerald-100 bg-emerald-50 p-6 shadow-sm dark:border-emerald-950 dark:bg-emerald-950/30">
                <p class="text-[11px] font-black uppercase tracking-[0.24em] text-emerald-700 dark:text-emerald-300">{{ __('Catatan Verifikator') }}</p>
                <p class="mt-1 text-sm text-emerald-700/80 dark:text-emerald-200/80">{{ __('Catatan untuk proses verifikasi editor konten.') }}</p>
                <div class="mt-4 rounded-2xl bg-white p-4 leading-relaxed text-emerald-950 ring-1 ring-emerald-100 dark:bg-slate-900 dark:text-emerald-100 dark:ring-emerald-900">{!! $verifierNotes !!}</div>
            </div>

            <div class="rounded-3xl border border-violet-100 bg-violet-50 p-6 shadow-sm dark:border-violet-950 dark:bg-violet-950/30">
                <p class="text-[11px] font-black uppercase tracking-[0.24em] text-violet-700 dark:text-violet-300">{{ __('Catatan Persetujuan') }}</p>
                <p class="mt-1 text-sm text-violet-700/80 dark:text-violet-200/80">{{ __('Tahap keputusan akhir oleh pihak berwenang.') }}</p>
                <div class="mt-4 rounded-2xl bg-white p-4 leading-relaxed text-violet-950 ring-1 ring-violet-100 dark:bg-slate-900 dark:text-violet-100 dark:ring-violet-900">{!! $approvalNotes !!}</div>
            </div>
        </div>
    </div>
</div>
