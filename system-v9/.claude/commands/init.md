# /init — Blueprint Proyek + Roadmap Adaptif
> Bekerja untuk **project baru** maupun **project yang sudah jalan**.
> Claude yang menentukan mode secara otomatis — kamu tidak perlu pilih.

---

## 🔀 DETEKSI MODE OTOMATIS

Saat `/init` dijalankan, Claude **langsung cek kondisi folder project**:

```
Ada PROJECT.md lengkap?
  YA  → MODE A: Project Baru (alur normal)
  TIDAK / KOSONG → MODE B: Project Lama (scan & analisa dulu)
```

---

---

# MODE A — PROJECT BARU
*(Aktif jika PROJECT.md sudah diisi lengkap)*

## Urutan Eksekusi

### Langkah 1 — Baca & Konfirmasi PROJECT.md

Baca `PROJECT.md` secara menyeluruh. Tampilkan ringkasan:

```
📋 SAYA BACA PROJECT.MD KAMU
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Proyek       : [nama proyek]
Jenis        : [jenis web]
Client       : [client / tujuan]
Target       : [target selesai]
Kompleksitas : [🟢 Rendah / 🟡 Sedang / 🔴 Tinggi] — [alasan singkat]

Fitur yang diminta:
  ✅ [fitur 1]
  ✅ [fitur 2]
  ✅ [dst...]

Desain:
  Palet    : [nama palet / warna]
  Nuansa   : [formal / modern / dll]
  Device   : [desktop / mobile / keduanya]
```

Tanya: *"Sudah benar semua? Ketik 'lanjut' atau koreksi jika ada yang salah."*

---

### Langkah 2 — Gambaran Lengkap Arsitektur

Setelah user konfirmasi, tampilkan **blueprint teknis**:

```
🏗️ BLUEPRINT PROYEK: [Nama Proyek]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ARSITEKTUR YANG AKAN DIBANGUN:
  Stack       : TALL (Tailwind + Alpine + Laravel + Livewire)
  Auth        : Laravel Breeze (Blade)
  Role        : [admin saja / admin + user / dll]

DATABASE — Tabel yang akan dibuat:
  • [tabel_1]   : [kolom-kolom kunci]
  • [tabel_2]   : [kolom-kolom kunci]

RELASI PENTING:
  • [Model A] hasMany [Model B]
  • [Model B] belongsTo [Model A]

HALAMAN & KOMPONEN YANG AKAN DIBUAT:
  Layouts:
    • layouts/app.blade.php
    • layouts/guest.blade.php

  Livewire Components:
    • [NamaComponent] — [fungsinya]

  Blade Components:
    • <x-card>, <x-button>, <x-modal>

KEPUTUSAN ARSITEKTUR AWAL:
  • [keputusan 1]
  • [keputusan 2]
```

---

### Langkah 3 — Roadmap Adaptif Per Fase

```
📅 ROADMAP: [Nama Proyek]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

FASE 1 — [Nama Fase] (Hari [X]-[Y])
  Tujuan      : [apa yang ingin dicapai]
  Deliverable :
    □ [item konkret 1]
    □ [item konkret 2]
  File utama  : [file yang akan dibuat]
  Risiko      : [potensi masalah, atau "Rendah"]
  ✅ Selesai jika: [kriteria fase dianggap done]

[dst sampai fase Deploy]

TOTAL ESTIMASI: [N] hari kerja
```

| Jenis | Fase Kritis | Bottleneck |
|---|---|---|
| `kasir` | Fase 3 | Keranjang + transaksi atomik |
| `company-profile` / `instansi` | Tidak ada | Desain & konten |
| `toko-online` | Fase 3 | Keranjang + checkout + stok |
| `portal-berita` | Tidak ada | Manajemen konten |
| `absensi` | Fase 3 | Logic waktu & terlambat |
| `booking` | Fase 3 | Konflik slot & konfirmasi |
| `dashboard-admin` | Fase 3 | Query statistik + chart |
| `inventaris` | Fase 3 | Mutasi stok + audit trail |

---

### Langkah 4 — Inisialisasi File System

Tulis `HANDOFF.md` sebagai snapshot awal, update `PROJECT.md` dengan roadmap, lalu:

```
✅ Blueprint selesai.
✅ HANDOFF.md diinisialisasi.
✅ Roadmap tercatat di PROJECT.md.

Mau langsung mulai Fase 1?
Langkah pertama: [sebutkan aksi konkret pertama]
```

---

---

# MODE B — PROJECT LAMA (SCAN OTOMATIS)
*(Aktif jika PROJECT.md tidak ada, kosong, atau project sudah punya kode)*

## Tujuan
Claude **membaca sendiri** seluruh kondisi project tanpa user harus isi apapun.
Hasilnya: laporan lengkap "project sudah sampai mana" + rencana lanjutan.

---

## Urutan Eksekusi

### Langkah 1 — Umumkan Bahwa Scanning Dimulai

```
🔍 PROJECT.MD TIDAK DITEMUKAN / KOSONG
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Sepertinya ini project yang sudah berjalan.
Aku akan scan seluruh folder project dulu untuk memahami kondisinya.
Ini membutuhkan beberapa saat...
```

---

### Langkah 2 — Scan Menyeluruh (Gunakan Filesystem MCP)

Baca file-file berikut secara berurutan:

**A. Identitas Project**
- `composer.json` → nama project, Laravel version, package yang dipakai
- `package.json` → dependencies frontend (Vite, Alpine, Tailwind, dll)
- `.env.example` → konfigurasi yang dipakai

**B. Database & Model**
- `database/migrations/` → semua file migrasi → petakan tabel & kolom
- `app/Models/` → semua model → petakan relasi antar tabel
- `database/seeders/` → data awal yang ada

**C. Halaman & Routing**
- `routes/web.php` → semua URL yang sudah ada + middleware
- `routes/api.php` → jika ada API
- `app/Http/Controllers/` → controller yang sudah dibuat

**D. Livewire & Blade**
- `app/Livewire/` → semua komponen Livewire yang sudah ada
- `resources/views/livewire/` → template Livewire
- `resources/views/components/` → Blade components
- `resources/views/layouts/` → layout yang dipakai

**E. Design System (baca dari kode)**
- `tailwind.config.js` → warna custom, font, breakpoint
- `resources/css/app.css` → custom CSS yang ada
- Scan warna yang paling sering dipakai di file Blade

**F. Status Fitur**
- Cek fitur yang setengah jalan (ada view tapi belum ada controller, atau sebaliknya)
- Cari file yang ada `// TODO` atau `// WIP` di dalamnya

---

### Langkah 3 — Tampilkan Laporan Hasil Scan

```
📊 HASIL SCAN PROJECT: [nama dari composer.json]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🔧 STACK TERDETEKSI:
  Laravel     : [versi]
  Livewire    : [versi / tidak ditemukan]
  Tailwind    : [versi / tidak ditemukan]
  Alpine.js   : [versi / tidak ditemukan]
  Auth        : [Breeze / Jetstream / manual / tidak ada]

🗄️ DATABASE — [X] tabel ditemukan:
  ✅ [tabel_1]   : [kolom utama] — [lengkap / kosong]
  ✅ [tabel_2]   : [kolom utama] — [lengkap / kosong]
  ⚠️ [tabel_3]   : ada migrasi tapi belum ada model

🔗 RELASI YANG DITEMUKAN:
  • [Model A] hasMany [Model B]
  • [Model B] belongsTo [Model A]

🌐 HALAMAN / URL — [X] route ditemukan:
  ✅ /[url]   → [Controller / Livewire] — terlihat lengkap
  ⚠️ /[url]   → ada route tapi view belum ada
  ❌ /[url]   → ada view tapi route belum terdaftar

🧩 LIVEWIRE COMPONENTS — [X] ditemukan:
  ✅ [NamaComponent]   — [fungsinya berdasarkan kode]
  ✅ [NamaComponent]   — [fungsinya berdasarkan kode]

🎨 DESIGN SYSTEM TERDETEKSI:
  Warna utama : [hex / nama class yang paling sering muncul]
  Font        : [dari tailwind.config / default]
  Komponen UI : [list komponen Blade yang ada]

⚠️ FITUR SETENGAH JALAN:
  • [deskripsi fitur yang belum selesai]

❓ YANG BELUM ADA (kemungkinan belum dibuat):
  • [fitur yang biasanya ada di jenis project ini tapi tidak ditemukan]
```

---

### Langkah 4 — Tanya Konfirmasi ke User

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Berdasarkan scan di atas, ada beberapa hal yang perlu aku tahu:

1. Nama project ini apa? (untuk dicatat di PROJECT.md)
2. Project ini untuk siapa / tujuannya apa?
3. Fitur apa yang ingin dilanjutkan atau ditambahkan?
4. Ada bagian yang JANGAN diubah sama sekali?

Jawab sesuai yang kamu tahu ya — tidak perlu teknis!
```

---

### Langkah 5 — Generate Blueprint & Rencana Lanjutan

Setelah user jawab:

**A. Isi otomatis `PROJECT.md`** berdasarkan hasil scan + jawaban user

**B. Isi otomatis `DESIGN-SYSTEM.md`** berdasarkan warna & komponen yang ditemukan

**C. Tampilkan rencana lanjutan:**

```
📋 RENCANA LANJUTAN PROJECT: [nama]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

YANG SUDAH SELESAI:
  ✅ [fitur/halaman yang sudah lengkap]

YANG PERLU DILANJUTKAN:
  🔧 [fitur setengah jalan — estimasi: X jam]

YANG BELUM ADA (saran tambahan):
  💡 [saran fitur — bisa skip kalau tidak perlu]

URUTAN PENGERJAAN YANG DISARANKAN:
  1. [langkah pertama]
  2. [langkah kedua]
  3. [dst]

⚠️ JANGAN DIUBAH:
  • [file/fitur yang sudah jalan & tidak boleh disentuh]
```

Tanya: *"Setuju dengan rencana ini? Atau ada yang mau diubah urutannya?"*

---

### Langkah 6 — Inisialisasi HANDOFF.md & Mulai

Setelah user setuju:
- Tulis `HANDOFF.md` dengan kondisi terkini project
- Update `PROJECT.md` dengan hasil scan & rencana
- Update `DESIGN-SYSTEM.md` dengan design tokens yang ditemukan

```
✅ Scan selesai. Project sudah terpetakan.
✅ PROJECT.md, HANDOFF.md, DESIGN-SYSTEM.md sudah diisi otomatis.
✅ AI manapun kini bisa lanjutkan project ini.

Mau mulai dari mana?
Saran pertama: [langkah paling logis berdasarkan kondisi project]
```

---

## Catatan Penting

- **Mode B tidak akan ubah kode yang ada** — hanya baca & catat
- Jika ada file yang tidak bisa dibaca → catat "tidak diketahui", lanjutkan scan
- Warna di DESIGN-SYSTEM.md diambil dari kode nyata, bukan asumsi
- Setelah `/init` Mode B selesai, semua command (`/desain`, `/new-page`, `/fix-ui`, dll) langsung bisa dipakai normal
