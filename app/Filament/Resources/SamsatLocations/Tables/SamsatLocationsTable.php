<?php

namespace App\Filament\Resources\SamsatLocations\Tables;

use App\Models\SamsatLocation;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SamsatLocationsTable
{
    private const JENIS_COLORS = [
        'Induk' => 'success',
        'Penuh' => 'info',
        'Pembantu' => 'warning',
        'Payment Point' => 'gray',
        'Drive Thru' => 'danger',
        'Keliling' => 'purple',
        'Mall / Gerai' => 'info',
        'MPP' => 'success',
        'Pelita' => 'warning',
        'Paten' => 'gray',
    ];

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label(__('NO'))
                    ->rowIndex()
                    ->width('48px')
                    ->alignCenter(),

                TextColumn::make('wilayah')
                    ->label(__('WILAYAH'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nama')
                    ->label(__('NAMA LAYANAN'))
                    ->searchable()
                    ->wrap()
                    ->description(fn (SamsatLocation $record) => $record->alamat ? \Illuminate\Support\Str::limit($record->alamat, 70) : null),

                TextColumn::make('jenis_layanan')
                    ->label(__('JENIS'))
                    ->badge()
                    ->color(fn (?string $state) => self::JENIS_COLORS[$state] ?? 'gray'),

                IconColumn::make('koordinat')
                    ->label(__('KOORDINAT'))
                    ->state(fn (SamsatLocation $record) => $record->latitude !== null && $record->longitude !== null)
                    ->boolean()
                    ->trueIcon('heroicon-o-map-pin')
                    ->falseIcon('heroicon-o-question-mark-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn (SamsatLocation $record) => $record->latitude !== null
                        ? "{$record->latitude}, {$record->longitude}"
                        : __('Belum ada koordinat')),

                IconColumn::make('status')
                    ->label(__('TAMPIL'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('wilayah')
                    ->label(__('Wilayah'))
                    ->options(fn () => SamsatLocation::query()->distinct()->pluck('wilayah', 'wilayah')->filter()->all()),

                SelectFilter::make('jenis_layanan')
                    ->label(__('Jenis Layanan'))
                    ->options(SamsatLocation::jenisOptions()),

                TernaryFilter::make('status')
                    ->label(__('Status Tampil')),
            ])
            ->recordActions([
                EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('primary')
                    ->tooltip(__('Ubah')),
                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger')
                    ->tooltip(__('Hapus')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->searchPlaceholder(__('Cari nama, wilayah, atau alamat...'))
            ->emptyStateHeading(__('Belum ada lokasi Samsat'))
            ->emptyStateDescription(__('Tambahkan lokasi secara manual atau impor dari CSV.'))
            ->emptyStateIcon('heroicon-o-map-pin');
    }
}
