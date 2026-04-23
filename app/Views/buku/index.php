<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- HEADER -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold m-0">📚 Koleksi Buku</h3>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
            <a href="<?= base_url('buku/create'); ?>" class="btn btn-warning shadow-sm fw-bold">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        <?php endif; ?>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($daftar_buku as $b) : ?>
                        <tr>

                            <!-- Sampul -->
                            <td>
                                <img src="<?= base_url('img/' . ($b['sampul'] ?? 'default_cover.jpg')) ?>"
                                    width="50"
                                    class="rounded shadow-sm">
                            </td>

                            <!-- Data -->
                            <td class="fw-bold"><?= $b['judul'] ?></td>
                            <td><?= $b['nama_penulis'] ?></td>
                            <td>
                                <span class="badge bg-info"><?= $b['stok'] ?></span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-center">

                                <!-- Detail -->
                                <a href="<?= base_url('buku/detail/' . $b['id_book']) ?>"
                                    class="btn btn-sm btn-outline-dark">
                                    Detail
                                </a>

                                <!-- ADMIN / PETUGAS -->
                                <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

                                    <a href="<?= base_url('buku/edit/' . $b['id_book']) ?>"
                                        class="btn btn-sm btn-warning text-white">
                                        Edit
                                    </a>

                                    <form action="<?= base_url('buku/delete/' . $b['id_book']) ?>"
                                        method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin hapus buku ini?')">

                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>

                                <?php endif; ?>

                                <!-- ANGGOTA -->
                                <?php if (session()->get('role') == 'anggota') : ?>

                                    <a href="<?= base_url('peminjaman/ajukan/' . $b['id_book']); ?>"
                                        class="btn btn-success btn-sm">
                                        Ajukan Pinjam
                                    </a>

                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>