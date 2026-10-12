@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --font-primary: 'Lexend', sans-serif;
        --font-secondary: 'Source Sans 3', sans-serif;
        --color-primary: #0F172A;
        --color-secondary: #334155;
        --color-cta: #0369A1;
        --color-bg: #F8FAFC;
    }
    body {font-family: var(--font-primary); background-color: var(--color-bg); color: var(--color-primary);}
    h1,h2,h3,h4 {font-family: var(--font-primary);}
    .btn-primary {background-color: var(--color-cta); color: #fff;}
    .btn-primary:hover {background-color: #075985;}
    .focus-visible {outline: 2px solid var(--color-cta); outline-offset: 2px;}
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="relative h-[400px] overflow-hidden bg-[#0c1e33]">
    <img src="{{ asset('images/background.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none opacity-10" alt="Background">
    <div class="absolute inset-0 bg-gradient-to-b from-[#112134] to-[#0c1e33]"></div>
    <div class="absolute top-10 left-10 w-72 h-72 bg-[#00c458]/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4 pt-32">
        <div class="relative z-10">
            @if($page->hero_badge)
            <span class="inline-block px-5 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 text-white/80 text-[10px] md:text-xs font-bold rounded-full mb-4 tracking-[0.2em] uppercase">
                {{ $page->hero_badge }}
            </span>
            @endif
            @php
                $titleWordsDL = explode(' ', $page->title);
                $lastWordDL = array_pop($titleWordsDL);
                $firstWordsDL = implode(' ', $titleWordsDL);
            @endphp
            <h2 class="text-3xl md:text-5xl font-black text-white px-2 drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)] font-montserrat uppercase tracking-tight leading-[1.1]">
                {{ $firstWordsDL }}
                @if($lastWordDL)
                    <span class="text-[#00c458]">{{ $lastWordDL }}</span>
                @endif
            </h2>
        </div>
    </div>
</section>

<!-- Content -->
<section class="relative bg-white py-12 lg:py-16 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 32px 32px;"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Search Bar -->
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 bg-emerald-500 rounded-full"></div>
                    <h3 class="font-black text-slate-800 text-lg uppercase tracking-tight">{{ $page->title }}</h3>
                </div>
                <div class="relative w-full md:w-96 group z-30">
                    <input type="text" id="searchInput" placeholder="Cari dokumen..."
                           class="w-full pl-14 pr-12 py-4 bg-white border border-gray-200 rounded-[1.5rem] text-sm font-bold text-slate-700 shadow-sm focus:outline-none focus:border-emerald-400 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400 placeholder:font-medium">
                    <div class="absolute top-1/2 left-5 -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Document Cards -->
            <div id="documentContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php $docs = $content['documents'] ?? []; @endphp
                @forelse($docs as $i => $doc)
                @php
                    $rawFileUrl = (string) ($doc['file_url'] ?? '');
                    $normalizedFileUrl = ltrim(str_replace('\\', '/', $rawFileUrl), '/');
                    if (!empty($doc['file_href'])) {
                        $fileHref = $doc['file_href'];
                    } elseif (\Illuminate\Support\Str::startsWith($rawFileUrl, ['http://', 'https://'])) {
                        $fileHref = $rawFileUrl;
                    } elseif ($normalizedFileUrl !== '') {
                        $fileHref = asset('storage/' . preg_replace('#^storage/#', '', $normalizedFileUrl));
                    } else {
                        $fileHref = '';
                    }
                @endphp
                <div class="document-card relative bg-white rounded-[1.5rem] shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition-shadow duration-300 focus-visible:outline focus-visible:ring-2 focus-visible:ring-primary">
                    <div class="absolute left-0 top-0 bottom-0 w-2 flex flex-col">
                        <div class="h-1/2 bg-[#FF0000]"></div>
                        <div class="h-1/2 bg-white border-r border-gray-100"></div>
                    </div>
                    <div class="flex flex-col lg:flex-row p-6 md:p-8 ml-2 gap-6 lg:gap-10 items-center">
                        <!-- Number -->
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-20 md:w-20 md:h-24 bg-slate-50 border-2 border-slate-100 rounded-xl flex items-center justify-center relative shadow-inner group-hover:bg-emerald-50 group-hover:border-emerald-100 transition-colors duration-500">
                                <svg class="w-8 h-8 md:w-10 md:h-10 text-slate-300 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div class="absolute -top-3 -right-3 w-8 h-8 bg-slate-900 text-white text-[10px] font-black rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                    {{ $i + 1 }}
                                </div>
                            </div>
                        </div>

                        <!-- Title & Info -->
                        <div class="flex-grow text-center lg:text-left title-container">
                            <div class="flex flex-wrap justify-center lg:justify-start gap-2 mb-3">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-full">Regulasi Negara</span>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[9px] font-black uppercase tracking-widest rounded-full">Edisi Digital</span>
                                @if(empty($fileHref))
                                <span class="px-3 py-1 bg-red-50 text-red-500 text-[9px] font-black uppercase tracking-widest rounded-full">Belum Ada File</span>
                                @endif
                            </div>
                            <h3 class="document-title text-lg md:text-xl font-black text-slate-900 font-montserrat leading-tight mb-2 group-hover:text-emerald-700 transition-colors">
                                {{ $doc['name'] ?? '-' }}
                            </h3>
                            @if(!empty($doc['description']))
                            <p class="text-slate-400 text-sm font-medium leading-relaxed mb-3 line-clamp-2">{{ $doc['description'] }}</p>
                            @endif
                            <div class="flex items-center justify-center lg:justify-start gap-4 mt-3">
                                <div class="flex items-center gap-1.5 text-emerald-600 text-[10px] font-black uppercase tracking-wider">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span id="view-count-{{ $i }}">{{ number_format($doc['views'] ?? 0) }}</span> DILIHAT
                                </div>
                                <div class="flex items-center gap-1.5 text-slate-400 text-[10px] font-black uppercase tracking-wider">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span id="dl-count-{{ $i }}">{{ number_format($doc['downloads'] ?? 0) }}</span> DIUNDUH
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-row lg:flex-col gap-3 flex-shrink-0 w-full lg:w-40 pt-4 lg:pt-0 border-t lg:border-t-0 lg:border-l border-gray-100 lg:pl-10">
                            @if(!empty($fileHref))
                            <a href="#" onclick="downloadDynamicList('{{ $fileHref }}', '{{ $doc['id'] ?? '' }}', '{{ $page->id ?? '' }}', {{ $i }}); return false;"
                               class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-600 text-white text-[11px] font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-700 hover:shadow-xl hover:shadow-emerald-500/25 transition-all transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Unduh
                            </a>
                            <button type="button" onclick="viewDynamicList('{{ $fileHref }}', '{{ $doc['id'] ?? '' }}', '{{ $page->id ?? '' }}', {{ $i }})"
                                    class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-50 text-slate-600 text-[11px] font-black uppercase tracking-widest rounded-2xl border border-slate-200 hover:bg-white hover:text-emerald-600 hover:border-emerald-500 hover:shadow-lg transition-all">
                                Lihat
                            </button>
                            @else
                            <span class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 text-slate-400 text-[10px] font-black uppercase tracking-wider rounded-xl cursor-not-allowed">
                                Tidak Tersedia
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-[2rem] p-20 text-center border border-dashed border-gray-200">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Belum ada dokumen tersedia.</p>
                </div>
                @endforelse

                <!-- No Results State -->
                <div id="noResults" class="hidden bg-white rounded-[2rem] p-20 text-center border border-dashed border-gray-200">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-sm">Tidak ditemukan hasil pencarian.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.pdf-modal')
@push('scripts')
<script src="{{ asset('js/peraturan-search.js') }}"></script>
<script>
const websiteSlug = @json(isset($website) ? $website->slug : request()->segment(1));
const ppidViewUrlTemplate = websiteSlug ? `/${websiteSlug}/ppid/item/__ITEM__/view` : '/ppid/item/__ITEM__/view';
const ppidDownloadUrlTemplate = websiteSlug ? `/${websiteSlug}/ppid/item/__ITEM__/download` : '/ppid/item/__ITEM__/download';
const manualViewUrlTemplate = websiteSlug ? `/${websiteSlug}/dynamic-page/manual-view/__PAGE__/__INDEX__` : '/dynamic-page/manual-view/__PAGE__/__INDEX__';
const manualDownloadUrlTemplate = websiteSlug ? `/${websiteSlug}/dynamic-page/manual-download/__PAGE__/__INDEX__` : '/dynamic-page/manual-download/__PAGE__/__INDEX__';

function trackListAction(type, fileUrl, dbId, pageId, index) {
    if (!fileUrl) return;
    
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) return;

    const fetchUrl = dbId
        ? (type === 'view'
            ? ppidViewUrlTemplate.replace('__ITEM__', dbId)
            : ppidDownloadUrlTemplate.replace('__ITEM__', dbId))
        : (type === 'view'
            ? manualViewUrlTemplate.replace('__PAGE__', pageId).replace('__INDEX__', index)
            : manualDownloadUrlTemplate.replace('__PAGE__', pageId).replace('__INDEX__', index));

    fetch(fetchUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(r => r.json())
      .then(data => {
          if (data.success || data[type + 's']) {
              const newVal = data[type + 's'];
              const badge = document.getElementById(
                  type === 'view' ? `view-count-${index}` : `dl-count-${index}`
              );
              if (badge && newVal) {
                  badge.textContent = Number(newVal).toLocaleString('id-ID');
              }
          }
      }).catch(err => console.error(`Error tracking ${type}:`, err));
}

function viewDynamicList(fileUrl, dbId, pageId, index) {
    trackListAction('view', fileUrl, dbId, pageId, index);
    try {
        if(typeof openPdfModal === 'function') openPdfModal(fileUrl);
        else window.open(fileUrl, '_blank');
    } catch(e) {
        window.open(fileUrl, '_blank');
    }
}

function downloadDynamicList(fileUrl, dbId, pageId, index) {
    trackListAction('download', fileUrl, dbId, pageId, index);
    if (!fileUrl) return;
    const a = document.createElement('a');
    a.href = fileUrl;
    a.download = '';
    a.target = '_blank';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>
@endpush
@endsection
