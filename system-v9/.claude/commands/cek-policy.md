# /cek-policy — Audit CMS Policy Compliance

> Perintah ini mengaudit apakah ada kode yang menyentuh area restricted (Filament/Models/Migrations).
> Jalankan ini sebelum commit atau saat ragu apakah perubahan sudah aman.

---

## Langkah Claude saat `/cek-policy`:

1. **Scan file yang baru dibuat/diubah** di sesi ini
2. **Cek apakah ada sentuhan** ke area restricted:
   - `app/Filament/` — Resources, Pages, Widgets, Clusters
   - `resources/views/filament/` — Custom Filament views
   - `database/migrations/` — Schema database
   - `app/Models/` — Business logic & relations
3. **Report hasil scan:**

```
🔍 POLICY AUDIT REPORT
━━━━━━━━━━━━━━━━━━━━━
File diaudit: [daftar file yang diubah]

✅ AMAN:
  - [file] → [area portal/publik]

🚨 VIOLATION (jika ada):
  - [file] → menyentuh [area restricted]
  → Rekomendasi: [solusi alternatif]

STATUS: ✅ CLEAR / 🚨 ADA VIOLATION
```

4. Jika ada violation → **STOP**, jangan lanjut coding, berikan alternatif yang aman
5. Jika clear → konfirmasi ke user bahwa semua perubahan dalam area yang diizinkan

---

## Area yang DIIZINKAN (portal publik):

```
✅ resources/views/portal/
✅ resources/views/components/portal/
✅ resources/views/layouts/portal.blade.php
✅ public/assets/portal/
✅ app/Http/Controllers/ (controller portal publik)
✅ app/Livewire/ (komponen Livewire portal)
✅ routes/web.php (route portal — bukan route Filament)
✅ resources/css/ dan resources/js/ (assets portal)
✅ tailwind.config.js (konfigurasi styling)
```

## Area yang DILARANG (backend CMS):

```
🚨 app/Filament/
🚨 resources/views/filament/
🚨 database/migrations/
🚨 app/Models/ (kecuali READ-ONLY query yang sudah ada)
🚨 config/filament.php
🚨 routes/filament.php (jika ada)
```
