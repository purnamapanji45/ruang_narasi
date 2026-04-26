<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
    protected $table = 'penerbit';
    // UBAH INI: dari 'id_penerbit' menjadi 'id'
    protected $primaryKey = 'id';

    // TAMBAHKAN INI: agar kolom lain bisa diisi lewat program
    protected $allowedFields = ['nama_penerbit', 'alamat_penerbit', 'telepon_penerbit'];

    // Opsional: aktifkan ini karena kamu punya kolom created_at & updated_at di gambar
    protected $useTimestamps = true;
}
