<?php

namespace App\Filament\Resources\PpidMenus\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PpidMenusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('NAMA MENU'))
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('link')
                    ->label(__('LINK'))
                    ->color('gray')
                    ->placeholder('—'),

                TextColumn::make('parent.name')
                    ->label(__('PARENT'))
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->label(__('AKTIF'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? __('Aktif') : __('Tidak Aktif'))
                    ->color(fn ($state) => $state ? 'info' : 'danger'),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('submenu')
                    ->label(false)
                    ->icon('heroicon-s-list-bullet')
                    ->color('info')
                    ->url(function (\App\Models\Menu $record) {
                        return \App\Filament\Resources\PpidMenus\Pages\ListPpidMenus::getUrl(['parent_id' => $record->id]);
                    }),

                EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('primary')
                    ->modalHeading(__('Edit Menu PPID'))
                    ->modalWidth('2xl'),

                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger'),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }
}
