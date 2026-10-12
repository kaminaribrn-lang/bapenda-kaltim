<?php

namespace App\Filament\Resources\FileSharings\Pages;

use App\Filament\Resources\FileSharings\FileSharingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFileSharing extends EditRecord
{
    protected static string $resource = FileSharingResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['is_folder'] = ($data['is_folder'] ?? false) ? 'folder' : 'file';
        $data['access_level'] = ($data['is_public'] ?? false) ? 'public' : 'restricted';

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['is_folder'] = ($data['is_folder'] ?? 'file') === 'folder';
        $data['is_public'] = ($data['access_level'] ?? 'restricted') === 'public';

        unset($data['access_level'], $data['share_link'], $data['share_token']);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
