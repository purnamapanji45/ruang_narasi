<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container p-4">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark"><i class="bi bi-file-earmark-pdf-fill text-danger"></i> Laporan Inventaris Buku</h3>
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-printer-fill me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul Buku</th>
                        <th>id_penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($buku as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="<?= base_url('img/' . $b['sampul']); ?>" width="50">
                            </td>
                            <td><?= $b['judul']; ?></td>
                            <td><?= $b['id_penulis']; ?></td>
                            <td><?= $b['tahun_terbit']; ?></td>
                            <td>
                                <span class="badge bg-success"><?= $b['stok']; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>