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
    // PROFILE
    // ======================
    $routes->get('profile', 'Users::profile');
    $routes->get('setting', 'Users::setting');
    $routes->post('users/update_profile', 'Users::update_profile');


    // ======================
    // ANGGOTA
    // ======================
    $routes->group('anggota', function ($routes) {
        $routes->get('/', 'Anggota::index');
        $routes->get('pinjaman_saya', 'Anggota::pinjaman_saya');

        // BAYAR USER
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
            $routes->delete('delete/(:num)', 'Buku::delete/$1');
        });


        // ======================
        // USERS
        // ======================
        $routes->group('users', ['filter' => 'auth'], function ($routes) {
            $routes->get('/', 'Users::index');              // list user
            $routes->get('create', 'Users::create');        // form tambah user
            $routes->post('store', 'Users::store');         // simpan user baru
            $routes->get('edit/(:num)', 'Users::edit/$1');  // form edit
            $routes->post('update/(:num)', 'Users::update/$1'); // update data
            $routes->get('delete/(:num)', 'Users::delete/$1');  // hapus user
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

            // BAYAR ADMIN
            $routes->get('bayar/(:num)', 'Peminjaman::bayar/$1');
            $routes->post('proses_bayar/(:num)', 'Peminjaman::proses_bayar/$1');
        });


        // ======================
        // LAPORAN
        // ======================
        $routes->get('laporan', 'Laporan::index');
    });
});
