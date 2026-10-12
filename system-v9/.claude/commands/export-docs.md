# /export-docs — Generate Draft Dokumen Tugas Akhir

> Ekstrak semua data dari sistem file proyek menjadi draft dokumen formal.
> Jalankan setelah semua fase selesai, sebelum sidang.
> Output: draft yang siap diedit, bukan dokumen final.

---

## DOKUMEN YANG BISA DI-GENERATE

Tanya user dokumen mana yang dibutuhkan:

```
Dokumen apa yang ingin di-generate?

1. 📊 Database Schema & ERD (teks)
2. 🔄 Flowchart Alur Sistem (teks/diagram)
3. 🏗️  Laporan Keputusan Teknis
4. 📋 Log Perubahan Per Fase
5. 📖 Semua sekaligus

Ketik angka atau "semua".
```

---

## OUTPUT PER DOKUMEN

### 1. Database Schema & ERD

Baca PROJECT.md dan HANDOFF.md → generate:

```markdown
# DATABASE SCHEMA — [Nama Proyek]

## Daftar Tabel

### Tabel: [nama_tabel]
| Kolom | Tipe | Nullable | Keterangan |
|-------|------|----------|------------|
| id | bigint unsigned | No | Primary key, auto increment |
| [kolom] | [tipe] | [yes/no] | [keterangan] |

**Relasi:**
- [nama_tabel] memiliki banyak [tabel_lain] (hasMany)
- [nama_tabel] dimiliki oleh [tabel_lain] (belongsTo)

---
[ulangi untuk setiap tabel]

## Ringkasan Relasi
[diagram teks relasi antar tabel]
```

**Catatan untuk user:**
```
Draft schema ini perlu diverifikasi dengan kode migration aktual.
Untuk ERD visual, gunakan tools:
  - dbdiagram.io (paste schema → auto generate ERD)
  - draw.io (buat manual dari draft ini)
  - MySQL Workbench (reverse engineer dari database)
```

---

### 2. Flowchart Alur Sistem

Baca HANDOFF.md bagian blueprint → generate alur per fitur utama:

```markdown
# FLOWCHART ALUR SISTEM — [Nama Proyek]

## Alur Login
START → Buka Halaman Login → Input Email & Password
→ [Validasi] → Gagal? → Tampil Pesan Error → Kembali ke Form
→ Berhasil? → Redirect ke Dashboard → END

## Alur [Fitur Utama 1]
[deskripsi alur dalam format yang bisa dijadikan flowchart]

## Alur [Fitur Utama 2]
[dst...]
```

**Catatan untuk user:**
```
Konversi teks ini ke diagram visual menggunakan:
  - draw.io / diagrams.net (gratis, bisa export PNG/PDF)
  - Lucidchart
  - Mermaid (jika laporan dalam format Markdown)
```

---

### 3. Laporan Keputusan Teknis

Baca tasks/lessons.md bagian KEPUTUSAN TEKNIS → format jadi laporan:

```markdown
# LAPORAN KEPUTUSAN TEKNIS — [Nama Proyek]

## 1. Pemilihan Tech Stack

### Framework: Laravel 11
**Alasan pemilihan:**
[dari keputusan yang tercatat]

**Alternatif yang dipertimbangkan:**
[dari lessons.md]

### [Keputusan teknis lainnya...]
[format sama]

## 2. Desain Database

### [Keputusan struktur database]
[dari lessons.md]

## 3. Keputusan Implementasi Fitur
[dari lessons.md — semua keputusan yang dicatat]
```

---

### 4. Log Perubahan Per Fase

Baca HANDOFF.md bagian LOG FASE SELESAI → format jadi tabel:

```markdown
# LOG PERUBAHAN PER FASE — [Nama Proyek]

| Fase | Nama | Tanggal | Yang Dikerjakan | File Utama |
|------|------|---------|-----------------|------------|
| 1 | Setup & Auth | [tanggal] | [ringkasan] | [file] |
| 2 | CRUD | [tanggal] | [ringkasan] | [file] |
...

## Detail Per Fase

### Fase 1 — [nama]
[detail dari HANDOFF.md]

### Fase 2 — [nama]
[detail dari HANDOFF.md]
```

---

## SETELAH GENERATE

```
✅ Draft dokumen sudah di-generate.

Langkah selanjutnya:
1. Review setiap draft — verifikasi dengan kode aktual
2. Tambah detail yang kurang dari pengalaman kamu sendiri
3. Konversi diagram teks ke visual (dbdiagram.io, draw.io)
4. Format sesuai template laporan kampus kamu
5. Minta dosen pembimbing review sebelum sidang

⚠️  PENTING:
Draft ini adalah titik awal, bukan produk akhir.
Kamu harus memahami dan bisa menjelaskan semua yang ada
di dokumen ini — penguji akan tanya detail.
```
