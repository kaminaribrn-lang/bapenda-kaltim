{{--
  Dynamic Floating Navbar for System V9
--}}
@props(['website', 'menus' => null])
@php
    // Design System Tokens
    $dockBtnBase = 'group flex items-center justify-center p-3 rounded-full transition-all duration-200 relative focus-visible:ring-2 focus-visible:ring-primary focus:outline-none cursor-pointer';
    $dockIconBase = 'w-5 h-5 transition-colors duration-200 relative z-10';
    $dockLabelBase = 'max-w-0 overflow-hidden hidden md:block whitespace-nowrap font-heading font-bold text-sm transition-all duration-300 relative z-10 group-hover:ml-2';
    
    // Dropdown Panels
    $dropWrapper = 'absolute bottom-[calc(100%+0.75rem)] left-1/2 -translate-x-1/2 z-[200] transform origin-bottom flex flex-col items-center';
    $dropPanel = 'relative w-[min(18rem,calc(100vw-2rem))] max-h-[70vh] overflow-y-auto bg-surface rounded-2xl shadow-xl border border-border-base flex flex-col p-2 z-10';
    $dropCaret = 'absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-4 h-4 bg-surface border-b border-r border-border-base transform rotate-45 z-0 rounded-sm';
    $dropLink = 'flex-shrink-0 flex items-center gap-3 px-4 py-3 text-sm text-text-muted hover:bg-primary-light hover:text-primary rounded-xl transition-all duration-150 font-heading font-bold group/item focus:outline-none';
@endphp

@if($menus && $menus->isNotEmpty())
<div class="fixed bottom-4 md:bottom-8 left-1/2 -translate-x-1/2 z-[100] w-[95%] max-w-max">
    <div class="bg-surface/95 backdrop-blur-xl border border-border-base p-2 rounded-full shadow-lg flex items-center gap-1 md:gap-2 mx-auto justify-center">

        @foreach($menus as $menu)
            @php
                $isActive = $menu->isActive();
                $isDanger = $menu->css_variant === 'danger';
            @endphp

            @if($menu->children && $menu->children->isNotEmpty())
                {{-- Dropdown Menu --}}
                <div x-data="{ open: false, isActive: {{ $isActive ? 'true' : 'false' }} }" class="relative shrink-0" @click.away="open = false">
                    <button type="button" @click="open = !open" 
                            class="{{ $dockBtnBase }}"
                            :class="isActive ? '{{ $isDanger ? 'bg-danger text-white' : 'bg-primary text-white' }}' : (open ? 'bg-primary-light text-primary' : 'hover:bg-primary-light text-text-muted')">
                        
                        @if(!empty($menu->svg_icon))
                            <svg class="{{ $dockIconBase }}" :class="isActive ? 'text-white' : (open ? 'text-primary' : 'group-hover:text-primary')" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu->svg_icon }}"/>
                            </svg>
                        @elseif($isDanger)
                            <div class="w-5 h-5 rounded-full flex items-center justify-center font-black text-[10px] relative z-10 transition-all" :class="isActive ? 'bg-white text-danger' : 'bg-danger text-white group-hover/danger:bg-danger-dark'">
                                {{ strtoupper(substr($menu->name, 0, 1)) }}
                            </div>
                        @else
                            {{-- Fallback default icon --}}
                            <svg class="{{ $dockIconBase }}" :class="isActive ? 'text-white' : (open ? 'text-primary' : 'group-hover:text-primary')" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        @endif

                        <span class="{{ $dockLabelBase }}" :class="isActive ? 'max-w-[200px] ml-2 text-white' : 'group-hover:max-w-[200px]'">{{ $menu->name }}</span>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="{{ $dropWrapper }}" x-cloak>
                        <div class="{{ $dropCaret }}"></div>
                        <div class="{{ $dropPanel }}">
                            @foreach($menu->children as $child)
                                @if($child->template === 'section_header')
                                    <div class="px-4 py-2 mt-1 mb-1 text-[10px] font-black uppercase tracking-[0.15em] text-primary border-b border-border-base bg-primary-light/50 rounded-lg mx-0">{{ $child->name }}</div>
                                @else
                                    <a href="{{ $child->portalHref($website) }}" 
                                       @if($child->open_in_new_tab) target="_blank" @endif
                                       class="{{ $dropLink }}">
                                        {{ $child->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Single Link Menu --}}
                <a href="{{ $menu->portalHref($website) }}"
                   @if($menu->open_in_new_tab) target="_blank" @endif
                   class="{{ $dockBtnBase }} {{ $isActive ? ($isDanger ? 'bg-danger text-white' : 'bg-primary text-white') : ($isDanger ? 'hover:bg-danger-light/20 text-text-muted group/danger' : 'hover:bg-primary-light text-text-muted') }}">
                    
                    @if(!empty($menu->svg_icon))
                        <svg class="{{ $dockIconBase }} {{ $isActive ? 'text-white' : 'group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu->svg_icon }}"/>
                        </svg>
                    @elseif($isDanger)
                        <div class="w-5 h-5 rounded-full flex items-center justify-center font-black text-[10px] relative z-10 transition-all {{ $isActive ? 'bg-white text-danger' : 'bg-danger text-white group-hover/danger:bg-danger-dark' }}">
                            {{ strtoupper(substr($menu->name, 0, 1)) }}
                        </div>
                    @else
                        {{-- Fallback default icon --}}
                        <svg class="{{ $dockIconBase }} {{ $isActive ? 'text-white' : 'group-hover:text-primary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    @endif

                    <span class="{{ $dockLabelBase }} {{ $isActive ? 'max-w-[150px] ml-2 text-white' : 'group-hover:max-w-[150px]' }}">{{ $menu->name }}</span>
                </a>
            @endif
        @endforeach

    </div>
</div>
@endif

