<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class EditDynamicPage extends EditRecord
{
    protected static string $resource = DynamicPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Pastikan field utama terisi jika otomatisasi gagal
        $data['title'] = $this->record->title;
        $data['slug'] = $this->record->slug;
        $data['template'] = $this->record->template;
        $data['menu_id'] = $this->record->menu_id;
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure published is always true (since we hid it in the form)
        if (!array_key_exists('published', $data) || is_null($data['published'])) {
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
                ->url(function () {
                    $menuId = $this->record->menu_id;
                    if ($menuId) {
                        $menu = \App\Models\Menu::find($menuId);
                        if ($menu) {
                            $root = $menu;
                            while ($root->parent_id) {
                                $parent = \App\Models\Menu::find($root->parent_id);
                                if (!$parent) break;
                                $root = $parent;
                            }
                            return DynamicPageResource::getUrl('index', ['active_id' => $root->id]);
                        }
                    }
                    return DynamicPageResource::getUrl('index');
                }),

            Action::make('save')
                ->label(__('Simpan Perubahan'))
                ->color('primary')
                ->icon('heroicon-m-check-circle')
                ->action('save'),


            DeleteAction::make(),
        ];
    }
}
