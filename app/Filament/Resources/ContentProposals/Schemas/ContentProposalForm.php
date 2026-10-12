<?php

namespace App\Filament\Resources\ContentProposals\Schemas;

use App\Models\ContentProposal;
use App\Models\User;
use App\Models\Website;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContentProposalForm
{
    public static function configure(Schema $schema): Schema
    {
        $record = $schema->getRecord();
        $authUser = auth()->user();
        $user = $authUser instanceof User ? $authUser : null;

        // Check if user is the proposer (penginput)
        $isProposer = $record instanceof ContentProposal
            && $user
            && (int) $record->proposer_id === (int) $user->id;
        $isSuperAdmin = $user && $user->isSuperAdmin();
        $canEdit = $isSuperAdmin || $isProposer;

        return $schema
            ->components([
                Section::make(__('Informasi Usulan'))
                    ->schema([
                        Select::make('website_id')
                            ->label(__('Website / UPTD Tujuan'))
                            ->options(fn () => Website::query()->orderBy('name')->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->required()
                            ->disabled(!$canEdit)
                            ->visible(fn () => auth()->user()?->isSuperAdmin())
                            ->default(fn () => auth()->user()?->website_id),

                        TextInput::make('title')
                            ->label(__('Judul Konten'))
                            ->placeholder(__('Masukkan judul usulan konten'))
                            ->required()
                            ->maxLength(255)
                            ->disabled(!$canEdit)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label(__('Deskripsi / Keterangan'))
                            ->placeholder(__('Jelaskan konsep desain atau konten yang diusulkan'))
                            ->rows(5)
                            ->disabled(!$canEdit)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(__('Rencana Upload'))
                    ->schema([
                        DatePicker::make('planned_upload_at')
                            ->label(__('Tanggal Rencana Upload'))
                            ->required()
                            ->disabled(!$canEdit),

                        CheckboxList::make('upload_channels')
                            ->label(__('Platform Upload'))
                            ->options(ContentProposal::uploadChannelOptions())
                            ->columns(2)
                            ->required()
                            ->disabled(!$canEdit)
                            ->columnSpanFull(),

                        TextInput::make('target_link')
                            ->label(__('Link Cek / Referensi'))
                            ->placeholder(__('https://...'))
                            ->url()
                            ->maxLength(255)
                            ->disabled(!$canEdit)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make(__('Verifikasi Editor Konten'))
                    ->schema([
                        TextInput::make('status')
                            ->label(__('Status Workflow'))
                            ->default('submitted')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }
}
