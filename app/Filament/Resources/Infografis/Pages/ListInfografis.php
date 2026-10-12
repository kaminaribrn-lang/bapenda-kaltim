<?php

namespace App\Filament\Resources\Infografis\Pages;

use App\Filament\Resources\Infografis\InfografisResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Infografis;

class ListInfografis extends ListRecords
{
    protected static string $resource = InfografisResource::class;

    public function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
