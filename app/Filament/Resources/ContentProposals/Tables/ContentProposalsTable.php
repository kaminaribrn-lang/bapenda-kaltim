<?php

namespace App\Filament\Resources\ContentProposals\Tables;

use App\Models\ContentProposal;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContentProposalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->label(__('Judul Usulan'))
                    ->searchable()
                    ->wrap()
                    ->alignLeft()
                    ->extraHeaderAttributes(['class' => 'text-left'])
                    ->extraCellAttributes(['class' => 'text-left long-text-column']),

                TextColumn::make('website.name')
                    ->label(__('Website/UPTD'))
                    ->badge()
                    ->searchable(),

                TextColumn::make('proposer.name')
                    ->label(__('Pengusul'))
                    ->searchable(),

                TextColumn::make('planned_upload_at')
                    ->label(__('Rencana Upload'))
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('upload_channels')
                    ->label(__('Platform'))
                    ->formatStateUsing(function ($state): string {
                        if (is_array($state)) {
                            $channels = $state;
                        } else {
                            $raw = (string) $state;
                            $decoded = json_decode($raw, true);
                            $channels = is_array($decoded)
                                ? $decoded
                                : (filled($raw) ? explode(',', $raw) : []);
                        }

                        $options = ContentProposal::uploadChannelOptions();
                        $placeholderTokens = ['', '-', '--', 'null', 'n/a', 'na'];

                        $labels = collect($channels)
                            ->map(fn ($channel): string => trim((string) $channel))
                            ->filter(function (string $channel) use ($placeholderTokens): bool {
                                return ! in_array(strtolower($channel), $placeholderTokens, true);
                            })
                            ->map(fn (string $channel): string => (string) ($options[$channel] ?? $channel))
                            ->filter(fn (string $label): bool => filled(trim($label)) && trim($label) !== '-')
                            ->values();

                        return $labels->isNotEmpty()
                            ? $labels->implode(', ')
                            : '-';
                    })
                    ->toggleable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ContentProposal::statusOptions()[$state] ?? $state)
                    ->color(fn (string $state): string => ContentProposal::statusColor($state)),

                IconColumn::make('is_publishable')
                    ->label(__('Layak Tayang'))
                    ->boolean()
                    ->toggleable(),

                TextColumn::make('verifier.name')
                    ->label(__('Verifikator'))
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('approver.name')
                    ->label(__('Disetujui Oleh'))
                    ->placeholder('-')
                    ->toggleable(),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options(ContentProposal::statusOptions()),
            ])
            ->actions([
                EditAction::make()
                    ->label(__('Ubah'))
                    ->visible(fn (ContentProposal $record): bool => self::canEdit($record)),

                Action::make('preview')
                    ->label(__('Preview'))
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn (ContentProposal $record): string => \App\Filament\Resources\ContentProposals\ContentProposalResource::getUrl('view', ['record' => $record])),

                DeleteAction::make()
                    ->label(__('Hapus')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('Aksi'))
            ->actionsAlignment('center')
            ->searchPlaceholder(__('Cari judul usulan...'))
            ->emptyStateHeading(__('Belum ada usulan konten'))
            ->emptyStateDescription(__('Admin UPTD maupun admin utama dapat membuat usulan konten dari halaman ini.'));
    }

    private static function canEdit(ContentProposal $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        // Super admin can edit
        if ($user->isSuperAdmin()) {
            return true;
        }

        // ONLY proposer (penginput) can edit
        return (int) $record->proposer_id === (int) $user->id
            && in_array($record->status, ['submitted', 'verified', 'rejected'], true);
    }

    private static function canVerify(ContentProposal $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        // Super admin can verify
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Only assigned verifier can verify
        return $user->isContentVerifier()
            && (int) $record->verifier_id === (int) $user->id
            && in_array($record->status, ['submitted', 'verified'], true);
    }

    private static function canApprove(ContentProposal $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        // Only approver (admin/super admin) can approve
        return $user->canApproveContentProposal()
            && in_array($record->status, ['verified', 'submitted', 'approved'], true);
    }

}
