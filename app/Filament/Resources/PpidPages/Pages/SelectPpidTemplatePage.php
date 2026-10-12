<?php

namespace App\Filament\Resources\PpidPages\Pages;

use App\Filament\Resources\DynamicPages\Pages\SelectTemplatePage;
use App\Filament\Resources\PpidPages\PpidPageResource;
use Filament\Resources\Pages\Page;

class SelectPpidTemplatePage extends Page
{
    protected static string $resource = PpidPageResource::class;

    protected string $view = 'filament.resources.ppid-pages.pages.select-template';

    public function getTitle(): string
    {
        return __('Pilih Template Halaman PPID');
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label(__('Kembali ke Daftar'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(function () {
                    return PpidPageResource::getUrl('index');
                }),
        ];
    }

    /**
     * Reuse the same template catalogue (label/description/category/color)
     * used by the regular Halaman Dinamis admin — no need to duplicate it.
     */
    public function getTemplateData(): array
    {
        return SelectTemplatePage::getTemplateData();
    }

    public function getCreateUrl(string $template): string
    {
        return route('filament.admin.resources.ppid-pages.create', [
            'template' => $template,
        ]);
    }
}
