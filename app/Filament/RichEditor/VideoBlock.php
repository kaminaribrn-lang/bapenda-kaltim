<?php

namespace App\Filament\RichEditor;

use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Storage;

class VideoBlock extends RichContentCustomBlock
{
    public const DISK = 'public';

    public const DIRECTORY = 'editor/videos';

    /** Batas unggah mengikuti upload_max_filesize PHP (10 MB). */
    public const MAX_SIZE_KB = 10240;

    public static function getId(): string
    {
        return 'video';
    }

    public static function getLabel(): string
    {
        return 'Video';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Sisipkan video dari YouTube atau unggah berkas video.')
            ->schema([
                ToggleButtons::make('source')
                    ->label('Sumber Video')
                    ->options([
                        'youtube' => 'Tautan YouTube',
                        'upload' => 'Unggah Berkas',
                    ])
                    ->default('youtube')
                    ->inline()
                    ->live()
                    ->required(),

                TextInput::make('url')
                    ->label('Tautan YouTube')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->url()
                    ->required()
                    ->rule(fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                        if (blank(static::youtubeId($value))) {
                            $fail('Tautan YouTube tidak valid.');
                        }
                    })
                    ->visible(fn (Get $get): bool => $get('source') !== 'upload'),

                FileUpload::make('file')
                    ->label('Berkas Video')
                    ->disk(static::DISK)
                    ->directory(static::DIRECTORY)
                    ->visibility('public')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                    ->maxSize(static::MAX_SIZE_KB)
                    ->helperText('Format MP4, WebM, atau OGG. Maksimal 10 MB — untuk video lebih besar gunakan tautan YouTube.')
                    ->required()
                    ->visible(fn (Get $get): bool => $get('source') === 'upload'),

                TextInput::make('caption')
                    ->label('Keterangan (opsional)')
                    ->maxLength(255),
            ]);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public static function getPreviewLabel(array $config): string
    {
        return filled($config['caption'] ?? null) ? 'Video: ' . $config['caption'] : 'Video';
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public static function toPreviewHtml(array $config): ?string
    {
        if (($config['source'] ?? 'youtube') === 'upload') {
            $file = static::filePath($config);

            return '<div style="padding:12px;font-size:13px;">Berkas video: ' . e(basename((string) $file)) . '</div>';
        }

        $id = static::youtubeId($config['url'] ?? null);

        if (blank($id)) {
            return '<div style="padding:12px;font-size:13px;">Tautan YouTube tidak valid.</div>';
        }

        return '<img src="https://img.youtube.com/vi/' . e($id) . '/hqdefault.jpg" alt="Pratinjau video YouTube" style="display:block;width:100%;max-width:360px;border-radius:8px;">';
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  array<string, mixed>  $data
     */
    public static function toHtml(array $config, array $data): ?string
    {
        if (($config['source'] ?? 'youtube') === 'upload') {
            $file = static::filePath($config);

            if (blank($file)) {
                return null;
            }

            $player = '<video controls preload="metadata" src="' . e(Storage::disk(static::DISK)->url($file)) . '" style="display:block;width:100%;border-radius:12px;background:#000;"></video>';
        } else {
            $id = static::youtubeId($config['url'] ?? null);

            if (blank($id)) {
                return null;
            }

            $player = '<div style="position:relative;width:100%;aspect-ratio:16/9;border-radius:12px;overflow:hidden;background:#000;">'
                . '<iframe src="https://www.youtube-nocookie.com/embed/' . e($id) . '" title="' . e($config['caption'] ?? 'Video') . '" loading="lazy" allowfullscreen'
                . ' allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"'
                . ' style="position:absolute;inset:0;width:100%;height:100%;border:0;"></iframe>'
                . '</div>';
        }

        $caption = filled($config['caption'] ?? null)
            ? '<figcaption style="margin-top:8px;font-size:0.875em;text-align:center;opacity:0.75;">' . e($config['caption']) . '</figcaption>'
            : '';

        return '<figure style="margin:1.5em 0;">' . $player . $caption . '</figure>';
    }

    public static function youtubeId(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $matched = preg_match(
            '~(?:youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{11})~',
            $url,
            $matches,
        );

        return $matched ? $matches[1] : null;
    }

    /**
     * @param  array<string, mixed>  $config
     */
    protected static function filePath(array $config): ?string
    {
        $file = $config['file'] ?? null;

        if (is_array($file)) {
            $file = array_values($file)[0] ?? null;
        }

        return filled($file) ? (string) $file : null;
    }
}
