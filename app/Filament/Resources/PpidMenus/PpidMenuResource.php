<?php

namespace App\Filament\Resources\PpidMenus;

use App\Filament\Resources\PpidMenus\Pages\ListPpidMenus;
use App\Filament\Resources\PpidMenus\Schemas\PpidMenuForm;
use App\Filament\Resources\PpidMenus\Tables\PpidMenusTable;
use App\Models\Menu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PpidMenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    public static function getNavigationGroup(): ?string
    {
        return 'PPID';
    }

    public static function getNavigationLabel(): string
    {
        return __('Menu PPID');
    }

    public static function getModelLabel(): string
    {
        return __('Menu PPID');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Menu PPID');
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('position', 'ppid');
    }

    public static function form(Schema $schema): Schema
    {
        return PpidMenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PpidMenusTable::configure($table);
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
            'index' => ListPpidMenus::route('/'),
        ];
    }
}
