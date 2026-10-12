<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('sliders')->truncate();

        // Tambah slider umum (user_id null)
        Slider::create([
            'website_id' => 1,
            'caption' => 'Selamat Datang di Bapenda Kaltim',
            'description' => 'Informasi pajak dan layanan terbaik untuk Anda.',
            'link' => '#',
            'status' => 1,
            'is_pinned' => true,
            'user_id' => null,
        ]);
        Slider::create([
            'website_id' => 1,
            'caption' => 'Bayar Pajak Tepat Waktu',
            'description' => 'Ayo bayar pajak kendaraan Anda sebelum jatuh tempo.',
            'link' => '#',
            'status' => 1,
            'is_pinned' => false,
            'user_id' => null,
        ]);
    }
}
