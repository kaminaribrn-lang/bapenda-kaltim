<?php

namespace App\Filament\Resources\Infografis;

use App\Filament\Resources\Infografis\Pages\ListInfografis;
use App\Filament\Resources\Infografis\Pages\CreateInfografis;
use App\Filament\Resources\Infografis\Pages\EditInfografis;
use App\Models\Infografis;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class InfografisResource extends Resource
{
    protected static ?string $model = Infografis::class;
    protected static ?string $navigationLabel = 'Infografis';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?int $navigationSort = 6;

public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }
    public static function getNavigationParentItem(): ?string
    {
        return 'Beranda';
    }
    public static function getModelLabel(): string
    {
        return __('Infografis');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Infografis');
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return \App\Filament\Resources\Infografis\Schemas\InfografisForm::make($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\Infografis\Tables\InfografisTable::make($table);
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
            'index' => ListInfografis::route('/'),
            'create' => CreateInfografis::route('/create'),
            'edit' => EditInfografis::route('/{record}/edit'),
        ];
    }
}
