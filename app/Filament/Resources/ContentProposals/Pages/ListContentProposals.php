<?php

namespace App\Filament\Resources\ContentProposals\Pages;

use App\Filament\Resources\ContentProposals\ContentProposalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContentProposals extends ListRecords
{
    protected static string $resource = ContentProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('Ajukan Konten')),
        ];
    }
}
