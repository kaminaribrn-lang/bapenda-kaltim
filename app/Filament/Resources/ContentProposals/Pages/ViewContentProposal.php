<?php

namespace App\Filament\Resources\ContentProposals\Pages;

use App\Filament\Resources\ContentProposals\ContentProposalResource;
use App\Models\ContentProposal;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewContentProposal extends ViewRecord
{
    protected static string $resource = ContentProposalResource::class;

    protected string $view = 'filament.resources.content-proposals.pages.view-content-proposal';

    public function getTitle(): string
    {
        return __('Preview Usulan Konten');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('decide')
                ->label(__('Setujui / Kembalikan'))
                ->icon('heroicon-o-check-badge')
                ->color(fn (): string => $this->decisionMode() === 'approve' ? 'success' : 'info')
                ->visible(fn (): bool => $this->decisionMode() !== null)
                ->fillForm(fn (): array => [
                    'is_publishable' => (bool) $this->record->is_publishable,
                    'verifier_notes' => $this->record->verifier_notes,
                    'approval_notes' => $this->record->approval_notes,
                ])
                ->form([
                    Select::make('decision')
                        ->label(__('Pilih Aksi'))
                        ->options(fn (): array => $this->decisionOptions())
                        ->required(),
                    Toggle::make('is_publishable')
                        ->label(__('Konten Layak Tayang'))
                        ->visible(fn (): bool => $this->decisionMode() === 'verify'),
                    Textarea::make('verifier_notes')
                        ->label(__('Catatan Verifikator'))
                        ->rows(4)
                        ->visible(fn (): bool => $this->decisionMode() === 'verify'),
                    Textarea::make('approval_notes')
                        ->label(__('Catatan Persetujuan'))
                        ->rows(4)
                        ->visible(fn (): bool => $this->decisionMode() === 'approve'),
                ])
                ->action(function (array $data): void {
                    $mode = $this->decisionMode();
                    if ($mode === null) {
                        return;
                    }

                    $record = $this->record;
                    if ($mode === 'verify') {
                        $record->update([
                            'is_publishable' => (bool) ($data['is_publishable'] ?? false),
                            'verifier_notes' => $data['verifier_notes'] ?? null,
                            'verifier_id' => auth()->id(),
                            'status' => $data['decision'],
                            'verified_at' => now(),
                        ]);
                    } else {
                        $record->update([
                            'status' => $data['decision'],
                            'approval_notes' => $data['approval_notes'] ?? null,
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);
                    }

                    Notification::make()
                        ->title(__('Keputusan berhasil disimpan.'))
                        ->success()
                        ->send();
                }),

            Action::make('edit')
                ->label(__('Ubah'))
                ->icon('heroicon-o-pencil-square')
                ->color('warning')
                ->visible(fn (): bool => ContentProposalResource::canEdit($this->record))
                ->url(fn (): string => ContentProposalResource::getUrl('edit', ['record' => $this->record])),

            Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn (): string => ContentProposalResource::getUrl('index')),
        ];
    }

    private function canVerify(): bool
    {
        $record = $this->record;
        if (! $record instanceof ContentProposal) {
            return false;
        }

        $user = auth()->user();
        if (! $user) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user->isContentVerifier()
            && (int) $record->verifier_id === (int) $user->id
            && in_array($record->status, ['submitted', 'verified'], true);
    }

    private function canApprove(): bool
    {
        $record = $this->record;
        if (! $record instanceof ContentProposal) {
            return false;
        }

        $user = auth()->user();
        if (! $user) {
            return false;
        }

        return $user->canApproveContentProposal()
            && in_array($record->status, ['verified', 'submitted', 'approved'], true);
    }

    private function decisionMode(): ?string
    {
        if ($this->canApprove()) {
            return 'approve';
        }

        if ($this->canVerify()) {
            return 'verify';
        }

        return null;
    }

    private function decisionOptions(): array
    {
        return match ($this->decisionMode()) {
            'approve' => [
                'approved' => __('Setujui'),
                'rejected' => __('Kembalikan'),
            ],
            'verify' => [
                'verified' => __('Setujui'),
                'rejected' => __('Kembalikan'),
            ],
            default => [],
        };
    }
}
