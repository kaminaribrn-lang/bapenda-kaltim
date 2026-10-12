# /tambah-fitur [deskripsi fitur] — Impact Analysis Sebelum Coding

> Wajib dijalankan sebelum menambah fitur apapun ke proyek yang sudah berjalan.
> Tujuan: tidak ada fitur baru yang crash atau merusak yang sudah ada.
> Prinsip: ANALISIS DULU, CODING BELAKANGAN.

---

## MENGAPA COMMAND INI WAJIB

Fitur baru yang ditambahkan tanpa analisis sering menyebabkan:
- Tabel database lama berubah → data lama corrupt
- Komponen yang sudah jalan ikut berubah → fitur lama rusak
- Tidak ada cara rollback kalau sesuatu crash

---

## URUTAN EKSEKUSI

### Langkah 1 — Pahami Fitur yang Diminta

Baca deskripsi fitur dari user. Jika kurang jelas, tanya dulu:
```
Sebelum saya analisis, saya perlu tahu:
1. [pertanyaan spesifik jika ada yang ambigu]
2. [pertanyaan tentang edge case jika perlu]
```

### Langkah 2 — Baca Konteks Proyek

Baca HANDOFF.md dan PROJECT.md untuk pahami:
- Tabel database yang sudah ada
- Komponen yang sudah dibuat
- Keputusan arsitektur yang sudah dikunci

### Langkah 3 — Tampilkan Impact Analysis

```
══════════════════════════════════════════════════════
  IMPACT ANALYSIS — [nama fitur]
══════════════════════════════════════════════════════

📋 PEMAHAMAN FITUR
  [deskripsi singkat fitur yang akan dibuat]

🗄️  DATABASE
  Tabel baru yang dibutuhkan:
    + [nama tabel] — [deskripsi]

  Tabel yang sudah ada dan akan disentuh:
    ~ [nama tabel] — [kolom apa yang berubah/ditambah]
    ⚠️  [nama tabel] — [peringatan jika ada risiko data lama]

  Tidak ada tabel yang perlu diubah:
    ✓ [nama tabel] — aman, tidak terpengaruh

🧩 KOMPONEN
  Komponen baru yang akan dibuat:
    + app/Livewire/[nama].php
    + resources/views/livewire/[nama].blade.php

  Komponen yang sudah ada dan akan disentuh:
    ~ [nama komponen] — [perubahan apa]
    ⚠️  [nama komponen] — [risiko jika ada]

  Komponen yang aman, tidak terpengaruh:
    ✓ [nama komponen]

🔗 RELASI & DEPENDENCY
  [fitur baru ini bergantung pada fitur lain yang mana]
  [fitur lain yang bergantung pada fitur ini]

⚠️  RISIKO
  [risiko utama yang perlu diwaspadai — atau "Tidak ada risiko signifikan"]

🛡️  STRATEGI AMAN
  [pendekatan yang direkomendasikan untuk minimasi risiko]
  Contoh: "Buat tabel baru, jangan ubah tabel orders yang sudah ada"

⏱️  ESTIMASI
  Kompleksitas : [Kecil / Sedang / Besar]
  Estimasi     : [X jam / X hari]

══════════════════════════════════════════════════════
```

### Langkah 4 — Konfirmasi Sebelum Mulai

```
Ada yang ingin diubah dari rencana di atas?

Ketik "lanjut" untuk mulai coding.
Ketik "ubah [bagian]" untuk revisi rencana.
Ketik "batal" untuk batalkan.
```

> ⚠️ JANGAN mulai coding sebelum user ketik "lanjut".

### Langkah 5 — Git Checkpoint

Setelah user konfirmasi, sebelum mulai coding:

```
⚠️ GIT CHECKPOINT
Sebelum mulai, pastikan semua kode yang sudah ada ter-commit:

  git add .
  git commit -m "chore: checkpoint sebelum tambah fitur [nama fitur]"

Ini memastikan kamu bisa rollback jika sesuatu crash.
Sudah commit? Ketik "sudah" untuk mulai.
```

### Langkah 6 — Mulai Coding dengan Urutan Aman

Ikuti urutan ini — additive first:
```
1. Buat migration baru (jangan ubah migration lama)
2. Buat Model baru
3. Buat Livewire component baru
4. Buat Blade view baru
5. Tambah route baru
6. Integrasi ke komponen/halaman yang sudah ada (terakhir)
7. Test setiap langkah sebelum lanjut ke langkah berikutnya
```

### Langkah 7 — Update Dokumentasi

Setelah fitur selesai dan jalan:
- Update registry di DESIGN-SYSTEM.md
- Tambah keputusan teknis ke tasks/lessons.md
- Update PROGRESS di PROJECT.md
- Update HANDOFF.md jika ada keputusan arsitektur baru

---

## PRINSIP ADDITIVE FIRST

```
✅ Tabel baru > ubah tabel lama
✅ Komponen baru > modifikasi komponen lama
✅ Route baru > ubah route lama
✅ Integrasi belakangan > langsung inject ke kode lama

Kalau terpaksa ubah yang lama:
→ Pastikan ada migration yang backward compatible
→ Pastikan tidak break data yang sudah ada
→ Test fitur lama setelah perubahan
```
