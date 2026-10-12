<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Website;
use App\Traits\RendersDynamicPage;

class DataController extends Controller
{
    use RendersDynamicPage;

    private function getCommonData(Website $website): array
    {
        return [
            'website'  => $website,
            'identity' => $website->identity,
            'menus'    => Menu::getForWebsite($website),
        ];
    }

    public function retribusiDaerah(Website $website)
    {
        return $this->renderMenuPage($website, 'penerimaan-retribusi', 'portal.data.retribusi-daerah', $this->getCommonData($website));
    }

    public function pendapatanDaerah(Website $website)
    {
        return $this->renderMenuPage($website, 'pendapatan-daerah', 'portal.data.pendapatan-daerah', $this->getCommonData($website));
    }
}
