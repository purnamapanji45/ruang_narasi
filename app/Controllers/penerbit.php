<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbitModel;

    public function __construct()
    {
        $this->penerbitModel = new PenerbitModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Penerbit',
            'penerbit' => $this->penerbitModel->findAll()
        ];
        return view('penerbit/index', $data);
    }

    public function store()
    {
        $this->penerbitModel->save([
            'nama_penerbit'    => $this->request->getPost('nama_penerbit'),
            'alamat_penerbit'  => $this->request->getPost('alamat_penerbit'),
            'telepon_penerbit' => $this->request->getPost('telepon_penerbit'),
        ]);
        return redirect()->to('/penerbit');
    }

    public function delete($id)
    {
        $this->penerbitModel->delete($id);
        return redirect()->to('/penerbit');
    }
    // File: app/Controllers/Penerbit.php

    public function create() // Ganti dari 'tambah' ke 'create'
    {
        // Pastikan nama file view-nya sesuai dengan yang kamu punya
        // Kalau nama filenya 'tambah_form', maka:
        return view('penerbit/create');
    }
    public function edit($id)
    {
        // 1. Cari data penerbit berdasarkan ID-nya
        // Pastikan nama Model kamu benar (misal: $this->penerbitModel)
        $data = [
            'penerbit' => $this->penerbitModel->find($id)
        ];

        // 2. Tampilkan file view edit.php yang ada di folder penerbit
        return view('penerbit/edit', $data);
    }

    public function update($id)
    {
        // 1. Ambil data dari form input
        $this->penerbitModel->update($id, [
            'nama_penerbit'    => $this->request->getPost('nama_penerbit'),
            'alamat_penerbit'  => $this->request->getPost('alamat_penerbit'),
            'telepon_penerbit' => $this->request->getPost('telepon_penerbit'),
        ]);

        // 2. Kasih notifikasi sukses (optional)
        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        // 3. Kembalikan ke halaman daftar penerbit
        return redirect()->to(base_url('penerbit'));
    }
}
