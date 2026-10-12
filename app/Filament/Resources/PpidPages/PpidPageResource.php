<?php

namespace App\Filament\Resources\PpidPages;

use App\Filament\Resources\PpidPages\Pages\CreatePpidPage;
use App\Filament\Resources\PpidPages\Pages\EditPpidPage;
use App\Filament\Resources\PpidPages\Pages\SelectPpidMenuPage;
use App\Filament\Resources\PpidPages\Pages\SelectPpidTemplatePage;
use App\Filament\Resources\PpidPages\Schemas\PpidPageForm;
use App\Models\DynamicPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;

class PpidPageResource extends Resource
{
    protected static ?string $model = DynamicPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentDuplicate;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'PPID';
    }

    public static function getModelLabel(): string
    {
        return __('Halaman PPID');
    }

    public static function getNavigationLabel(): string
    {
        return __('Halaman PPID');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Halaman PPID');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('menu', fn (Builder $query) => $query->where('position', 'ppid'));
    }

    public static function form(Schema $schema): Schema
    {
        return PpidPageForm::configure($schema);
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
            'index' => SelectPpidMenuPage::route('/'),
            'select-template' => SelectPpidTemplatePage::route('/select-template'),
            'create' => CreatePpidPage::route('/create'),
            'edit' => EditPpidPage::route('/{record}/edit'),
        ];
    }
}
