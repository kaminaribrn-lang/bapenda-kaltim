@extends(request()->is('admin/*') || request()->is('preview/*') || request()->routeIs('filament.*') ? 'layouts.app' : 'layouts.portal')

@section('title', ($page->meta_title ?? $page->title) . ' - Bapenda Provinsi Kalimantan Timur')

@section('content')
<!-- Internal Hero Section -->
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
                $titleWordsDG = explode(' ', $page->title);
                $lastWordDG = array_pop($titleWordsDG);
                $firstWordsDG = implode(' ', $titleWordsDG);
            @endphp
            <h2 class="text-3xl md:text-5xl font-black text-white px-2 drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)] font-montserrat uppercase tracking-tight leading-[1.1]">
                {{ $firstWordsDG }}
                @if($lastWordDG)
                    <span class="text-[#00c458]">{{ $lastWordDG }}</span>
                @endif
            </h2>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="relative bg-white py-16 lg:py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 32px 32px;"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                <div class="bg-white p-8 rounded-[2.5rem] shadow-[0_4px_20px_rgba(0,0,0,0.05)] border border-gray-100 relative overflow-hidden group hover:-translate-y-2 hover:shadow-2xl hover:border-emerald-200 transition-all duration-500 cursor-pointer doc-card"
                     data-id="{{ $i }}"
                     data-dbid="{{ $doc['id'] ?? '' }}"
                     data-pageid="{{ $page->id }}"
                     data-title="{{ $doc['name'] ?? '-' }}"
                     data-year="{{ $doc['date'] ?? '-' }}"
                     data-from="{{ Str::limit($doc['description'] ?? '', 100) }}"
                     data-views="{{ $doc['views'] ?? 0 }}"
                     data-pdf="{{ $fileHref }}"
                     onclick="openAwardModal(this)">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700"></div>
                    
                    <div class="relative z-10">
                        <h4 class="text-xl font-black text-slate-800 mb-2 leading-tight font-montserrat uppercase group-hover:text-emerald-700 transition-colors">{{ $doc['name'] ?? '-' }}</h4>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">{{ $doc['date'] ?? '-' }}</span>
                        </div>
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-widest mb-4">{{ $doc['description'] ?? '' }}</p>
                        
                        <!-- View Info -->
                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center gap-1.5 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="text-xs font-bold" id="view-count-{{ $i }}">{{ number_format($doc['views'] ?? 0) }}</span>
                            </div>
                            <span class="text-emerald-600 text-xs font-bold group-hover:underline">Klik untuk lihat →</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16 text-gray-400">
                    <p class="text-lg font-semibold">Belum ada dokumen.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="flex items-center justify-center gap-2 mt-12" id="pagination">
                <button onclick="changePage('prev')" id="prevBtn" class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-400 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <div class="flex items-center gap-1" id="pageNumbers">
                    <!-- Page numbers will be generated by JavaScript -->
                </div>
                
                <button onclick="changePage('next')" id="nextBtn" class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-400 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-600 transition-all flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Page Info -->
            <p class="text-center text-sm text-gray-400 mt-4">
                Menampilkan <span id="showingFrom">1</span>-<span id="showingTo">5</span> dari <span id="totalItems">5</span> penghargaan
            </p>
        </div>
    </div>
</section>

<!-- PDF Modal -->
<div id="awardModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm" onclick="closeAwardModal(event)">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="modalContent" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-[#0c1e33] to-[#1a3a5c] p-5 md:p-6 text-white pb-6 rounded-t-3xl border-b border-[#0c1e33]/50">
            <div class="flex items-start justify-between">
                <div class="pr-6">
                    <h3 class="text-lg md:text-xl font-bold font-montserrat mb-3 text-white drop-shadow-sm leading-snug" id="modalTitle">Judul Dokumen</h3>
                    <div class="flex items-center gap-2 text-emerald-50 text-sm flex-wrap">
                        <span class="px-2.5 py-1 bg-white/20 hover:bg-white/30 backdrop-blur-sm transition-colors rounded-md text-xs font-semibold shadow-inner" id="modalYear">-</span>
                        <span class="font-medium opacity-90 line-clamp-1" id="modalFrom">-</span>
                    </div>
                </div>
                <button onclick="closeAwardModal()" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- PDF Viewer -->
        <div class="bg-gray-100 h-[50vh]">
            <iframe id="pdfViewer" src="" class="w-full h-full border-0"></iframe>
        </div>
        
        <!-- Modal Footer -->
        <div class="bg-white p-5 border-t border-gray-100 rounded-b-3xl">
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4" id="modalFooterInner">
                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    <a id="btnLihat" href="#" target="_blank" class="px-6 py-3 bg-emerald-100 text-emerald-700 rounded-xl font-bold text-sm hover:bg-emerald-200 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Lihat
                    </a>
                    <a id="btnDownload" href="#" download class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const websiteSlug = @json(isset($website) ? $website->slug : request()->segment(1));
const ppidViewUrlTemplate = websiteSlug ? `/${websiteSlug}/ppid/item/__ITEM__/view` : '/ppid/item/__ITEM__/view';
const manualViewUrlTemplate = websiteSlug ? `/${websiteSlug}/dynamic-page/manual-view/__PAGE__/__INDEX__` : '/dynamic-page/manual-view/__PAGE__/__INDEX__';

document.addEventListener('DOMContentLoaded', function() {
    // Add staggered transition delays for reveal elements
    const revealElements = document.querySelectorAll('.reveal');
    revealElements.forEach((el, index) => {
        el.style.transitionDelay = (index * 0.1) + 's';
    });
});

// Modal functions
let currentAwardId = null;

function openAwardModal(element) {
    const title = element.getAttribute('data-title');
    const year = element.getAttribute('data-year');
    const from = element.getAttribute('data-from');
    const pdfUrl = element.getAttribute('data-pdf');
    const dbId = element.getAttribute('data-dbid');
    const rawViews = element.getAttribute('data-views') || 0;
    const views = parseInt(rawViews);
    currentAwardId = element.getAttribute('data-id');
    
    // Update modal content
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalYear').textContent = year;
    document.getElementById('modalFrom').textContent = from;
    
    // Setup modal view container based on manual vs auto
    let viewContainer = document.getElementById('modalViewContainer');
    if (!viewContainer) {
        viewContainer = document.createElement('div');
        viewContainer.id = 'modalViewContainer';
        viewContainer.className = 'flex items-center gap-2 text-gray-500 mr-auto';
        viewContainer.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg><span class="text-sm font-bold"><span id="modalViews">0</span> orang telah melihat</span>`;
        document.getElementById('modalFooterInner').prepend(viewContainer);
    }

    if (true) {
        viewContainer.style.display = 'flex';
        document.getElementById('modalViews').textContent = (views + 1).toLocaleString();
    }
    
    // Validate PDF URL
    if (!pdfUrl || pdfUrl === 'null' || pdfUrl === '/') {
        document.getElementById('pdfViewer').src = '';
        document.getElementById('pdfViewer').style.display = 'none';
        
        // Let user know there is no file
        if (!document.getElementById('noFileMsg')) {
            const noFileDiv = document.createElement('div');
            noFileDiv.id = 'noFileMsg';
            noFileDiv.className = 'flex items-center justify-center h-full w-full bg-gray-100 text-gray-400 text-sm font-semibold';
            noFileDiv.textContent = 'File dokumen tidak tersedia.';
            document.getElementById('pdfViewer').parentNode.appendChild(noFileDiv);
        } else {
            document.getElementById('noFileMsg').style.display = 'flex';
        }
        
        document.getElementById('btnLihat').style.display = 'none';
        document.getElementById('btnDownload').style.display = 'none';
    } else {
        document.getElementById('pdfViewer').src = pdfUrl;
        document.getElementById('pdfViewer').style.display = 'block';
        if (document.getElementById('noFileMsg')) {
            document.getElementById('noFileMsg').style.display = 'none';
        }
        
        document.getElementById('btnLihat').style.display = 'flex';
        document.getElementById('btnLihat').href = pdfUrl;
        document.getElementById('btnDownload').style.display = 'flex';
        document.getElementById('btnDownload').href = pdfUrl;
        // Fix for file name not matching document title
        const safeTitle = title.replace(/[^a-z0-9]/gi, '_').toLowerCase();
        document.getElementById('btnDownload').setAttribute('download', safeTitle + '.pdf');
    }
    
    // Show modal with animation
    const modal = document.getElementById('awardModal');
    const content = document.getElementById('modalContent');
    
    if (modal && content) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        document.body.style.overflow = 'hidden';
    }

    // Set CSRF token meta tag if not exists
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const pageId = element.getAttribute('data-pageid');
    
    // Perform AJAX request to increment views in database if it's a PPID item
    // OR persist directly via the specific manual dynamic page endpoint
    if (csrfToken) {
        const fetchUrl = dbId
            ? ppidViewUrlTemplate.replace('__ITEM__', dbId)
            : manualViewUrlTemplate.replace('__PAGE__', pageId).replace('__INDEX__', currentAwardId);
            
        fetch(fetchUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success || data.views) {
                  const newViews = data.views || (views + 1);
                  // Update modal view count
                  if (document.getElementById('modalViews')) {
                      document.getElementById('modalViews').textContent = Number(newViews).toLocaleString();
                  }
                  
                  // Update card view count
                  const viewCountEl = document.getElementById('view-count-' + currentAwardId);
                  if (viewCountEl) {
                      viewCountEl.textContent = Number(newViews).toLocaleString();
                  }
                  
                  // Update data attribute for next time
                  element.setAttribute('data-views', newViews);
              }
          }).catch(err => console.error('Error tracking view:', err));
    }
}

function closeAwardModal(event) {
    if (event && event.target !== document.getElementById('awardModal')) return;
    
    const modal = document.getElementById('awardModal');
    const content = document.getElementById('modalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('pdfViewer').src = '';
    }, 300);
    
    document.body.style.overflow = '';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeAwardModal();
});

// Pagination functionality
const ITEMS_PER_PAGE = 6;
let currentPage = 1;
let totalItems = 0;
let allCards = [];

document.addEventListener('DOMContentLoaded', function() {
    // Get all award cards
    allCards = Array.from(document.querySelectorAll('.grid > div[onclick]'));
    totalItems = allCards.length;
    
    // Initialize pagination
    updatePagination();
    showPage(1);
});

function showPage(page) {
    currentPage = page;
    const start = (page - 1) * ITEMS_PER_PAGE;
    const end = start + ITEMS_PER_PAGE;
    
    allCards.forEach((card, index) => {
        if (index >= start && index < end) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
    
    updatePagination();
    
    // Update info text
    const showingFrom = totalItems > 0 ? start + 1 : 0;
    const showingTo = Math.min(end, totalItems);
    document.getElementById('showingFrom').textContent = showingFrom;
    document.getElementById('showingTo').textContent = showingTo;
    document.getElementById('totalItems').textContent = totalItems;
}

function updatePagination() {
    const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
    const pageNumbersContainer = document.getElementById('pageNumbers');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    // Update prev/next buttons
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages || totalPages === 0;
    
    // Generate page numbers
    pageNumbersContainer.innerHTML = '';
    
    for (let i = 1; i <= totalPages; i++) {
        const isActive = i === currentPage;
        const btn = document.createElement('button');
        btn.className = `w-10 h-10 rounded-xl font-bold text-sm transition-all flex items-center justify-center ${
            isActive 
                ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' 
                : 'bg-white border border-gray-200 text-gray-600 hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-600'
        }`;
        btn.textContent = i;
        btn.onclick = () => showPage(i);
        pageNumbersContainer.appendChild(btn);
    }
}

function changePage(direction) {
    const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
    
    if (direction === 'prev' && currentPage > 1) {
        showPage(currentPage - 1);
    } else if (direction === 'next' && currentPage < totalPages) {
        showPage(currentPage + 1);
    }
    
    // Scroll to top of awards section
    document.querySelector('.grid').scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>


@endsection
