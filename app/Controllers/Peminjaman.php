<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\UsersModel;

class Peminjaman extends BaseController
{
    protected $pinjamModel;
    protected $bukuModel;
    protected $userModel;

    public function __construct()
    {
        $this->pinjamModel = new PeminjamanModel();
        $this->bukuModel   = new BukuModel();
        $this->userModel   = new UsersModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $status  = $this->request->getGet('status');

        // 1. Definisikan builder di awal secara lengkap
        $builder = $this->pinjamModel
            ->select('peminjaman.*, users.nama AS nama_peminjam, buku.judul')
            ->join('users', 'users.id = peminjaman.id_user', 'left')
            ->join('buku', 'buku.id_book = peminjaman.id_book', 'left');

        // 2. Jika ada keyword, tambahkan filter LIKE (jangan di-reset buildernya!)
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('buku.judul', $keyword)
                ->groupEnd();
        }

        // 3. Jika ada filter status
        if (!empty($status) && $status !== 'all') {
            $builder->where('peminjaman.status', strtolower($status));
        }

        // 4. Urutkan supaya yang terbaru ada di atas (Optional tapi bagus)
        $builder->orderBy('peminjaman.id_peminjaman', 'DESC');

        return view('peminjaman/index', [
            'title'   => 'Data Peminjaman',
            'pinjam'  => $builder->paginate(5, 'peminjaman'),
            'pager'   => $this->pinjamModel->pager,
            'keyword' => $keyword,
            'status'  => $status
        ]);
    }

    public function create()
    {
        return view('peminjaman/tambah', [
            'title' => 'Tambah Peminjaman',
            'users' => $this->userModel->findAll(),
            'buku'  => $this->bukuModel->where('stok >', 0)->findAll()
        ]);
    }

    public function save()
    {
        $id_book = $this->request->getVar('id_book');

        $this->pinjamModel->save([
            'id_user'         => $this->request->getVar('id_user'),
            'id_book'         => $id_book,
            'tanggal_pinjam'  => $this->request->getVar('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),
            'status' => 'dipinjam'
        ]);

        $buku = $this->bukuModel->find($id_book);
        if ($buku && $buku['stok'] > 0) {
            $this->bukuModel->update($id_book, [
                'stok' => $buku['stok'] - 1
            ]);
        }

        return redirect()->to('/peminjaman')
            ->with('pesan', 'Peminjaman berhasil dicatat!');
    }

    public function kembalikan($id)
    {
        $pinjam = $this->pinjamModel->find($id);

        if ($pinjam) {
            $this->pinjamModel->update($id, ['status' => 'kembali']);

            $buku = $this->bukuModel->find($pinjam['id_book']);
            if ($buku) {
                $this->bukuModel->update($pinjam['id_book'], [
                    'stok' => $buku['stok'] + 1
                ]);
            }

            session()->setFlashdata('pesan', 'Buku berhasil dikembalikan!');
        }

        return redirect()->to('/peminjaman');
    }

    public function delete($id)
    {
        $this->pinjamModel->delete($id);

        return redirect()->to('/peminjaman')
            ->with('pesan', 'Data riwayat berhasil dihapus!');
    }

    public function cetak_nota($id)
    {
        $pinjam = $this->pinjamModel
            ->select('peminjaman.*, buku.judul, users.nama AS nama_peminjam')
            ->join('buku', 'buku.id_book = peminjaman.id_book')
            ->join('users', 'users.id = peminjaman.id_user')
            ->find($id);

        if (!$pinjam) {
            return redirect()->to('/peminjaman');
        }

        return view('peminjaman/cetak_nota', [
            'title'  => 'Nota Kembali',
            'pinjam' => $pinjam
        ]);
    }

    // ✅ Setujui Peminjaman (FIX: hanya 1 function)
    public function setuju($id)
    {
        $pinjam = $this->pinjamModel->find($id);

        if ($pinjam) {
            // 1. Cek stok buku dulu sebelum menyetujui
            $buku = $this->bukuModel->find($pinjam['id_book']);

            if ($buku && $buku['stok'] > 0) {
                // 2. Update status jadi dipinjam
                $this->pinjamModel->update($id, [
                    'status' => 'dipinjam',
                    'tanggal_pinjam' => date('Y-m-d')
                ]);

                // 3. Kurangi stok buku
                $this->bukuModel->update($pinjam['id_book'], [
                    'stok' => $buku['stok'] - 1
                ]);

                return redirect()->to('/peminjaman')->with('pesan', 'Peminjaman disetujui, stok berkurang!');
            } else {
                return redirect()->to('/peminjaman')->with('error', 'Gagal! Stok buku habis.');
            }
        }

        return redirect()->to('/peminjaman');
    }

    // ✅ Selesai / Dikembalikan
    public function selesai($id)
    {
        $pinjam = $this->pinjamModel->find($id);

        if ($pinjam) {
            // Mencegah penambahan stok berulang jika statusnya memang sudah 'kembali'
            if ($pinjam['status'] == 'kembali') {
                return redirect()->to('/peminjaman')->with('error', 'Buku ini sudah dikembalikan sebelumnya!');
            }

            // 1. Update status peminjaman jadi kembali
            $this->pinjamModel->update($id, ['status' => 'kembali']);

            // 2. Tambah stok buku secara otomatis
            $buku = $this->bukuModel->find($pinjam['id_book']);
            if ($buku) {
                $newStok = $buku['stok'] + 1;
                $this->bukuModel->update($pinjam['id_book'], [
                    'stok' => $newStok
                ]);
            }

            return redirect()->to('/peminjaman')->with('pesan', 'Buku berhasil kembali, stok bertambah jadi ' . $newStok);
        }
    }
    public function ajukan($id_book)
    {
        // Ubah dari 'id_user' menjadi 'id' agar sesuai dengan Auth Controller kamu
        $id_user = session()->get('id');

        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Sesi habis, silakan login kembali.');
        }

        $this->pinjamModel->save([
            'id_user'         => $id_user, // Ini tetap id_user karena ini nama kolom di tabel peminjaman
            'id_book'         => $id_book,
            'tanggal_pinjam'  => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status'          => 'diajukan'
        ]);

        // Arahkan ke /katalog atau /buku sesuai route kamu
        return redirect()->to('/katalog')->with('pesan', 'Peminjaman berhasil diajukan!');
    }
    public function bayar($id)
    {
        $pinjam = $this->pinjamModel
            ->select('peminjaman.*, users.nama as nama_peminjam, buku.judul')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('buku', 'buku.id_book = peminjaman.id_book')
            ->find($id);

        if (!$pinjam) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        $tgl_kembali = new \DateTime($pinjam['tanggal_kembali']);
        $tgl_sekarang = new \DateTime(date('Y-m-d'));

        $denda = 0;
        if ($tgl_sekarang > $tgl_kembali) {
            $selisih = $tgl_sekarang->diff($tgl_kembali)->days;
            $denda = $selisih * 2000;
        }

        return view('peminjaman/bayar', [
            'title' => 'Pembayaran Denda',
            'pinjam' => $pinjam,
            'denda' => $denda
        ]);
    }

    public function proses_bayar($id)
    {
        // Update status denda atau langsung selesaikan peminjaman
        $this->pinjamModel->update($id, [
            'status' => 'kembali'
        ]);

        // Tambah stok buku kembali
        $pinjam = $this->pinjamModel->find($id);
        $buku = $this->bukuModel->find($pinjam['id_book']);
        $this->bukuModel->update($pinjam['id_book'], ['stok' => $buku['stok'] + 1]);

        return redirect()->to('/peminjaman')->with('pesan', 'Denda lunas dan buku dikembalikan!');
    }
    public function upload_bukti($id)
    {
        $fileBukti = $this->request->getFile('bukti_bayar');
        $metode = $this->request->getVar('metode_bayar');
        $denda = $this->request->getVar('denda_nominal');

        // Cek apakah ada file yang dipilih
        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {

            // Generate nama unik
            $namaFile = $fileBukti->getRandomName();

            // Pindahkan ke folder public/uploads/bukti_bayar
            $fileBukti->move('uploads/bukti_bayar', $namaFile);

            // UPDATE DATABASE
            $dataUpdate = [
                'denda'          => $denda,
                'metode_bayar'   => $metode,
                'bukti_bayar'    => $namaFile,
                'status_bayar'   => 'proses', // Agar admin tahu ini sedang bayar
                'status'         => 'dipinjam' // Tetap dipinjam sampai admin konfirmasi lunas
            ];

            if ($this->pinjamModel->update($id, $dataUpdate)) {
                return redirect()->to('/anggota/pinjaman_saya')->with('pesan', 'Bukti terkirim! Menunggu konfirmasi admin.');
            } else {
                return redirect()->back()->with('error', 'Gagal update database.');
            }
        }

        return redirect()->back()->with('error', 'File tidak valid atau belum dipilih.');
    }
    public function halaman_bayar_user($id)
    {
        $pinjam = $this->pinjamModel
            ->select('peminjaman.*, users.nama AS nama_peminjam, buku.judul')
            ->join('users', 'users.id = peminjaman.id_user', 'left')
            ->join('buku', 'buku.id_book = peminjaman.id_book', 'left')
            ->find($id);

        // --- KODE HITUNG DENDA (TAMBAHKAN INI) ---
        $tgl_kembali = new \DateTime($pinjam['tanggal_kembali']);
        $tgl_sekarang = new \DateTime(date('Y-m-d'));
        $total_denda = 0;

        if ($tgl_sekarang > $tgl_kembali) {
            $selisih = $tgl_sekarang->diff($tgl_kembali)->days;
            $total_denda = $selisih * 2000; // Rp 2.000 per hari
        }
        // -----------------------------------------

        return view('Anggota/bayar_denda', [
            'title'  => 'Bayar Denda',
            'pinjam' => $pinjam,
            'denda'  => $total_denda // Sekarang ini tidak akan merah lagi
        ]);
    }
}
