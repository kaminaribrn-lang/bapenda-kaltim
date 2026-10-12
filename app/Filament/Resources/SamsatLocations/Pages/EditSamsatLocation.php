<?php

namespace App\Filament\Resources\SamsatLocations\Pages;

use App\Filament\Resources\SamsatLocations\SamsatLocationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSamsatLocation extends EditRecord
{
    protected static string $resource = SamsatLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
