<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    protected $users;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru'
        ];
        return view('users/create', $data); // Ini bakal manggil file create.php
    }

    public function store()
    {
        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('uploads/users/', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        $this->users->save([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'foto'     => $namaFoto,
            'status'   => 'aktif'
        ]);

        return redirect()->to(base_url('users'))->with('success', 'User Berhasil Ditambah!');
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $role    = $this->request->getGet('role');

        $usersModel = $this->users;

        // Filter Username atau Nama
        if ($keyword) {
            $usersModel->groupStart()
                ->like('username', $keyword)
                ->orLike('nama', $keyword)
                ->groupEnd();
        }

        // Filter Role
        if ($role) {
            $usersModel->where('role', $role);
        }

        $data = [
            'users'   => $usersModel->findAll(),
            'title'   => 'Data Management Users',
            'keyword' => $keyword,
            'role'    => $role
        ];

        return view('users/index', $data);
    }
    public function edit($id)
    {
        return view('users/edit', [
            'user' => $this->users->find($id)
        ]);
    }

    public function update($id)
    {
        $user = $this->users->find($id);
        $fotoBaru = $this->request->getFile('foto');
        $namaFoto = $user['foto'];

        if ($fotoBaru && $fotoBaru->isValid() && !$fotoBaru->hasMoved()) {

            if ($namaFoto && file_exists(FCPATH . 'uploads/users/' . $namaFoto)) {
                unlink(FCPATH . 'uploads/users/' . $namaFoto);
            }

            $namaFoto = $fotoBaru->getRandomName();
            $fotoBaru->move(FCPATH . 'uploads/users', $namaFoto);
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
            'foto'     => $namaFoto
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->users->update($id, $data);

        return redirect()->to('/users')->with('success', 'User berhasil diupdate!');
    }

    public function delete($id)
    {
        $user = $this->users->find($id);

        if ($user) {
            // Cek apakah kolom foto ada isinya DAN bukan default.jpg
            if (!empty($user['foto']) && $user['foto'] != 'default.jpg') {
                $path = 'uploads/users/' . $user['foto'];

                // Tambahin cek is_file biar dia yakin yang dihapus itu FILE, bukan FOLDER
                if (file_exists($path) && is_file($path)) {
                    unlink($path);
                }
            }

            // Hapus data dari database
            $this->users->delete($id);

            return redirect()->to(base_url('users'))->with('success', 'User berhasil dihapus es!');
        }

        return redirect()->to(base_url('users'))->with('error', 'User tidak ditemukan!');
    }

    public function changeStatus($id, $status)
    {
        $this->users->update($id, [
            'status' => $status
        ]);

        $pesan = ($status == 'aktif') ? 'User berhasil diaktifkan!' : 'User berhasil dinonaktifkan!';

        return redirect()->to('/users')->with('success', $pesan);
    }
    // Di dalam class Controller kamu...

    public function profile()
    {
        // Cek dulu apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        // Ambil data user yang sedang login dari database
        // Ambil data user yang sedang login
        $userId = session()->get('id');
        $data = [
            'title' => 'Profil Saya',
            'user'  => $this->users->find($userId) // Pake $this->users sesuai baris 142
        ];

        return view('users/profile', $data); // Pastikan file view ini sudah ada
    }
}
