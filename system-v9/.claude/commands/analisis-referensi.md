# /analisis-referensi [URL] — Ekstrak Design DNA dari Referensi Visual

> Gunakan command ini saat kamu punya referensi visual yang ingin dijadikan acuan desain.
> Bisa kirim satu URL atau beberapa sekaligus.
> Hasil disimpan permanen ke DESIGN-SYSTEM.md.

---

## KAPAN DIGUNAKAN

- Awal proyek: "Saya suka tampilan website X, jadikan acuan"
- Tengah proyek: "Saya mau komponen card seperti di website Y"
- Redesign: "Client minta tampilan seperti Z"

---

## URUTAN EKSEKUSI

### Langkah 1 — Buka dan Analisis URL

Buka setiap URL yang diberikan. Analisis secara menyeluruh:

```
Yang dianalisis:
  □ Palet warna dominan (primary, secondary, accent, background, surface)
  □ Tipografi — font yang dipakai, ukuran heading vs body, weight
  □ Spacing & layout — seberapa padat, grid system, whitespace
  □ Komponen unik — cara mereka buat card, button, navbar, table
  □ Micro-interaction — hover, loading, animasi
  □ "Rasa" keseluruhan — formal/playful/premium/minimal
  □ Hal yang paling menonjol dan memorable
```

### Langkah 2 — Tampilkan Hasil Analisis

```
══════════════════════════════════════════════════════
  ANALISIS VISUAL — [nama/domain website]
══════════════════════════════════════════════════════

🎨 PALET WARNA
  Primary   : [hex] — [nama warna]
  Secondary : [hex] — [nama warna]
  Accent    : [hex] — [nama warna]
  Background: [hex]
  Surface   : [hex]

🔤 TIPOGRAFI
  Font      : [nama font]
  Style     : [deskripsi — contoh: "Inter, berat di heading, ringan di body"]

📐 LAYOUT & SPACING
  Karakter  : [deskripsi — contoh: "Dense tapi bernapas, banyak whitespace vertikal"]
  Grid      : [contoh: "Asimetris — sidebar 1/4, konten 3/4"]

✨ MICRO-INTERACTION
  [deskripsi animasi dan hover state yang menarik]

💡 YANG PALING MENONJOL
  [2-3 hal yang paling memorable dari site ini]

🎭 "RASA" KESELURUHAN
  [deskripsi singkat — contoh: "Premium tapi approachable, seperti produk SaaS kelas atas"]

══════════════════════════════════════════════════════
```

### Langkah 3 — Tanya Bagian yang Disukai

```
Dari analisis di atas, bagian mana yang paling kamu suka?
(Bisa lebih dari satu, atau sebutkan "semua")

Contoh jawaban:
- "Suka palетnya tapi tidak suka layout-nya"
- "Suka micro-interaction-nya"
- "Semua — jadikan acuan utama"
```

### Langkah 4 — Jika Ada Beberapa URL

Kalau user kirim beberapa URL, setelah analisis semua tampilkan:

```
══════════════════════════════════════════════════════
  SINTESIS — Menggabungkan [N] Referensi
══════════════════════════════════════════════════════

Dari [site A] → ambil: [elemen yang diambil]
Dari [site B] → ambil: [elemen yang diambil]
Dari [site C] → ambil: [elemen yang diambil]

Hasil gabungan:
  Palet    : [gabungan warna terbaik]
  Tipografi: [pilihan font]
  Layout   : [pendekatan layout]
  Feel     : [deskripsi rasa keseluruhan]

Apakah sintesis ini sudah sesuai ekspektasi?
══════════════════════════════════════════════════════
```

### Langkah 5 — Simpan ke DESIGN-SYSTEM.md

Setelah user konfirmasi, update dua bagian di DESIGN-SYSTEM.md:

**A. Update bagian 🎨 PALET WARNA** dengan warna yang diekstrak.

**B. Tambahkan entry di bagian 📝 CATATAN KEPUTUSAN DESAIN:**

```markdown
| [tanggal] | Referensi visual: [nama site] | Dipilih karena [alasan singkat] |
```

**C. Tambahkan ke GEMINI.md bagian DESIGN DNA — Referensi Visual:**

```
Referensi    : [nama site] — [URL]
Diambil      : [elemen yang diambil]
```

### Langkah 6 — Konfirmasi

```
✅ Design DNA diupdate dari referensi [nama site]
✅ DESIGN-SYSTEM.md diupdate
✅ GEMINI.md diupdate

Mulai sekarang semua komponen UI yang dibuat
akan mengikuti referensi visual ini.

Mau langsung test dengan membuat satu komponen
menggunakan Design DNA baru ini?
```

---

## CATATAN PENTING

- Analisis visual, jangan copy kode — copyright tetap berlaku
- Kalau site butuh login untuk lihat konten → minta user screenshot
- Kalau URL tidak bisa diakses → minta user deskripsi atau screenshot
- Hasil analisis adalah interpretasi, bukan reproduksi
