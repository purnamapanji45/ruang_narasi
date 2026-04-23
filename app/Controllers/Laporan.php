<?php

namespace App\Controllers;

use App\Models\BukuModel; // WAJIB PANGGIL INI ES!

class Laporan extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel(); // Dia bakal otomatis nyari tabel 'buku'

        $data = [
            'title' => 'Laporan Koleksi Buku - Ruang Narasi',
            'buku'  => $bukuModel->getBukuLengkap() // Pakai fungsi baru kita
        ];

        return view('laporan/index', $data);
    }

    public function print()
    {
        $bukuModel = new BukuModel();

        $data = [
            'buku' => $bukuModel->getBukuLengkap(),
        ];

        return view('laporan/print', $data);
    }
}
