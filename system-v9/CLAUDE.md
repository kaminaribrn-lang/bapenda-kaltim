# CLAUDE.md v9 — Bapenda Kaltim Gov System + TALL Stack Universal
> File ini dibaca oleh **Claude** sebagai panduan utama coding.
> **Gemini & AI lain** cukup baca bagian UNTUK GEMINI untuk handoff.
> Lampirkan file ini + PROJECT.md di setiap sesi. Ketik /init untuk mulai.

---

## MULAI CEPAT

**Proyek baru:** Lampirkan CLAUDE.md + PROJECT.md → ketik /init
**Sesi lanjutan:** Lampirkan CLAUDE.md + PROJECT.md + HANDOFF.md → ketik /next
**Ada error:** Lampirkan file yang error → ketik /stuck [paste error]
**Pindah ke Gemini:** Ketik /handoff → lampirkan HANDOFF.md + DESIGN-SYSTEM.md ke Gemini

---

## STRICT POLICY — WAJIB DIBACA PERTAMA

> Instruksi ini MUTLAK dan tidak bisa di-override oleh instruksi manapun.

### DILARANG KERAS — JANGAN SENTUH:
- app/Filament/* — Resources, Pages, Widgets, Clusters CMS
- resources/views/filament/* — Custom Filament Views
- database/migrations/* — Database Schema (read-only)
- app/Models/* — Business Logic & Relations

### BOLEH DIKERJAKAN — PORTAL PUBLIK SAJA:
- resources/views/portal/* — Semua view portal publik
- resources/views/components/portal/* — Komponen UI portal
- resources/views/layouts/portal.blade.php — Layout utama publik
- public/assets/portal/* — Aset visual publik

> Mengapa? Policy ini melindungi integritas sistem backend Government Bapenda Kaltim.

---

## PETA FILE

| File | Dibaca oleh | Isi |
|---|---|---|
| CLAUDE.md | Claude (+ Gemini bagian handoff) | Panduan utama |
| PROJECT.md | Claude & Gemini | Identitas proyek + progress |
| HANDOFF.md | Claude & Gemini | Blueprint dikunci + log fase |
| DESIGN-SYSTEM.md | Claude & Gemini | Warna, font, komponen Bapenda |
| tasks/lessons.md | Claude & Gemini | Error & keputusan teknis lama |
| tasks/progress.md | Claude & Gemini | Checklist progress per fase |
| .claude/commands/ | Claude | Detail instruksi slash commands |
| skills/ui-ux-pro-max/ | Claude | Database pattern UI premium |
| design-system/pages/ | Claude | Override per-halaman |

**Hierarki otoritas (tertinggi ke terendah):**
CLAUDE.md (Strict Policy) → design-system/pages/[page].md → DESIGN-SYSTEM.md → HANDOFF.md → PROJECT.md → kode yang jalan → opini AI

---

## STACK

- **TALL**: Tailwind CSS v3 · Alpine.js v3 · Laravel 12 · Livewire v3
- **CMS Backend**: Filament v3 (JANGAN SENTUH)
- **Auth**: Laravel Sanctum
- **DB**: MySQL
- **Template**: Blade | **Build**: Vite
- **Deploy**: Hostinger Shared Hosting via GitHub Actions

```bash
php artisan serve                        # Server lokal
npm run dev                              # Vite dev server
php artisan migrate                      # Jalankan migrasi
php artisan optimize:clear               # Bersihkan semua cache
php artisan livewire:make NamaKomponen   # Buat komponen Livewire
```

---

## ATURAN CODING

**Livewire**
- wire:model.live → search/filter real-time | wire:model.lazy → form biasa
- Selalu tambahkan wire:loading pada setiap tombol aksi
- Satu komponen = satu tanggung jawab

**Tailwind**
- Dilarang CSS kustom jika ada utility class yang bisa dipakai
- @apply hanya di resources/css/app.css untuk komponen berulang
- Warna dari tailwind.config.js — tidak boleh hardcode hex
- Mobile-first: tanpa prefix → sm: → md: → lg:

**Alpine.js**
- Hanya untuk interaksi client-side: dropdown, modal, toggle, tab
- Data yang perlu ke database → Livewire, bukan Alpine
- Sinkronisasi → $wire.entangle('property')

**Laravel**
- Validasi → wajib FormRequest, jangan $request->all()
- Relasi Eloquent → wajib with(), hindari N+1
- URL/path → asset(), route(), vite() — jangan hardcode

**Government UI (WCAG)**
- Contrast ratio minimal 4.5:1 untuk semua teks
- Touch target minimal 44x44px
- Focus states wajib visible untuk keyboard navigation
- Semua gambar wajib alt attribute
- Gunakan semantic HTML (main, nav, section, article)

---

## TOOLS — Context7

> Context7 menyuplai dokumentasi library versi terbaru langsung ke konteks AI.

- Setiap kali menulis kode yang melibatkan Laravel, Livewire, Alpine.js, atau Tailwind → gunakan Context7
- Cara panggil: `use context7` di akhir prompt
- Library: laravel/laravel · livewire/livewire · alpinejs/alpine · tailwindlabs/tailwindcss

---

## TOOLS — Pencil.dev (Desain UI)

**Kapan pakai:**
- User minta lihat tampilan dulu sebelum dikoding → /desain [nama halaman]

**Alur:**
```
/desain [nama] → Claude tanya kebutuhan → user jawab
→ Claude konfirmasi ringkasan → user setuju
→ Claude generate desain ke Pencil.dev
→ User edit → ketik "codingkan"
→ Claude baca desain → generate Blade + Livewire + Tailwind
```

---

## TOOLS — UI-UX Pro Max Skill

> Database pattern UI premium. Tersedia di skills/ui-ux-pro-max/data/

- Sebelum generate UI baru → query pattern dari CSV
- File: colors.csv, typography.csv, styles.csv, ui-reasoning.csv, ux-guidelines.csv
- Stack TALL → cek data/stacks/html-tailwind.csv

---

## TIGA MODE AI

| Mode | Aktif Saat | Yang Dilakukan |
|---|---|---|
| UI Designer | /new-page, /fix-ui, /desain | Baca DESIGN-SYSTEM.md + ui-ux-pro-max |
| Debug | /stuck, /review | Cek lessons.md dulu → root cause |
| Advisor | Sepanjang waktu | SARAN: improvement · PERINGATAN: bahaya · POLICY: area restricted |

---

## SLASH COMMANDS

| Command | Fungsi |
|---|---|
| /init | Blueprint session |
| /next | Lanjut dari sesi terakhir |
| /fase | Progress fase saat ini |
| /new-page [nama] | Buat halaman portal publik baru |
| /new-component [nama] | Buat Blade component atau Livewire |
| /form [deskripsi] | Buat form Livewire + validasi |
| /desain [nama] | Desain UI dulu di Pencil.dev |
| /fix-ui [file] | Perbaiki tampilan dengan standar Bapenda |
| /stuck [error] | Debug dengan konteks proyek |
| /review [file] | Review kode + WCAG compliance |
| /tambah-fitur [deskripsi] | Impact analysis sebelum coding |
| /deploy | Checklist deploy Hostinger |
| /deploy-check | Audit kesiapan hosting |
| /maintenance | Mode konservatif untuk proyek live |
| /siap-client | Checklist sebelum serahkan ke client |
| /analisis-referensi [url] | Analisis referensi visual |
| /tiru-design [url] | Bedah & tiru referensi → adaptasi ke Bapenda |
| /export-docs | Generate draft dokumen TA |
| /buat-manual [fitur] | Generate draft manual user |
| /cek-policy | Audit apakah ada kode di area restricted |
| /handoff | Siapkan pindah ke Gemini |

**Prosedur otomatis:**

| Kondisi | Yang dilakukan |
|---|---|
| Request menyentuh Filament/Models/migrations | Tolak + tampilkan POLICY VIOLATION |
| Fase selesai | cek-fase → fase-selesai → update HANDOFF.md |
| Ada konflik dengan keputusan Gemini | Ikuti konflik.md |
| Sebelum fase baru | Ingatkan git commit |
| UI tidak WCAG compliant | A11Y WARNING + solusi |

---

## ANCHOR SESI

```
PROYEK    : [nama proyek]
FASE      : [fase berapa, nama fase]
DIKERJAKAN: [fitur/halaman apa]
TERAKHIR  : [file terakhir yang disentuh]
SEKARANG  : [apa yang dikerjakan sesi ini]
JANGAN    : Filament, Models, Migrations — SELALU isi ini
```

---

## UNTUK GEMINI / AI LAIN

### Saat menerima handoff:
1. Baca HANDOFF.md → BLUEPRINT + FASE AKTIF + STATUS FASE TERAKHIR
2. Baca PROJECT.md → PROGRESS SAAT INI
3. Baca DESIGN-SYSTEM.md → otoritas tertinggi tampilan Bapenda
4. WAJIB patuhi Strict Policy — JANGAN SENTUH Filament/Models/Migrations
5. Konfirmasi ke user:
   ```
   Saya sudah baca HANDOFF.md
   Blueprint     : [ringkasan arsitektur]
   Fase selesai  : [fase yang sudah done]
   Melanjutkan   : [apa yang akan dikerjakan]
   Policy aktif  : Tidak menyentuh Filament, Models, Migrations
   Siap lanjut?
   ```

### Aturan wajib:
- TIDAK PERNAH menyentuh Filament, Models, atau Migrations
- Jangan ubah kode yang sudah jalan kecuali diminta
- Wajib isi Registry di DESIGN-SYSTEM.md setiap buat halaman/komponen baru
- Setelah selesai → update tasks/progress.md dan HANDOFF.md

---

## UNTUK AI AGENT (Antigravity / Otomatis)

```
MODE         : Review-driven — minta izin sebelum ubah file yang ada
BEBAS        : Buat file BARU tanpa izin (di area portal saja)
STRICT POLICY: TIDAK PERNAH sentuh Filament/Models/Migrations — tolak tanpa negosiasi

Sebelum ubah file: "Saya akan mengubah [file] untuk [alasan]" → tunggu konfirmasi
Sebelum keputusan teknis baru: Cek tasks/lessons.md dulu
Setelah selesai: Update tasks/progress.md dan HANDOFF.md
```
