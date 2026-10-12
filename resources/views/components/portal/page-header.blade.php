@props(['title', 'breadcrumbs' => []])

<div class="relative bg-navy pt-32 pb-16 md:pt-40 md:pb-24 overflow-hidden">
    {{-- Background Pattern/Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/80 to-navy opacity-50"></div>
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10 mix-blend-overlay"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        {{-- Breadcrumbs --}}
        @if(!empty($breadcrumbs))
        <nav class="flex justify-center mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 font-body text-sm">
                @foreach($breadcrumbs as $index => $crumb)
                    <li class="inline-flex items-center">
                        @if(!$loop->last && isset($crumb['url']))
                            <a href="{{ $crumb['url'] }}" class="text-surface/70 hover:text-surface transition-colors duration-200">
                                {{ $crumb['label'] }}
                            </a>
                            <svg class="w-4 h-4 text-surface/50 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        @else
                            <span class="text-surface font-medium" aria-current="page">{{ $crumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        @endif

        {{-- Page Title --}}
        <h1 class="font-heading text-3xl md:text-5xl font-bold text-surface fade-up mb-4">
            {{ $title }}
        </h1>
        
        @if($slot->isNotEmpty())
        <div class="fade-up" style="animation-delay: 0.1s;">
            {{ $slot }}
        </div>
        @endif
    </div>
</div>
