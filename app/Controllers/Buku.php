<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    // ✅ 1. TAMPILKAN BUKU + STATUS PINJAM USER
    public function index()
    {
        $db = \Config\Database::connect();
        $id_user = session()->get('id');
        $keyword = $this->request->getGet('keyword');

        $builder = $db->table('buku')
            ->select('buku.*, penulis.nama_penulis, peminjaman.status as status_peminjaman')
            // 🔥 WAJIB TAMBAH JOIN PENULIS DI BAWAH INI
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id = buku.id_penerbit', 'left')
            ->join(
                'peminjaman',
                'peminjaman.id_book = buku.id_book AND peminjaman.id_user = ' . ($id_user ?? 0),
                'left'
            );

        if (!empty($keyword)) {
            $builder->like('buku.judul', $keyword);
        }

        $data['daftar_buku'] = $builder->get()->getResultArray();
        $data['title'] = 'Daftar Buku';

        return view('buku/index', $data);
    }
    // ✅ 2. FORM TAMBAH
    public function create()
    {
        $db = \Config\Database::connect();

        return view('buku/create', [
            'kategori' => $db->table('kategori')->get()->getResultArray(),
            'penulis'  => $db->table('penulis')->get()->getResultArray(),
            'penerbit' => $db->table('penerbit')->get()->getResultArray(),
            'rak'      => $db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ✅ 3. SIMPAN
    public function store()
    {
        $file = $this->request->getFile('sampul');

        if ($file->getError() == 4) {
            $nama = 'default_cover.jpg';
        } else {
            $nama = $file->getRandomName();
            $file->move('img', $nama);
        }

        $this->bukuModel->save([
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'id_penulis'   => $this->request->getPost('id_penulis'),
            'id_penerbit'  => $this->request->getPost('id_penerbit'),
            'id_rak'       => $this->request->getPost('id_rak'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $this->request->getPost('stok'),
            'sampul'       => $nama
        ]);

        return redirect()->to('/buku')->with('pesan', 'Buku berhasil ditambah!');
    }

    // ✅ 4. DETAIL
    public function detail($id)
    {
        $db = \Config\Database::connect();

        $data['buku'] = $db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id = buku.id_penerbit', 'left')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'left')
            ->where('buku.id_book', $id)
            ->get()
            ->getRowArray();

        return view('buku/detail', $data);
    }

    // ✅ 5. EDIT
    public function edit($id)
    {
        $db = \Config\Database::connect();

        return view('buku/edit', [
            'buku'     => $db->table('buku')->where('id_book', $id)->get()->getRowArray(),
            'kategori' => $db->table('kategori')->get()->getResultArray(),
            'penulis'  => $db->table('penulis')->get()->getResultArray(),
            'penerbit' => $db->table('penerbit')->get()->getResultArray(),
            'rak'      => $db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ✅ 6. UPDATE
    public function update($id)
    {
        $file = $this->request->getFile('sampul');
        $lama = $this->bukuModel->find($id);

        if ($file->getError() == 4) {
            $nama = $this->request->getPost('sampulLama');
        } else {
            $nama = $file->getRandomName();
            $file->move('img', $nama);

            if ($lama['sampul'] != 'default_cover.jpg' && file_exists('img/' . $lama['sampul'])) {
                unlink('img/' . $lama['sampul']);
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
            'sampul'       => $nama
        ]);

        return redirect()->to('/buku')->with('pesan', 'Data berhasil diupdate!');
    }

    // ✅ 7. DELETE
    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if ($buku && $buku['sampul'] != 'default_cover.jpg' && file_exists('img/' . $buku['sampul'])) {
            unlink('img/' . $buku['sampul']);
        }

        $this->bukuModel->delete($id);

        return redirect()->to('/buku')->with('pesan', 'Buku berhasil dihapus!');
    }

    // ✅ 8. PRINT
    public function print()
    {
        return view('buku/print', [
            'daftar_buku' => $this->bukuModel->findAll()
        ]);
    }
}
