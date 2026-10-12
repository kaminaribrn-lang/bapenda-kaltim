<?php

use App\Enums\UserRole;
use App\Filament\Resources\Faqs\Pages\CreateFaq;
use App\Filament\Resources\Faqs\Pages\ListFaqs;
use App\Filament\Resources\FileSharings\Pages\CreateFileSharing;
use App\Filament\Resources\FileSharings\Pages\EditFileSharing;
use App\Filament\Resources\Galleries\Pages\CreateGallery;
use App\Filament\Resources\PostCategories\Pages\CreatePostCategory;
use App\Filament\Resources\PostCategories\Pages\ListPostCategories;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\UserResource;
use App\Http\Controllers\Portal\UptdController;
use App\Models\Agenda;
use App\Models\DynamicPage;
use App\Models\Faq;
use App\Models\FileSharing;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Pengaduan;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PpidRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\Website;
use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    $this->seed();

    $this->admin = User::where('email', 'admin-samarinda@bapenda.go.id')->firstOrFail();
    $this->website = $this->admin->website;
    $this->actingAs($this->admin);

    Filament::setCurrentPanel(Filament::getPanel('admin'));
    Filament::setTenant($this->website);
});

test('faq input is saved under the tenant and displayed to its admin', function () {
    Livewire::test(CreateFaq::class)
        ->fillForm([
            'question' => 'Pertanyaan uji integrasi',
            'answer' => '<p>Jawaban uji integrasi.</p>',
            'sort_order' => 1,
            'is_featured' => false,
            'status' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('faqs', [
        'website_id' => $this->website->id,
        'question' => 'Pertanyaan uji integrasi',
    ]);

    Livewire::test(ListFaqs::class)
        ->assertSee('Pertanyaan uji integrasi');
});

test('super admin can create and edit a tenant admin from the user form', function () {
    $superAdmin = User::where('email', 'superadmin@bapenda.go.id')->firstOrFail();
    $balikpapan = Website::where('slug', 'balikpapan')->firstOrFail();
    $this->actingAs($superAdmin);

    expect(UserResource::canAccess())->toBeTrue();

    Livewire::test(CreateUser::class)
        ->fillForm([
            'role' => UserRole::Admin->value,
            'website_id' => $balikpapan->id,
            'name' => 'Admin Uji Balikpapan',
            'username' => 'admin-uji-balikpapan',
            'email' => 'admin-uji-balikpapan@example.test',
            'password' => 'Test-Only-Password-2026',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::where('email', 'admin-uji-balikpapan@example.test')->firstOrFail();
    expect($user->website_id)->toBe($balikpapan->id)
        ->and($user->role)->toBe(UserRole::Admin)
        ->and(\Illuminate\Support\Facades\Hash::check('Test-Only-Password-2026', $user->password))->toBeTrue();

    Livewire::test(ListUsers::class)
        ->set('tableSearch', 'Admin Uji Balikpapan')
        ->assertSee('Admin Uji Balikpapan');

    Livewire::test(EditUser::class, ['record' => $user->getRouteKey()])
        ->fillForm(['name' => 'Admin Balikpapan Terverifikasi', 'password' => null])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($user->fresh()->name)->toBe('Admin Balikpapan Terverifikasi');
});

test('database seeder creates one canonical website per regional unit', function () {
    expect(Website::count())->toBe(11)
        ->and(User::where('role', UserRole::Admin->value)->count())->toBe(11)
        ->and(User::where('role', UserRole::Admin->value)->distinct('website_id')->count())->toBe(11)
        ->and(Website::whereIn('slug', [
            'kutai-kartanegara',
            'kutai-timur',
            'kutai-barat',
            'penajam-paser-utara',
        ])->exists())->toBeFalse();
});

test('regional navigation links point to all canonical tenant homepages', function () {
    $websites = Website::where('is_main', false)->get();
    $expectedSlugs = ['samarinda', 'balikpapan', 'bontang', 'paser', 'kukar', 'kutim', 'mahulu', 'kubar', 'ppu', 'berau'];

    expect($websites->pluck('slug')->sort()->values()->all())
        ->toBe(collect($expectedSlugs)->sort()->values()->all())
        ->and(Website::where('is_main', true)->count())->toBe(1);

    foreach (Website::all() as $sourceWebsite) {
        $profileMenu = Menu::withoutGlobalScopes()
            ->where('website_id', $sourceWebsite->id)
            ->where('name', 'Profil')
            ->firstOrFail();
        $regionalLinks = Menu::withoutGlobalScopes()
            ->where('parent_id', $profileMenu->id)
            ->where('status', true)
            ->whereNotNull('link')
            ->get()
            ->filter(fn (Menu $menu) => preg_match('#^/[a-z0-9-]+$#', $menu->link));

        expect($regionalLinks)->toHaveCount(10);

        foreach ($websites as $targetWebsite) {
            $link = $regionalLinks->firstWhere('link', '/' . $targetWebsite->slug);

            expect($link)->not->toBeNull()
                ->and($link->portalHref($sourceWebsite))->toBe(url('/' . $targetWebsite->slug));
        }
    }
});

test('published dynamic pages render through tenant menu routes only for their own website', function () {
    $menu = Menu::create([
        'website_id' => $this->website->id,
        'name' => 'Halaman Dinamis Uji',
        'slug' => 'halaman-dinamis-uji',
        'position' => 'website',
        'order' => 999,
        'status' => true,
    ]);

    $page = DynamicPage::create([
        'website_id' => $this->website->id,
        'menu_id' => $menu->id,
        'slug' => 'halaman-dinamis-uji-samarinda',
        'title' => 'Halaman Dinamis Tenant Samarinda',
        'template' => 'blank_editor',
        'content' => ['editor' => '<p>Konten dinamis khusus Samarinda.</p>'],
        'published' => true,
    ]);

    expect($menu->portalHref($this->website))
        ->toBe(route('portal.page.show', [$this->website->slug, $menu->slug]));

    $this->get('/samarinda/halaman-dinamis-uji')
        ->assertOk()
        ->assertSee('Halaman Dinamis Tenant Samarinda')
        ->assertSee('Konten dinamis khusus Samarinda.');
    $this->get('/balikpapan/halaman-dinamis-uji')->assertNotFound();

    $page->update(['published' => false]);
    $this->get('/samarinda/halaman-dinamis-uji')->assertNotFound();
});

test('dynamic pages override supported static menu destinations for their tenant', function () {
    $menu = Menu::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('slug', 'kepala-bapenda')
        ->firstOrFail();

    $page = DynamicPage::create([
        'website_id' => $this->website->id,
        'menu_id' => $menu->id,
        'slug' => 'profil-kepala-samarinda-uji',
        'title' => 'Profil Kepala Samarinda Dinamis',
        'template' => 'blank_editor',
        'content' => ['editor' => '<p>Konten dinamis menu profil Samarinda.</p>'],
        'published' => true,
    ]);

    $this->get('/samarinda/profil/kepala-bapenda')
        ->assertOk()
        ->assertSee($page->title)
        ->assertSee('Konten dinamis menu profil Samarinda.');

    expect($menu->portalHref($this->website))
        ->toBe(route('portal.page.show', [$this->website->slug, $menu->slug]));
});

test('published dynamic content takes precedence over a configured static menu link', function () {
    $menu = Menu::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('position', 'website')
        ->where('name', 'Berita & Artikel')
        ->firstOrFail();

    $page = DynamicPage::create([
        'website_id' => $this->website->id,
        'menu_id' => $menu->id,
        'slug' => 'berita-dinamis-samarinda-uji',
        'title' => 'Informasi Samarinda Dinamis',
        'template' => 'blank_editor',
        'content' => ['editor' => '<p>Konten yang dikelola melalui halaman dinamis.</p>'],
        'published' => true,
    ]);

    $expectedUrl = route('portal.page.show', [$this->website->slug, $menu->slug]);

    expect($menu->portalHref($this->website))->toBe($expectedUrl);

    $this->get($expectedUrl)
        ->assertOk()
        ->assertSee($page->title)
        ->assertSee('Konten yang dikelola melalui halaman dinamis.');
});

test('regional admins cannot access other tenants or manage users', function () {
    $otherWebsite = Website::where('slug', 'balikpapan')->firstOrFail();
    $accessibleTenants = $this->admin->getTenants(Filament::getPanel('admin'));

    expect($this->admin->canAccessTenant($this->website))->toBeTrue()
        ->and($this->admin->canAccessTenant($otherWebsite))->toBeFalse()
        ->and($this->admin->canAccessTenant($this->admin))->toBeFalse()
        ->and($accessibleTenants->modelKeys())->toBe([$this->website->id])
        ->and(UserResource::canAccess())->toBeFalse();

    Faq::create([
        'website_id' => $this->website->id,
        'question' => 'FAQ hanya Samarinda',
        'answer' => '<p>Jawaban uji.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    Faq::withoutGlobalScopes()->create([
        'website_id' => $otherWebsite->id,
        'question' => 'FAQ hanya Balikpapan',
        'answer' => '<p>Jawaban uji tenant lain.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    Filament::setTenant($otherWebsite);

    expect(Faq::where('question', 'FAQ hanya Samarinda')->exists())->toBeTrue()
        ->and(Faq::where('question', 'FAQ hanya Balikpapan')->exists())->toBeFalse();
});

test('main website admins can access only the main website tenant', function () {
    $mainAdmin = User::where('email', 'admin@bapenda.go.id')->firstOrFail();
    $mainWebsite = Website::where('is_main', true)->firstOrFail();
    $regionalWebsite = Website::where('slug', 'samarinda')->firstOrFail();
    $this->actingAs($mainAdmin);
    Filament::setTenant($mainWebsite);

    expect($mainAdmin->canAccessTenant($mainWebsite))->toBeTrue()
        ->and($mainAdmin->canAccessTenant($regionalWebsite))->toBeFalse()
        ->and($mainAdmin->getTenants(Filament::getPanel('admin'))->modelKeys())->toBe([$mainWebsite->id]);

    Faq::create([
        'website_id' => $mainWebsite->id,
        'question' => 'FAQ khusus website utama',
        'answer' => '<p>Jawaban utama.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    Faq::withoutGlobalScopes()->create([
        'website_id' => $regionalWebsite->id,
        'question' => 'FAQ khusus UPTD Samarinda',
        'answer' => '<p>Jawaban UPTD.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    Filament::setTenant($regionalWebsite);

    expect(Faq::where('question', 'FAQ khusus website utama')->exists())->toBeTrue()
        ->and(Faq::where('question', 'FAQ khusus UPTD Samarinda')->exists())->toBeFalse();
});

test('UPTD directory links to all ten known units and rejects unknown units', function () {
    $uptds = app(UptdController::class)->getUptdDataPublic();

    expect($uptds)->toHaveCount(10);

    $directory = $this->get('/samarinda/uptd')->assertOk();

    foreach ($uptds as $slug => $uptd) {
        $directory->assertSee(route('portal.uptd.show', [
            'website' => $this->website->slug,
            'slug' => $slug,
        ]), false);

        $this->get('/samarinda/uptd/'.$slug)->assertOk();
    }

    $this->get('/samarinda/uptd/mahulu')
        ->assertOk()
        ->assertSee('Halaman sedang disiapkan')
        ->assertDontSee('Jl. Jend.')
        ->assertDontSee('Samsat Induk');
    $this->get('/samarinda/uptd/wilayah-tidak-terdaftar')->assertNotFound();
});

test('Mahakam Ulu tenant has an intentionally empty placeholder homepage', function () {
    $this->get('/mahulu')
        ->assertOk()
        ->assertSee('Halaman sedang disiapkan')
        ->assertSee('Informasi dan layanan UPTD Mahakam Ulu akan diperbarui setelah data resminya tersedia.')
        ->assertDontSee('Berita Uji')
        ->assertDontSee('Nomor Polisi');
});

test('every regional tenant homepage resolves to its matching page', function () {
    foreach ([
        'samarinda',
        'balikpapan',
        'bontang',
        'paser',
        'kukar',
        'kutim',
        'mahulu',
        'kubar',
        'ppu',
        'berau',
    ] as $slug) {
        $this->get('/'.$slug)->assertOk();
    }

    $this->get('/kutim')
        ->assertSee('UPTD PPRD Wilayah Kutai Timur')
        ->assertDontSee('UPTD PPRD Wilayah Kutai Kartanegara');
});

test('published services are shown only on their own tenant homepage', function () {
    $storageRoot = sys_get_temp_dir().DIRECTORY_SEPARATOR.'bapenda-services-'.bin2hex(random_bytes(8));
    config(['filesystems.disks.public.root' => $storageRoot]);
    Storage::forgetDisk('public');

    try {
        Livewire::test(CreateService::class)
            ->fillForm([
                'name' => 'Layanan Samarinda Uji',
                'description' => 'Layanan yang dikelola admin Samarinda.',
                'link' => null,
                'status' => true,
                'file' => [
                    'path' => UploadedFile::fake()->image('layanan-uji.png'),
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $service = Service::where('name', 'Layanan Samarinda Uji')->firstOrFail();
        expect($service->website_id)->toBe($this->website->id)
            ->and($service->file)->not->toBeNull();
        Storage::disk('public')->assertExists($service->file->path);

        $this->get('/samarinda')
            ->assertOk()
            ->assertSee('Layanan Samarinda Uji')
            ->assertSee(route('portal.layanan.index', $this->website->slug), false);
        $this->get('/samarinda/uptd/samarinda')
            ->assertOk()
            ->assertSee('Layanan Samarinda Uji');

        $this->get('/balikpapan')
            ->assertOk()
            ->assertDontSee('Layanan Samarinda Uji')
            ->assertSee('Belum ada layanan yang dipublikasikan.');
        $this->get('/balikpapan/uptd/samarinda')
            ->assertOk()
            ->assertDontSee('Layanan Samarinda Uji');
    } finally {
        Storage::forgetDisk('public');
        File::deleteDirectory($storageRoot);
    }
});

test('gallery upload is saved to the tenant and displayed on its public gallery page', function () {
    $storageRoot = sys_get_temp_dir().DIRECTORY_SEPARATOR.'bapenda-galleries-'.bin2hex(random_bytes(8));
    config(['filesystems.disks.public.root' => $storageRoot]);
    Storage::forgetDisk('public');

    try {
        Livewire::test(CreateGallery::class)
            ->fillForm([
                'caption' => 'Foto Kegiatan Uji',
                'description' => 'Foto untuk memastikan unggahan galeri tampil.',
                'featured' => false,
                'status' => true,
                'file' => [
                    'path' => UploadedFile::fake()->image('kegiatan-uji.png'),
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $gallery = Gallery::where('caption', 'Foto Kegiatan Uji')->firstOrFail();
        expect($gallery->website_id)->toBe($this->website->id)
            ->and($gallery->status)->toBe(1)
            ->and($gallery->slug)->toBe('foto-kegiatan-uji')
            ->and($gallery->file)->not->toBeNull();
        Storage::disk('public')->assertExists($gallery->file->path);

        $this->get('/samarinda/galeri')
            ->assertOk()
            ->assertSee('Foto Kegiatan Uji');
        $this->get('/balikpapan/galeri')
            ->assertOk()
            ->assertDontSee('Foto Kegiatan Uji');
    } finally {
        Storage::forgetDisk('public');
        File::deleteDirectory($storageRoot);
    }
});

test('agendas appear on the selected tenant public agenda page only', function () {
    $schedule = now()->addDays(2);
    Livewire::test(\App\Filament\Resources\Agendas\Pages\ListAgendas::class)
        ->callAction('create', data: [
            'temp_date' => $schedule->toDateString(),
            'temp_time' => $schedule->format('H:i'),
            'caption' => 'Agenda Samarinda Uji',
            'description' => 'Agenda publik untuk pengujian.',
            'location' => 'Kantor UPTD Samarinda',
        ]);

    $agenda = Agenda::where('caption', 'Agenda Samarinda Uji')->firstOrFail();
    expect($agenda->website_id)->toBe($this->website->id)
        ->and($agenda->schedule->toDateString())->toBe($schedule->toDateString());

    $query = http_build_query([
        'start_date' => $schedule->toDateString(),
        'end_date' => $schedule->toDateString(),
    ]);

    $this->get('/samarinda/informasi/agenda-kerja?'.$query)
        ->assertOk()
        ->assertSee('Agenda Samarinda Uji');
    $this->get('/balikpapan/informasi/agenda-kerja?'.$query)
        ->assertOk()
        ->assertDontSee('Agenda Samarinda Uji');
});

test('file-sharing folders preserve access selection and appear publicly only when enabled', function () {
    Livewire::test(CreateFileSharing::class)
        ->fillForm([
            'title' => 'Folder Uji Terbatas',
            'is_folder' => 'folder',
            'access_level' => 'restricted',
            'status' => 1,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $folder = FileSharing::where('title', 'Folder Uji Terbatas')->firstOrFail();
    expect($folder->website_id)->toBe($this->website->id)
        ->and($folder->user_id)->toBe($this->admin->id)
        ->and($folder->is_public)->toBeFalse()
        ->and($folder->share_code)->not->toBeEmpty();

    $this->get('/samarinda/dokumen')->assertDontSee('Folder Uji Terbatas');

    Livewire::test(EditFileSharing::class, ['record' => $folder->getRouteKey()])
        ->assertFormSet(['access_level' => 'restricted'])
        ->fillForm(['access_level' => 'public'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($folder->fresh()->is_public)->toBeTrue();
    expect($folder->publicShareUrl())->toContain('/samarinda/dokumen?folder='.$folder->id);
    $this->get('/samarinda/dokumen')->assertSee('Folder Uji Terbatas');
});

test('public file uploads are stored on the public disk and download from the portal', function () {
    $storageRoot = sys_get_temp_dir().DIRECTORY_SEPARATOR.'bapenda-public-'.bin2hex(random_bytes(8));
    config(['filesystems.disks.public.root' => $storageRoot]);
    Storage::forgetDisk('public');

    try {
        Livewire::test(CreateFileSharing::class)
            ->fillForm([
                'title' => 'Dokumen Uji',
                'is_folder' => 'file',
                'file_path' => UploadedFile::fake()->create('dokumen-uji.txt', 1, 'text/plain'),
                'access_level' => 'public',
                'status' => 1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $file = FileSharing::where('title', 'Dokumen Uji')->firstOrFail();
        expect($file->is_public)->toBeTrue()
            ->and(Storage::disk('public')->exists($file->file_path))->toBeTrue();

        $this->get('/samarinda/dokumen')->assertOk()->assertSee('Dokumen Uji');
        $this->get('/samarinda/dokumen/download/'.$file->share_code)
            ->assertOk()
            ->assertDownload('Dokumen Uji');

        expect($file->fresh()->download_count)->toBe(1);
    } finally {
        Storage::forgetDisk('public');
        File::deleteDirectory($storageRoot);
    }
});

test('category and published news input persist and appear in admin and public pages', function () {
    Livewire::test(CreatePostCategory::class)
        ->fillForm([
            'name' => 'Kategori Uji',
            'slug' => 'kategori-uji-integrasi',
            'active' => 1,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $category = PostCategory::where('slug', 'kategori-uji-integrasi')->firstOrFail();

    Livewire::test(ListPostCategories::class)
        ->set('tableSearch', 'Kategori Uji')
        ->assertSee('Kategori Uji');

    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Berita Uji Integrasi',
            'category_id' => $category->id,
            'content' => '<p>Konten berita uji.</p>',
            'status' => 1,
            'slug' => 'berita-uji-integrasi',
            'type' => 'post',
            'user_id' => $this->admin->id,
            'penulis' => $this->admin->name,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $post = Post::where('slug', 'berita-uji-integrasi')->firstOrFail();
    expect($post->website_id)->toBe($this->website->id)
        ->and($post->category_id)->toBe($category->id)
        ->and($post->user_id)->toBe($this->admin->id);

    Livewire::test(ListPosts::class)
        ->set('tableSearch', 'Berita Uji Integrasi')
        ->assertSee('Berita Uji Integrasi');

    $this->get('/samarinda/berita')
        ->assertOk()
        ->assertSee('Berita Uji Integrasi');
    $this->get('/samarinda/berita/berita-uji-integrasi')
        ->assertOk()
        ->assertSee('Konten berita uji.');
    $this->get('/samarinda')
        ->assertOk()
        ->assertSee('Berita Uji Integrasi');
    $this->get('/balikpapan')
        ->assertOk()
        ->assertDontSee('Berita Uji Integrasi');
});

test('public complaint submission can be tracked using its returned report code', function () {
    $this->get('/samarinda/pengaduan')->assertOk();
    $this->get('/samarinda/wbs')->assertOk();

    $response = $this->post('/samarinda/pengaduan', [
        'kategori' => 'Pajak Kendaraan',
        'nama_lengkap' => 'Pelapor Uji',
        'email' => 'pelapor-uji@example.test',
        'judul_laporan' => 'Pengaduan Uji',
        'kronologis' => 'Kronologi untuk pengujian alur.',
        'tanggal_kejadian' => now()->toDateString(),
    ]);

    $report = Pengaduan::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('judul_laporan', 'Pengaduan Uji')
        ->firstOrFail();

    $response->assertRedirect(route('portal.pengaduan.cek', $this->website->slug))
        ->assertSessionHas('kode_laporan', $report->kode_laporan);

    $this->post('/samarinda/pengaduan/cek', [
        'kode_laporan' => $report->kode_laporan,
    ])
        ->assertOk()
        ->assertSee('Pengaduan Uji')
        ->assertSee($report->kode_laporan);

    $anonymousResponse = $this->post('/samarinda/pengaduan', [
        'kategori' => 'Integritas',
        'is_anonymous' => 'on',
        'judul_laporan' => 'Laporan Anonim Uji',
        'kronologis' => 'Kronologi laporan anonim.',
        'tanggal_kejadian' => now()->toDateString(),
    ]);

    $anonymousReport = Pengaduan::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('judul_laporan', 'Laporan Anonim Uji')
        ->firstOrFail();

    expect($anonymousReport->is_anonymous)->toBeTrue()
        ->and($anonymousReport->nama_lengkap)->toBe('Anonim')
        ->and($anonymousReport->email)->toBeNull();
    $anonymousResponse->assertSessionHas('kode_laporan', $anonymousReport->kode_laporan);

    $wbsResponse = $this->post('/samarinda/wbs', [
        'judul_laporan' => 'Laporan WBS Uji',
        'kronologis' => 'Kronologi WBS.',
        'tanggal_kejadian' => now()->toDateString(),
        'unit_kerja' => 'UPTD Uji',
    ]);

    $wbsReport = Pengaduan::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('judul_laporan', 'Laporan WBS Uji')
        ->firstOrFail();

    expect($wbsReport->kategori)->toBe('WBS')
        ->and($wbsReport->is_anonymous)->toBeTrue();
    $wbsResponse->assertSessionHas('kode_laporan', $wbsReport->kode_laporan);
});

test('public PPID application is saved for the selected website and shown to its staff', function () {
    $this->get('/samarinda/ppid/permohonan')
        ->assertOk()
        ->assertSee('name="cara_memperoleh"', false);

    $applicationData = [
        'nama_lengkap' => 'Pemohon Uji',
        'nik' => '1234567890',
        'email' => 'pemohon-uji@example.test',
        'no_telepon' => '081234567890',
        'alamat' => 'Alamat uji',
        'pekerjaan' => 'Warga',
        'tujuan_penggunaan' => 'Pengujian alur permohonan informasi',
        'rincian_informasi' => 'Informasi uji',
        'cara_mendapatkan' => 'Mendapatkan Salinan',
        'cara_memperoleh' => 'Email',
    ];

    $this->from('/samarinda/ppid/permohonan')
        ->post('/samarinda/ppid/permohonan', array_diff_key($applicationData, ['cara_memperoleh' => true]))
        ->assertSessionHasErrors('cara_memperoleh');

    $this->post('/samarinda/ppid/permohonan', $applicationData)
        ->assertRedirect()
        ->assertSessionHas('success');

    $application = PpidRequest::withoutGlobalScopes()
        ->where('website_id', $this->website->id)
        ->where('nama_lengkap', 'Pemohon Uji')
        ->firstOrFail();

    expect($application->status)->toBe('baru')
        ->and($application->cara_memperoleh)->toBe('Email')
        ->and($application->kode_permohonan)->not->toBeEmpty();

    $superAdmin = User::where('email', 'superadmin@bapenda.go.id')->firstOrFail();
    $this->actingAs($superAdmin);
    Filament::setTenant($this->website);

    $this->get('/site-admin/samarinda/ppid-requests')
        ->assertOk()
        ->assertSee('Pemohon Uji');
});

test('all tenant-scoped admin pages render for the super admin', function () {
    $superAdmin = User::where('email', 'superadmin@bapenda.go.id')->firstOrFail();
    $this->actingAs($superAdmin);

    $routes = collect(app('router')->getRoutes())
        ->filter(fn ($route) => in_array('GET', $route->methods(), true))
        ->map(fn ($route) => $route->uri())
        ->filter(fn ($uri) => str_starts_with($uri, 'site-admin/{tenant}'))
        ->map(fn ($uri) => str_replace('{tenant}', 'utama', $uri))
        ->filter(fn ($uri) => ! str_contains($uri, '{'))
        ->unique()
        ->values();

    expect($routes)->not->toBeEmpty();

    foreach ($routes as $uri) {
        $response = $this->get('/'.$uri);

        if ($response->isRedirect()) {
            $location = parse_url($response->headers->get('Location'), PHP_URL_PATH);
            $response = $this->get($location);
        }

        expect($response->status())->toBe(
            200,
            'GET /'.$uri.' returned '.$response->status()
            .' ('.$response->headers->get('Location', 'no redirect target').')',
        );
    }
});

test('all static public portal pages render for a regional website', function () {
    $this->get('/')->assertOk();

    $routes = collect(app('router')->getRoutes())
        ->filter(fn ($route) => in_array('GET', $route->methods(), true))
        ->map(fn ($route) => $route->uri())
        ->filter(fn ($uri) => str_starts_with($uri, '{website}'))
        ->map(fn ($uri) => str_replace('{website}', 'samarinda', $uri))
        ->filter(fn ($uri) => ! str_contains($uri, '{'))
        ->unique()
        ->values();

    expect($routes)->not->toBeEmpty();

    foreach ($routes as $uri) {
        $response = $this->get('/'.$uri);

        if ($response->isRedirect()) {
            $location = parse_url($response->headers->get('Location'), PHP_URL_PATH);
            $response = $this->get($location);
        }

        expect($response->status())->toBe(
            200,
            'GET /'.$uri.' returned '.$response->status()
            .' ('.$response->headers->get('Location', 'no redirect target').')',
        );
    }
});

test('public FAQ page shows only active FAQs belonging to the selected website', function () {
    $otherWebsite = Website::where('slug', 'balikpapan')->firstOrFail();

    Faq::create([
        'website_id' => $this->website->id,
        'question' => 'FAQ Samarinda aktif',
        'answer' => '<p>Jawaban Samarinda.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    Faq::create([
        'website_id' => $this->website->id,
        'question' => 'FAQ Samarinda nonaktif',
        'answer' => '<p>Jawaban nonaktif.</p>',
        'sort_order' => 2,
        'status' => false,
    ]);

    Faq::create([
        'website_id' => $otherWebsite->id,
        'question' => 'FAQ Balikpapan',
        'answer' => '<p>Jawaban Balikpapan.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    $this->get('/samarinda/faq')
        ->assertOk()
        ->assertSee('FAQ Samarinda aktif')
        ->assertDontSee('FAQ Samarinda nonaktif')
        ->assertDontSee('FAQ Balikpapan');
});

test('UPTD FAQ page renders its FAQ instead of terminating the request', function () {
    Faq::create([
        'website_id' => $this->website->id,
        'uptd_slug' => 'samarinda',
        'question' => 'FAQ UPTD Samarinda',
        'answer' => '<p>Jawaban UPTD.</p>',
        'sort_order' => 1,
        'status' => true,
    ]);

    $this->get('/samarinda/samarinda/faq')
        ->assertOk()
        ->assertSee('FAQ UPTD Samarinda');
});
