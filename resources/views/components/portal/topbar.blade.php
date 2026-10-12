{{-- Top Bar: Utilities (Bahasa, Aksesibilitas, Pencarian) --}}
<div class="bg-navy text-surface text-xs py-2 px-4 hidden md:block">
    <div class="max-w-7xl mx-auto flex items-center justify-end gap-6">
        
        {{-- Language Switcher --}}
        <div x-data="{ open: false }" class="relative" @click.outside="open = false" @keydown.escape="open = false">
            <button @click="open = !open" class="flex items-center gap-1.5 hover:text-primary-light transition-colors duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded px-1" aria-haspopup="true" :aria-expanded="open.toString()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                ID
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition x-cloak class="absolute top-full mt-2 right-0 w-24 bg-surface border border-border-base rounded shadow-lg py-1 z-50 text-text-base">
                <button class="w-full text-left px-3 py-1.5 hover:bg-bg-base hover:text-primary transition-colors duration-200 cursor-pointer focus:outline-none focus:bg-bg-base">ID - Indonesia</button>
                <button class="w-full text-left px-3 py-1.5 hover:bg-bg-base hover:text-primary transition-colors duration-200 cursor-pointer focus:outline-none focus:bg-bg-base">EN - English</button>
            </div>
        </div>

        {{-- Accessibility Menu: Terintegrasi dengan UserWay --}}
        <button class="accessibility-trigger flex items-center gap-1.5 hover:text-primary-light transition-colors duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded px-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Aksesibilitas
        </button>

        {{-- Search Trigger --}}
        <button @click="$dispatch('search-open')" class="flex items-center gap-1.5 hover:text-primary-light transition-colors duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary rounded px-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Pencarian
        </button>

    </div>
</div>
