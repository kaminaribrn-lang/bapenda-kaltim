<?php

namespace App\Filament\Resources\SamsatLocations\Schemas;

use App\Models\SamsatLocation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SamsatLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Informasi Lokasi'))
                    ->columns(2)
                    ->schema([
                        TextInput::make('wilayah')
                            ->label(__('Wilayah'))
                            ->placeholder(__('Contoh: Samarinda, Balikpapan, Kutai Kartanegara'))
                            ->required()
                            ->maxLength(255),

                        Select::make('jenis_layanan')
                            ->label(__('Jenis Layanan'))
                            ->helperText(__('Menentukan warna penanda & filter pada peta.'))
                            ->options(SamsatLocation::jenisOptions())
                            ->searchable()
                            ->required()
                            ->default('Lainnya'),

                        TextInput::make('nama')
                            ->label(__('Nama Resmi Layanan'))
                            ->placeholder(__('Contoh: Samsat Induk Samarinda'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('label_singkat')
                            ->label(__('Label Singkat (opsional)'))
                            ->placeholder(__('Contoh: Samarinda Utara — untuk referensi internal admin'))
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('alamat')
                            ->label(__('Alamat'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make(__('Koordinat Peta'))
                    ->description(__('Kosongkan jika belum diketahui — lokasi tetap tampil di daftar tapi tidak muncul sebagai penanda di peta.'))
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('latitude')
                                ->label(__('Latitude'))
                                ->numeric()
                                ->step('0.0000001')
                                ->placeholder('-0.5022'),

                            TextInput::make('longitude')
                                ->label(__('Longitude'))
                                ->numeric()
                                ->step('0.0000001')
                                ->placeholder('117.1486'),
                        ]),
                    ]),

                Section::make(__('Lainnya'))
                    ->columns(3)
                    ->schema([
                        TextInput::make('whatsapp')
                            ->label(__('No. WhatsApp (opsional)'))
                            ->placeholder('6281234500001')
                            ->tel()
                            ->maxLength(32),

                        TextInput::make('order')
                            ->label(__('Urutan'))
                            ->numeric()
                            ->default(0),

                        Toggle::make('status')
                            ->label(__('Tampilkan di Peta'))
                            ->onColor('success')
                            ->default(true),
                    ]),
            ]);
    }
}
