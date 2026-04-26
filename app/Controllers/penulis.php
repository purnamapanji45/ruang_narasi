<?php

namespace App\Controllers;

use App\Models\PenulisModel;
use App\Models\PenulisModelModel;

class Penulis extends BaseController
{
    public function index()
    {
        $model = new PenulisModel();

        $data = [
            'title' => 'Data Penulis',
            'penulis' => $model->findAll()
        ];

        return view('penulis/index', $data);
    }
    public function store()
    {
        $penulisModel = new \App\Models\PenulisModel();

        $penulisModel->save([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis')->with('pesan', 'Data berhasil ditambah!');
    }
    public function edit($id)
    {
        $db = \Config\Database::connect();

        $data['penulis'] = $db->table('penulis')
            ->where('id_penulis', $id)
            ->get()
            ->getRowArray();

        return view('penulis/edit', $data);
    }
    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('penulis')->update([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ], ['id_penulis' => $id]);

        return redirect()->to('/penulis')->with('pesan', 'Data berhasil diupdate!');
    }
    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('penulis')->delete(['id_penulis' => $id]);

        return redirect()->to('/penulis')->with('pesan', 'Data berhasil dihapus!');
    }
    public function create()
    {
        return view('penulis/create');
    }
}
