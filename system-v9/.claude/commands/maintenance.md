# /maintenance — Mode Proyek yang Sudah Live

> Gunakan command ini saat membuka kembali proyek yang sudah live dan ada user nyata.
> AI akan lebih konservatif, selalu minta izin, dan catat semua perubahan.
> Berbeda dari sesi development biasa — di sini ada data real yang harus dilindungi.

---

## KAPAN DIGUNAKAN

- Proyek sudah deploy dan dipakai user
- Client minta perbaikan atau perubahan
- Ada bug yang dilaporkan dari production
- Ingin tambah fitur kecil setelah go-live

---

## URUTAN EKSEKUSI

### Langkah 1 — Re-orientasi Konteks

Baca HANDOFF.md dari atas ke bawah. Konfirmasi pemahaman:

```
══════════════════════════════════════════════════════
  MODE MAINTENANCE — [Nama Proyek]
══════════════════════════════════════════════════════

⚠️  PROYEK INI SUDAH LIVE — ada user nyata yang bergantung padanya.
    Setiap perubahan akan berdampak langsung ke production.

📋 Yang saya pahami dari HANDOFF.md:
  Dibangun    : [ringkasan proyek]
  Fase selesai: [fase berapa yang sudah done]
  Stack       : TALL — Laravel + Livewire
  Hosting     : [hosting yang dipakai]

Ada yang perlu dikoreksi sebelum lanjut?
══════════════════════════════════════════════════════
```

### Langkah 2 — Identifikasi Jenis Perubahan

Tanya user:
```
Perubahan apa yang dibutuhkan?

1. 🐛 Bug fix — ada yang tidak berjalan dengan benar
2. ✏️  Perubahan kecil — teks, warna, tampilan minor
3. ➕ Fitur baru — tambah sesuatu yang belum ada
4. 🔧 Optimasi — performa atau keamanan

Ketik angka atau deskripsi masalahnya.
```

### Langkah 3 — Tindak Lanjut per Jenis

#### Jika Bug Fix (1)
```
→ Tanya: "Error apa yang terjadi? Ada pesan error atau screenshot?"
→ Cek tasks/lessons.md — apakah bug ini pernah terjadi sebelumnya?
→ Identifikasi root cause sebelum fix
→ Fix minimal — hanya yang perlu, tidak lebih
→ Minta user test di staging dulu sebelum push ke production
```

#### Jika Perubahan Kecil (2)
```
→ Konfirmasi scope: "Hanya [hal ini] yang berubah, benar?"
→ Identifikasi file yang terpengaruh (biasanya 1-2 file saja)
→ Tampilkan perubahan sebelum eksekusi
→ Minta konfirmasi → baru eksekusi
```

#### Jika Fitur Baru (3)
```
→ Stop — jalankan /tambah-fitur [deskripsi] dulu
→ Maintenance mode tidak cocok untuk fitur besar
→ Kalau fitur kecil: impact analysis singkat tetap wajib
```

#### Jika Optimasi (4)
```
→ Tanya: "Ada keluhan performa spesifik? Halaman mana yang lambat?"
→ Ukur dulu sebelum optimasi — jangan asumsi
→ Optimasi satu hal per sesi, bukan semua sekaligus
```

### Langkah 4 — Git Checkpoint WAJIB

Sebelum perubahan apapun:
```
⚠️  BACKUP DULU SEBELUM UBAH APAPUN

Di server production:
  git add .
  git commit -m "backup: sebelum maintenance [tanggal]"

Di lokal (jika ada):
  git pull origin main
  git checkout -b maintenance/[tanggal]-[deskripsi]

Sudah backup? Ketik "sudah" untuk lanjut.
```

### Langkah 5 — Eksekusi dengan Prinsip Minimal Change

```
✅ Ubah sesedikit mungkin untuk mencapai tujuan
✅ Satu perubahan per sesi jika memungkinkan
✅ Test di lokal sebelum push ke production
✅ Kalau ada downtime → pasang maintenance page dulu
❌ Jangan refactor sekalian saat maintenance
❌ Jangan ubah hal yang tidak diminta
❌ Jangan "perbaiki" yang tidak rusak
```

### Langkah 6 — Catat Semua Perubahan di HANDOFF.md

Setelah selesai, tambahkan entry di HANDOFF.md bagian LOG FASE SELESAI:

```markdown
---
### MAINTENANCE — [tanggal]
**Jenis**: [Bug fix / Perubahan / Optimasi]
**Dikerjakan oleh**: [Claude / Gemini]

#### Perubahan yang Dilakukan
- [perubahan 1 — file yang diubah]
- [perubahan 2]

#### Alasan
[kenapa perubahan ini dilakukan]

#### Yang Tidak Diubah (intentional)
[hal yang dipertimbangkan untuk diubah tapi sengaja tidak diubah]

#### Status Setelah Maintenance
[semua oke ✅ / masih ada issue ⚠️]
---
```

### Langkah 7 — Verifikasi Post-Maintenance

```
[ ] Fitur yang diubah berfungsi dengan benar
[ ] Fitur lain yang berkaitan tidak rusak
[ ] Tidak ada error baru di storage/logs/laravel.log
[ ] User/client sudah konfirmasi perubahan sesuai ekspektasi
```

---

## ATURAN KHUSUS MODE MAINTENANCE

```
1. KONSERVATIF — selalu minta izin sebelum ubah apapun
2. MINIMAL — ubah sesedikit mungkin
3. DOKUMENTASI — catat semua perubahan di HANDOFF.md
4. BACKUP DULU — tidak ada pengecualian
5. TEST DULU — jangan langsung push ke production tanpa test
```
