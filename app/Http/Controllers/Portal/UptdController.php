<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Post;
use App\Models\SamsatLocation;
use App\Models\Service;
use App\Models\Website;
use App\Models\WebsiteIdentity;

class UptdController extends Controller
{
    public function getUptdDataPublic(): array
    {
        return $this->getUptdData();
    }

    private function getUptdData(): array
    {
        return [
            'samarinda' => [
                'name' => 'Samarinda',
                'slug' => 'samarinda',
                'address' => 'Jl. Rapak Indah No.99, Loa Bakung, Samarinda, Kalimantan Timur 75243',
                'phone' => '(0541) 734969',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Samarinda melayani administrasi Pajak Kendaraan Bermotor (PKB), Bea Balik Nama Kendaraan Bermotor (BBNKB), dan Pajak Air Permukaan untuk wilayah Kota Samarinda.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.658607639148!2d117.1472533!3d-0.4950073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f3b8909115f%3A0xc6c429589a1c13bc!2sSamarinda!5e0!3m2!1sen!2sid!4v1700000000000',
            ],
            'balikpapan' => [
                'name' => 'Balikpapan',
                'slug' => 'balikpapan',
                'address' => 'Jl. Jend. Sudirman No.22, Balikpapan Kota, Kalimantan Timur 76112',
                'phone' => '(0542) 421234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Balikpapan melayani administrasi pajak kendaraan bermotor dan pendapatan daerah lainnya untuk wilayah Kota Balikpapan.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d116.8529!3d-1.2654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df148b57a3bcacb%3A0x8b11be14d55e5628!2sBalikpapan!5e0!3m2!1sen!2sid!4v1700000000001',
            ],
            'kutai-kartanegara' => [
                'name' => 'Kutai Kartanegara',
                'slug' => 'kutai-kartanegara',
                'address' => 'Jl. Wolter Monginsidi, Tenggarong, Kutai Kartanegara, Kalimantan Timur',
                'phone' => '(0541) 661100',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Kutai Kartanegara melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Kutai Kartanegara.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d117.0!3d-0.44!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df6c23b4e34f4cd%3A0x6b7b0e6d7c50f5a5!2sTenggarong!5e0!3m2!1sen!2sid!4v1700000000002',
            ],
            'kutai-timur' => [
                'name' => 'Kutai Timur',
                'slug' => 'kutai-timur',
                'address' => 'Jl. A.W Syahrani, Sangatta, Kutai Timur, Kalimantan Timur',
                'phone' => '(0549) 21234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Kutai Timur melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Kutai Timur dan sekitarnya.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d117.578!3d0.553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSangatta!5e0!3m2!1sen!2sid!4v1700000000003',
            ],
            'kutai-barat' => [
                'name' => 'Kutai Barat',
                'slug' => 'kutai-barat',
                'address' => 'Sendawar, Kutai Barat, Kalimantan Timur',
                'phone' => '(0545) 41234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Kutai Barat melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Kutai Barat.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d115.655!3d-0.135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sSendawar!5e0!3m2!1sen!2sid!4v1700000000004',
            ],
            'bontang' => [
                'name' => 'Bontang',
                'slug' => 'bontang',
                'address' => 'Jl. MH. Thamrin No.05, Bontang, Kalimantan Timur 75311',
                'phone' => '(0548) 21234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Bontang melayani administrasi pajak kendaraan bermotor untuk wilayah Kota Bontang.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d117.5!3d0.133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sBontang!5e0!3m2!1sen!2sid!4v1700000000005',
            ],
            'paser' => [
                'name' => 'Paser',
                'slug' => 'paser',
                'address' => 'Tanah Grogot, Paser, Kalimantan Timur',
                'phone' => '(0543) 21234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Paser melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Paser.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d116.18!3d-1.87!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTanah+Grogot!5e0!3m2!1sen!2sid!4v1700000000006',
            ],
            'penajam-paser-utara' => [
                'name' => 'Penajam Paser Utara',
                'slug' => 'penajam-paser-utara',
                'address' => 'Penajam, Penajam Paser Utara, Kalimantan Timur',
                'phone' => '(0542) 71234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Penajam Paser Utara melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Penajam Paser Utara.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d116.48!3d-1.46!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPenajam!5e0!3m2!1sen!2sid!4v1700000000007',
            ],
            'mahulu' => [
                'name' => 'Mahakam Ulu',
                'slug' => 'mahulu',
                'address' => 'Informasi alamat sedang disiapkan.',
                'phone' => '-',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'Informasi UPTD Mahakam Ulu sedang disiapkan.',
                'map_url' => null,
            ],
            'berau' => [
                'name' => 'Berau',
                'slug' => 'berau',
                'address' => 'Tanjung Redeb, Berau, Kalimantan Timur 77311',
                'phone' => '(0554) 21234',
                'hours' => 'Senin - Kamis: 08.00 - 14.00 | Jumat: 08.00 - 11.30',
                'description' => 'UPTD Pelayanan Pajak Berau melayani administrasi pajak kendaraan bermotor untuk wilayah Kabupaten Berau.',
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127825.23!2d117.49!3d2.16!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTanjung+Redeb!5e0!3m2!1sen!2sid!4v1700000000008',
            ],
        ];
    }

    private function getMenus(Website $website)
    {
        return Menu::getForWebsite($website);
    }

    /**
     * Website milik UPTD untuk slug halaman ini.
     * Beberapa UPTD punya dua website (slug panjang & singkatan); slug halaman didahulukan.
     *
     * @return \Illuminate\Support\Collection<int, Website>
     */
    private function uptdWebsites(string $slug): \Illuminate\Support\Collection
    {
        $aliases = [
            'kutai-kartanegara' => 'kukar',
            'kutai-timur' => 'kutim',
            'kutai-barat' => 'kubar',
            'penajam-paser-utara' => 'ppu',
        ];

        $slugs = array_values(array_filter([$slug, $aliases[$slug] ?? null]));

        return Website::whereIn('slug', $slugs)
            ->where('is_main', false)
            ->with(['identity' => fn ($query) => $query->withoutGlobalScopes()])
            ->get()
            ->sortBy(fn (Website $site) => array_search($site->slug, $slugs))
            ->values();
    }

    /**
     * Identitas website milik UPTD (sumber pengaturan section sambutan).
     *
     * @param  \Illuminate\Support\Collection<int, Website>  $uptdWebsites
     */
    private function resolveWelcomeIdentity(\Illuminate\Support\Collection $uptdWebsites): ?WebsiteIdentity
    {
        // Website yang slug-nya sama dengan halaman selalu didahulukan (uptdWebsites() sudah mengurutkannya),
        // supaya halaman /uptd/{slug} sejalan dengan isian admin website {slug}.
        return $uptdWebsites
            ->map(fn (Website $site) => $site->identity)
            ->filter()
            ->first();
    }

    public function index(Website $website)
    {
        $identity = $website->identity;
        $menus = $this->getMenus($website);
        $allUptds = $this->getUptdData();

        return view('portal.uptd.index', compact('website', 'identity', 'menus', 'allUptds'));
    }

    public function show(Website $website, $slug)
    {
        $identity = $website->identity;
        $menus = $this->getMenus($website);
        $allUptds = $this->getUptdData();

        abort_unless(isset($allUptds[$slug]), 404);
        $uptd = $allUptds[$slug];

        $uptdWebsites = $this->uptdWebsites($slug);
        $uptdWebsiteIds = $uptdWebsites->pluck('id')->all();
        $welcomeIdentity = $this->resolveWelcomeIdentity($uptdWebsites);

        // Hanya layanan milik UPTD ini, bukan layanan website yang sedang dibuka.
        $services = Service::withoutGlobalScopes()
            ->whereIn('website_id', $uptdWebsiteIds)
            ->where('status', true)
            ->with('file')
            ->get();
        $samsatLocations = SamsatLocation::mapArraysForUptd($slug, $uptdWebsiteIds);

        // Berita milik UPTD ini; bila UPTD punya dua website, pakai yang pertama berisi berita.
        $beritaTerbaru = collect();
        foreach ($uptdWebsiteIds as $uptdWebsiteId) {
            $beritaTerbaru = Post::withoutGlobalScopes()
                ->where('website_id', $uptdWebsiteId)
                ->where('status', 1)
                ->with(['file', 'category', 'website'])
                ->latest('published_at')
                ->take(6)
                ->get();

            if ($beritaTerbaru->isNotEmpty()) {
                break;
            }
        }

        // Check if specific view exists for the UPTD slug
        if (view()->exists("portal.uptd.{$slug}")) {
            return view("portal.uptd.{$slug}", compact('website', 'identity', 'menus', 'uptd', 'services', 'welcomeIdentity', 'samsatLocations', 'beritaTerbaru'));
        }

        return view('portal.uptd.placeholder', compact('website', 'identity', 'menus', 'uptd'));
    }
}
