# Protokol Konflik — Claude vs Gemini

> File ini dibaca oleh KEDUANYA — Claude dan Gemini.
> Ketika ada ketidaksetujuan soal implementasi, ikuti protokol ini.
> Tujuan: konsistensi proyek lebih penting dari opini masing-masing AI.

---

## PRINSIP DASAR

```
HANDOFF.md  →  otoritas tertinggi (blueprint dikunci)
DESIGN-SYSTEM.md  →  otoritas tertinggi untuk desain
PROJECT.md  →  referensi keputusan user
Kode yang sudah jalan  →  tidak boleh diubah tanpa alasan kuat
```

**Aturan emas:** Jika sudah ada keputusan yang tercatat di salah satu file di atas,
AI yang datang belakangan WAJIB ikuti — bukan override.

---

## TABEL KONFLIK & SIAPA YANG MENANG

| Situasi | Yang Menang | Alasan |
|---|---|---|
| Claude buat komponen X dengan cara A, Gemini mau ubah ke cara B | **Claude** | Kode sudah jalan, jangan sentuh |
| Gemini buat desain dengan warna X, Claude mau pakai warna berbeda | **DESIGN-SYSTEM.md** | Cek file dulu, ikuti yang tercatat |
| Claude dan Gemini beda pendapat soal struktur tabel DB | **Blueprint di HANDOFF.md** | Sudah dikunci saat /init |
| Keduanya punya argumen valid, tidak ada yang tercatat | **Tanya user** | Jangan putuskan sendiri |
| AI baru masuk, tidak suka keputusan lama | **Keputusan lama** | Konsistensi > preferensi AI |

---

## KONDISI YANG BOLEH OVERRIDE

AI boleh mengusulkan perubahan dari keputusan lama HANYA jika:

1. **Ada bug nyata** — bukan "saya pikir ini lebih baik", tapi ada error yang terbukti
2. **Ada bottleneck performa** — dengan data konkret, bukan asumsi
3. **User meminta eksplisit** — user yang minta, bukan AI yang inisiatif

Jika salah satu kondisi di atas terpenuhi, format pengajuan wajib:

```
⚠️ USULAN OVERRIDE

Keputusan lama : [apa yang ada sekarang]
Alasan override : [bug / performa / permintaan user]
Bukti           : [error message / angka / kutipan user]
Usulan baru     : [apa yang diusulkan]
Dampak          : [file apa yang berubah, fitur apa yang terpengaruh]

Setuju lanjut?
```

Tunggu konfirmasi user sebelum mengubah apapun.

---

## ZONA TANGGUNG JAWAB (jangan masuk zona lain tanpa diminta)

| Zona | Pemilik | Yang lain boleh... |
|---|---|---|
| Logic PHP, Livewire, Database | **Claude** | Gemini boleh baca, tidak boleh ubah |
| Tampilan UI, warna, layout, animasi | **Gemini** | Claude boleh baca, tidak boleh ubah |
| Blade template (struktur HTML) | **Berdua** | Koordinasi via HANDOFF.md |
| Keputusan arsitektur baru | **User** | Keduanya hanya eksekutor |

---

## CARA MENCATAT KONFLIK YANG SUDAH DISELESAIKAN

Setiap konflik yang selesai wajib dicatat di `tasks/lessons.md` dengan format:

```markdown
## [Tanggal] — Konflik: [topik singkat]
**Pihak**: Claude vs Gemini
**Masalah**: [apa yang diperdebatkan]
**Keputusan**: [apa yang dipilih]
**Alasan**: [kenapa]
**Dicatat oleh**: [siapa yang resolve]
```

---

## CHECKLIST SEBELUM MENGUBAH KODE YANG SUDAH ADA

Sebelum AI manapun mengubah kode yang sudah ditulis AI lain:

- [ ] Sudah baca HANDOFF.md bagian LOG FASE SELESAI?
- [ ] Perubahan ini diminta user, atau inisiatif sendiri?
- [ ] Ada keputusan yang sudah dikunci yang bertentangan?
- [ ] Sudah tampilkan format USULAN OVERRIDE ke user?
- [ ] User sudah konfirmasi?

Jika ada satu saja yang belum → STOP, tanya user dulu.

---

## 💡 ADVISOR CHANNEL — Saran Tanpa Harus Ada Bug

> AI boleh dan HARUS kasih saran improvement kapanpun melihat sesuatu yang bisa lebih baik.
> Ini bukan override — ini jalur komunikasi yang jelas antara AI dan user.
> Saran tidak berarti langsung dieksekusi. User yang memutuskan.

### Kapan Menggunakan Advisor Channel

```
✅ Melihat pola kode yang bisa lebih efisien
✅ Ada pendekatan yang lebih aman untuk keamanan data
✅ Struktur yang sekarang akan menyulitkan di fase berikutnya
✅ Ada library/teknik yang lebih cocok untuk kebutuhan ini
✅ Desain yang bisa lebih baik dari referensi Design DNA
✅ Potensi masalah performa di masa depan
```

### Format Wajib — Gunakan Selalu

```
💡 SARAN IMPROVEMENT
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Yang ada sekarang : [kondisi saat ini]
Saran             : [apa yang diusulkan]
Manfaat           : [kenapa lebih baik]
Risiko jika skip  : [konsekuensi jika tidak diubah — atau "-"]
Effort            : [Kecil / Sedang / Besar]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Mau saya implementasikan? (ya / nanti / skip)
```

### Aturan Advisor Channel

```
✅ Kasih saran kapanpun relevan — jangan tahan
✅ Satu saran per respons — jangan tumpuk banyak sekaligus
✅ Selalu pakai format di atas — konsisten
✅ Tunggu jawaban user sebelum lanjut coding
❌ Jangan langsung eksekusi tanpa konfirmasi
❌ Jangan kasih saran yang sama berulang kali jika user sudah skip
❌ Jangan gunakan saran sebagai alasan untuk override keputusan lama
```

### Respon User dan Tindak Lanjut

```
User jawab "ya"    → implementasikan, catat di lessons.md sebagai keputusan teknis
User jawab "nanti" → catat di tasks/progress.md bagian antrian, lanjut coding
User jawab "skip"  → catat di lessons.md bahwa saran ini sudah dipertimbangkan
                     dan ditolak — jangan tanya lagi
```
