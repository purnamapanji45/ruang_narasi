<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Buku</h1>
        <a href="<?= base_url('buku'); ?>" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Koleksi
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <img src="<?= base_url('img/' . ($buku['sampul'] ?? 'default.jpg')); ?>"
                        class="img-fluid rounded shadow"
                        style="max-height: 450px;"
                        alt="Sampul Buku">
                </div>

                <div class="col-md-8">
                    <h2 class="font-weight-bold text-primary"><?= $buku['judul']; ?></h2>
                    <hr>
                    <table class="table table-borderless mt-3">
                        <tr>
                            <th width="180">Judul</th>
                            <td>: <?= $buku['judul']; ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>: <?= $buku['nama_kategori'] ?? 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>: <?= $buku['nama_penulis'] ?? 'Tidak diketahui'; ?></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>: <?= $buku['nama_penerbit'] ?? 'Tidak diketahui'; ?></td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td>: <?= $buku['nama_rak'] ?? 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>: <?= $buku['tahun_terbit']; ?></td>
                        </tr>
                        <tr>
                            <th>Stok Buku</th>
                            <td>:
                                <span class="badge bg-<?= ($buku['stok'] > 0 ? 'success' : 'danger'); ?> p-2">
                                    <?= $buku['stok']; ?> Tersedia
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4 p-3 bg-light rounded">
                        <h5>Sinopsis / Deskripsi :</h5>
                        <p class="text-muted">
                            <?= $buku['deskripsi'] ?? 'Belum ada deskripsi untuk buku ini.'; ?>
                        </p>
                    </div>

                    <div class="mt-4 d-grid gap-2 d-md-block">

                        <?php if ($buku['stok'] > 0) : ?>
                            <a href="<?= base_url('peminjaman/ajukan/' . $buku['id_book']) ?>"
                                class="btn btn-primary btn-lg shadow">
                                <i class="fas fa-bookmark"></i> Pinjam Buku Sekarang
                            </a>
                        <?php else : ?>
                            <button class="btn btn-secondary btn-lg" disabled>
                                Stok Habis
                            </button>
                        <?php endif; ?>

                    </div>

                    <a href="<?= base_url('buku/edit/' . $buku['id_book']); ?>" class="btn btn-warning btn-lg shadow text-white">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>