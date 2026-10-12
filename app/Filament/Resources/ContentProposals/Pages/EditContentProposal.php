<?php

namespace App\Filament\Resources\ContentProposals\Pages;

use App\Filament\Resources\ContentProposals\ContentProposalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContentProposal extends EditRecord
{
    protected static string $resource = ContentProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label(__('Hapus')),
        ];
    }
}
