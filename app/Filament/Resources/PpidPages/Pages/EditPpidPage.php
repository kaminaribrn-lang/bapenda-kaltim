<?php

namespace App\Filament\Resources\PpidPages\Pages;

use App\Filament\Resources\PpidPages\PpidPageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPpidPage extends EditRecord
{
    protected static string $resource = PpidPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['title'] = $this->record->title;
        $data['slug'] = $this->record->slug;
        $data['template'] = $this->record->template;
        $data['menu_id'] = $this->record->menu_id;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! array_key_exists('published', $data) || is_null($data['published'])) {
            $data['published'] = true;
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(fn () => PpidPageResource::getUrl('index')),

            Action::make('save')
                ->label(__('Simpan Perubahan'))
                ->color('primary')
                ->icon('heroicon-m-check-circle')
                ->action('save'),

            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return PpidPageResource::getUrl('index');
    }
}
