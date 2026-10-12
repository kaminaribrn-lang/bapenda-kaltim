# HANDOFF.md — Jembatan Antar AI

> File ini diinisialisasi otomatis saat `/init` dan diupdate otomatis setiap fase selesai.
> **Cara pakai:** Lampirkan file ini setiap kali pindah AI (Claude → Gemini atau sebaliknya).
> AI yang menerima handoff wajib baca file ini dari atas ke bawah sebelum melakukan apapun.

---

## 🗺️ BLUEPRINT PROYEK
> ⚠️ Bagian ini JANGAN dihapus atau diubah. Ini fondasi permanen dari `/init`.

```
Proyek   : Bapenda Kaltimprov — Portal Publik
Jenis    : instansi (portal pemerintah multi-tenant)
Client   : Badan Pendapatan Daerah Provinsi Kalimantan Timur
Stack    : Laravel 12 · Tailwind CSS v4 · Alpine.js · Blade
CMS      : Filament v3 (⛔ JANGAN SENTUH)
DB       : MySQL
Deploy   : Hostinger (GitHub Actions)
PHP      : 8.2+
```

### Arsitektur Multi-Tenant:
```
• Root /         → welcome.blade.php (pilih website dari 3 kartu)
• /{website:slug} → portal per instansi (bapenda, dll)
• Semua route portal diprefix: Route::prefix('/{website:slug}')->name('portal.')
• Website model: slug sebagai identifier tenant
```

### Tabel Database (read-only dari portal):
```
• websites       : id, name, slug, status, identity (JSON settings)
• posts/berita   : id, website_id, title, slug, content, image, published_at
• galleries      : id, website_id, title, image, category
• documents      : id, website_id, title, file_path, share_code, category
• layanans       : id, website_id, title, description, icon
• pengaduans     : id, website_id, kode, nama, isi, status, kategori
• ppid_permohonan: id, website_id, nama, nik, subjek, status
• menus          : id, website_id, label, slug, type, content_template
```

### Keputusan Arsitektur:
```
• Portal READ-ONLY — tidak ada write langsung ke DB kecuali pengaduan & ppid permohonan
• Dynamic pages via /{menuSlug} → DynamicPageController (fallback route paling bawah)
• Template halaman dinamis: aparatur, berita, dokumen_grid, dokumen_list,
  galeri, gambar_1, penjelasan_1, penjelasan_2, profil_pimpinan, tabel, blank_editor
• Design tokens di app.css via @theme (Tailwind v4 syntax — BUKAN tailwind.config.js)
• Warna AKTUAL: Primary #E8610A (oranye), Navy #0F2744 (bukan hijau di DESIGN-SYSTEM.md)
  → ⚠️ DESIGN-SYSTEM.md perlu diupdate ke palette aktual sebelum buat halaman baru
• Font AKTUAL: Plus Jakarta Sans (main), Montserrat & Inter (alternatif)
• Fitur animasi: orb-float, fade-up, reveal-on-scroll, glassmorphism
```

### Roadmap:
```
• Fase 1: Audit & Init ✅            | Audit kode, isi system-v9, selaraskan design system
• Fase 2: UI Polish Beranda ⏳       | Beranda, hero, layanan unggulan, statistik
• Fase 3: Halaman-Halaman Utama ⏳  | Berita, galeri, layanan, UPTD, kontak, dokumen
• Fase 4: Halaman PPID & Pengaduan ⏳| Form PPID, pengaduan, WBS, cek status
• Fase 5: Polish & SEO ⏳            | WCAG check, responsif, meta tags, performance
• Fase 6: Deploy Hostinger ⏳        | CI/CD GitHub Actions, FTP, .env production
```

---

## 📌 FASE AKTIF

```
Fase   : Fase 2 — UI Polish Beranda & Komponen Global
Status : 🔄 Sedang berjalan
Mulai  : 2026-05-11
```

---

## 📦 STATUS FASE TERAKHIR
> Diisi otomatis setiap fase selesai. Ini yang dibaca AI pertama kali saat pindah.

```
Fase Selesai    : Fase 1 — Audit & Init
Tanggal         : 2026-05-11
Dikerjakan oleh : Gemini (Antigravity)
```

### File Dibuat/Diubah:
```
• system-v9/HANDOFF.md          — diisi blueprint aktual
• system-v9/PROJECT.md          — diisi progress & roadmap
• system-v9/tasks/progress.md   — diisi status per fase
• system-v9/DESIGN-SYSTEM.md   — registry halaman & komponen diisi
```

### Keputusan Arsitektur Tambahan:
```
• Palette AKTUAL (dari app.css) BERBEDA dari DESIGN-SYSTEM.md:
  - Aktual: Primary #E8610A (oranye), Navy #0F2744
  - Design-System.md: Primary #10C840 (hijau Kaltim)
  → Keputusan: Gunakan palette AKTUAL (#E8610A + #0F2744) karena sudah diimplementasi
    dan disetujui di sesi sebelumnya. Update DESIGN-SYSTEM.md di Fase 2.
• Tailwind v4 (bukan v3) — syntax @theme di app.css, BUKAN tailwind.config.js
• Tidak ada Livewire component — murni Blade + Alpine.js client-side
```

### Yang Belum Selesai + Alasan:
```
• DESIGN-SYSTEM.md registry halaman & komponen belum diisi detail
• Beberapa halaman belum di-review WCAG compliance
• Palette di DESIGN-SYSTEM.md belum diselaraskan ke aktual
```

### Next Step — Fase 2:
```
• Review & polish halaman beranda.blade.php
• Selaraskan DESIGN-SYSTEM.md palette ke aktual
• Audit semua komponen portal (header, footer, floating-navbar, dll)
• Pastikan semua halaman responsive 375px → 1440px
```

---

## 📝 LOG PERUBAHAN ANTAR FASE
> Entri terbaru selalu di paling atas. Entri lama tidak dihapus.

```
(kosong — akan terisi otomatis setiap fase selesai)
```

---

## 💬 CATATAN UNTUK AI PENERIMA HANDOFF

Saat kamu (Claude atau Gemini) membuka file ini untuk melanjutkan:

1. Baca **BLUEPRINT PROYEK** → pahami struktur dan keputusan yang sudah dibuat
2. Baca **STATUS FASE TERAKHIR** → tahu persis di mana proyek berhenti
3. Baca **LOG PERUBAHAN** → lihat perjalanan fase sebelumnya
4. Konfirmasi ke user: *"Saya sudah baca HANDOFF.md. Melanjutkan [nama fase] dari [titik terakhir]. Siap lanjut?"*
5. Jangan ubah apapun di **BLUEPRINT PROYEK** — itu referensi permanen

> Prinsip: Setiap AI yang masuk harus bisa langsung kerja tanpa perlu penjelasan ulang dari user.
