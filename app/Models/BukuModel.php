<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_book';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // atau 'object'
    protected $useSoftDeletes   = false; // Ubah ke true jika ingin fitur 'trash'

    protected $allowedFields = [
        'judul',
        'id_kategori',
        'id_penulis',
        'id_penerbit',
        'id_rak',
        'tahun_terbit',
        'stok',
        'sampul'
    ];

    // Otomatis ngisi tanggal
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi anti-input sembarangan
    protected $validationRules = [
        'judul' => 'required|min_length[3]',
        'stok'  => 'required|numeric',
    ];

    // Fungsi tambahan biar panggil data ga ribet
    public function cariBuku($keyword)
    {
        return $this->table($this->table)->like('judul', $keyword)->get()->getResultArray();
    }
    public function getBukuLengkap()
    {
        // Gunakan 'left' di parameter ketiga fungsi join
        return $this->select('buku.*, penulis.nama_penulis')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->findAll();
    }
}
