<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use App\Models\KategoriModel;

class Anggota extends BaseController
{
    protected $bukuModel;
    protected $pinjamModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->bukuModel     = new BukuModel();
        $this->pinjamModel   = new PeminjamanModel();
        $this->kategoriModel = new KategoriModel();
    }

    // ==========================
    // DASHBOARD
    // ==========================
    public function index()
    {
        $id = session()->get('id');

        $total_pinjam = $this->pinjamModel
            ->where('id_user', $id)
            ->countAllResults();

        $pinjaman = $this->pinjamModel
            ->select('peminjaman.*, buku.judul, buku.sampul')
            ->join('buku', 'buku.id_book = peminjaman.id_book')
            ->where('peminjaman.id_user', $id)
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();

        return view('Anggota/dashboard', [
            'title'            => 'Dashboard Anggota',
            'total_buku'       => $this->bukuModel->countAll(),
            'total_pinjam'     => $total_pinjam,
            'total_kategori'   => $this->kategoriModel->countAll(),
            'buku_rekomendasi' => $this->bukuModel
                ->orderBy('id_book', 'DESC')
                ->first(),
            'pinjaman'         => $pinjaman
        ]);
    }

    // ==========================
    // KATALOG
    // ==========================
    public function katalog()
    {
        return view('Anggota/index', [
            'title' => 'Katalog Buku Anggota',
            'buku'  => $this->bukuModel->findAll()
        ]);
    }

    // ==========================
    // AJUKAN PEMINJAMAN
    // ==========================
    public function ajukan($id_book)
    {
        $this->pinjamModel->save([
            'id_user'          => session()->get('id'),
            'nama_peminjam'    => session()->get('nama_user'),
            'id_book'          => $id_book,
            'tanggal_pinjam'   => date('Y-m-d'),
            'tanggal_kembali'  => date('Y-m-d', strtotime('+7 days')),
            'status'           => 'diajukan'
        ]);

        return redirect()->to('/anggota/katalog')
            ->with('pesan', 'Peminjaman berhasil diajukan! Tunggu persetujuan admin.');
    }

    // ==========================
    // PINJAMAN SAYA
    // ==========================
    public function pinjaman_saya()
    {
        $id = session()->get('id');

        $data = [
            'title'    => 'Pinjaman Saya',
            'pinjaman' => $this->pinjamModel
                ->select('peminjaman.*, buku.judul, buku.sampul')
                ->join('buku', 'buku.id_book = peminjaman.id_book')
                ->where('peminjaman.id_user', $id)
                ->orderBy('peminjaman.id_peminjaman', 'DESC')
                ->findAll()
        ];

        return view('Anggota/pinjaman_saya', $data);
    }
}
