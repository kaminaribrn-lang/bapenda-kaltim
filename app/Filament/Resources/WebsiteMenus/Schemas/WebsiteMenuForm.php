<?php

namespace App\Filament\Resources\WebsiteMenus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WebsiteMenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('position')->default('website'),

                TextInput::make('name')
                    ->label(__('Nama Menu'))
                    ->required()
                    ->placeholder(__('Masukkan nama menu'))
                    ->maxLength(255),

                TextInput::make('link')
                    ->label(__('Alamat Tautan (URL)'))
                    ->placeholder(__('Contoh: /profil-website/visi-misi, route:portal.beranda, atau URL lengkap'))
                    ->maxLength(255)
                    ->default(function (\Livewire\Component $livewire) {
                        if (property_exists($livewire, 'parent_id') && $livewire->parent_id) {
                            $parent = \App\Models\Menu::find($livewire->parent_id);
                            if ($parent && $parent->link) {
                                return rtrim($parent->link, '/') . '/';
                            }
                        }
                        return '/';
                    }),

                TextInput::make('active_pattern')
                    ->label(__('Pattern Aktif (URL/Rute)'))
                    ->placeholder(__('Contoh: */profil* atau portal.beranda (pisahkan dengan koma jika lebih dari satu)'))
                    ->maxLength(255),

                Select::make('icon')
                    ->label(__('Ikon Dashboard'))
                    ->options([
                        '' => '— Tidak ada ikon —',
                        'home' => '🏠 Beranda',
                        'user' => '👤 Profil',
                        'newspaper' => '📰 Info & Berita',
                        'shield-check' => '🛡️ Peraturan',
                        'document-text' => '📄 Dokumen',
                        'headset' => '🎧 Layanan',
                        'default' => '☰ Umum (Menu)',
                    ])
                    ->afterStateHydrated(fn($component, $state) => $component->state($state ?? ''))
                    ->dehydrateStateUsing(fn($state) => $state ?: null)
                    ->default('default'),

                Textarea::make('svg_icon')
                    ->label(__('Ikon SVG (Path)'))
                    ->placeholder(__('Masukkan path data dari SVG (hanya atribut d="..." di dalam path)'))
                    ->rows(3),

                Select::make('css_variant')
                    ->label(__('Varian CSS (Warna)'))
                    ->options([
                        '' => 'Default (Primary)',
                        'danger' => 'Danger (Merah - e.g. PPID)',
                    ])
                    ->afterStateHydrated(fn($component, $state) => $component->state($state ?? ''))
                    ->dehydrateStateUsing(fn($state) => $state ?: null),

                Hidden::make('parent_id'),

                TextInput::make('order')
                    ->label(__('Urutan'))
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('status')
                    ->label(__('Aktif'))
                    ->onColor('info')
                    ->default(true),

                Toggle::make('open_in_new_tab')
                    ->label(__('Buka di Tab Baru'))
                    ->onColor('success')
                    ->default(false),
            ]);
    }
}
