<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();

        $data = [
            'title' => 'Data Kategori',
            'kategori' => $model->findAll()
        ];

        return view('kategori/index', $data);
    }
    public function create()
    {
        return view('kategori/create');
    }
    public function edit($id)
    {
        $db = \Config\Database::connect();

        $data['kategori'] = $db->table('kategori')
            ->where('id_kategori', $id)
            ->get()
            ->getRowArray();

        return view('kategori/edit', $data);
    }
    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('kategori')->update([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ], ['id_kategori' => $id]);

        return redirect()->to('/kategori')->with('pesan', 'Data berhasil diupdate!');
    }
    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('kategori')->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori')->with('pesan', 'Data berhasil ditambah!');
    }
    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('kategori')->delete(['id_kategori' => $id]);

        return redirect()->to('/kategori')->with('pesan', 'Data berhasil dihapus!');
    }
}
