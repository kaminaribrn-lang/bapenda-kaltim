@php
    $statusOptions = \App\Models\ContentProposal::statusOptions();
    $statusLabel = $statusOptions[$record->status] ?? $record->status;
    $statusColor = \App\Models\ContentProposal::statusColor((string) $record->status);

    $plannedUploadAt = filled($record->planned_upload_at)
        ? date('d M Y', strtotime((string) $record->planned_upload_at))
        : '-';

    $channelOptions = \App\Models\ContentProposal::uploadChannelOptions();
    if (is_array($record->upload_channels)) {
        $channels = $record->upload_channels;
    } else {
        $rawChannels = (string) $record->upload_channels;
        $decodedChannels = json_decode($rawChannels, true);
        $channels = is_array($decodedChannels)
            ? $decodedChannels
            : (filled($rawChannels) ? explode(',', $rawChannels) : []);
    }
    $placeholderTokens = ['', '-', '--', 'null', 'n/a', 'na'];
    $channelLabels = collect($channels)
        ->map(fn ($channel): string => trim((string) $channel))
        ->filter(fn (string $channel): bool => ! in_array(strtolower($channel), $placeholderTokens, true))
        ->map(fn (string $channel): string => (string) ($channelOptions[$channel] ?? $channel))
        ->filter(fn (string $label): bool => filled(trim($label)) && trim($label) !== '-')
        ->values();

    $referenceUrl = filled($record->target_link) ? $record->target_link : null;

    $verifierNotes = filled($record->verifier_notes)
        ? (string) $record->verifier_notes
        : '-';

    $approvalNotes = filled($record->approval_notes)
        ? (string) $record->approval_notes
        : '-';
@endphp

<x-filament-panels::page>
    <style>
        .cp-grid { display: grid; gap: 1rem; }
        @media (min-width: 1024px) {
            .cp-grid { grid-template-columns: 2fr 1fr; }
        }
        .cp-stack { display: grid; gap: 1rem; }
        .cp-kv { display: grid; grid-template-columns: 180px 1fr; gap: .5rem 1rem; }
        .cp-kv dt { color: #64748b; font-size: .8125rem; }
        .cp-kv dd { color: #0f172a; font-weight: 600; }
        .dark .cp-kv dt { color: #94a3b8; }
        .dark .cp-kv dd { color: #f1f5f9; }
        .cp-badges { display: flex; flex-wrap: wrap; gap: .5rem; }
        .cp-badge { font-size: .75rem; font-weight: 700; border-radius: 999px; padding: .35rem .7rem; border: 1px solid #dbeafe; background: #eff6ff; color: #1d4ed8; }
        .cp-note { white-space: pre-wrap; line-height: 1.7; }
    </style>

    <x-filament::section>
        <x-slot name="heading">{{ $record->title ?: __('Detail Usulan Konten') }}</x-slot>
        <x-slot name="description">{{ __('Halaman ini bersifat baca ringkas untuk meninjau usulan sebelum menentukan keputusan.') }}</x-slot>

        <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap;">
            <div style="font-size:.875rem; color:#64748b;">
                {{ __('Pengusul') }}: <strong style="color:inherit;">{{ $record->proposer?->name ?? '-' }}</strong>
                <span style="padding:0 .5rem;">|</span>
                {{ __('Diajukan Ke') }}: <strong style="color:inherit;">{{ $record->website?->name ?? '-' }}</strong>
            </div>
            <x-filament::badge :color="$statusColor">{{ $statusLabel }}</x-filament::badge>
        </div>
    </x-filament::section>

    <div class="cp-grid">
        <div class="cp-stack">
            <x-filament::section>
                <x-slot name="heading">{{ __('Informasi Usulan') }}</x-slot>
                <dl class="cp-kv">
                    <dt>{{ __('Rencana Upload') }}</dt>
                    <dd>{{ $plannedUploadAt }}</dd>

                    <dt>{{ __('Platform Upload') }}</dt>
                    <dd>
                        @if ($channelLabels->isEmpty())
                            -
                        @else
                            <div class="cp-badges">
                                @foreach ($channelLabels as $label)
                                    <span class="cp-badge">{{ $label }}</span>
                                @endforeach
                            </div>
                        @endif
                    </dd>

                    <dt>{{ __('Link Cek / Referensi') }}</dt>
                    <dd>
                        @if ($referenceUrl)
                            <a href="{{ $referenceUrl }}" target="_blank" rel="noopener noreferrer">{{ $referenceUrl }}</a>
                        @else
                            -
                        @endif
                    </dd>
                </dl>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">{{ __('Deskripsi / Keterangan') }}</x-slot>
                <div class="cp-note">{{ (string) ($record->description ?? '-') }}</div>
            </x-filament::section>
        </div>

        <div class="cp-stack">
            <x-filament::section>
                <x-slot name="heading">{{ __('Catatan Verifikator') }}</x-slot>
                <div class="cp-note">{{ $verifierNotes }}</div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">{{ __('Catatan Persetujuan') }}</x-slot>
                <div class="cp-note">{{ $approvalNotes }}</div>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>
