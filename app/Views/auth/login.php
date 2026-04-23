<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ruang Narasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-header h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .btn-login {
            background: #764ba2;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #667eea;
            transform: translateY(-2px);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header text-center mb-4">
            <h2>RUANG NARASI</h2>
            <p class="text-muted small text-uppercase">Digital Library System</p>
        </div>

        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-danger small py-2"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/proses-login') ?>" method="post">
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Masukkan username" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="Masukkan password" required>
                </div>
            </div>
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-login">Masuk ke Ruang Narasi</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p>Belum punya akun? <a href="<?= base_url('/daftar'); ?>">Daftar Baru</a></p>
        </div>
    </div>

</body>

</html>