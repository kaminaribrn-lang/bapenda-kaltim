<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->label(__('Urutan'))
                    ->width('90px')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('question')
                    ->label(__('Pertanyaan'))
                    ->grow()
                    ->searchable()
                    ->limit(90)
                    ->wrap()
                    ->alignLeft()
                    ->extraHeaderAttributes(['class' => 'text-left'])
                    ->extraCellAttributes(['class' => 'text-left long-text-column']),

                IconColumn::make('is_featured')
                    ->label(__('Unggulan'))
                    ->width('110px')
                    ->alignCenter()
                    ->boolean(),

                IconColumn::make('status')
                    ->label(__('Status'))
                    ->width('100px')
                    ->alignCenter()
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label(__('Diubah'))
                    ->width('140px')
                    ->since()
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label(__('Status Tayang'))
                    ->trueLabel(__('Hanya Tayang'))
                    ->falseLabel(__('Hanya Tidak Tayang'))
                    ->native(false),

                TernaryFilter::make('is_featured')
                    ->label(__('FAQ Unggulan'))
                    ->trueLabel(__('Hanya Unggulan'))
                    ->falseLabel(__('Hanya Biasa'))
                    ->native(false),
            ])
            ->actions([
                EditAction::make()
                    ->label(__('Ubah')),
                DeleteAction::make()
                    ->label(__('Hapus')),
            ])
            ->actionsColumnLabel(__('Aksi'))
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsAlignment('center')
            ->reorderable('sort_order')
            ->searchPlaceholder(__('Cari FAQ...'))
            ->emptyStateHeading(__('Belum ada FAQ'))
            ->emptyStateDescription(__('Klik tombol "Buat FAQ" untuk menambahkan pertanyaan pertama.'));
    }
}
