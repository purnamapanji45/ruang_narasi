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
}
