# DESIGN-SYSTEM.md — Bapenda Kaltim Prov
> **Otoritas tertinggi untuk semua keputusan visual.**
> Claude & Gemini WAJIB baca sebelum membuat atau mengubah apapun yang visual.
> Konflik antara file ini dan file lain → FILE INI YANG MENANG.
> Override per-halaman: buat file di design-system/pages/[nama-halaman].md

---

**Project:** Bapenda Kaltimprov — Portal Publik
**Category:** Government / Public Service
**Standard:** WCAG 2.1 AA Compliant
**Stack:** TALL (Tailwind · Alpine · Laravel · Livewire)

---

## PALET WARNA

> Warna diekstrak dari logo resmi Kaltim. DILARANG hardcode hex — wajib pakai token.

### Warna Utama

| Role | Hex | Tailwind Token | Keterangan |
|------|-----|----------------|------------|
| Primary | #059669 | primary | Emerald Green (Brand Utama) |
| Primary Dark | #047857 | primary-dark | Hover state |
| Primary Light | #D1FAE5 | primary-light | Background subtle |
| Secondary | #DC2626 | secondary | Merah (Aksen/Secondary) |
| Secondary Dark | #B91C1C | secondary-dark | Hover secondary |
| Secondary Light | #FEE2E2 | secondary-light | Background secondary subtle |
| Navy | #0F2744 | navy | Navy (Elemen Gelap/Footer) |
| Danger | #D92D20 | danger | Merah warm — aksi penting |
| Danger Light | #FEE4E2 | danger-light | Background danger subtle |
| Info | #0891B2 | info | Cyan — pendukung |

### Warna Netral

| Role | Hex | Tailwind Token |
|------|-----|----------------|
| Background | #F8FAFC | bg-base |
| Surface | #FFFFFF | surface |
| Border | #E2E8F0 | border-base |
| Text Primary | #0F172A | text-base |
| Text Muted | #64748B | text-muted |
| Text Subtle | #94A3B8 | text-subtle |

### tailwind.config.js

```js
theme: {
  extend: {
    colors: {
      primary: {
        DEFAULT: '#059669',
        dark:    '#047857',
        light:   '#D1FAE5',
      },
      secondary: {
        DEFAULT: '#DC2626',
        dark:    '#B91C1C',
        light:   '#FEE2E2',
      },
      navy: {
        DEFAULT: '#0F2744',
        dark:    '#091A30',
        light:   '#1E3A5F',
      },
      danger: {
        DEFAULT: '#D92D20',
        dark:    '#B42318',
        light:   '#FEE4E2',
      },
      info: {
        DEFAULT: '#0891B2',
        light:   '#CFFAFE',
      },
      surface:      '#FFFFFF',
      'bg-base':    '#F8FAFC',
      'border-base':'#E2E8F0',
      'text-base':  '#0F172A',
      'text-muted': '#64748B',
      'text-subtle':'#94A3B8',
      warning:      '#F59E0B',
    },
    fontFamily: {
      heading: ['Plus Jakarta Sans', 'sans-serif'],
      body:    ['Inter', 'sans-serif'],
    }
  }
}
```

---

## TIPOGRAFI

```
Font Heading : Poppins (400, 500, 600, 700)
Font Body    : Open Sans (300, 400, 500, 600, 700)
```

**CSS Import:**
```css
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');
```

| Elemen | Class Tailwind |
|--------|----------------|
| H1 Hero | font-heading text-4xl md:text-5xl font-bold text-text-base |
| H2 Section | font-heading text-3xl font-semibold text-text-base |
| H3 Card Title | font-heading text-xl font-semibold text-text-base |
| Body | font-body text-base font-normal text-text-muted |
| Label | font-body text-sm font-medium text-text-base |
| Caption | font-body text-xs text-text-subtle |

---

## SPACING & LAYOUT

```
Border radius card   : rounded-xl (12px)
Border radius button : rounded-lg (8px)
Border radius input  : rounded-lg (8px)
Max width konten     : max-w-7xl mx-auto
Padding halaman      : px-4 sm:px-6 lg:px-8
Gap antar section    : py-16 md:py-24
```

---

## COMPONENT SPECS

### Button

```html
<!-- Primary -->
<button class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 cursor-pointer focus:outline-none focus:ring-4 focus:ring-primary/30">
  Label Aksi
</button>

<!-- Danger -->
<button class="bg-danger hover:bg-danger-dark text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 cursor-pointer focus:outline-none focus:ring-4 focus:ring-danger/30">
  Hapus
</button>

<!-- Outline Secondary -->
<button class="border-2 border-secondary text-secondary hover:bg-secondary hover:text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 cursor-pointer">
  Info
</button>

<!-- Dengan wire:loading -->
<button wire:click="aksi" wire:loading.attr="disabled"
  class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 cursor-pointer disabled:opacity-60">
  <span wire:loading.remove>Simpan</span>
  <span wire:loading>Menyimpan...</span>
</button>
```

### Card

```html
<div class="bg-surface rounded-xl shadow-sm border border-border-base p-6 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
  <!-- konten -->
</div>
```

### Input

```html
<div class="mb-4">
  <label class="block font-body text-sm font-medium text-text-base mb-1.5">Label</label>
  <input type="text"
    class="w-full border border-border-base rounded-lg px-4 py-3 font-body text-sm
           focus:outline-none focus:ring-4 focus:ring-primary/20 focus:border-primary
           placeholder:text-text-subtle bg-surface transition-all duration-200">
  @error('field') <p class="font-body text-xs text-danger mt-1.5">{{ $message }}</p> @enderror
</div>
```

### Modal (Alpine.js)

```html
<div x-data="{ open: false }">
  <button @click="open = true" class="bg-primary text-white px-4 py-2 rounded-lg cursor-pointer">
    Buka Modal
  </button>
  <div x-show="open" x-cloak
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4"
    @click.self="open = false">
    <div class="bg-surface rounded-xl shadow-xl w-full max-w-md p-6">
      <h2 class="font-heading text-lg font-semibold text-text-base mb-4">Judul Modal</h2>
      <div class="flex justify-end gap-3 mt-6">
        <button @click="open = false" class="border border-border-base px-4 py-2 rounded-lg cursor-pointer">Batal</button>
        <button class="bg-primary text-white px-4 py-2 rounded-lg cursor-pointer">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>
```

### Badge

```html
<!-- Aktif -->
<span class="px-2.5 py-1 rounded-full font-body text-xs font-semibold bg-primary-light text-primary">Aktif</span>
<!-- Warning -->
<span class="px-2.5 py-1 rounded-full font-body text-xs font-semibold bg-warning/10 text-warning">Pending</span>
<!-- Danger -->
<span class="px-2.5 py-1 rounded-full font-body text-xs font-semibold bg-danger-light text-danger">Nonaktif</span>
<!-- Info -->
<span class="px-2.5 py-1 rounded-full font-body text-xs font-semibold bg-secondary-light text-secondary">Info</span>
```

### Table

```html
<div class="overflow-x-auto rounded-xl border border-border-base">
  <table class="min-w-full divide-y divide-border-base font-body text-sm">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-3.5 text-left font-semibold text-text-base">Kolom</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-border-base bg-surface">
      <tr class="hover:bg-primary-light/30 transition-colors duration-150">
        <td class="px-4 py-3 text-text-muted">Data</td>
      </tr>
    </tbody>
  </table>
</div>
```

---

## ANTI-PATTERNS (JANGAN DIPAKAI)

- Emojis sebagai ikon — gunakan SVG Heroicons/Lucide
- Hardcode hex warna langsung di Blade/CSS
- Missing cursor:pointer di elemen clickable
- Kontras teks < 4.5:1
- Transisi instan — selalu pakai transition duration-150/200/300
- Focus state tidak visible
- AI purple/pink gradient
- Motion effect berlebihan

---

## PRE-DELIVERY CHECKLIST

- [ ] Semua warna pakai token (tidak ada hardcode hex)
- [ ] Font Poppins untuk heading, Open Sans untuk body
- [ ] Tidak ada emoji sebagai ikon (pakai SVG)
- [ ] cursor-pointer di semua elemen clickable
- [ ] Hover state dengan smooth transition (150-300ms)
- [ ] Kontras teks minimal 4.5:1
- [ ] Focus states visible
- [ ] Responsive: 375px → 768px → 1024px → 1440px
- [ ] Semantic HTML (main, nav, section, article)
- [ ] Registry Komponen/Halaman diupdate

---

## REGISTRY KOMPONEN

### Blade Components

| Nama | File | Deskripsi | Props |
|------|------|-----------|-------|
| x-portal.header | `resources/views/components/portal/header.blade.php` | Navigasi utama dengan dropdown dan mobile menu | `website`, `identity`, `menus` |
| x-portal.topbar | `resources/views/components/portal/topbar.blade.php` | Baris utilitas untuk bahasa, aksesibilitas, pencarian | `identity` |
| x-portal.footer | `resources/views/components/portal/footer.blade.php` | Footer dengan info identitas, sitemap, dan kontak | `website`, `identity`, `menus` |
| x-portal.floating-navbar | `resources/views/components/portal/floating-navbar.blade.php` | Navigasi melayang di mobile | `website`, `menus` |
| x-portal.floating-widgets | `resources/views/components/portal/floating-widgets.blade.php` | Widget disabilitas dan WhatsApp | (tidak ada) |

### Livewire Components

| Nama Class | File View | Deskripsi | Properties |
|---|---|---|---|
| (belum ada) | | | |

---

## REGISTRY HALAMAN

| Route Name | URL | File Blade | Livewire? | Status |
|---|---|---|---|---|
| portal.beranda | `/{website:slug}` | `resources/views/portal/beranda.blade.php` | - | Aktif |

---

## CATATAN KEPUTUSAN DESAIN

| Tanggal | Keputusan | Alasan |
|---|---|---|
| 2026-05-11 | Primary hijau #059669 | Emerald Green Premium — diganti dari #10C840 demi higher contrast & WCAG compliance |
| 2026-05-11 | Danger merah #D92D20 | Warm red, professional, WCAG compliant |
| 2026-05-11 | Secondary cyan #0891B2 | Harmonis dengan hijau, info elements |
| 2026-05-11 | Font Poppins + Open Sans | Modern, readable, government-appropriate |
