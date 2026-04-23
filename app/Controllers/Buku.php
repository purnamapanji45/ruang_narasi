<?php

namespace App\Controllers;

// WAJIB ADA: Pemanggil Model agar tidak merah lagi es!
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;

class Buku extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        // Inisialisasi model utama
        $this->bukuModel = new BukuModel();
    }

    // 1. Menampilkan Semua Buku
    public function index()
    {
        $data = [
            'title'       => 'Daftar Buku',
            'daftar_buku' => $this->bukuModel->getBukuLengkap(),
        ];
        return view('buku/index', $data);
    }

    // 2. Form Tambah Buku
    public function create()
    {
        $db = \Config\Database::connect();

        $data['kategori'] = $db->table('kategori')->get()->getResultArray();
        $data['penulis'] = $db->table('penulis')->get()->getResultArray();
        $data['penerbit'] = $db->table('penerbit')->get()->getResultArray();
        $data['rak'] = $db->table('rak')->get()->getResultArray();

        return view('buku/create', $data);
    }

    // 3. Simpan Buku Baru (POST)
    public function store()
    {
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default_cover.jpg';
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
        }

        $this->bukuModel->save([
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'id_penulis'   => $this->request->getPost('id_penulis'),
            'id_penerbit'  => $this->request->getPost('id_penerbit'),
            'id_rak'       => $this->request->getPost('id_rak'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $this->request->getPost('stok'),
            'sampul'       => $namaSampul
        ]);

        return redirect()->to('/buku')->with('pesan', 'Buku berhasil ditambah es!');
    }

    // 4. Detail Buku
    public function detail($id)
    {
        $db = \Config\Database::connect();

        $data['buku'] = $db->table('buku')
            ->select('
            buku.*, 
            kategori.nama_kategori, 
            penulis.nama_penulis, 
            penerbit.nama_penerbit, 
            rak.nama_rak
        ')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'left')
            ->where('buku.id_book', $id)
            ->get()
            ->getRowArray();

        return view('buku/detail', $data);
    }

    // 5. Form Edit Buku
    public function edit($id)
    {
        $db = \Config\Database::connect();

        $data['buku'] = $db->table('buku')->where('id_book', $id)->get()->getRowArray();

        $data['kategori'] = $db->table('kategori')->get()->getResultArray();
        $data['penulis'] = $db->table('penulis')->get()->getResultArray();
        $data['penerbit'] = $db->table('penerbit')->get()->getResultArray();
        $data['rak'] = $db->table('rak')->get()->getResultArray();

        return view('buku/edit', $data);
    }

    // 6. Update Data (POST)
    public function update($id)
    {
        $fileSampul = $this->request->getFile('sampul');
        $bukuLama = $this->bukuModel->find($id);

        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getPost('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);
            // Hapus file lama jika bukan default
            if ($bukuLama['sampul'] != 'default_cover.jpg' && file_exists('img/' . $bukuLama['sampul'])) {
                unlink('img/' . $bukuLama['sampul']);
            }
        }

        $this->bukuModel->update($id, [
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'id_penulis'   => $this->request->getPost('id_penulis'),
            'id_penerbit'  => $this->request->getPost('id_penerbit'),
            'id_rak'       => $this->request->getPost('id_rak'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $this->request->getPost('stok'),
            'sampul'       => $namaSampul
        ]);

        return redirect()->to('/buku')->with('pesan', 'Data berhasil diupdate!');
    }

    // 7. Hapus Buku
    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);
        // Proteksi agar file gambar ikut terhapus di folder img
        if ($buku['sampul'] != 'default_cover.jpg' && file_exists('img/' . $buku['sampul'])) {
            unlink('img/' . $buku['sampul']);
        }

        $this->bukuModel->delete($id);
        return redirect()->to('/buku');
    }

    // 8. Cetak Data
    public function print()
    {
        $data = [
            'daftar_buku' => $this->bukuModel->findAll()
        ];
        return view('buku/print', $data);
    }
}
