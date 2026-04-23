<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    public function index()
    {
        $model = new PenerbitModel();

        $data = [
            'title' => 'Data Penerbit',
            'penerbit' => $model->findAll()
        ];

        return view('penerbit/index', $data);
    }
}
