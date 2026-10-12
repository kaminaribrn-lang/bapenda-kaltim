<x-filament-panels::page>
    <div class="slider-grid">
        @forelse($infografis as $item)
            <div class="slider-card {{ $item->is_pinned ? 'is-pinned' : '' }}">
                <div class="slider-image-wrapper">
                    @if($item->file && $item->file->path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->file->path) }}" alt="{{ $item->caption }}" class="slider-image">
                    @else
                        <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; color:#cbd5e1;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:3rem; height:3rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="slider-content">
                    <h3 class="slider-title" title="{{ $item->caption }}">
                        {{ $item->caption ?? __('Tanpa Judul') }}
                    </h3>
                    @if($item->description)
                        <p class="slider-description">
                            {{ $item->description }}
                        </p>
                    @endif
                    <div class="slider-meta">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1rem; height:1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>
                            {{ $item->created_at->format('d M, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="empty-state-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <p class="empty-state-title">{{ __('Belum ada infografis') }}</p>
                <p class="empty-state-description">{{ __('Silakan tambahkan infografis baru dengan menekan tombol "Tambah Infografis"') }}</p>
            </div>
        @endforelse
    </div>
    <div class="pagination-wrapper">
        {{ $infografis->links() }}
    </div>
</x-filament-panels::page>
