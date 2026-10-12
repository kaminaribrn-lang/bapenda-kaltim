<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('caption')
                    ->label(__('Judul Foto'))
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state ?? '')))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->rows(3)
                    ->columnSpanFull(),

                Section::make(__('Gambar'))
                    ->relationship('file')
                    ->schema([
                        FileUpload::make('path')
                            ->label(__('Pilih Gambar'))
                            ->disk('public')
                            ->directory(fn () => \App\Models\Website::getUploadDir('galleries'))
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                            ->maxSize(5120)
                            ->required()
                            ->helperText(__('Format: JPG, PNG, atau GIF. Maksimal 5MB.')),
                        Hidden::make('name')->default('gallery_image'),
                        Hidden::make('disk')->default('public'),
                        Hidden::make('type')->default('image'),
                        Hidden::make('user_id')->default(fn () => auth()->id()),
                    ])
                    ->columnSpanFull(),

                Toggle::make('featured')
                    ->label(__('Tampilkan sebagai unggulan'))
                    ->default(false),

                Toggle::make('status')
                    ->label(__('Aktif'))
                    ->default(true)
                    ->helperText(__('Hanya foto aktif yang akan ditampilkan di website')),
            ])
            ->columns(2);
    }
}
