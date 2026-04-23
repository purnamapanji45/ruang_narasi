<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <h3 class="fw-bold mb-4">👤 Profil Pengguna</h3>

    <?php
    // Logika penentuan foto profil
    $fotoPath = 'uploads/users/' . ($user['foto'] ?? '');
    $src = (!empty($user['foto']) && file_exists(FCPATH . $fotoPath))
        ? base_url($fotoPath)
        : base_url('img/default.jpg');

    // Penentuan ID User (menangani id atau id_user)
    $userId = $user['id'] ?? $user['id_user'] ?? 0;
    ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-3 text-center">
                    <img src="<?= $src ?>" class="rounded-circle shadow-sm"
                        style="width:140px;height:140px;object-fit:cover;border:3px solid #ddd;">
                </div>

                <div class="col-md-9">
                    <h4 class="fw-bold"><?= esc($user['username']); ?></h4>

                    <a href="<?= base_url('users/edit/' . $userId) ?>" class="btn btn-sm btn-primary px-3">
                        <i class="fas fa-edit me-1"></i> Edit Profil
                    </a>

                    <div class="mt-3">
                        <p class="mb-1"><strong>Nama Lengkap:</strong> <?= esc($user['nama']); ?></p>
                        <p class="mb-1 text-muted"><strong>Email:</strong> <?= esc($user['email']); ?></p>
                        <p class="mb-0">
                            <span class="badge bg-info text-dark">Role: <?= esc($user['role']); ?></span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3">📚 Koleksi Buku Saya</h5>
    <div class="row">
        <?php if (!empty($bukuSaya)) : ?>
            <?php foreach ($bukuSaya as $b) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;"
                            alt="<?= esc($b['judul']); ?>">

                        <div class="card-body p-2 text-center">
                            <h6 class="card-title mb-0" style="font-size: 0.9rem;"><?= esc($b['judul']); ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada buku yang ditambahkan.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>