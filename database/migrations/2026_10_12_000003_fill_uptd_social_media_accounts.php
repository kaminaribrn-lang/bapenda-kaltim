<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Akun media sosial resmi UPTD, diambil dari arsip sub-situs lama masing-masing
     * (bapenda.kaltimprov.go.id/uptd...). Hanya mengisi kolom yang masih kosong.
     */
    private array $accounts = [
        'samarinda' => [
            'instagram' => 'https://www.instagram.com/uptdpprd.samarinda',
            'facebook' => 'https://www.facebook.com/uptdpprd.samarinda',
            'youtube' => 'https://www.youtube.com/channel/UCgK1Dx4kmQPkNax3pVH1fVg',
        ],
        'balikpapan' => [
            'instagram' => 'https://www.instagram.com/uptdpprdbalikpapan',
        ],
        'kutim' => [
            'instagram' => 'https://www.instagram.com/bapenda.uptdpprdkutim',
            'facebook' => 'https://www.facebook.com/share/1KkVYZ5NoG/',
        ],
        'kutai-timur' => [
            'instagram' => 'https://www.instagram.com/bapenda.uptdpprdkutim',
            'facebook' => 'https://www.facebook.com/share/1KkVYZ5NoG/',
        ],
        'berau' => [
            'instagram' => 'https://www.instagram.com/uptdpprdbapendaberau',
            'facebook' => 'https://www.facebook.com/uptdpprd.wilayahberau',
        ],
        'paser' => [
            'instagram' => 'https://www.instagram.com/uptdpprdpaser',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->accounts as $slug => $accounts) {
            $websiteId = DB::table('websites')->where('slug', $slug)->value('id');

            if (! $websiteId) {
                continue;
            }

            foreach ($accounts as $column => $url) {
                DB::table('website_identities')
                    ->where('website_id', $websiteId)
                    ->where(fn ($query) => $query->whereNull($column)->orWhere($column, ''))
                    ->update([$column => $url, 'updated_at' => now()]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->accounts as $slug => $accounts) {
            $websiteId = DB::table('websites')->where('slug', $slug)->value('id');

            foreach ($accounts as $column => $url) {
                DB::table('website_identities')
                    ->where('website_id', $websiteId)
                    ->where($column, $url)
                    ->update([$column => null, 'updated_at' => now()]);
            }
        }
    }
};
