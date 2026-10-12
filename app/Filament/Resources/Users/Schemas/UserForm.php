<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('role')
                    ->label('Peran (Role)')
                    ->options(UserRole::class)
                    ->default('admin')
                    ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Set $set, $state) {
                        if ($state === 'super_admin') {
                            $set('website_id', null);
                        }
                    })
                    ->required(),
                Select::make('website_id')
                    ->label('Unit Kerja (UPTD / Portal)')
                    ->relationship('website', 'name')
                    ->searchable()
                    ->preload()
                    ->required(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('role') === 'admin')
                    ->hidden(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('role') === 'super_admin'),
                Toggle::make('is_content_verifier')
                    ->label('Sebagai Verifikator Konten')
                    ->default(false)
                    ->helperText('User ini dapat menjadi editor/verifikator usulan konten.'),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
            ]);
    }
}
