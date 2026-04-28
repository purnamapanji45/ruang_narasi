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

        // --- LOGIKA LAMA (TETAP DIPERTAHANKAN) ---
        $total_pinjam = $this->pinjamModel
            ->where('id_user', $id)
            ->whereNotIn('status', ['Kembali', 'kembali'])
            ->countAllResults();

        $sudah_kembali = $this->pinjamModel
            ->where('id_user', $id)
            ->where('status', 'kembali')
            ->countAllResults();

        $pinjaman = $this->pinjamModel
            ->select('peminjaman.*, buku.judul, buku.sampul')
            ->join('buku', 'buku.id_book = peminjaman.id_book')
            ->where('peminjaman.id_user', $id)
            ->where('peminjaman.status !=', 'kembali')
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();
        // ------------------------------------------

        // --- LOGIKA BARU UNTUK CEK STATUS BUKU REKOMENDASI ---
        // Kita ambil buku terbaru, tapi kita JOIN ke tabel pinjam untuk tahu statusnya bagi user ini
        $buku_rekomendasi = $this->bukuModel
            ->select('buku.*, peminjaman.status as status_peminjaman')
            ->join('peminjaman', "peminjaman.id_book = buku.id_book AND peminjaman.id_user = '$id'", 'left')
            ->orderBy('buku.id_book', 'DESC')
            ->first();

        return view('Anggota/dashboard', [
            'title'            => 'Dashboard Anggota',
            'total_buku'       => $this->bukuModel->countAll(),
            'total_pinjam'     => $total_pinjam,
            'total_kategori'   => $this->kategoriModel->countAll(),
            'buku_rekomendasi' => $buku_rekomendasi, // Sekarang data ini punya info 'status_peminjaman'
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
