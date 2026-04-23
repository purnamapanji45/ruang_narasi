<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Narasi - Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        :root {
            --brown-dark: #3e2723;
            --brown-medium: #5d4037;
            --brown-light: #d7ccc8;
            --paper-color: #f4f1ea;
        }

        body {
            background-color: var(--paper-color);
            font-family: 'Poppins', sans-serif;
            color: #4e342e;
        }

        /* Sidebar Style - Klasik Kayu */
        .sidebar {
            min-width: 260px;
            max-width: 260px;
            background: linear-gradient(180deg, #2d1b18 0%, #1a0a08 100%);
            min-height: 100vh;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .content-area {
            min-height: 100vh;
            overflow-y: auto;
            background: url('https://www.transparenttextures.com/patterns/paper.png');
            /* Efek tekstur kertas */
        }

        /* Navbar Style */
        .navbar {
            background-color: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(141, 110, 99, 0.2);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
            color: var(--brown-dark) !important;
        }

        /* Animasi Dropdown */
        .dropdown-menu {
            animation: fadeIn 0.3s ease;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background-color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card Styling biar kayak Katalog */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Custom Scrollbar biar estetik */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--brown-medium);
            border-radius: 10px;
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<body>
    <div class="d-flex">
        <?= $this->include('layout/menu') ?>

        <div class="content-area w-100 p-4">
            <nav class="navbar navbar-expand-lg mb-4 shadow-sm p-3 rounded-4">
                <div class="container-fluid">
                    <span class="navbar-brand fw-bold">
                        <i class="bi bi-book-half me-2" style="color: #8d6e63;"></i>RUANG NARASI
                    </span>

                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="text-end me-3 d-none d-sm-block">
                                    <small class="d-block fw-bold text-dark lh-1"><?= ($GLOBALS['user_aktif']) ? $GLOBALS['user_aktif']['nama'] : 'Guest'; ?></small>
                                    <span class="badge bg-dark mt-1" style="font-size: 8px; letter-spacing: 1px;"><?= ($GLOBALS['user_aktif']) ? strtoupper($GLOBALS['user_aktif']['role']) : 'GUEST'; ?></span>
                                </div>

                                <?php
                                $user = $GLOBALS['user_aktif'];
                                $fotoPath = ($user) ? 'uploads/users/' . $user['foto'] : '';

                                // Cek apakah file fotonya ada di folder public/uploads/users/
                                if ($user && !empty($user['foto']) && file_exists(FCPATH . $fotoPath)): ?>
                                    <img src="<?= base_url($fotoPath) ?>" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border: 2px solid #8d6e63;">
                                <?php else: ?>
                                    <img src="<?= base_url('img/default.jpg') ?>" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border: 2px solid #8d6e63;">
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-2 mt-3" style="border-radius: 15px; min-width: 220px;">
                                <li class="px-3 py-3 text-center bg-light rounded-4 mb-2">
                                    <small class="text-muted d-block">Selamat Datang,</small>
                                    <div class="fw-bold"><?= ($GLOBALS['user_aktif']) ? $GLOBALS['user_aktif']['nama'] : 'Guest'; ?></div>
                                </li>
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('profile') ?>"><i class="bi bi-person-circle me-2"></i> Profil Saya</a></li>
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('setting') ?>"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item rounded-3 py-2 text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-power me-2"></i> Keluar Sistem</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="animate-fade">
                <?= $this->renderSection('content') ?>
            </main>

            <footer class="mt-5 text-center text-muted small pb-4">
                <hr class="mb-4 opacity-10">
                &copy; <?= date('Y') ?> <span style="font-family: 'Playfair Display', serif;">Ruang Narasi</span> -
                <span class="text-brown">Premium Digital Library System</span>
            </footer>
        </div>
    </div>
    <script>
        function togglePassword(id, el) {
            let input = document.getElementById(id);

            if (!input) return;

            if (input.type === "password") {
                input.type = "text";
                el.innerHTML = "🙈";
            } else {
                input.type = "password";
                el.innerHTML = "👁️";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>