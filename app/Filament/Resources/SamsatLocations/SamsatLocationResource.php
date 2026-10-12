<?php

namespace App\Filament\Resources\SamsatLocations;

use App\Filament\Resources\SamsatLocations\Pages\CreateSamsatLocation;
use App\Filament\Resources\SamsatLocations\Pages\EditSamsatLocation;
use App\Filament\Resources\SamsatLocations\Pages\ListSamsatLocations;
use App\Filament\Resources\SamsatLocations\Schemas\SamsatLocationForm;
use App\Filament\Resources\SamsatLocations\Tables\SamsatLocationsTable;
use App\Models\SamsatLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SamsatLocationResource extends Resource
{
    protected static ?string $model = SamsatLocation::class;

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
        return __('Lokasi Samsat');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Peta Layanan Samsat');
    }

    public static function getNavigationLabel(): string
    {
        return __('Peta Layanan Samsat');
    }

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    public static function form(Schema $schema): Schema
    {
        return SamsatLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SamsatLocationsTable::configure($table);
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
            'index' => ListSamsatLocations::route('/'),
            'create' => CreateSamsatLocation::route('/create'),
            'edit' => EditSamsatLocation::route('/{record}/edit'),
        ];
    }
}
