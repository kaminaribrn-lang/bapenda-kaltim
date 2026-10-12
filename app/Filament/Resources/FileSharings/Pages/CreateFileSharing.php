<?php

namespace App\Filament\Resources\FileSharings\Pages;

use App\Filament\Resources\FileSharings\FileSharingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFileSharing extends CreateRecord
{
    protected static string $resource = FileSharingResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_folder'] = ($data['is_folder'] ?? 'file') === 'folder';
        $data['is_public'] = ($data['access_level'] ?? 'restricted') === 'public';
        $data['user_id'] = auth()->id();

        unset($data['access_level'], $data['share_link'], $data['share_token']);

        return $data;
    }
}
