<!-- Dummy PDF Modal Component for Preview -->
<div id="pdfModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm" onclick="closePdfModal(event)">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="pdfModalContent" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-5 text-white flex justify-between items-center">
            <h3 class="font-bold text-lg" id="pdfModalTitle">Lihat Dokumen</h3>
            <button onclick="closePdfModal()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="bg-gray-100 h-[60vh] flex items-center justify-center text-slate-400">
            [Preview PDF Simulasi]
        </div>
    </div>
</div>

<script>
    function openPdfModal(url) {
        const modal = document.getElementById('pdfModal');
        const content = document.getElementById('pdfModalContent');
        if (modal && content) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        } else {
            window.open(url, '_blank');
        }
    }

    function closePdfModal(e) {
        if (e && e.target !== document.getElementById('pdfModal')) return;
        const modal = document.getElementById('pdfModal');
        const content = document.getElementById('pdfModalContent');
        if (modal && content) {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
            document.body.style.overflow = '';
        }
    }
</script>
