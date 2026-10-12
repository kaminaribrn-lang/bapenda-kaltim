<?php

namespace App\Filament\Resources\PpidPages\Schemas;

use App\Filament\Resources\DynamicPages\Schemas\DynamicPageForm;
use Filament\Schemas\Schema;

/**
 * Reuse the exact same form/field definitions as the regular "Halaman"
 * (DynamicPage) admin resource — the templates (penjelasan_1, penjelasan_2,
 * dokumen_list, dll) are fully generic and not tied to the website menu tree.
 */
class PpidPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return DynamicPageForm::configure($schema);
    }
}
