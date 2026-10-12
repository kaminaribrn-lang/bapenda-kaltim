@php
    $layananMenus = [
        ['name' => 'Pintu Utama Layanan', 'route' => 'portal.layanan.index'],
        ['name' => 'Samsat Online', 'route' => 'portal.layanan.samsat-online'],
        ['name' => 'Samsat Corner / Mall', 'route' => 'portal.layanan.samsat-corner'],
        ['name' => 'Samsat Drive Thru', 'route' => 'portal.layanan.samsat-drive-thru'],
        ['name' => 'Samsat Mobil / Keliling', 'route' => 'portal.layanan.samsat-mobil'],
        ['name' => 'Maklumat Pelayanan UPTD', 'route' => 'portal.informasi.maklumat-pelayanan-uptd'],
    ];
@endphp

<aside>
    <div class="sticky top-28 space-y-6">
        <div class="bg-surface rounded-3xl border border-border-base shadow-sm overflow-hidden p-6 reveal">
            <h3 class="font-heading font-black text-text-base text-lg uppercase tracking-wider mb-5 pb-4 border-b border-border-base flex items-center gap-3">
                <div class="w-1.5 h-6 rounded-full bg-primary"></div>
                Layanan Publik
            </h3>
            <div class="flex flex-col gap-2">
                @foreach($layananMenus as $menuItem)
                    @php
                        $isActive = request()->routeIs($menuItem['route']);
                    @endphp
                    <a href="{{ route($menuItem['route'], $website->slug) }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-heading font-bold transition-all duration-200 group {{ $isActive ? 'bg-primary text-surface shadow-md' : 'text-text-muted hover:bg-bg-base hover:text-primary' }}">
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-200 {{ $isActive ? 'translate-x-1' : 'group-hover:translate-x-1' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        {{ $menuItem['name'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</aside>
