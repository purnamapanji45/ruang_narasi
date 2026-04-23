<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Daftar Baru - Ruang Narasi'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #6f42c1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .register-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .btn-register {
            background-color: #6f42c1;
            color: white;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #5a32a3;
            color: white;
        }
    </style>
</head>

<body>

    <div class="register-card">
        <h3 class="text-center fw-bold mb-1">RUANG NARASI</h3>
        <p class="text-center text-muted small mb-4">DAFTAR ANGGOTA BARU</p>

        <form action="<?= base_url('auth/save_register') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label small text-muted">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label small text-muted">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Buat username" required>
            </div>
            <div class="mb-3">
                <label class="form-label small text-muted">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
            </div>
            <button type="submit" class="btn btn-register py-2 mb-3">Daftar Sekarang</button>
        </form>

        <div class="text-center">
            <small>Sudah punya akun? <a href="<?= base_url('/login'); ?>" class="text-decoration-none" style="color: #6f42c1;">Masuk di sini</a></small>
        </div>
    </div>

</body>

</html>