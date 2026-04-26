<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// 1. PUBLIC (tanpa login)
// ==========================
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('proses-login', 'Auth::prosesLogin');

// REGISTER
$routes->get('daftar', 'Auth::register');
$routes->post('auth/save_register', 'Auth::save_register');

// LOGOUT
$routes->get('logout', 'Auth::logout');


// ==========================
// 2. LOGIN REQUIRED
// ==========================
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ======================
    // DASHBOARD
    // ======================
    $routes->get('home', 'Home::index');
    $routes->get('dashboard', 'Home::index');

    // ======================
    // KATALOG
    // ======================
    $routes->get('katalog', 'Buku::index');

    // ======================
    // PROFILE & SETTING
    // ======================
    $routes->get('profile', 'Users::profile');

    $routes->get('setting', 'Setting::index');
    $routes->post('setting/update', 'Setting::update');
    $routes->post('setting/password', 'Setting::password');


    // ======================
    // ANGGOTA
    // ======================
    $routes->group('anggota', function ($routes) {
        $routes->get('/', 'Anggota::index');
        $routes->get('pinjaman_saya', 'Anggota::pinjaman_saya');
        $routes->get('bayar/(:num)', 'Peminjaman::halaman_bayar_user/$1');
    });


    // ======================
    // PEMINJAMAN (USER)
    // ======================
    $routes->group('peminjaman', function ($routes) {
        $routes->get('ajukan/(:num)', 'Peminjaman::ajukan/$1');
        $routes->get('setuju/(:num)', 'Peminjaman::setuju/$1');
        $routes->get('selesai/(:num)', 'Peminjaman::selesai/$1');
        $routes->post('upload_bukti/(:num)', 'Peminjaman::upload_bukti/$1');
    });


    // ==========================
    // ADMIN + PETUGAS
    // ==========================
    $routes->group('', ['filter' => 'role:admin,petugas'], function ($routes) {

        // ======================
        // KATEGORI (🔥 TAMBAHAN)
        // ======================
        $routes->group('kategori', function ($routes) {
            $routes->get('/', 'Kategori::index');
            $routes->get('create', 'Kategori::create');
            $routes->post('store', 'Kategori::store');
            $routes->get('edit/(:num)', 'Kategori::edit/$1');
            $routes->post('update/(:num)', 'Kategori::update/$1');
            $routes->get('delete/(:num)', 'Kategori::delete/$1');
        });

        // ======================
        // PENULIS (🔥 TAMBAHAN)
        // ======================
        $routes->group('penulis', function ($routes) {
            $routes->get('/', 'Penulis::index');
            $routes->get('create', 'Penulis::create');
            $routes->post('store', 'Penulis::store');
            $routes->get('edit/(:num)', 'Penulis::edit/$1');
            $routes->post('update/(:num)', 'Penulis::update/$1');
            $routes->post('users/delete/(:num)', 'Users::delete/$1');
        });

        // ======================
        // PENERBIT (🔥 TAMBAHAN)
        // ======================
        $routes->group('penerbit', function ($routes) {
            $routes->get('/', 'Penerbit::index');
            $routes->get('create', 'Penerbit::create');
            $routes->post('store', 'Penerbit::store');
            $routes->get('edit/(:num)', 'Penerbit::edit/$1');
            $routes->post('update/(:num)', 'Penerbit::update/$1');
            $routes->get('delete/(:num)', 'Penerbit::delete/$1');
        });

        // ======================
        // RAK
        // ======================
        $routes->group('rak', function ($routes) {
            $routes->get('/', 'Rak::index');
            $routes->get('create', 'Rak::create');
            $routes->post('store', 'Rak::store');
            $routes->get('detail/(:num)', 'Rak::detail/$1');
            $routes->get('edit/(:num)', 'Rak::edit/$1');
            $routes->post('update/(:num)', 'Rak::update/$1');
            $routes->get('delete/(:num)', 'Rak::delete/$1');
        });

        // ======================
        // BUKU
        // ======================
        $routes->group('buku', function ($routes) {
            $routes->get('/', 'Buku::index');
            $routes->get('create', 'Buku::create');
            $routes->post('store', 'Buku::store');
            $routes->get('detail/(:num)', 'Buku::detail/$1');
            $routes->get('edit/(:num)', 'Buku::edit/$1');
            $routes->post('update/(:num)', 'Buku::update/$1');
            $routes->post('delete/(:num)', 'Buku::delete/$1');
        });

        // ======================
        // USERS
        // ======================
        $routes->group('users', function ($routes) {
            $routes->get('/', 'Users::index');
            $routes->get('create', 'Users::create');
            $routes->post('store', 'Users::store');
            $routes->get('edit/(:num)', 'Users::edit/$1');
            $routes->post('update/(:num)', 'Users::update/$1');
            $routes->post('delete/(:num)', 'Users::delete/$1');
        });

        // ======================
        // PEMINJAMAN (ADMIN)
        // ======================
        $routes->group('peminjaman', function ($routes) {
            $routes->get('/', 'Peminjaman::index');
            $routes->get('create', 'Peminjaman::create');
            $routes->post('save', 'Peminjaman::save');

            $routes->get('setuju/(:num)', 'Peminjaman::setuju/$1');
            $routes->get('kembalikan/(:num)', 'Peminjaman::kembalikan/$1');
            $routes->get('selesai/(:num)', 'Peminjaman::selesai/$1');
            $routes->get('delete/(:num)', 'Peminjaman::delete/$1');

            $routes->get('nota/(:num)', 'Peminjaman::cetak_nota/$1');

            $routes->get('bayar/(:num)', 'Peminjaman::bayar/$1');
            $routes->post('proses_bayar/(:num)', 'Peminjaman::proses_bayar/$1');
        });

        // ======================
        // LAPORAN
        // ======================
        $routes->get('laporan', 'Laporan::index');
    });
});
