<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Infografis;
use Illuminate\Support\Facades\DB;

class InfografisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('infografis')->truncate();

        Infografis::create([
            'website_id' => 1,
            'caption' => 'Infografis Pajak Daerah',
            'description' => 'Statistik dan info visual pajak daerah terkini.',
            'link' => '#',
            'status' => 1,
            'is_pinned' => true,
            'user_id' => null,
        ]);
        Infografis::create([
            'website_id' => 1,
            'caption' => 'Cara Bayar Pajak Online',
            'description' => 'Panduan visual pembayaran pajak kendaraan secara daring.',
            'link' => '#',
            'status' => 1,
            'is_pinned' => false,
            'user_id' => null,
        ]);
    }
}
