<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\UsersModel;
use App\Models\PeminjamanModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Inisialisasi SEMUA Model yang dibutuhkan
        $userModel     = new \App\Models\UsersModel();
        $pinjamModel   = new \App\Models\PeminjamanModel();
        $bukuModel     = new \App\Models\BukuModel();
        $kategoriModel = new \App\Models\KategoriModel(); // Tambahkan ini supaya tidak merah lagi

        // 2. Siapkan data untuk dikirim ke View
        $data = [
            'title'          => 'Dashboard',
            'total_buku'     => $bukuModel->countAllResults(),
            'total_user'     => $userModel->countAllResults(),
            'total_pinjam'   => $pinjamModel->countAllResults(), // Sesuaikan dengan nama di view kamu
            'total_kategori' => $kategoriModel->countAllResults(),
            'all_books'      => $bukuModel->findAll(8),
        ];

        return view('dashboard', $data);
    }
}
