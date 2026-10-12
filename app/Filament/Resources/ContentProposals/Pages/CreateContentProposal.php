<?php

namespace App\Filament\Resources\ContentProposals\Pages;

use App\Filament\Resources\ContentProposals\ContentProposalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContentProposal extends CreateRecord
{
    protected static string $resource = ContentProposalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        $data['proposer_id'] = $user?->id;
        $data['status'] = 'submitted';

        if (empty($data['website_id']) && $user?->website_id) {
            $data['website_id'] = $user->website_id;
        }

        return $data;
    }
}
