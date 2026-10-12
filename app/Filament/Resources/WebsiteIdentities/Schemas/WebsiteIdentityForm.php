<?php

namespace App\Filament\Resources\WebsiteIdentities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class WebsiteIdentityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('WebsiteIdentityTabs')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Identitas & Kontak')
                            ->icon('heroicon-m-identification')
                            ->schema([
                                // ── Informasi Dasar ──────────────────────────────────────────
                Section::make(__('Informasi Dasar'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Nama Website'))
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label(__('Deskripsi Website'))
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Hero Beranda ─────────────────────────────────────────────
                Section::make(__('Hero Beranda'))
                    ->description(__('Gambar latar bagian paling atas halaman beranda. Kosongkan untuk memakai gambar bawaan.'))
                    ->schema([
                        FileUpload::make('hero_background')
                            ->label(__('Gambar Latar Hero'))
                            ->image()
                            ->disk('public')
                            ->directory('identity/hero')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '21:9'])
                            ->maxSize(4096)
                            ->helperText(__('Disarankan gambar mendatar minimal 1920×800 piksel, maksimal 4 MB. Gambar akan digelapkan otomatis agar teks tetap terbaca.'))
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Sambutan Beranda ─────────────────────────────────────────
                Section::make(__('Sambutan Beranda'))
                    ->description(__('Isi dan foto pada bagian "Selamat Datang" di halaman beranda. Kolom yang dikosongkan memakai teks bawaan.'))
                    ->schema([
                        Textarea::make('welcome_title')
                            ->label(__('Judul Sambutan'))
                            ->placeholder("Selamat Datang\ndi Website Resmi")
                            ->helperText(__('Baris baru (Enter) menjadi baris kedua judul.'))
                            ->rows(2)
                            ->maxLength(255),

                        Textarea::make('welcome_subtitle')
                            ->label(__('Nama Instansi (teks berwarna)'))
                            ->placeholder("UPTD PPRD Wilayah\nSamarinda - Prov Kaltim")
                            ->helperText(__('Maksimal dua baris: baris pertama dan baris kedua di bawah judul.'))
                            ->rows(2),

                        Textarea::make('welcome_content')
                            ->label(__('Isi Sambutan'))
                            ->placeholder(__('Contoh: Mewujudkan tata kelola pendapatan daerah yang inovatif, transparan, dan akuntabel...'))
                            ->rows(4)
                            ->maxLength(600)
                            ->columnSpanFull(),

                        FileUpload::make('welcome_photo')
                            ->label(__('Foto Pimpinan'))
                            ->image()
                            ->disk('public')
                            ->directory('identity/welcome')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['3:4'])
                            ->maxSize(2048)
                            ->helperText(__('Disarankan potret rasio 3:4, maksimal 2 MB.'))
                            ->columnSpanFull(),

                        TextInput::make('welcome_leader_name')
                            ->label(__('Nama Pimpinan'))
                            ->placeholder('Contoh: Dra. Hj. Ismiati, M.Si')
                            ->maxLength(255),

                        TextInput::make('welcome_leader_position')
                            ->label(__('Jabatan'))
                            ->placeholder('Contoh: Kepala Bapenda Kaltim')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Logo & Ikon ───────────────────────────────────────────────
                Section::make(__('Logo & Ikon'))
                    ->schema([
                        FileUpload::make('logo')
                            ->label(__('Logo Utama (Kabupaten)'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText(__('Logo daerah/kabupaten yang tampil di kiri header.')),

                        FileUpload::make('logo_secondary')
                            ->label(__('Logo Kedua (Inspektorat)'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText(__('Logo inspektorat yang tampil di sebelah logo utama.')),

                        FileUpload::make('favicon')
                            ->label(__('Favicon'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Kontak ────────────────────────────────────────────────────
                Section::make(__('Kontak'))
                    ->schema([
                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone')
                            ->tel(),

                        TextInput::make('header_contact_text')
                            ->label(__('Teks Kontak'))
                            ->placeholder(__('Ada Pertanyaan? Hubungi kami')),

                        TextInput::make('whatsapp')
                            ->label(__('Nomor WhatsApp'))
                            ->tel()
                            ->placeholder(__('Contoh: 081138133333')),

                        Textarea::make('address')
                            ->label(__('Alamat Kantor'))
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Textarea::make('google_maps_embed')
                            ->label(__('Google Maps Embed (Iframe)'))
                            ->placeholder(__('Tempel kode <iframe src="..."> dari Google Maps di sini'))
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText(__('Gunakan fitur "Share > Embed a map" di Google Maps untuk mendapatkan kodenya.')),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Media Sosial ──────────────────────────────────────────────
                Section::make(__('Media Sosial'))
                    ->description(__('Tautan akun resmi website ini. Ditampilkan di bagian "Media Sosial" beranda dan di footer. Bila semuanya kosong, beranda menampilkan akun Bapenda Kaltim.'))
                    ->schema([
                        TextInput::make('instagram')
                            ->label(__('Instagram'))
                            ->url()
                            ->placeholder('https://www.instagram.com/namaakun')
                            ->helperText(__('Akun ini juga dipakai untuk kotak "Ikuti Kami di Instagram".')),

                        TextInput::make('facebook')
                            ->label(__('Facebook'))
                            ->url()
                            ->placeholder('https://www.facebook.com/namahalaman'),

                        TextInput::make('youtube')
                            ->label(__('YouTube'))
                            ->url()
                            ->placeholder('https://www.youtube.com/@namakanal'),

                        TextInput::make('twitter')
                            ->label(__('X (Twitter)'))
                            ->url()
                            ->placeholder('https://x.com/namaakun'),

                        TextInput::make('tiktok')
                            ->label(__('TikTok'))
                            ->url()
                            ->placeholder('https://www.tiktok.com/@namaakun'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Profil & Footer')
                            ->icon('heroicon-m-users')
                            ->schema([
                                // ── Foto Pejabat ──────────────────────────────────────────────
                Section::make(__('Foto Pejabat (Tim Pimpinan)'))
                    ->schema([
                        Repeater::make('leaders')
                            ->label(false)
                            ->schema([
                                FileUpload::make('photo')
                                    ->label(__('Foto'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('identity/leaders')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        '4:5',
                                    ])
                                    ->maxSize(2048)
                                    ->required(),

                                TextInput::make('name')
                                    ->label(__('Nama Pimpinan'))
                                    ->placeholder('Contoh: Margono, S.T., M.Si')
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('position')
                                    ->label(__('Jabatan'))
                                    ->placeholder('Contoh: Inspektur Kabupaten Mahakam Ulu')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(10)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel(false)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Link-Link Footer ──────────────────────────────────────────
                Section::make(__('Link-Link Footer'))
                    ->description(__('Kelola link yang ditampilkan di bagian footer website'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                // Kolom 1: Link Terkait
                                Repeater::make('footer_links_related')
                                    ->label(__('Link Terkait'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Link'))
                                            ->placeholder(__('Contoh: KEMENDAGRI'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Link Terkait')),

                                // Kolom 2: Inspektorat Kota
                                Repeater::make('footer_links_city')
                                    ->label(__('Inspektorat Kota'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Kota'))
                                            ->placeholder(__('Contoh: Balikpapan'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Inspektorat Kota')),

                                // Kolom 3: Inspektorat Kabupaten
                                Repeater::make('footer_links_regency')
                                    ->label(__('Inspektorat Kabupaten'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Kabupaten'))
                                            ->placeholder(__('Contoh: Kutai Barat'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Inspektorat Kab')),
                            ]),
                    ])
                    ->columnSpanFull(),

                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Integrasi & SEO')
                            ->icon('heroicon-m-globe-alt')
                            ->schema([
                                // ── GPR Kominfo Widget ────────────────────────────────────────
                Section::make(__('GPR Kominfo Widget'))
                    ->description(__('Konfigurasi widget berita GPR Kominfo yang tampil di halaman utama website.'))
                    ->schema([
                        Toggle::make('gpr_widget_status')
                            ->label(__('Aktifkan Widget GPR Kominfo'))
                            ->helperText(__('Aktifkan untuk menampilkan widget berita GPR di halaman utama.'))
                            ->default(false),

                        TextInput::make('gpr_widget_rss_url')
                            ->label(__('URL RSS Widget'))
                            ->url()
                            ->placeholder('https://widget.kominfo.go.id/data/latest/gpr.xml')
                            ->default('https://widget.kominfo.go.id/data/latest/gpr.xml')
                            ->helperText(__('URL sumber data RSS untuk widget GPR Kominfo.'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Survey Kepuasan Masyarakat ────────────────────────────────
                Section::make(__('Survey Kepuasan Masyarakat'))
                    ->description(__('Konfigurasi koneksi Survey Kepuasan Masyarakat.'))
                    ->schema([
                        TextInput::make('survey_link_url')
                            ->label(__('URL Survey Kepuasan Masyarakat'))
                            ->url()
                            ->placeholder('https://eskm-inspektorat.akkreatif.my.id/')
                            ->default('https://eskm-inspektorat.akkreatif.my.id/')
                            ->helperText(__('URL alamat website e-SKM (Survey Kepuasan Masyarakat).'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
            ])
            // ->columns(2); // Dihapus karena menyebabkan syntax error
                        ]) // <--- Tutup schema Tabs 'Integrasi & SEO'
                    ]) // <--- Tutup tabs WebsiteIdentityTabs
                ; // <--- Tutup components
    }
}
