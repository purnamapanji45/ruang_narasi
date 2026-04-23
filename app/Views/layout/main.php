<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Narasi - Digital Library</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --brown-dark: #3e2723;
            --brown-medium: #5d4037;
            --paper-color: #f4f1ea;
        }

        body {
            background-color: var(--paper-color);
            font-family: 'Poppins', sans-serif;
            color: #4e342e;
        }

        /* SIDEBAR */
        .sidebar {
            min-width: 260px;
            background: linear-gradient(180deg, #2d1b18, #1a0a08);
            min-height: 100vh;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
        }

        /* CONTENT */
        .content-area {
            min-height: 100vh;
            background: url('https://www.transparenttextures.com/patterns/paper.png');
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(12px);
            border-radius: 12px;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        /* IMAGE HOVER */
        .card img {
            transition: 0.3s;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        /* BUTTON */
        .btn {
            transition: 0.2s;
        }

        .btn:hover {
            transform: scale(1.03);
        }

        .btn-primary {
            background: #6d4c41;
            border: none;
        }

        .btn-primary:hover {
            background: #5d4037;
        }

        /* SCROLL */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--brown-medium);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- SIDEBAR -->
        <?= $this->include('layout/menu') ?>

        <!-- CONTENT -->
        <div class="content-area w-100 p-4">

            <!-- NAVBAR -->
            <nav class="navbar mb-4 shadow-sm p-3">
                <div class="container-fluid">

                    <span class="navbar-brand fw-bold">
                        <i class="bi bi-book-half me-2"></i> RUANG NARASI
                    </span>

                    <div class="ms-auto d-flex align-items-center">

                        <?php
                        $user = $GLOBALS['user_aktif'];
                        $fotoPath = ($user) ? 'uploads/users/' . $user['foto'] : '';
                        ?>

                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">

                                <div class="text-end me-3 d-none d-sm-block">
                                    <small class="fw-bold"><?= $user['nama'] ?? 'Guest'; ?></small><br>
                                    <span class="badge bg-dark"><?= strtoupper($user['role'] ?? 'guest'); ?></span>
                                </div>

                                <?php if ($user && !empty($user['foto']) && file_exists(FCPATH . $fotoPath)): ?>
                                    <img src="<?= base_url($fotoPath) ?>" class="rounded-circle"
                                        style="width:35px;height:35px;object-fit:cover;">
                                <?php else: ?>
                                    <img src="<?= base_url('img/default.jpg') ?>" class="rounded-circle"
                                        style="width:35px;height:35px;object-fit:cover;">
                                <?php endif; ?>

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end mt-3">
                                <li><a class="dropdown-item" href="<?= base_url('profile') ?>">
                                        <i class="bi bi-person"></i> Profil
                                    </a></li>

                                <li><a class="dropdown-item" href="<?= base_url('setting') ?>">
                                        <i class="bi bi-gear"></i> Pengaturan
                                    </a></li>

                                <li>
                                    <hr>
                                </li>

                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </nav>

            <!-- CONTENT -->
            <main>
                <?= $this->renderSection('content') ?>
            </main>

            <!-- FOOTER -->
            <footer class="mt-5 text-center text-muted small">
                <hr>
                &copy; <?= date('Y') ?> Ruang Narasi - Digital Library
            </footer>

        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

</body>

</html>