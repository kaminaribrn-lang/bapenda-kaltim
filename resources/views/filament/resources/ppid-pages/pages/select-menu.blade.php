<x-filament-panels::page>

@php
    $menus = $this->getMenus();
@endphp

<style>
    .ppm-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.25rem;
    }
    .dark .ppm-subtitle { color: #94a3b8; }

    .ppm-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .ppm-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: #ffffff;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.875rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .dark .ppm-card {
        background: #1e293b;
        border-color: #334155;
    }

    .ppm-card-name {
        font-weight: 700;
        font-size: 0.9rem;
        color: #111827;
    }
    .dark .ppm-card-name { color: #f1f5f9; }

    .ppm-card-sub {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.15rem;
    }

    .ppm-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.65rem;
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        white-space: nowrap;
    }
    .ppm-badge.has-page { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .ppm-badge.no-page { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }

    .ppm-actions { display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }

    .ppm-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.9rem;
        border-radius: 0.55rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: all .15s;
    }
    .ppm-btn.primary { background: #10b981; color: #fff; }
    .ppm-btn.primary:hover { background: #059669; }
    .ppm-btn.gray { background: #f1f5f9; color: #334155; }
    .dark .ppm-btn.gray { background: #334155; color: #e2e8f0; }
    .ppm-btn.gray:hover { background: #e2e8f0; }

    .ppm-children {
        margin-top: 0.6rem;
        padding-left: 1rem;
        border-left: 2px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }
    .dark .ppm-children { border-left-color: #334155; }

    .ppm-empty {
        text-align: center;
        padding: 3rem 1rem;
        color: #9ca3af;
    }
</style>

<div class="ppm-subtitle">
    {{ __('Kelola halaman untuk setiap item Menu PPID. Satu menu bisa memiliki satu halaman dengan template pilihan Anda (Penjelasan, Dokumen, Galeri, dll).') }}
</div>

@if($menus->isEmpty())
    <div class="ppm-empty">
        <p style="font-weight:600;margin-bottom:.35rem;">{{ __('Belum ada Menu PPID') }}</p>
        <p style="font-size:.85rem;">{{ __('Silakan tambahkan Menu PPID terlebih dahulu di menu "Menu PPID" pada sidebar.') }}</p>
    </div>
@else
    <div class="ppm-list">
        @foreach($menus as $menu)
            @php $pageId = $this->getPageIdForMenu($menu->id); @endphp
            <div class="ppm-card">
                <div>
                    <div class="ppm-card-name">{{ $menu->name }}</div>
                    <div class="ppm-card-sub">/{{ $menu->slug ?: \Illuminate\Support\Str::slug($menu->name) }}</div>
                </div>
                <div class="ppm-actions">
                    @if($pageId)
                        <span class="ppm-badge has-page">{{ __('Sudah Ada Halaman') }}</span>
                        <a href="{{ \App\Filament\Resources\PpidPages\PpidPageResource::getUrl('edit', ['record' => $pageId]) }}" class="ppm-btn primary">
                            {{ __('Edit Halaman') }}
                        </a>
                    @else
                        <span class="ppm-badge no-page">{{ __('Belum Ada Halaman') }}</span>
                        <a href="{{ \App\Filament\Resources\PpidPages\PpidPageResource::getUrl('select-template', ['menu_id' => $menu->id, 'menu_name' => $menu->name]) }}" class="ppm-btn primary">
                            {{ __('Buat Halaman') }}
                        </a>
                    @endif
                </div>
            </div>

            @if($menu->children && $menu->children->isNotEmpty())
                <div class="ppm-children">
                    @foreach($menu->children as $child)
                        @php $childPageId = $this->getPageIdForMenu($child->id); @endphp
                        <div class="ppm-card">
                            <div>
                                <div class="ppm-card-name">{{ $child->name }}</div>
                                <div class="ppm-card-sub">/{{ $child->slug ?: \Illuminate\Support\Str::slug($child->name) }}</div>
                            </div>
                            <div class="ppm-actions">
                                @if($childPageId)
                                    <span class="ppm-badge has-page">{{ __('Sudah Ada Halaman') }}</span>
                                    <a href="{{ \App\Filament\Resources\PpidPages\PpidPageResource::getUrl('edit', ['record' => $childPageId]) }}" class="ppm-btn primary">
                                        {{ __('Edit Halaman') }}
                                    </a>
                                @else
                                    <span class="ppm-badge no-page">{{ __('Belum Ada Halaman') }}</span>
                                    <a href="{{ \App\Filament\Resources\PpidPages\PpidPageResource::getUrl('select-template', ['menu_id' => $child->id, 'menu_name' => $child->name]) }}" class="ppm-btn primary">
                                        {{ __('Buat Halaman') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endif

</x-filament-panels::page>
