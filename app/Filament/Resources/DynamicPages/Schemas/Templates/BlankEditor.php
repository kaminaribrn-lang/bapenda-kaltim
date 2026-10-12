<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\RichEditor;

class BlankEditor implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            RichEditor::make('content.editor')
                ->label('Isi Konten Bebas')
                ->columnSpanFull()
                ->extraInputAttributes(['style' => 'min-height: 600px;']),
        ];
    }
}
