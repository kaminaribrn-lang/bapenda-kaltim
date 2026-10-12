# /tiru-design [url] — Tiru & Adaptasi Design ke Brand Proyek

> Gunakan command ini saat kamu punya referensi website yang ingin ditiru secara mendalam.
> Claude akan menganalisis SETIAP detail visual — layout, font, card, spacing, warna,
> komponen, hingga micro-interaction — lalu mengadaptasinya ke identitas proyek kamu.
> Hasil akhir: DESIGN-SYSTEM.md terupdate + kode komponen siap pakai.

---

## KAPAN DIGUNAKAN

- "Saya mau proyek saya tampilannya seperti website ini"
- "Tiru layout dashboard ini, tapi pakai warna brand saya"
- "Jadikan referensi utama untuk semua UI proyek ini"

---

## URUTAN EKSEKUSI

### Langkah 1 — Baca Konteks Proyek Dulu

Sebelum membuka URL apapun, baca:
- `PROJECT.md` → jenis proyek, target pengguna, palet warna yang sudah ada
- `DESIGN-SYSTEM.md` → apakah sudah ada design token sebelumnya?

Jika sudah ada design token di DESIGN-SYSTEM.md → nanti akan ada langkah konfirmasi
apakah akan di-replace atau digabung.

---

### Langkah 2 — Buka dan Bedah URL Secara Menyeluruh

Buka setiap URL yang diberikan. Analisis dengan sangat detail — jangan ada yang terlewat:

```
LAYER 1 — MAKRO (kesan pertama)
  □ Jenis layout: apakah sidebar? top-nav? full-width? centered?
  □ Visual hierarchy: apa yang mata lihat pertama, kedua, ketiga?
  □ Density: padat seperti dashboard? atau lega seperti landing page?
  □ "Rasa" keseluruhan: formal / playful / premium / minimal / techy / friendly

LAYER 2 — WARNA
  □ Background utama halaman
  □ Surface/card background (biasanya sedikit lebih terang/gelap dari background)
  □ Primary color (warna aksi utama — tombol, link, highlight)
  □ Secondary color (aksen pendukung)
  □ Text color: heading, body, muted/subtle
  □ Border color
  □ Status colors: success, warning, danger, info
  □ Apakah dark mode atau light mode?
  □ Apakah ada gradient? Di mana?

LAYER 3 — TIPOGRAFI
  □ Nama font heading (cek via Google Fonts atau font-face di source)
  □ Nama font body
  □ Apakah heading dan body pakai font berbeda?
  □ Ukuran relatif: heading besar dan bold? atau sedang dan medium?
  □ Line height: rapat atau lega?
  □ Letter spacing: normal atau ada tracking khusus?
  □ Apakah ada text transform (uppercase) di bagian tertentu?

LAYER 4 — SPACING & LAYOUT
  □ Padding card: rapat atau longgar?
  □ Gap antar elemen: konsisten berapa px estimasi?
  □ Border radius: sharp (0px)? subtle (4-6px)? rounded (8-12px)? pill (full)?
  □ Grid system: berapa kolom? ada breakpoint yang mencolok?
  □ Max-width container: narrow (720px)? medium (1024px)? wide (1280px+)?
  □ Sidebar lebar berapa estimasi?

LAYER 5 — KOMPONEN DETAIL
  □ NAVBAR: tinggi, background, apakah ada shadow/border-bottom?
           posisi logo, posisi nav items, ada avatar/dropdown user?
  □ CARD: shadow atau flat? border atau tidak? hover effect?
          struktur internal: ada header? footer? badge?
  □ BUTTON primary: warna, radius, padding, ada icon? ada hover animation?
  □ BUTTON secondary/outline: style berbeda atau sama?
  □ TABLE: ada striped rows? hover row? sticky header?
  □ FORM INPUT: border style, focus ring warna, label posisi (atas/dalam/float)?
  □ BADGE/CHIP: shape, warna per status
  □ SIDEBAR (jika ada): background berbeda? ada active state? ada icon?
  □ MODAL/DIALOG: ada backdrop blur? border radius berapa?
  □ ALERT/TOAST: posisi, style

LAYER 6 — MICRO-INTERACTION
  □ Hover pada card: lift (shadow)? color change? border appear?
  □ Hover pada button: darken? lighten? scale?
  □ Transisi halaman: ada fade? slide?
  □ Loading state: skeleton? spinner? pulse?
  □ Animasi masuk elemen: fade-in? slide-up?
  □ Active nav item: background? left border? underline?
```

---

### Langkah 3 — Tampilkan Hasil Analisis Lengkap

```
╔══════════════════════════════════════════════════════════════╗
  BEDAH DESIGN — [nama/domain website]
  Dianalisis untuk proyek: [nama dari PROJECT.md]
╚══════════════════════════════════════════════════════════════╝

🌐 KESAN PERTAMA
  Layout     : [deskripsi]
  Density    : [deskripsi]
  Rasa       : [deskripsi]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🎨 SISTEM WARNA
  Background : [hex] ████
  Surface    : [hex] ████
  Primary    : [hex] ████  → [nama warna]
  Secondary  : [hex] ████  → [nama warna]
  Text utama : [hex] ████
  Text muted : [hex] ████
  Border     : [hex] ████
  Success    : [hex] ████
  Warning    : [hex] ████
  Danger     : [hex] ████
  Mode       : [Light / Dark / Keduanya]
  Gradient   : [ada di mana / tidak ada]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🔤 TIPOGRAFI
  Font heading : [nama] — [weight] — [karakteristik]
  Font body    : [nama] — [weight] — [karakteristik]
  Heading size : [estimasi — contoh: "Besar, ~2xl-3xl, font-bold"]
  Body size    : [estimasi — contoh: "Normal, ~sm-base, font-normal"]
  Line height  : [rapat / normal / lega]
  Kekhususan   : [contoh: "Label uppercase di section title"]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📐 SPACING & LAYOUT
  Border radius: [contoh: "Konsisten rounded-lg (~8px) di semua komponen"]
  Card padding : [contoh: "Lega — estimasi p-6"]
  Gap elemen   : [contoh: "gap-4 antar card, gap-2 antar item list"]
  Container    : [contoh: "max-w-7xl, centered, px-6"]
  Grid         : [contoh: "3 kolom di desktop, 1 kolom di mobile"]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🧩 KOMPONEN — DETAIL

NAVBAR
  [deskripsi detail]

CARD
  [deskripsi detail + pola shadow/border/hover]

BUTTON
  Primary : [deskripsi]
  Secondary: [deskripsi]

TABLE
  [deskripsi]

FORM INPUT
  [deskripsi]

SIDEBAR (jika ada)
  [deskripsi]

BADGE/STATUS
  [deskripsi]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

✨ MICRO-INTERACTION
  Card hover  : [deskripsi]
  Button hover: [deskripsi]
  Loading     : [deskripsi]
  Animasi     : [deskripsi]
  Nav active  : [deskripsi]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

💡 3 HAL PALING MENONJOL
  1. [hal pertama yang paling memorable]
  2. [hal kedua]
  3. [hal ketiga]

╚══════════════════════════════════════════════════════════════╝
```

---

### Langkah 4 — Adaptasi ke Brand Proyek

Setelah analisis, jangan langsung copy mentah. Lakukan adaptasi:

```
PRINSIP ADAPTASI:
  Struktur & pola    → tiru sedekat mungkin
  Warna              → sesuaikan dengan palet dari PROJECT.md
                       jika PROJECT.md belum punya palet → gunakan warna referensi
  Font               → tiru nama font-nya jika tersedia di Google Fonts
                       jika tidak → pilih alternatif dengan karakter serupa
  Spacing & radius   → tiru persis
  Komponen pattern   → tiru struktur, sesuaikan warna/konten
  Micro-interaction  → tiru polanya, implementasi dengan Tailwind + Alpine.js
```

Tampilkan hasil adaptasi:

```
╔══════════════════════════════════════════════════════════════╗
  ADAPTASI KE PROYEK: [nama proyek]
╚══════════════════════════════════════════════════════════════╝

🎨 PALET ADAPTASI
  [warna referensi] → [warna adaptasi] — [alasan]
  Contoh: #3B82F6 (biru referensi) → #16A34A (hijau brand proyek) karena kasir

🔤 FONT ADAPTASI
  Heading: [font referensi] → [font yang dipakai] — [tersedia/alternatif]
  Body   : [font referensi] → [font yang dipakai]

📐 YANG DITIRU PERSIS
  - Border radius: [nilai]
  - Spacing pattern: [nilai]
  - Shadow style: [nilai]
  - Layout structure: [deskripsi]

✏️ YANG DISESUAIKAN
  - [elemen]: [referensi] → [adaptasi] karena [alasan]

╚══════════════════════════════════════════════════════════════╝

Apakah adaptasi ini sudah sesuai ekspektasi?
Ada bagian yang ingin disesuaikan berbeda?
```

---

### Langkah 5 — Konfirmasi Sebelum Simpan

Jika DESIGN-SYSTEM.md sudah berisi design token sebelumnya, tanya:

```
⚠️ DESIGN-SYSTEM.md sudah berisi design token sebelumnya.

Pilih:
  A) Replace semua — pakai design dari referensi baru ini
  B) Gabungkan — ambil elemen tertentu saja, sisanya tetap
  C) Batal — jangan update DESIGN-SYSTEM.md

Jawab A, B, atau C:
```

---

### Langkah 6 — Update DESIGN-SYSTEM.md

Setelah konfirmasi, update DESIGN-SYSTEM.md dengan format berikut:

**A. Update bagian PALET WARNA:**
```css
/* Diadaptasi dari: [nama referensi] — [URL] */
/* Tanggal: [tanggal] */

--color-background : [hex];
--color-surface    : [hex];
--color-primary    : [hex];
--color-secondary  : [hex];
--color-text       : [hex];
--color-text-muted : [hex];
--color-border     : [hex];
--color-success    : [hex];
--color-warning    : [hex];
--color-danger     : [hex];
```

**B. Update bagian TIPOGRAFI:**
```
Font heading : [nama] — import: [Google Fonts URL]
Font body    : [nama] — import: [Google Fonts URL]
```

**C. Update bagian SPACING & RADIUS:**
```
Border radius default : [nilai Tailwind]
Card padding          : [nilai Tailwind]
Gap standar           : [nilai Tailwind]
Container max-width   : [nilai Tailwind]
```

**D. Tambahkan bagian KOMPONEN PATTERN:**
```
Pola card    : [deskripsi + class Tailwind]
Pola button  : [deskripsi + class Tailwind]
Pola navbar  : [deskripsi + class Tailwind]
Pola input   : [deskripsi + class Tailwind]
Hover card   : [class Tailwind untuk hover effect]
```

**E. Tambahkan entry CATATAN KEPUTUSAN DESAIN:**
```
| [tanggal] | Referensi: [nama site] | Diadaptasi via /tiru-design |
```

---

### Langkah 7 — Tawarkan Implementasi Langsung

```
✅ DESIGN-SYSTEM.md diupdate dari referensi [nama site]

Design DNA baru aktif:
  Warna  : [ringkasan palet]
  Font   : [ringkasan font]
  Radius : [nilai]
  Shadow : [nilai]

Mau langsung implementasi? Pilih yang mau dibuat dulu:

  A) Navbar — komponen navigasi utama
  B) Card dashboard — kartu statistik / ringkasan
  C) Layout halaman utama — skeleton struktur
  D) Komponen form — input, button, label
  E) Semua sekaligus — buat starter template lengkap

Atau sebutkan komponen spesifik yang paling dibutuhkan proyek ini.
```

---

## CATATAN PENTING

- **Analisis visual, bukan copy kode** — copyright tetap berlaku
- **URL tidak bisa diakses** (login/paywall) → minta user kirim screenshot
- **Font proprietary** (bukan Google Fonts) → pilihkan alternatif dengan karakter serupa
- **Beberapa URL sekaligus** → analisis satu per satu dulu, lalu sintesis terbaik dari semua
- **Gunakan Context7** saat implementasi Tailwind untuk pastikan class yang dipakai valid di versi yang diinstall
- Hasil adalah **interpretasi & adaptasi**, bukan reproduksi identik
