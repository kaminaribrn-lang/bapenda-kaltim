# tasks/lessons.md — Memori Kolektif Proyek
> Dua fungsi: (1) error yang pernah terjadi + solusinya, (2) keputusan teknis yang sudah dibuat.
> Claude & Gemini WAJIB baca sebelum debug atau membuat keputusan teknis baru.
> Jangan hapus entri lama — ini memori permanen proyek.

---

## 📖 CARA BACA CEPAT
- Cari dengan tag: `#livewire` `#blade` `#alpine` `#query` `#auth` `#vite` `#upload` `#keputusan`
- Error terbaru di **paling atas**
- Sebelum debug → cari dulu di sini, mungkin sudah pernah terjadi
- Sebelum buat keputusan teknis baru → cek dulu, mungkin sudah ada keputusan sebelumnya

---

## 🏗️ KEPUTUSAN TEKNIS

> Setiap keputusan arsitektur penting dicatat di sini.
> Tujuan: AI tidak reinvent solusi berbeda untuk masalah yang sama.

### Template keputusan (salin saat menambah):
```markdown
---
## [YYYY-MM-DD] — Keputusan: [topik singkat]
**Tag**: #keputusan #[area]
**Konteks**: [situasi apa yang membutuhkan keputusan ini]
**Pilihan yang dipertimbangkan**:
  - Opsi A: [deskripsi] → [kelebihan / kekurangan]
  - Opsi B: [deskripsi] → [kelebihan / kekurangan]
**Keputusan**: [opsi yang dipilih]
**Alasan**: [kenapa opsi ini yang dipilih]
**Dampak**: [file/komponen yang terpengaruh]
**Jangan diubah kecuali**: [kondisi yang membolehkan override]
---
```

_(Kosong — terisi saat keputusan teknis pertama dibuat)_

---

## 🐛 ERROR & SOLUSI

> Setiap error yang berhasil diselesaikan dicatat di sini via `/stuck`.

### Template error (salin saat menambah):
```markdown
---
## [YYYY-MM-DD] — [Judul Error Singkat]
**Status**: ✅ Selesai
**Tag**: #[tag1] #[tag2]
- **Konteks**: [di komponen/fitur/halaman apa]
- **Gejala**: [pesan error atau perilaku yang terlihat]
- **Penyebab**: [root cause sebenarnya]
- **Solusi**:
  ```php/html/js
  [kode solusinya]
  ```
- **Pencegahan**: [apa yang harus selalu dilakukan/dihindari]
---
```

_(Kosong — terisi saat error pertama diselesaikan)_

---

## 📚 PRE-LOADED KNOWLEDGE — Pola Error Umum TALL Stack

### #livewire — Property tidak tersimpan
**Penyebab**: Lupa tambahkan ke `$fillable` di Model
**Solusi**: Cek `protected $fillable`

### #livewire — CSRF Token Mismatch
**Penyebab**: Form Livewire tidak dibungkus tag `<form>`
**Solusi**: Selalu pakai `<form wire:submit="...">`

### #livewire — Component not found
**Penyebab**: Namespace + nama class + nama file tidak konsisten
**Solusi**: Jalankan `php artisan livewire:discover`

### #query — Data relasi tidak muncul (N+1)
**Penyebab**: Tidak menggunakan `with()` saat query
**Solusi**: `Model::with(['relasi1', 'relasi2'])->get()`

### #vite — Asset 404 setelah deploy
**Penyebab**: Lupa `npm run build` atau pakai URL hardcode
**Solusi**: Gunakan `@vite(...)` helper, jalankan `npm run build`

### #alpine — x-data tidak reaktif ke Livewire
**Penyebab**: Alpine dan Livewire kelola state terpisah
**Solusi**: Gunakan `$wire.entangle('propertyName')`

### #auth — Redirect setelah login salah halaman
**Penyebab**: `HOME` constant di `RouteServiceProvider` belum diubah
**Solusi**: Ubah `public const HOME = '/dashboard'`

### #livewire — Property tidak reaktif di child component (Livewire v3)
**Penyebab**: Lupa tambahkan `#[Reactive]` attribute pada property di child component
**Solusi**: Tambahkan `#[Reactive]` di atas property: `#[Reactive] public $data;`

### #livewire — wire:navigate konflik dengan Alpine x-data
**Penyebab**: `wire:navigate` melakukan SPA-like navigation, Alpine `x-data` tidak re-init
**Solusi**: Gunakan `@persist` directive atau `x-init` yang idempotent, atau pakai `@livewireScriptConfig(['navigate' => true])`

### #livewire — Form Object validation tidak jalan
**Penyebab**: Menggunakan `$this->validate()` padahal rules ada di Form Object
**Solusi**: Panggil `$this->form->validate()` bukan `$this->validate()`. Rules didefinisikan di class Form yang extend `Livewire\Form`

### #alpine — x-cloak tidak berfungsi (elemen masih flicker)
**Penyebab**: CSS `[x-cloak] { display: none !important; }` belum ditambahkan
**Solusi**: Tambahkan di `resources/css/app.css`: `[x-cloak] { display: none !important; }`
