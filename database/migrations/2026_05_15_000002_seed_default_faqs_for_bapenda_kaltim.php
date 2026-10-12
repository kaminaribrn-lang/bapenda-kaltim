<?php

use App\Models\Website;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function defaultFaqs(): array
    {
        return [
            [
                'question' => 'Apa layanan utama Bapenda Provinsi Kalimantan Timur?',
                'answer' => '<p>Bapenda Provinsi Kalimantan Timur melayani pengelolaan pendapatan daerah provinsi, termasuk pelayanan informasi perpajakan daerah, fasilitasi pembayaran pajak daerah provinsi, dukungan layanan Samsat, serta penyediaan kanal informasi digital untuk masyarakat dan wajib pajak.</p>',
                'sort_order' => 1,
                'is_featured' => true,
                'status' => true,
            ],
            [
                'question' => 'Jenis pajak daerah provinsi apa saja yang umumnya dilayani?',
                'answer' => '<p>Layanan Bapenda provinsi umumnya berkaitan dengan pajak yang menjadi kewenangan pemerintah provinsi sesuai ketentuan yang berlaku, seperti Pajak Kendaraan Bermotor, Bea Balik Nama Kendaraan Bermotor, Pajak Bahan Bakar Kendaraan Bermotor, dan objek lain yang ditetapkan dalam regulasi daerah terbaru.</p><p>Untuk rincian jenis layanan yang aktif, masyarakat disarankan melihat pengumuman resmi pada website atau kanal informasi Bapenda Kaltim.</p>',
                'sort_order' => 2,
                'is_featured' => true,
                'status' => true,
            ],
            [
                'question' => 'Bagaimana cara mengecek informasi pajak kendaraan di Bapenda Kaltim?',
                'answer' => '<p>Pengecekan informasi pajak kendaraan dapat dilakukan melalui kanal digital yang disediakan Bapenda Kaltim, termasuk aplikasi atau tautan layanan yang terhubung dari portal resmi.</p><p>Siapkan data dasar kendaraan seperti nomor polisi dan informasi identitas kendaraan agar proses pengecekan lebih cepat dan akurat.</p>',
                'sort_order' => 3,
                'is_featured' => true,
                'status' => true,
            ],
            [
                'question' => 'Apa syarat umum pembayaran PKB tahunan?',
                'answer' => '<p>Secara umum, masyarakat perlu menyiapkan STNK, KTP pemilik kendaraan, dan dokumen pendukung lain sesuai mekanisme layanan yang dipilih. Apabila pembayaran dilakukan melalui kanal digital atau gerai tertentu, persyaratan teknis dapat menyesuaikan kebijakan layanan setempat.</p><p>Pastikan data kendaraan dan identitas pemilik sesuai agar proses pembayaran tidak terhambat.</p>',
                'sort_order' => 4,
                'is_featured' => false,
                'status' => true,
            ],
            [
                'question' => 'Apa syarat umum untuk proses balik nama kendaraan bermotor?',
                'answer' => '<p>Balik nama kendaraan umumnya memerlukan dokumen kendaraan, identitas pemilik baru, bukti perolehan atau transaksi kendaraan, serta dokumen lain sesuai verifikasi petugas. Pada praktiknya, persyaratan dapat berbeda tergantung jenis kendaraan, kondisi berkas, dan status registrasi kendaraan.</p><p>Untuk memastikan kelengkapan, cek informasi terbaru melalui kanal resmi Bapenda Kaltim atau hubungi unit pelayanan terkait sebelum datang.</p>',
                'sort_order' => 5,
                'is_featured' => false,
                'status' => true,
            ],
            [
                'question' => 'Apakah pembayaran pajak bisa dilakukan secara online?',
                'answer' => '<p>Bapenda Kaltim mendukung transformasi layanan digital. Untuk beberapa jenis layanan, pembayaran atau pengecekan dapat dilakukan melalui kanal elektronik yang telah bekerja sama dengan pemerintah daerah, Samsat, atau mitra pembayaran resmi.</p><p>Ketersediaan kanal online dapat berubah mengikuti kebijakan layanan, sehingga masyarakat sebaiknya menggunakan tautan yang tercantum pada portal resmi.</p>',
                'sort_order' => 6,
                'is_featured' => true,
                'status' => true,
            ],
            [
                'question' => 'Bagaimana jika STNK hilang atau data kendaraan perlu klarifikasi?',
                'answer' => '<p>Jika STNK hilang, data kendaraan tidak sesuai, atau ada kendala administrasi lainnya, masyarakat perlu datang ke unit layanan terkait untuk proses verifikasi lebih lanjut. Petugas akan mengarahkan dokumen tambahan yang diperlukan sesuai jenis permasalahan.</p><p>Simpan seluruh dokumen pendukung yang dimiliki agar proses klarifikasi dapat dilakukan lebih efisien.</p>',
                'sort_order' => 7,
                'is_featured' => false,
                'status' => true,
            ],
            [
                'question' => 'Bagaimana cara memperoleh informasi program pemutihan atau keringanan pajak?',
                'answer' => '<p>Informasi program pemutihan, relaksasi, atau kebijakan insentif pajak diumumkan secara resmi melalui website, media sosial resmi, dan kanal komunikasi Bapenda Kaltim. Program seperti ini bersifat periodik dan mengikuti keputusan pemerintah daerah.</p><p>Masyarakat disarankan tidak mengandalkan informasi dari sumber tidak resmi sebelum melakukan pembayaran.</p>',
                'sort_order' => 8,
                'is_featured' => true,
                'status' => true,
            ],
            [
                'question' => 'Bagaimana cara menyampaikan pengaduan, saran, atau permohonan informasi?',
                'answer' => '<p>Pengaduan, saran, atau permohonan informasi dapat disampaikan melalui kanal kontak resmi yang tersedia pada website Bapenda Kaltim, termasuk formulir pengaduan, layanan PPID, atau kontak unit pelayanan terkait.</p><p>Sampaikan data dan kronologi secara jelas agar tindak lanjut dapat dilakukan lebih cepat.</p>',
                'sort_order' => 9,
                'is_featured' => false,
                'status' => true,
            ],
        ];
    }

    public function up(): void
    {
        if (! Schema::hasTable('faqs') || ! Schema::hasTable('websites')) {
            return;
        }

        $now = now();
        $faqs = $this->defaultFaqs();

        Website::query()->select('id')->chunkById(100, function ($websites) use ($faqs, $now) {
            foreach ($websites as $website) {
                foreach ($faqs as $faq) {
                    DB::table('faqs')->updateOrInsert(
                        [
                            'website_id' => $website->id,
                            'question' => $faq['question'],
                        ],
                        [
                            'answer' => $faq['answer'],
                            'sort_order' => $faq['sort_order'],
                            'is_featured' => $faq['is_featured'],
                            'status' => $faq['status'],
                            'updated_at' => $now,
                            'created_at' => $now,
                        ]
                    );
                }
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('faqs')) {
            return;
        }

        $questions = array_column($this->defaultFaqs(), 'question');

        DB::table('faqs')
            ->whereIn('question', $questions)
            ->delete();
    }
};
