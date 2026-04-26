<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Data Management Users</h2>
            <p class="text-muted">Kelola petugas dan anggota dengan filter JEDER</p>
        </div>
        <a href="<?= base_url('users/create') ?>" class="btn btn-primary shadow-sm px-4 rounded-pill">
            <i class="fas fa-plus-circle me-2"></i> Tambah User
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-body p-3">
            <form action="<?= base_url('users') ?>" method="get" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 ps-0" placeholder="Cari username atau nama..." value="<?= $keyword ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" <?= ($role == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= ($role == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                        <option value="anggota" <?= ($role == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
                <div class="col-md-auto d-flex gap-2">
                    <button type="submit" class="btn btn-dark px-4">Cari</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-outline-danger">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted text-uppercase small fw-bold">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th>Profil</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : $no = 1;
                        foreach ($users as $u) : ?>
                            <tr>
                                <td class="ps-4 fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php
                                        $fotoPath = 'uploads/users/' . $u['foto'];
                                        $linkFoto = (!empty($u['foto']) && file_exists(FCPATH . $fotoPath))
                                            ? base_url($fotoPath)
                                            : base_url('img/default.jpg');
                                        ?>
                                        <img src="<?= $linkFoto ?>" class="rounded-3 me-3 shadow-sm" width="45" height="45">
                                        <div>
                                            <div class="fw-bold text-dark"><?= $u['nama'] ?></div>
                                            <small class="text-muted"><?= $u['email'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>@<?= $u['username'] ?></td>
                                <td>
                                    <span class="badge <?= $u['role'] == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                        <?= strtoupper($u['role']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-<?= $u['status'] == 'aktif' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($u['status']) ?>
                                    </span>
                                </td>

                                <!-- 🔥 BAGIAN YANG DIPERBAIKI -->
                                <td class="text-center">
                                    <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <!-- DELETE PAKAI POST -->
                                    <form action="<?= base_url('users/delete/' . $u['id']) ?>" method="post" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach;
                    else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>