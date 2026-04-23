<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_user',
        'id_book',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    protected $useTimestamps = false; // ubah ke true kalau pakai created_at, updated_at

    /**
     * Ambil data peminjaman lengkap (join users & buku)
     */
    public function getPeminjamanLengkap()
    {
        return $this->select('peminjaman.*, buku.judul, users.nama AS nama_peminjam')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('buku', 'buku.id_book = peminjaman.id_book')
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->findAll();
    }

    /**
     * Builder untuk kebutuhan search, filter, pagination
     */
    public function getPeminjamanQuery($keyword = null, $status = null)
    {
        $builder = $this->select('peminjaman.*, buku.judul, users.nama AS nama_peminjam')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('buku', 'buku.id_book = peminjaman.id_book');

        // 🔍 SEARCH
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('buku.judul', $keyword)
                ->groupEnd();
        }

        // 🎯 FILTER STATUS
        if (!empty($status) && $status !== 'all') {
            $builder->where('peminjaman.status', strtolower($status));
        }

        return $builder->orderBy('peminjaman.id_peminjaman', 'DESC');
    }
}
