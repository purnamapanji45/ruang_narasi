<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        // Panggil model user yang tadi kita benerin
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        // Cek kalau sudah login, langsung lempar ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('login/index'); // Ini file view login kamu
    }

    public function auth()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = (string)$this->request->getPost('password'); // Pastikan string

        $user = $this->usersModel->getUsersByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // SESUAIKAN DENGAN DATABASE (Ganti id_user jadi id)
                $session->set([
                    'id'        => $user['id'], // Sesuai kolom di phpMyAdmin kamu
                    'nama'      => $user['nama'],
                    'username'  => $user['username'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ]);

                return redirect()->to(base_url('dashboard'));
            } else {
                return redirect()->to(base_url('login'))->with('msg', 'Password Salah Es!');
            }
        } else {
            return redirect()->to(base_url('login'))->with('msg', 'Username Gak Ketemu!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
