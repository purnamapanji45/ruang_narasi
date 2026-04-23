<?php

namespace App\Controllers;

use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rakModel;

    public function __construct()
    {
        $this->rakModel = new RakModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Rak',
            'rak'   => $this->rakModel->findAll()
        ];
        return view('rak/index', $data);
    }

    public function simpan()
    {
        $this->rakModel->save([
            'nama_rak' => $this->request->getVar('nama_rak'),
            'lokasi'   => $this->request->getVar('lokasi'),
        ]);

        return redirect()->to('/rak')->with('pesan', 'Data rak berhasil ditambahkan.');
    }

    public function hapus($id)
    {
        $this->rakModel->delete($id);
        return redirect()->to('/rak')->with('pesan', 'Data rak berhasil dihapus.');
    }
}
