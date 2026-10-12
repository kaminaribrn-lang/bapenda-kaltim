<?php

namespace App\Filament\Resources\ContentProposals;

use App\Filament\Resources\ContentProposals\Pages\CreateContentProposal;
use App\Filament\Resources\ContentProposals\Pages\EditContentProposal;
use App\Filament\Resources\ContentProposals\Pages\ListContentProposals;
use App\Filament\Resources\ContentProposals\Pages\ViewContentProposal;
use App\Filament\Resources\ContentProposals\Schemas\ContentProposalForm;
use App\Filament\Resources\ContentProposals\Tables\ContentProposalsTable;
use App\Models\ContentProposal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContentProposalResource extends Resource
{
    protected static ?string $model = ContentProposal::class;

    protected static bool $isScopedToTenant = false;

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationLabel(): string
    {
        return __('Usulan Konten');
    }

    public static function getModelLabel(): string
    {
        return __('Usulan Konten');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Usulan Konten Desain');
    }

    protected static ?int $navigationSort = 9;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function canAccess(): bool
    {
        $user = auth()->user();

        // Semua user dapat mengakses usulan konten (view-only jika bukan penulis)
        return $user !== null;
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();

        return $user && ($user->isSuperAdmin() || $user->isAdmin());
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        // Hanya penginput yang boleh mengubah isi usulan, termasuk saat dikembalikan.
        if ((int) $record->proposer_id === (int) $user->id) {
            return in_array($record->status, ['submitted', 'verified', 'rejected'], true);
        }

        return false;
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        return (int) $record->proposer_id === (int) $user->id
            && in_array($record->status, ['submitted'], true);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['website', 'proposer', 'verifier', 'approver']);
        $user = auth()->user();

        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        // Semua user dapat melihat semua usulan konten
        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return ContentProposalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContentProposalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContentProposals::route('/'),
            'create' => CreateContentProposal::route('/create'),
            'view' => ViewContentProposal::route('/{record}'),
            'edit' => EditContentProposal::route('/{record}/edit'),
        ];
    }
}
