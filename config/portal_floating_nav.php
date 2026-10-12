<?php

/**
 * Slug dan segmen URL untuk floating navbar portal.
 * Samakan data CMS (post_categories.slug, menus/dynamic_pages) dengan nilai di sini.
 */
return [

    'berita_category_slugs' => [
        'berita_bapenda'       => 'berita-bapenda',
        'berita_kaltim'        => 'berita-kaltim',
        'gebyar_taat_pajak'    => 'gebyar-taat-pajak',
    ],

    /** Segmen kedua pada route portal.page.show ({website}/{segment}) */
    'dynamic_segments' => [
        'kepala_bapenda'           => 'kepala-bapenda',
        'struktur_organisasi'      => 'struktur-organisasi',
        'visi_misi'                => 'visi-misi',
        'maklumat_layanan'         => 'maklumat-layanan',
        'tentang_bapenda'          => 'tentang-bapenda',
        'maklumat_pelayanan_uptd'  => 'maklumat-pelayanan-uptd',
        'agenda_kerja'             => 'agenda-kerja',
        'sk_gubernur'              => 'sk-gubernur',
        'peraturan_daerah'         => 'peraturan-daerah',
        'peraturan_gubernur'       => 'peraturan-gubernur',
    ],

    /** Halaman dinamis untuk tombol Inovasi */
    'inovasi_segment' => 'inovasi',

];
