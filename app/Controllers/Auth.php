<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // ==========================
    // LOGIN PAGE
    // ==========================
    public function login()
    {
        return view('auth/login');
    }

    // ==========================
    // PROSES LOGIN
    // ==========================
    public function prosesLogin()
    {
        $session = session();
        $usersModel = new UsersModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $usersModel->getUsersByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // SET SESSION
                $session->set([
                    'id'        => $user['id'],   // konsisten pakai ini
                    'nama_user' => $user['nama'],
                    'email'     => $user['email'],
                    'username'  => $user['username'],
                    'role'      => $user['role'],
                    'foto'      => $user['foto'],
                    'logged_in' => true
                ]);

                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/login')
                    ->with('error', 'Password salah');
            }
        } else {
            return redirect()->to('/login')
                ->with('error', 'Username tidak ditemukan');
        }
    }

    // ==========================
    // LOGOUT
    // ==========================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // ==========================
    // REGISTER PAGE
    // ==========================
    public function register()
    {
        $data = [
            'title' => 'Daftar Baru - Ruang Narasi'
        ];
        return view('auth/register', $data); // Pastikan $data dimasukkan di sini
    }
    public function proses_daftar() // Harus sama dengan yang di Routes
    {
        $usersModel = new UsersModel();
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => 'anggota',
            'foto'     => 'default.jpg'
        ];  // ... isi kode pendaftaran ...
    }

    // ==========================
    // SAVE REGISTER
    // ==========================
    public function save_register()
    {
        $usersModel = new UsersModel();

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => 'anggota',
            'foto'     => 'default.jpg'
        ];

        $usersModel->save($data);

        return redirect()->to('/login')
            ->with('pesan', 'Pendaftaran berhasil! Silakan login.');
    }
}
