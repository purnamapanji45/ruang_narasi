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
}
