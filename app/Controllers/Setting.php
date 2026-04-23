<?php

namespace App\Controllers;

use App\Models\UsersModel;

$this->usersModel = new UsersModel();

class Setting extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $userId = session()->get('id') ?? session()->get('id_user');

        $data = [
            'user' => $this->usersModel->find($userId)
        ];

        return view('setting/index', $data);
    }

    public function update()
    {
        $userId = session()->get('id') ?? session()->get('id_user');

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        // Upload foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/users/', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->usersModel->update($userId, $data);

        return redirect()->back()->with('pesan', 'Profil berhasil diupdate');
    }

    public function password()
    {
        $userId = session()->get('id') ?? session()->get('id_user');
        $user = $this->usersModel->find($userId);

        $old = $this->request->getPost('password_lama');
        $new = $this->request->getPost('password_baru');

        if (!password_verify($old, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama salah');
        }

        $this->usersModel->update($userId, [
            'password' => password_hash($new, PASSWORD_DEFAULT)
        ]);

        return redirect()->back()->with('pesan', 'Password berhasil diubah');
    }
}
