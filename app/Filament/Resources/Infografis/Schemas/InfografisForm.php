<?php

namespace App\Filament\Resources\Infografis\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class InfografisForm
{
    public static function make(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->schema([
                \Filament\Forms\Components\TextInput::make('caption')
                    ->label(__('Judul'))
                    ->placeholder(__('Masukkan judul infografis'))
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('link')
                    ->label(__('Alamat Tautan'))
                    ->placeholder(__('Masukkan URL tautan (opsional)'))
                    ->url()
                    ->maxLength(255),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->placeholder(__('Masukkan deskripsi infografis (opsional)'))
                    ->rows(4)
                    ->columnSpanFull(),
                \Filament\Forms\Components\Radio::make('status')
                    ->label(__('Status'))
                    ->boolean()
                    ->options([
                        1 => __('Tayang'),
                        0 => __('Konsep'),
                    ])
                    ->inline()
                    ->default(1),
                \Filament\Schemas\Components\Section::make(__('Gambar'))
                    ->relationship('file')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('path')
                            ->label(__('Pilih Gambar'))
                            ->disk('public')
                            ->directory(fn () => \App\Models\Website::getUploadDir('infografis'))
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->required()
                            ->helperText(__('Format: JPG, PNG, atau GIF. Maksimal 2MB.')),
                        \Filament\Forms\Components\Hidden::make('name')->default('infografis_image'),
                        \Filament\Forms\Components\Hidden::make('disk')->default('public'),
                        \Filament\Forms\Components\Hidden::make('type')->default('image'),
                    ]),
            ]);
    }
}
