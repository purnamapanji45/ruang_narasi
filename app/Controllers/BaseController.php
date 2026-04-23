<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UsersModel; // Tambahkan ini biar bisa panggil model user

/**
 * Class BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically.
     */
    protected $helpers = ['form', 'url']; // Tambahin helper dasar

    /**
     * Variabel untuk menampung data user yang sedang login
     */
    protected $currentUser;
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // 1. Inisialisasi Session
        $this->session = \Config\Services::session();

        // 2. Load Model User
        $usersModel = new \App\Models\UsersModel();

        // 3. Ambil data user
        if ($this->session->get('logged_in')) {
            $userId = $this->session->get('id');
            $this->currentUser = $usersModel->find($userId);
        } else {
            $this->currentUser = null;
        }

        // --- BAGIAN PENTING: DAFTARKAN GLOBAL ---
        // Tambahkan baris ini tepat sebelum fungsi initController berakhir
        $GLOBALS['user_aktif'] = $this->currentUser;
    }
}
