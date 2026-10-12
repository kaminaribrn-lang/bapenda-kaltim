<?php

namespace App\Filament\Resources\PpidPages\Pages;

use App\Filament\Resources\PpidPages\PpidPageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePpidPage extends CreateRecord
{
    protected static string $resource = PpidPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    // Persistent Livewire properties — survive re-renders (query params are lost after initial request)
    public ?int   $pageMenuId = null;
    public string $pageTemplate = '';

    public function mount(): void
    {
        parent::mount();

        if (request()->has('template')) {
            $this->pageMenuId = request()->integer('menu_id') ?: null;
            $this->pageTemplate = request('template', '');

            $this->form->fill([
                'template' => $this->pageTemplate,
                'menu_id' => $this->pageMenuId,
            ]);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['menu_id']) && $this->pageMenuId) $data['menu_id'] = $this->pageMenuId;
        if (empty($data['template']) && $this->pageTemplate) $data['template'] = $this->pageTemplate;

        // Auto-fill title and slug from Menu to satisfy DB constraints
        if (! empty($data['menu_id'])) {
            $menu = \App\Models\Menu::find($data['menu_id']);
            if ($menu) {
                $data['title'] = $menu->name;
                $data['slug'] = $menu->slug ?? \Illuminate\Support\Str::slug($menu->name);
            }
        }

        if (empty($data['title'])) $data['title'] = 'Halaman PPID ' . time();
        if (empty($data['slug'])) $data['slug'] = 'halaman-ppid-' . time();

        if (! array_key_exists('published', $data) || is_null($data['published'])) {
            $data['published'] = true;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // 1-to-1 enforcement: if a page already exists for this menu, update it instead of creating
        if (! empty($data['menu_id'])) {
            $existing = \App\Models\DynamicPage::where('menu_id', $data['menu_id'])->first();
            if ($existing) {
                $existing->update($data);
                return $existing;
            }
        }

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $i = 2;
        while (\App\Models\DynamicPage::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }
        $data['slug'] = $slug;

        return parent::handleRecordCreation($data);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(fn () => PpidPageResource::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return PpidPageResource::getUrl('index');
    }
}
