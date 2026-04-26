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
}
