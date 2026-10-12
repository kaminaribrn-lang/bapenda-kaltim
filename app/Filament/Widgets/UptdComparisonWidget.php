<?php

namespace App\Filament\Widgets;

use App\Models\Website;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UptdComparisonWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    
    // Memberikan judul yang jelas untuk widget ini
    public function getTableHeading(): string
    {
        return __('📊 Performa & Statistik Konten Antar UPTD');
    }

    // Membatasi agar hanya SuperAdmin yang bisa melihat widget ini
    public static function canView(): bool
    {
        return auth()->user()->isSuperAdmin();
    }

    // Mengambil full width agar perbandingannya terlihat jelas
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Website::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Portal / UPTD')
                    ->weight('bold')
                    ->description(fn (Website $record) => $record->slug),
                
                Tables\Columns\TextColumn::make('users_count')
                    ->label('Admin')
                    ->counts('users')
                    ->badge()
                    ->color('primary')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('posts_count')
                    ->label('Berita')
                    ->counts('posts')
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('agenda_count')
                    ->label('Agenda')
                    ->counts('agenda')
                    ->badge()
                    ->color('warning')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('ppids_count')
                    ->label('PPID')
                    ->counts('ppids')
                    ->badge()
                    ->color('gray')
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Status Sistem')
                    ->boolean()
                    ->alignCenter()
                    ->tooltip(fn ($state) => $state ? 'Sistem Aktif' : 'Sistem Non-Aktif'),
            ])
            ->paginated(false);
    }
}
