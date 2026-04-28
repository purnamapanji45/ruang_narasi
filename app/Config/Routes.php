<?php

use CodeIgniter\Router\RouteCollection;

/* =========================
| PUBLIC
========================= */

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('proses-login', 'Auth::prosesLogin');

$routes->get('daftar', 'Auth::register');
$routes->post('auth/save_register', 'Auth::save_register');

$routes->group('restore', function ($routes) {
    $routes->get('/', 'Restore::index');
    $routes->post('auth', 'Restore::auth');
    $routes->get('form', 'Restore::form');
    $routes->post('process', 'Restore::process');
});

$routes->get('logout', 'Auth::logout');


/* =========================
| AUTH REQUIRED
========================= */
$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('home', 'Home::index');
    $routes->get('dashboard', 'Home::index');

    $routes->get('katalog', 'Buku::index');
    $routes->get('katalog/detail/(:num)', 'Buku::detail/$1');
    /* =========================
    | ANGGOTA
    ========================= */
    $routes->group('anggota', function ($routes) {
        $routes->get('/', 'Anggota::index');
        $routes->get('pinjaman_saya', 'Anggota::pinjaman_saya');
        $routes->get('bayar/(:num)', 'Peminjaman::halaman_bayar_user/$1');
    });

    /* =========================
    | PEMINJAMAN (CLEAN FIX)
    ========================= */
    $routes->group('peminjaman', function ($routes) {

        // LIST
        $routes->get('/', 'Peminjaman::index');

        // USER ACTION
        $routes->get('ajukan/(:num)', 'Peminjaman::ajukan/$1');
        $routes->get('setuju/(:num)', 'Peminjaman::setuju/$1');
        $routes->get('selesai/(:num)', 'Peminjaman::selesai/$1');
        $routes->post('upload_bukti/(:num)', 'Peminjaman::upload_bukti/$1');

        // ADMIN ACTION (TAPI MASIH 1 PREFIX)
        $routes->get('create', 'Peminjaman::create');
        $routes->post('save', 'Peminjaman::save');

        $routes->get('kembalikan/(:num)', 'Peminjaman::kembalikan/$1');

        // NOTA (FIX ERROR KAMU)
        $routes->get('nota/(:num)', 'Peminjaman::cetak_nota/$1');

        // BAYAR
        $routes->get('bayar/(:num)', 'Peminjaman::bayar/$1');
        $routes->post('proses_bayar/(:num)', 'Peminjaman::proses_bayar/$1');
        $routes->get('setujui_bayar/(:num)', 'Peminjaman::setujui_bayar/$1');
        // DELETE (FIX ERROR TERAKHIR)
        $routes->get('delete/(:num)', 'Peminjaman::delete/$1');
    });

    /* =========================
    | ADMIN ONLY
    ========================= */
    $routes->group('', ['filter' => 'role:admin,petugas'], function ($routes) {
        $routes->group('verifikasi', function ($routes) {
            $routes->get('/', 'Peminjaman::verifikasi');
            $routes->get('approve/(:num)', 'Peminjaman::approve/$1');
            $routes->get('reject/(:num)', 'Peminjaman::reject/$1');
        });
        /* KATEGORI */
        $routes->group('kategori', function ($routes) {
            $routes->get('/', 'Kategori::index');
            $routes->get('create', 'Kategori::create');
            $routes->post('store', 'Kategori::store');
            $routes->get('edit/(:num)', 'Kategori::edit/$1');
            $routes->post('update/(:num)', 'Kategori::update/$1');
            $routes->post('delete/(:num)', 'Kategori::delete/$1');
        });

        /* PENULIS */
        $routes->group('penulis', function ($routes) {
            $routes->get('/', 'Penulis::index');
            $routes->get('create', 'Penulis::create');
            $routes->post('store', 'Penulis::store');
            $routes->get('edit/(:num)', 'Penulis::edit/$1');
            $routes->post('update/(:num)', 'Penulis::update/$1');
            $routes->post('delete/(:num)', 'Penulis::delete/$1');
        });

        /* PENERBIT */
        $routes->group('penerbit', function ($routes) {
            $routes->get('/', 'Penerbit::index');
            $routes->get('create', 'Penerbit::create');
            $routes->post('store', 'Penerbit::store');
            $routes->get('edit/(:num)', 'Penerbit::edit/$1');
            $routes->post('update/(:num)', 'Penerbit::update/$1');
            $routes->post('delete/(:num)', 'Penerbit::delete/$1');
        });

        /* RAK */
        $routes->group('rak', function ($routes) {
            $routes->get('/', 'Rak::index');
            $routes->get('create', 'Rak::create');
            $routes->post('store', 'Rak::store');
            $routes->get('detail/(:num)', 'Rak::detail/$1');
            $routes->get('edit/(:num)', 'Rak::edit/$1');
            $routes->post('update/(:num)', 'Rak::update/$1');
            $routes->post('delete/(:num)', 'Rak::delete/$1');
            $routes->get('delete/(:num)', 'Rak::delete/$1');
        });

        /* BUKU */
        $routes->group('buku', function ($routes) {
            $routes->get('/', 'Buku::index');
            $routes->get('create', 'Buku::create');
            $routes->post('store', 'Buku::store');
            $routes->get('detail/(:num)', 'Buku::detail/$1');
            $routes->get('edit/(:num)', 'Buku::edit/$1');
            $routes->post('update/(:num)', 'Buku::update/$1');
            $routes->post('delete/(:num)', 'Buku::delete/$1');
        });

        /* USERS */
        $routes->group('users', function ($routes) {
            $routes->get('/', 'Users::index');
            $routes->get('create', 'Users::create');
            $routes->post('store', 'Users::store');
            $routes->get('edit/(:num)', 'Users::edit/$1');
            $routes->post('update/(:num)', 'Users::update/$1');
            $routes->post('delete/(:num)', 'Users::delete/$1');
        });

        /* LAPORAN */
        $routes->get('laporan', 'Laporan::index');

        /* BACKUP */
        $routes->get('backup', 'Backup::index');
    });
});
