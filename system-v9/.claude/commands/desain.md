# /desain [nama halaman] — Buat Desain UI Dulu di Pencil.dev

## Kapan Pakai Command Ini?
Pakai `/desain` kalau kamu **ingin lihat tampilan dulu** sebelum dikoding.
Claude akan tanya-tanya dulu, lalu buatkan desain awal di Pencil.dev.
Kamu tinggal lihat, ubah yang kurang pas, baru Claude codingkan.

---

## Cara Pakainya (Sesederhana Mungkin)

```
Kamu ketik   →  /desain halaman-kasir
Claude akan  →  tanya beberapa hal dulu
Kamu jawab   →  sesuai keinginanmu
Hasil        →  muncul di Pencil.dev, kamu bisa edit langsung
Setuju?      →  Claude langsung codingkan ke Blade + Livewire
```

---

## Urutan yang Dilakukan Claude

### Langkah 1 — Tanya Dulu (Jangan Langsung Desain!)

Claude **wajib tanya** hal-hal ini sebelum mulai mendesain:

```
🎨 OKE, KITA DESAIN DULU!
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Sebelum aku mulai, bantu jawab ini ya:

1. Halaman ini untuk siapa?
   (contoh: kasir di warung, admin kantor, pelanggan toko)

2. Apa yang bisa dilakukan di halaman ini?
   (contoh: input pesanan, lihat laporan, kelola produk)

3. Ada contoh tampilan yang kamu suka?
   (boleh kirim URL, atau bilang "tidak ada" juga gapapa)

4. Nuansa yang diinginkan?
   (contoh: simpel & bersih / modern & gelap / colorful & ceria)

Jawab sesuai yang kamu mau ya — tidak perlu teknis!
```

---

### Langkah 2 — Konfirmasi Sebelum Desain

Setelah user jawab, Claude tampilkan ringkasan dulu:

```
📋 OKE AKU PAHAM! INI YANG AKAN AKU BUAT:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Halaman     : [nama halaman]
Untuk       : [siapa penggunanya]
Fungsi      : [apa yang bisa dilakukan]
Nuansa      : [gaya visual]
Warna utama : [dari DESIGN-SYSTEM.md]

Yang akan muncul di halaman:
  • [elemen 1 — contoh: tabel daftar produk]
  • [elemen 2 — contoh: tombol tambah & hapus]
  • [elemen 3 — contoh: search bar]

Sudah sesuai? Ketik "lanjut" atau kasih koreksi dulu.
```

---

### Langkah 3 — Generate Desain ke Pencil.dev

Setelah user konfirmasi, baru generate desain via Pencil MCP.

**Aturan desain:**
- Ikuti warna & font dari `DESIGN-SYSTEM.md`
- Mobile-first (tampilan HP dulu, baru desktop)
- Gunakan komponen yang sudah ada di Registry `DESIGN-SYSTEM.md`
- Jangan terlalu ramai — utamakan keterbacaan

Setelah generate:
```
✅ DESAIN SUDAH MUNCUL DI PENCIL.DEV!
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Silakan buka Pencil.dev dan lihat hasilnya.

Yang bisa kamu lakukan sekarang:
  🖱️  Geser elemen kalau posisinya kurang pas
  🎨  Ganti warna kalau belum sesuai selera
  ✏️  Hapus atau tambah bagian yang dirasa perlu
  📐  Ubah ukuran font atau jarak antar elemen

Kalau sudah oke → ketik "codingkan"
Kalau mau aku yang ubah → ceritakan perubahannya
```

---

### Langkah 4 — Codingkan Setelah Disetujui

Saat user bilang **"codingkan"** atau **"oke lanjut"**:

1. Baca ulang desain terbaru dari Pencil.dev via MCP
2. Generate file Blade + Livewire + Tailwind
3. Ikuti struktur folder project:
   - `resources/views/livewire/[nama].blade.php`
   - `app/Livewire/[Nama].php`
4. Tulis route ke `routes/web.php`
5. Update Registry di `DESIGN-SYSTEM.md`
6. Lapor ke user:

```
✅ SELESAI DIKODINGKAN!
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
File dibuat:
  📄 resources/views/livewire/[nama].blade.php
  📄 app/Livewire/[Nama].php
  🔗 Route: /[url] → sudah ditambahkan

Jalankan:
  php artisan serve
  npm run dev

Buka di browser: http://localhost:8000/[url]
```

---

## Penting Diingat

- **Pencil.dev hanya untuk desain visual** — logika & database tetap dikerjakan Claude via kode
- **Desain bisa diubah kapan saja** — ketik `/desain [nama]` lagi untuk revisi
- **Tidak wajib pakai Pencil** — kalau mau langsung koding tanpa desain dulu, pakai `/new-page` seperti biasa
- **Warna & font mengikuti DESIGN-SYSTEM.md** — tidak boleh asal-asalan agar tampilan konsisten
