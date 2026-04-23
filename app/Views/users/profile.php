<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profil Pengguna</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <div class="card-body">
                    <?php
                    // Logika foto yang kita bahas tadi
                    $fotoPath = 'uploads/users/' . $user['foto'];
                    if (!empty($user['foto']) && file_exists(FCPATH . $fotoPath)): ?>
                        <img src="<?= base_url($fotoPath) ?>" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <img src="<?= base_url('img/default.jpg') ?>" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php endif; ?>

                    <h5 class="mt-3 font-weight-bold"><?= $user['nama']; ?></h5>
                    <span class="badge bg-info text-dark"><?= strtoupper($user['role']); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Informasi</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Username</th>
                            <td>: <?= $user['username']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= $user['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Role Akses</th>
                            <td>: <?= $user['role']; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <a href="<?= base_url('users/edit/' . $user['id']); ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>