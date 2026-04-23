<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';
    // allowedFields harus sesuai dengan nama kolom di tabel kategori kamu es
    protected $allowedFields = ['nama_kategori'];
}
