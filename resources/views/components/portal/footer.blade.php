@props(['website', 'identity', 'menus' => null])
<footer class="bg-navy text-surface pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- Kolom 1: Identitas --}}
            <div class="{{ (!empty($identity?->footer_links_related) && count($identity->footer_links_related)) ? '' : 'lg:col-span-2' }}">
                <div class="flex items-center gap-3 mb-4">
                    @if($identity?->footer_logo)
                    <img src="{{ Storage::url($identity->footer_logo) }}" alt="{{ $identity->name ?? $website->name }}" class="h-14 w-auto">
                    @elseif($identity?->logo)
                    <img src="{{ Storage::url($identity->logo) }}" alt="{{ $identity->name ?? $website->name }}" class="h-14 w-auto brightness-0 invert">
                    @endif
                    <div>
                        <div class="font-bold text-lg leading-tight">{{ $identity->name ?? $website->name }}</div>
                    </div>
                </div>
                @if($identity?->description)
                <p class="text-surface/60 text-sm leading-relaxed mb-5">{{ $identity->description }}</p>
                @endif

                {{-- Sosmed --}}
                <div class="flex items-center gap-3">
                    @if($identity?->facebook)
                    <a href="{{ $identity->facebook }}" target="_blank" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-primary flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    @endif
                    @if($identity?->instagram)
                    <a href="{{ $identity->instagram }}" target="_blank" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-primary flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg>
                    </a>
                    @endif
                    @if($identity?->youtube)
                    <a href="{{ $identity->youtube }}" target="_blank" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-primary flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon class="text-navy fill-current" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                    </a>
                    @endif
                    @if($identity?->tiktok)
                    <a href="{{ $identity->tiktok }}" target="_blank" class="w-9 h-9 rounded-full bg-surface/10 hover:bg-primary flex items-center justify-center transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 104 4V4a5 5 0 005 5"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Kolom 2: Sitemap --}}
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-4 text-primary">Sitemap</h4>
                <ul class="space-y-2">
                    @if($menus)
                        @foreach($menus as $menu)
                        <li>
                            <a href="{{ $menu->slug === 'beranda' ? route('portal.beranda', $website->slug) : $menu->portalHref($website) }}" 
                               class="text-surface/60 hover:text-surface text-sm transition-colors duration-200">
                                {{ $menu->name }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Kolom 3: Tautan Terkait --}}
            @if(!empty($identity?->footer_links_related) && count($identity->footer_links_related))
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-4 text-primary">Tautan Terkait</h4>
                <ul class="space-y-2">
                    @foreach($identity->footer_links_related as $link)
                    <li>
                        <a href="{{ $link['url'] ?? '#' }}" target="_blank"
                           class="text-surface/60 hover:text-surface text-sm transition flex items-center gap-2">
                            <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            {{ $link['label'] ?? $link['url'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Kolom 4: Kontak --}}
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest mb-4 text-primary">Kontak</h4>
                <ul class="space-y-3 text-sm text-surface/60">
                    @if($identity?->address)
                    <li class="flex gap-2.5">
                        <svg class="w-4 h-4 shrink-0 mt-0.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $identity->address }}</span>
                    </li>
                    @endif
                    @if($identity?->email)
                    <li class="flex gap-2.5">
                        <svg class="w-4 h-4 shrink-0 mt-0.5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $identity->email }}" class="hover:text-surface transition">{{ $identity->email }}</a>
                    </li>
                    @endif
                    @if($identity?->phone)
                    <li class="flex gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ $identity->phone }}" class="hover:text-surface transition">{{ $identity->phone }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-surface/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-surface/40">
            <span>&copy; {{ date('Y') }} {{ $identity->name ?? $website->name }}. Hak Cipta Dilindungi.</span>
            <span>Didukung oleh <span class="text-primary font-semibold">Bapenda Kalimantan Timur</span></span>
        </div>
    </div>
</footer>
