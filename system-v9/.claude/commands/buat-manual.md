# /buat-manual [nama fitur] — Generate Draft Manual User

> Generate draft manual penggunaan dari sudut pandang user, bukan developer.
> Jalankan setiap fase selesai — jangan numpuk di akhir.
> Output: panduan yang bisa dibaca orang yang tidak tahu coding.

---

## PRINSIP PENULISAN

```
✅ Bahasa user, bukan bahasa developer
   Bukan: "Livewire component akan dispatch event ke parent"
   Tapi : "Setelah klik tombol, data otomatis tersimpan"

✅ Langkah per langkah yang konkret
   Bukan: "Lakukan proses pembayaran"
   Tapi : "1. Klik tombol 'Bayar' 2. Pilih metode pembayaran 3. ..."

✅ Sertakan apa yang terjadi jika salah
   "Jika muncul pesan 'Data tidak valid', periksa..."

✅ Gunakan nama tombol/menu yang persis sama dengan di aplikasi
```

---

## FORMAT OUTPUT

```markdown
# PANDUAN PENGGUNAAN — [Nama Fitur]
**Untuk**: [target user — contoh: Kasir, Admin, Manajer]
**Diperbarui**: [tanggal]

---

## Apa itu [Nama Fitur]?
[Penjelasan 2-3 kalimat — apa fungsinya, kapan dipakai]

---

## Cara Menggunakan

### [Sub-fitur atau alur pertama]

**Langkah-langkah:**
1. [langkah pertama — spesifik]
2. [langkah kedua]
3. [dst...]

**Hasil yang diharapkan:**
[apa yang akan terjadi setelah langkah selesai]

---

### [Sub-fitur atau alur kedua]
[format sama]

---

## Pertanyaan Umum

**Q: [pertanyaan yang mungkin ditanya user]**
A: [jawaban praktis]

**Q: [pertanyaan tentang error umum]**
A: [solusi praktis]

---

## Pesan Error yang Mungkin Muncul

| Pesan | Artinya | Yang Harus Dilakukan |
|-------|---------|---------------------|
| "[pesan error 1]" | [penjelasan] | [tindakan] |
| "[pesan error 2]" | [penjelasan] | [tindakan] |

---

## Catatan Penting
- [hal yang perlu diperhatikan user]
- [batasan sistem yang perlu diketahui]
```

---

## KAPAN DIJALANKAN

```
Setelah Fase 1 selesai → /buat-manual Login & Navigasi
Setelah Fase 2 selesai → /buat-manual Manajemen [entitas utama]
Setelah Fase 3 selesai → /buat-manual [fitur kritis — misal: Transaksi]
Setelah Fase 4 selesai → /buat-manual Laporan & Dashboard
```

Simpan semua manual di folder `docs/manual/` dalam proyek.

---

## UNTUK TUGAS AKHIR

Manual yang sudah dibuat bisa langsung masuk ke lampiran laporan TA
sebagai "Panduan Penggunaan Sistem" — ini dokumen yang sering diminta
kampus dan sering dibuat terburu-buru di akhir.

Dengan membuat per fase, saat sidang kamu sudah punya manual yang
lengkap dan terstruktur tanpa harus buat semua dalam semalam.
