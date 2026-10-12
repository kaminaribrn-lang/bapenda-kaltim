<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Website;
use App\Traits\RendersDynamicPage;

class ProfilController extends Controller
{
    use RendersDynamicPage;

    private function getCommonData(Website $website)
    {
        return [
            'website' => $website,
            'identity' => $website->identity,
            'menus' => Menu::getForWebsite($website),
        ];
    }

    public function kepalaBapenda(Website $website)
    {
        return $this->renderMenuPage($website, 'kepala-bapenda', 'portal.profil.kepala-bapenda', $this->getCommonData($website));
    }

    public function strukturOrganisasi(Website $website)
    {
        return $this->renderMenuPage($website, 'struktur-organisasi', 'portal.profil.struktur-organisasi', $this->getCommonData($website));
    }

    public function visiMisi(Website $website)
    {
        return $this->renderMenuPage($website, 'visi-misi', 'portal.profil.visi-misi', $this->getCommonData($website));
    }

    public function maklumatLayanan(Website $website)
    {
        return $this->renderMenuPage($website, 'maklumat-layanan', 'portal.profil.maklumat-layanan', $this->getCommonData($website));
    }

    public function tentangBapenda(Website $website)
    {
        return $this->renderMenuPage($website, 'tentang-bapenda', 'portal.profil.tentang-bapenda', $this->getCommonData($website));
    }
}
