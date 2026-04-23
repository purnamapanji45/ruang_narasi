<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-4">

    <h3 class="fw-bold mb-4">👤 Profil Pengguna</h3>

    <?php
    $fotoPath = 'uploads/users/' . $user['foto'];
    $src = (!empty($user['foto']) && file_exists(FCPATH . $fotoPath))
        ? base_url($fotoPath)
        : base_url('img/default.jpg');

    $userId = $user['id'] ?? $user['id_user'];
    ?>

    <!-- PROFILE HEADER -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="row align-items-center">

                <!-- FOTO -->
                <div class="col-md-3 text-center">
                    <img src="<?= $src ?>"
                        class="rounded-circle shadow-sm"
                        style="width:140px;height:140px;object-fit:cover;border:3px solid #ddd;">
                </div>

                <!-- INFO -->
                <div class="col-md-9">

                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <h4 class="mb-0"><?= $user['username']; ?></h4>

                        <a href="<?= base_url('users/edit/' . $userId) ?>"
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <span class="badge bg-info text-dark text-uppercase">
                            <?= $user['role']; ?>
                        </span>
                    </div>

                    <div class="text-muted mb-2">
                        <strong><?= $user['nama']; ?></strong><br>
                        <?= $user['email']; ?>
                    </div>

                    <!-- STAT -->
                    <div class="d-flex gap-4 mt-3">

                        <div>
                            <h5 class="mb-0"><?= $totalBuku ?? 0 ?></h5>
                            <small class="text-muted">Buku</small>
                        </div>

                        <div>
                            <h5 class="mb-0"><?= $poin ?? 0 ?></h5>
                            <small class="text-muted">Poin</small>
                        </div>

                        <div>
                            <h5 class="mb-0"><?= ucfirst($user['role']); ?></h5>
                            <small class="text-muted">Status</small>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- DETAIL -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold text-primary">
            Detail Informasi
        </div>

        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="30%">Username</th>
                    <td><?= $user['username']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $user['email']; ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= ucfirst($user['role']); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- BUKU SAYA -->
    <div class="text-center mb-3">
        <small class="fw-bold text-uppercase text-muted">
            <i class="bi bi-grid-3x3-gap"></i> Buku Saya
        </small>
    </div>

    <div class="row">
        <?php if (!empty($bukuSaya)) : ?>
            <?php foreach ($bukuSaya as $b) : ?>

                <?php
                $coverPath = 'uploads/buku/' . $b['cover'];
                $cover = (!empty($b['cover']) && file_exists(FCPATH . $coverPath))
                    ? base_url($coverPath)
                    : base_url('img/default_buku.jpg');
                ?>

                <div class="col-md-3 mb-4">
                    <div class="card h-100">

                        <img src="<?= $cover ?>"
                            class="card-img-top"
                            style="height:200px;object-fit:cover;">

                        <div class="card-body">
                            <h6 class="fw-bold mb-1"><?= $b['judul']; ?></h6>
                            <small class="text-muted"><?= $b['penulis'] ?? '-' ?></small>
                        </div>

                        <div class="card-footer bg-white text-muted small">
                            <?= $b['tanggal_pinjam']; ?>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center text-muted py-4">
                <i class="bi bi-book fs-1"></i>
                <p class="mb-0">Belum ada buku dipinjam</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<style>
    body {
        background-color: #fafafa;
    }

    .card {
        border-radius: 14px;
        transition: all 0.25s ease;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card img {
        transition: 0.3s;
    }

    .card:hover img {
        transform: scale(1.05);
    }
</style>
<?= $this->endSection() ?>