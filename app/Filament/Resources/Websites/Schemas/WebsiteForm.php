<?php

namespace App\Filament\Resources\Websites\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WebsiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Portal / UPTD')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('domain')
                    ->label('Custom Domain (Opsional)')
                    ->placeholder('contoh: uptd-samarinda.kaltimprov.go.id'),
                Toggle::make('is_main')
                    ->label('Portal Utama?')
                    ->default(false),
                Toggle::make('status')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
