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

    // ================= INDEX =================
    public function index()
    {
        $data['rak'] = $this->rakModel->findAll();
        return view('rak/index', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('rak/create');
    }

    public function store()
    {
        $this->rakModel->save([
            'nama_rak'   => $this->request->getPost('nama_rak'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/rak')->with('success', 'Data berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $data['rak'] = $this->rakModel->find($id);
        return view('rak/edit', $data);
    }

    public function update($id)
    {
        $this->rakModel->update($id, [
            'nama_rak'   => $this->request->getPost('nama_rak'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/rak')->with('success', 'Data berhasil diupdate');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->rakModel->delete($id);
        return redirect()->to('/rak')->with('success', 'Data berhasil dihapus');
    }
}
