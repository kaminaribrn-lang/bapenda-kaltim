<?php

namespace App\Support;

use App\Filament\RichEditor\VideoBlock;
use Filament\Forms\Components\RichEditor\RichContentRenderer;

class RichContent
{
    /**
     * Blok kustom (mis. video) yang tersedia di semua RichEditor.
     *
     * @return array<class-string>
     */
    public static function customBlocks(): array
    {
        return [
            VideoBlock::class,
        ];
    }

    /**
     * Ubah konten RichEditor menjadi HTML siap tampil di halaman publik.
     * Konten tanpa blok kustom dikembalikan apa adanya.
     */
    public static function html(?string $content): string
    {
        if (blank($content)) {
            return '';
        }

        if (! str_contains($content, 'data-type="customBlock"')) {
            return $content;
        }

        return RichContentRenderer::make($content)
            ->customBlocks(static::customBlocks())
            ->fileAttachmentsDisk('public')
            ->fileAttachmentsVisibility('public')
            ->toUnsafeHtml();
    }
}
