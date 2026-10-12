<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label(__('Pertanyaan'))
                    ->placeholder(__('Masukkan pertanyaan FAQ'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                RichEditor::make('answer')
                    ->label(__('Jawaban'))
                    ->placeholder(__('Masukkan jawaban FAQ'))
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label(__('Urutan'))
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                Toggle::make('is_featured')
                    ->label(__('FAQ Unggulan'))
                    ->default(false),

                Toggle::make('status')
                    ->label(__('Tampilkan'))
                    ->default(true),
            ]);
    }
}
