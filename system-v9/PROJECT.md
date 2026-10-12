# PROJECT.md — Konteks Proyek

> **Isi file ini sekali di awal proyek. Update bagian PROGRESS setiap sesi.**
> Claude akan baca file ini saat `/init` dan adaptasi semua saran sesuai jenis proyek.

---

## 🏷️ IDENTITAS PROYEK

```
Nama Proyek      : Bapenda Kaltimprov — Portal Publik
Jenis Web        : instansi (portal pemerintah multi-tenant)
Tanggal Mulai    : 2026-05-08
Tanggal Init V9  : 2026-05-11
Client / Tujuan  : Badan Pendapatan Daerah Provinsi Kalimantan Timur
```

**Scope:** Portal Publik saja — CMS/Backend Filament dikelola terpisah oleh tim backend.

---

## ✅ FITUR PORTAL PUBLIK

### Fitur Utama
- [x] Halaman Welcome (pemilih 3 instansi)
- [x] Halaman Beranda per instansi (Hero, Layanan, Berita, Statistik)
- [x] Halaman Layanan (index)
- [x] Halaman Berita (index + show/detail)
- [x] Halaman Galeri
- [x] Halaman UPTD Wilayah
- [x] Halaman Kontak
- [x] Halaman Dokumen Publik (download via share code)
- [x] Halaman PPID (index + form permohonan)
- [x] Halaman Pengaduan (form + cek status)
- [x] Halaman WBS (Whistle Blowing System)
- [x] Dynamic Pages via CMS (11 template: aparatur, galeri, dokumen_grid, dll)

### Yang Perlu Dipoles / Ditambah
- [ ] SEO meta tags per halaman
- [ ] Responsive audit menyeluruh (375px → 1440px)
- [ ] WCAG 2.1 AA compliance check semua halaman
- [ ] Kalkulator pajak publik (opsional)
- [ ] FAQ interaktif (opsional)

---

## 🎨 DESAIN & TAMPILAN

```
Palet warna AKTUAL : Primary #E8610A (oranye) + Navy #0F2744 + Accent #c4520a
Font AKTUAL        : Plus Jakarta Sans (main), Montserrat & Inter (alternatif)
Nuansa tampilan    : Government-modern — dark navy, oranye aksen, glassmorphism
Target perangkat   : ✅ Desktop utama + ✅ Mobile (responsive)
Standard           : WCAG 2.1 AA
⚠️ CATATAN          : DESIGN-SYSTEM.md masih pakai hijau #10C840 — perlu diselaraskan
```

---

## 🗄️ DATABASE

> Portal publik hanya READ dari database — tidak ada write langsung ke DB dari portal.

```
Data dibaca dari  : API dari backend Filament / Eloquent models (read-only)
Cache             : Gunakan Laravel cache untuk data statis (berita, layanan)
```

---

## ⚙️ TEKNIS

```
Framework     : Laravel 12
Frontend      : Alpine.js v3 + Tailwind CSS v4 + Blade (BUKAN Livewire)
CSS Syntax    : @import 'tailwindcss' + @theme {} (Tailwind v4 — bukan tailwind.config.js)
CMS Backend   : Filament v3 (⛔ JANGAN SENTUH)
Auth          : Guest/publik (tidak ada auth di portal)
DB            : MySQL
Deploy        : Hostinger Shared Hosting via GitHub Actions
PHP           : 8.2+
Build         : Vite (npm run dev / npm run build)
```

---

## 📈 PROGRESS SAAT INI

> **Update bagian ini setiap akhir sesi.**

```
Fase saat ini         : Fase 2 — UI Polish & Komponen Global
Yang sudah jalan      : Palette AKTUAL (Green #059669 & Red #DC2626), Beranda Polish,
                        Komponen Global (Header, Footer, Floating Nav) sudah Hijau.
Yang sedang dikerjakan: Review WCAG menyeluruh, Responsive audit per halaman.
Blocking / stuck      : -
Target sesi ini       : Selesaikan Fase 2 & Mulai Fase 3 (Halaman Berita/Galeri)
```

---

## 📅 ROADMAP

> Diisi otomatis oleh Claude saat `/init`. Jangan edit manual.

```
• Fase 1: Audit & Init ✅            | 2026-05-11 — sistem v9 diinisialisasi
• Fase 2: UI Polish Beranda ✅       | Header, beranda, komponen global, palette orange
• Fase 3: Halaman-Halaman Utama ⏳  | Berita, galeri, layanan, UPTD, kontak, dokumen
• Fase 4: Halaman PPID & Pengaduan ⏳| Form PPID, pengaduan, WBS, cek status
• Fase 5: Polish & SEO ⏳            | WCAG, meta tags, responsif, performance
• Fase 6: Deploy Hostinger ⏳        | CI/CD, .env production, testing live
```

---

## 🗒️ CATATAN TAMBAHAN

```
- Area kerja: resources/views/portal/ dan public/assets/portal/ SAJA
- CMS Filament dikelola tim backend — JANGAN SENTUH
- Design system sudah ditetapkan di DESIGN-SYSTEM.md — ikuti tanpa modifikasi
- Semua warna harus pakai token tailwind — dilarang hardcode hex
- Hosting: Hostinger shared hosting
- CI/CD: GitHub Actions (FTP Deploy)
```
