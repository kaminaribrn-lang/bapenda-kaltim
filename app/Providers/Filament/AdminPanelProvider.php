<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;

use Illuminate\Support\Facades\Blade;
// use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Models\Website;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {


        return $panel
            ->default()
            ->id('admin')
            ->path('site-admin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->tenant(Website::class, slugAttribute: 'slug')
            ->tenantRegistration(null) // Matikan registrasi tenant baru oleh user
            ->tenantProfile(null)
            ->maxContentWidth('full')


            // === 1. LOGO & JUDUL DINAMIS ===
            ->brandName(fn () => \Filament\Facades\Filament::getTenant()?->name ?? __('BAPENDA'))
            ->brandLogo(fn () => new HtmlString('
                <div style="display: flex; align-items: center; gap: 12px; padding-left: 8px;">
                    <div class="brand-logo-wrap">
                        <img 
                            src="/images/kaltimlogo.png" 
                            onerror="this.style.display=\'none\'"
                            alt="Logo" 
                            style="height: 2.5rem; width: auto; object-fit: contain;"
                        >
                    </div>
                    <span class="brand-name-text">
                        ' . (\Filament\Facades\Filament::getTenant()?->name ?? 'BAPENDA') . '<br>
                        <span class="brand-sub-text">' . __('Prov. Kalimantan Timur') . '</span>
                    </span>
                </div>
            '))

            // === 2. MODIFIKASI TAMPILAN MODERN (CSS INJECTION) ===
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn(): string => Blade::render(<<<'HTML'
                <style>
                    /* --- 1. GLOBAL BACKGROUND --- */
                    .fi-layout, .fi-body {
                        background-color: #f8fafc !important; 
                    }
                    .dark .fi-layout, .dark .fi-body {
                        background-color: #020617 !important;
                    }

                    /* --- 2. BRAND LOGO --- */
                    .brand-logo-wrap {
                        background: white !important;
                        padding: 4px;
                        border-radius: 50%;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 45px;
                        height: 45px;
                        flex-shrink: 0;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    }
                    .dark .brand-logo-wrap {
                        background: white !important; /* Kembali ke putih agar logo terlihat jelas */
                        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2), 0 4px 10px rgba(0,0,0,0.3);
                        border: 1px solid rgba(255,255,255,0.1);
                    }

                    .dark .brand-logo-wrap img {
                        filter: brightness(1); /* Kembali ke normal */
                    }

                    .brand-logo-wrap:hover {
                        transform: scale(1.05) rotate(5deg);
                    }

                    .brand-name-text {
                        font-weight: 850;
                        font-size: 1.15rem;
                        color: #1e3a8a;
                        letter-spacing: -0.5px;
                        line-height: 1;
                        font-family: 'Plus Jakarta Sans', sans-serif;
                    }
                    .dark .brand-name-text {
                        color: #f1f5f9;
                    }

                    .brand-sub-text {
                        font-size: 0.65rem;
                        color: #36a36d;
                        font-weight: 700;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }

                    /* --- 3. HEADER STYLING --- */
                    .fi-header {
                        background-color: rgba(255, 255, 255, 0.9) !important;
                        backdrop-filter: blur(10px);
                        border-bottom: 1px solid #e2e8f0;
                        position: sticky;
                        top: 0;
                        z-index: 20;
                        padding: 1rem 2rem !important;
                    }
                    
                    /* Topbar Right Icons Gap */
                    .fi-topbar-content > div:last-child {
                        display: flex !important;
                        align-items: center !important;
                        gap: 1rem !important;
                    }
                    .dark .fi-header {
                        background-color: rgba(15, 23, 42, 0.9) !important;
                        border-bottom-color: #1e293b;
                    }

                    .fi-header-heading {
                        font-weight: 700 !important;
                        color: #1e293b;
                        letter-spacing: -0.025em;
                        font-size: 1.5rem !important;
                    }
                    .dark .fi-header-heading {
                        color: #f1f5f9 !important;
                    }

                    /* --- GLOBAL TYPOGRAPHY REFINEMENT --- */
                    /* Memperhalus label input agar lebih terbaca dan tidak "kasar" */
                    .fi-fo-field-wrp-label {
                        color: #334155 !important; /* Warna lebih tegas supaya kelihatan */
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        letter-spacing: 0.01em;
                        margin-bottom: 0.5rem !important;
                        display: inline-block !important;
                    }
                    .dark .fi-fo-field-wrp-label {
                        color: #e2e8f0 !important; /* Kontras tinggi di mode gelap */
                    }

                    /* Smooth Section Headers */
                    .fi-section-header-heading {
                        font-weight: 700 !important;
                        font-size: 1.1rem !important;
                        letter-spacing: -0.01em;
                        color: #1e293b !important;
                        text-transform: none !important; /* Menghilangkan ALL CAPS agar lebih smooth */
                    }
                    .dark .fi-section-header-heading {
                        color: #f8fafc !important;
                    }

                    /* Input placeholder smoothness */
                    ::placeholder {
                        color: #94a3b8 !important;
                        font-weight: 400 !important;
                    }

                    /* --- 3. SIDEBAR COMPACT & MODERN --- */
                    .fi-sidebar {
                        background-color: white !important;
                        border-right: 1px solid #e2e8f0;
                        box-shadow: 4px 0 24px rgba(0,0,0,0.02);
                    }
                    .dark .fi-sidebar {
                        background-color: #0f172a !important;
                        border-right-color: #1e293b;
                        box-shadow: 4px 0 24px rgba(0,0,0,0.2);
                    }

                    .fi-sidebar-group-label {
                        color: #64748b !important;
                        font-weight: 700 !important;
                    }
                    .dark .fi-sidebar-group-label {
                        color: #94a3b8 !important;
                    }

                    /* --- GLOBAL TEXT VISIBILITY REFINEMENT --- */
                    /* Memastikan teks tabel & elemen umum selalu kontras */
                    .fi-ta-text-item-label, .fi-ta-text-item-description {
                        color: #334155 !important;
                    }
                    .dark .fi-ta-text-item-label, .dark .fi-ta-text-item-description {
                        color: #e2e8f0 !important;
                    }
                    
                    /* Background zebra tabel yang lebih smooth */
                    .fi-ta-row:nth-child(even) {
                        background-color: rgba(0, 0, 0, 0.01);
                    }
                    .dark .fi-ta-row:nth-child(even) {
                        background-color: rgba(255, 255, 255, 0.02);
                    }

                    .fi-sidebar-nav .fi-sidebar-item {
                        margin-bottom: 2px !important;
                    }
                    .fi-sidebar-item-button {
                        padding-top: 6px !important;
                        padding-bottom: 6px !important;
                        border-radius: 8px !important;
                    }

                    .fi-sidebar-item-active .fi-sidebar-item-button {
                        background-color: #f0fdf4 !important;
                        color: #36a36d !important;
                        font-weight: 600 !important;
                    }
                    .dark .fi-sidebar-item-active .fi-sidebar-item-button {
                        background-color: rgba(54, 163, 109, 0.15) !important;
                        color: #4ade80 !important;
                    }

                    /* --- 4. CONTENT CARDS (FORM & TABEL) --- */
                    .fi-main-ctn, .fi-form, .fi-section, .fi-ta-ctn {
                        border-radius: 12px !important;
                    }

                    /* Section Headers (seperti "CREATE KATEGORI INFO PUBLIK") */
                    .fi-section-header-heading {
                        font-weight: 700 !important;
                        font-size: 1rem !important;
                        color: #334155 !important;
                        text-transform: none !important; /* Lebih smooth, tidak dipaksa huruf besar */
                    }
                    .dark .fi-section-header-heading {
                        color: #f1f5f9 !important;
                    }
                    
                    .fi-fo {
                        background-color: white !important;
                        border: 1px solid #f1f5f9;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
                        padding: 2rem !important;
                        margin-top: 1rem !important;
                    }
                    .dark .fi-fo {
                        background-color: #1e293b !important;
                        border-color: #334155;
                        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4) !important;
                    }

                    .fi-btn-primary {
                        background-image: linear-gradient(135deg, #36a36d, #1a5d3b) !important;
                        border: none !important;
                        box-shadow: 0 4px 14px 0 rgba(54, 163, 109, 0.39) !important;
                        transition: all 0.3s ease !important;
                        font-weight: 700 !important;
                        letter-spacing: 0.025em !important;
                    }
                    .fi-btn-primary:hover {
                        transform: translateY(-2px) !important;
                        box-shadow: 0 6px 20px rgba(54, 163, 109, 0.45) !important;
                        filter: brightness(1.1);
                    }
                    .fi-btn-primary:active {
                        transform: translateY(0);
                    }

                    /* --- 5. ABSOLUTE FULL WIDTH LAYOUT (scoped to .fi-page only) --- */
                    /* Modals render OUTSIDE .fi-page, so they won't be affected */
                    .fi-main-ctn,
                    .fi-main-ctn > div,
                    .fi-header,
                    .fi-ta-ctn {
                        max-width: none !important;
                        width: 100% !important;
                    }

                    /* Full-width for page content ONLY */
                    .fi-page,
                    .fi-page > div,
                    .fi-page .fi-section,
                    .fi-page .fi-fo,
                    .fi-page .fi-fo-ctn,
                    .fi-page .fi-fo-ctn > div,
                    .fi-page .fi-schema,
                    .fi-page .fi-schema > div,
                    .fi-page .fi-form-ctn,
                    .fi-page .fi-form-ctn > div,
                    .fi-page-content,
                    .fi-page-content > div,
                    .fi-page-content > div > div {
                        max-width: none !important;
                        width: 100% !important;
                    }


                    .fi-header > div {
                        display: flex !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                        flex-wrap: wrap !important;
                        gap: 1rem !important;
                    }
                    .fi-breadcrumbs {
                        width: 100% !important;
                        margin-bottom: -0.5rem !important;
                    }
                    .fi-main {
                        padding: 1rem 1.5rem !important;
                    }
                    
                    @media (min-width: 1024px) {
                        .fi-main { padding: 1.5rem 2rem !important; }
                    }

                    /* --- 6. PRECISE TREE SIDEBAR HIERARCHY --- */
                    /* Buletin Group (Group 2) */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4) {
                        margin-left: 1.25rem !important;
                        padding-left: 0.75rem !important;
                        border-left: 1px solid #cbd5e1;
                        position: relative;
                        margin-bottom: 2px;
                        transition: all 0.2s ease;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4) {
                        border-left-color: #334155;
                    }

                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4)::before {
                        content: "";
                        position: absolute;
                        left: 0;
                        top: 50%;
                        width: 0.5rem;
                        border-top: 1px solid #cbd5e1;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4)::before {
                        border-top-color: #334155;
                    }

                    /* Parent Item styling for Profil Buletin (the 3rd item in Buletin group) */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3) {
                        position: relative;
                        z-index: 1;
                        border-radius: 8px !important;
                        background-color: #f1f5f9 !important;
                        margin-bottom: 4px !important;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3) {
                        background-color: rgba(255, 255, 255, 0.05) !important;
                    }

                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3)::after {
                        content: "";
                        position: absolute;
                        left: 1.55rem;
                        top: 100%;
                        bottom: -10px;
                        border-left: 1px solid #cbd5e1;
                        z-index: 0;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3)::after {
                        border-left-color: #334155;
                    }
                    
                    /* Hide child link if last child */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :last-child {
                        border-left: none !important;
                    }

                    /* Smooth Breadcrumbs */
                    .fi-breadcrumbs-item-label {
                        font-weight: 500 !important;
                        font-size: 0.825rem !important;
                        color: #64748b !important;
                    }
                    .dark .fi-breadcrumbs-item-label {
                        color: #94a3b8 !important;
                    }
                    .fi-breadcrumbs-item-active .fi-breadcrumbs-item-label {
                        color: #1e293b !important;
                        font-weight: 600 !important;
                    }
                    .dark .fi-breadcrumbs-item-active .fi-breadcrumbs-item-label {
                        color: #f1f5f9 !important;
                    }

                    /* Smooth Input Text */
                    input, select, textarea {
                        font-family: inherit !important;
                        font-size: 0.925rem !important;
                    }

                    /* --- 7. GLOBAL TABLE STYLING (MODERN & CENTERED - FORCED) --- */
                    
                    /* Hilangkan fitur centang (Selection Checkbox) */
                    .fi-ta-selection-cell, 
                    .fi-ta-selection-header-cell {
                        display: none !important;
                    }

                    /* FORCE CENTER SEMUA ISI TABEL (HEADER & BODY) - KECUALI FILE MANAGER & KOLOM NAMA MENU */
                    /* Gunakan selektor yang lebih spesifik agar tidak tabrakan */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-header-cell:not(.column-nama-menu):not(.text-left):not(.ppid-name-col), 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-header-cell:not(.column-nama-menu):not(.text-left):not(.ppid-name-col) *,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell:not(.column-nama-menu):not(.long-text-column):not(.text-left):not(.ppid-name-col),
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell:not(.column-nama-menu):not(.long-text-column):not(.text-left):not(.ppid-name-col) * {
                        text-align: center !important;
                        justify-content: center !important;
                    }

                    /* PPID Name Column - Force Left Align */
                    .fi-ta-header-cell.ppid-name-col,
                    .fi-ta-header-cell.ppid-name-col * {
                        text-align: left !important;
                        justify-content: flex-start !important;
                    }
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item,
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item-label,
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item-description {
                        text-align: left !important;
                        justify-content: flex-start !important;
                        width: 100%;
                        display: flex;
                    }

                    /* Center Text Items and Actions - ONLY FOR TABLES (Excluded in Grid View) */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item-label, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item-description,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-actions {
                        width: 100% !important;
                        display: flex !important;
                        justify-content: center !important;
                    }

                    .fi-ta-header-cell, 
                    .fi-ta-header-cell * {
                        background-color: #4b5563 !important; /* Gray 600 - Unified Color */
                        color: white !important;
                        padding-top: 0.875rem !important;
                        padding-bottom: 0.875rem !important;
                        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
                        transition: background-color 0.2s;
                    }

                    .dark .fi-ta-header-cell,
                    .dark .fi-ta-header-cell * {
                        background-color: #1e293b !important; /* Slate 800 */
                        border-right-color: rgba(255, 255, 255, 0.05) !important;
                    }

                    .fi-ta-header-cell:last-child {
                        border-right: none !important;
                    }

                    .fi-ta-header-cell-label {
                        font-weight: 700 !important;
                        text-transform: uppercase !important;
                        font-size: 0.75rem !important;
                        letter-spacing: 0.05em !important;
                        display: flex !important;
                        width: 100% !important;
                    }

                    /* Center All Table Content & Row Cells */
                    :not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell {
                        border-right: 1px solid #f1f5f9 !important;
                    }
                    .dark :not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell {
                        border-right: 1px solid #334155 !important;
                    }
                    .fi-ta-cell:last-child {
                        border-right: none !important;
                    }

                    /* Center Text Items and Actions - ONLY FOR TABLES (Excluded in Grid View) */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item-label, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item-description,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-actions {
                        width: 100% !important;
                        display: flex !important;
                        justify-content: center !important;
                    }

                    /* Sort Icon */
                    .fi-ta-header-cell .fi-icon-btn, 
                    .fi-ta-header-cell button svg {
                        color: rgba(255, 255, 255, 0.8) !important;
                    }

                    /* --- 8. GLOBAL FLUID & RESPONSIVE TABLES --- */
                    /* Konteks Responsivitas yang Diperhalus */
                    .fi-ta-ctn:not(:has(.fi-ta-content-grid)), 
                    .fi-ta-content:not(.fi-ta-content-grid) {
                        display: block !important;
                        width: 100% !important;
                        overflow-x: auto !important;
                        overflow-y: visible !important;
                        -webkit-overflow-scrolling: touch;
                        position: relative !important;
                    }

                    .fi-ta-table {
                        width: 100% !important;
                        min-width: 0 !important; /* Truly dynamic, no fixed space wasted */
                        table-layout: auto !important;
                        border-collapse: collapse !important;
                    }

                    .fi-ta-header-cell, 
                    .fi-ta-cell {
                        padding: 12px 16px !important;
                        white-space: nowrap !important; /* Default to no-wrap to protect labels */
                    }

                    /* Allow wrapping for long-text columns like PPID name */
                    .fi-ta-cell.ppid-name-col {
                        white-space: normal !important;
                        word-break: break-word !important;
                        min-width: 200px;
                    }

                    /* Class khusus untuk kolom yang isinya panjang (seperti deskripsi) */
                    .fi-ta-cell.long-text-column,
                    .fi-ta-cell.long-text-column * {
                        white-space: normal !important;
                        word-break: break-word !important;
                    }

                    /* Keep the post listing readable while allowing horizontal scrolling on small screens. */
                    .fi-resource-posts .fi-ta-table {
                        min-width: 1040px !important;
                        table-layout: fixed !important;
                    }

                    .fi-resource-posts .fi-ta-header-cell.post-title-column,
                    .fi-resource-posts .fi-ta-header-cell.post-title-column *,
                    .fi-resource-posts .fi-ta-cell.post-title-column {
                        text-align: left !important;
                        justify-content: flex-start !important;
                    }

                    .fi-resource-posts .fi-ta-cell.post-title-column .flex {
                        flex-wrap: wrap;
                        gap: 0.25rem 0.5rem;
                    }

                    /* CUSTOM SCROLLBAR */
                    .fi-ta-ctn::-webkit-scrollbar, .fi-ta-content::-webkit-scrollbar {
                        height: 8px;
                        background-color: #f8fafc;
                    }
                    .fi-ta-ctn::-webkit-scrollbar-thumb, .fi-ta-content::-webkit-scrollbar-thumb {
                        background: #cbd5e1;
                        border-radius: 10px;
                        border: 2px solid #f8fafc;
                    }

                </style>
                HTML)
            )


            // === 3. KONFIGURASI WARNA (DEFAULT STYLE) ===
            ->colors([
                'primary' => Color::hex('#36a36d'),
                'warning' => Color::Yellow,
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::hex('#1e3a8a'),
                'success' => Color::hex('#36a36d'),
            ])

            // === 4. KONFIGURASI UMUM ===
            ->globalSearch(false)
            ->font('Poppins')
            ->icons([
                'panels::sidebar.collapse-button' => 'heroicon-o-bars-3',
                'panels::sidebar.expand-button' => 'heroicon-o-bars-3',
            ])
            ->sidebarWidth('250px')
            ->sidebarCollapsibleOnDesktop()
            ->userMenuItems([
                \Filament\Navigation\MenuItem::make()
                    ->label('Infografis')
                    ->icon('heroicon-o-chart-bar')
                    ->url('/site-admin/infografis', true),
                // Language switcher moved outside to top bar for easier access
            ])
            ->navigationGroups([
                'Portal' => \Filament\Navigation\NavigationGroup::make('Portal')
                    ->label(__('Portal')),
                'Website' => \Filament\Navigation\NavigationGroup::make('Website')
                    ->label(__('Website')),
                'Media & Arsip' => \Filament\Navigation\NavigationGroup::make('Media & Arsip')
                    ->label(__('Media & Arsip')),
                'Pengaturan' => \Filament\Navigation\NavigationGroup::make('Pengaturan')
                    ->label(__('Pengaturan'))
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->spa()
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->renderHook(
                'panels::head.done',
                fn() => new \Illuminate\Support\HtmlString('
                    <style>
                        .fi-wi { gap: 2rem; }
                        .flex { display: flex; }
                        .grid { display: grid; }
                        .gap-8 { gap: 2rem; }
                        .space-y-8 > * + * { margin-top: 2rem; }
                        .rounded-2xl { border-radius: 1rem; }
                    </style>
                ')
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
