<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">📚 Koleksi Buku</h3>
            <small class="text-muted">Kelola dan lihat semua buku di perpustakaan</small>
        </div>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
            <a href="<?= base_url('buku/create'); ?>" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Buku
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH + FILTER -->
    <div class="card p-3 mb-3 shadow-sm border-0">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="🔍 Cari judul buku...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option>Semua Penulis</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    Cari
                </button>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0 rounded-4">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">
                    <tr class="text-muted">
                        <th width="80">Sampul</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th class="text-center" width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($daftar_buku)) : ?>
                        <?php foreach ($daftar_buku as $b) : ?>
                            <tr>

                                <!-- Sampul -->
                                <td>
                                    <img src="<?= base_url('img/' . ($b['sampul'] ?? 'default_cover.jpg')) ?>"
                                        class="rounded shadow-sm"
                                        style="width:55px;height:75px;object-fit:cover;">
                                </td>

                                <!-- Judul -->
                                <td>
                                    <div class="fw-semibold"><?= $b['judul'] ?></div>
                                    <small class="text-muted">ID: <?= $b['id_book'] ?></small>
                                </td>

                                <!-- Penulis -->
                                <td><?= $b['nama_penulis'] ?></td>

                                <!-- Stok -->
                                <td>
                                    <?php if ($b['stok'] > 0): ?>
                                        <span class="badge bg-success"><?= $b['stok'] ?> tersedia</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Aksi -->
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1 flex-wrap">

                                        <!-- Detail -->
                                        <a href="<?= base_url('buku/detail/' . $b['id_book']) ?>"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- ADMIN -->
                                        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

                                            <a href="<?= base_url('buku/edit/' . $b['id_book']) ?>"
                                                class="btn btn-sm btn-warning text-white">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="<?= base_url('buku/delete/' . $b['id_book']) ?>"
                                                method="post"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin hapus buku ini?')">

                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        <?php endif; ?>

                                        <!-- ANGGOTA -->
                                        <?php if (session()->get('role') == 'anggota') : ?>

                                            <a href="<?= base_url('peminjaman/ajukan/' . $b['id_book']); ?>"
                                                class="btn btn-success btn-sm">
                                                Pinjam
                                            </a>

                                        <?php endif; ?>

                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-book fs-2"></i>
                                <p class="mb-0">Belum ada data buku</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>