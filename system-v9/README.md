# System-v9 — Bapenda Kaltim Gov Framework
> Framework AI development untuk portal publik Bapenda Provinsi Kalimantan Timur.
> Gabungan system-v8 (TALL Stack Universal) + .agent (Bapenda-specific).

---

## 🚀 CARA PAKAI

### Sesi Pertama (Proyek Baru)
```
1. Lampirkan CLAUDE.md + PROJECT.md ke Claude
2. Ketik: /init
3. Claude akan isi roadmap di PROJECT.md dan siapkan blueprint
```

### Sesi Lanjutan
```
1. Lampirkan CLAUDE.md + PROJECT.md + HANDOFF.md
2. Ketik: /next
3. Claude langsung lanjut dari titik terakhir
```

### Ada Error
```
1. Lampirkan file yang error
2. Ketik: /stuck [paste error message]
```

---

## 📁 STRUKTUR FILE

```
system-v9/
├── CLAUDE.md              ← 🧠 Panduan utama Claude (baca ini dulu)
├── PROJECT.md             ← 🏷️ Identitas proyek + progress (update tiap sesi)
├── DESIGN-SYSTEM.md       ← 🎨 Warna, font, komponen (otoritas visual tertinggi)
├── HANDOFF.md             ← 🤝 Jembatan Claude ↔ Gemini
├── README.md              ← 📖 Ini
│
├── tasks/
│   ├── progress.md        ← ✅ Checklist progress per fase
│   └── lessons.md         ← 📚 Error & keputusan teknis yang sudah dipelajari
│
├── .claude/commands/      ← ⚡ Detail instruksi slash commands
│   ├── init.md            ← /init — Blueprint sesi
│   ├── next.md            ← /next — Lanjut sesi
│   ├── new-page.md        ← /new-page — Buat halaman baru
│   ├── desain.md          ← /desain — Desain di Pencil.dev
│   ├── fix-ui.md          ← /fix-ui — Perbaiki tampilan
│   ├── stuck.md           ← /stuck — Debug error
│   ├── review.md          ← /review — Review kode
│   ├── handoff.md         ← /handoff — Pindah ke Gemini
│   ├── cek-policy.md      ← /cek-policy — Audit CMS policy ⭐ NEW
│   ├── deploy.md          ← /deploy — Checklist deploy
│   └── ...                ← (dan lainnya)
│
├── skills/
│   └── ui-ux-pro-max/     ← 🎨 Database pattern UI premium
│       ├── SKILL.md       ← Cara pakai skill ini
│       ├── data/          ← CSV database: colors, typography, patterns, dll
│       │   ├── colors.csv
│       │   ├── typography.csv
│       │   ├── styles.csv
│       │   ├── stacks/    ← Pattern per stack (html-tailwind, react, vue, dll)
│       │   └── ...
│       └── scripts/       ← Python scripts untuk query CSV
│
└── design-system/
    └── pages/             ← Override design per halaman (lebih spesifik dari DESIGN-SYSTEM.md)
        └── [nama-halaman].md
```

---

## 🎨 DESIGN TOKENS

| Token | Warna | Penggunaan |
|-------|-------|------------|
| `primary` | `#10C840` | CTA utama, highlight, link aktif |
| `primary-dark` | `#0A9E31` | Hover state primary |
| `danger` | `#D92D20` | Aksi hapus, error, peringatan penting |
| `secondary` | `#0891B2` | Info, elemen pendukung |
| `text-base` | `#0F172A` | Teks utama |
| `text-muted` | `#64748B` | Teks sekunder |

**Font:** Poppins (heading) + Open Sans (body)

> Semua token dari logo resmi Kaltim — warna hijau `#10C840` diekstrak langsung dari SVG logo.

---

## 🚨 RULES PALING PENTING

1. **JANGAN SENTUH** `app/Filament/`, `app/Models/`, `database/migrations/` — ini area backend CMS
2. **KERJA DI** `resources/views/portal/` dan `public/assets/portal/` saja
3. **WARNA** harus pakai token tailwind — tidak boleh hardcode hex
4. **WCAG** — contrast ratio minimal 4.5:1, focus states wajib visible
5. **Context7** — wajib digunakan setiap coding Laravel/Livewire/Alpine

---

## 📋 SLASH COMMANDS

| Command | Fungsi |
|---------|--------|
| `/init` | Mulai proyek baru — isi blueprint |
| `/next` | Lanjut sesi dari terakhir |
| `/new-page [nama]` | Buat halaman portal baru |
| `/desain [nama]` | Design di Pencil.dev dulu |
| `/fix-ui [file]` | Perbaiki tampilan |
| `/stuck [error]` | Debug error |
| `/review [file]` | Review + WCAG check |
| `/cek-policy` | Audit CMS compliance ⭐ |
| `/handoff` | Serah ke Gemini |
| `/deploy` | Checklist deploy Hostinger |
| `/tiru-design [url]` | Analisis & tiru referensi |
| `/export-docs` | Generate dokumen TA |

---

## 🔄 CHANGELOG

### v9 (2026-05-11) — Bapenda Focused
- ✅ Merge system-v8 + .agent menjadi satu framework
- ✅ Strict CMS Policy masuk sebagai bagian wajib CLAUDE.md
- ✅ Warna diupdate ke palette Bapenda (hijau logo Kaltim `#10C840`)
- ✅ ui-ux-pro-max skill terintegrasi
- ✅ Command baru `/cek-policy` untuk audit compliance
- ✅ DESIGN-SYSTEM.md dirombak total dengan warna & font Bapenda
- ✅ PROJECT.md pre-filled untuk Bapenda portal publik
- ✅ WCAG guidelines terintegrasi di seluruh sistem

### v8 (sebelumnya)
- Framework universal TALL Stack
- Pencil.dev integration
- Context7 integration
- 22+ slash commands
