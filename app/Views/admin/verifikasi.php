<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3>Verifikasi Pembayaran</h3>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Buku</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($pembayaran)) : ?>
            <?php foreach ($pembayaran as $p) : ?>
                <tr>
                    <td><?= $p['nama_peminjam']; ?></td>
                    <td><?= $p['judul']; ?></td>

                    <!-- BUKTI -->
                    <td>
                        <?php if (!empty($p['bukti_bayar'])) : ?>
                            <a href="<?= base_url('uploads/bukti/' . $p['bukti_bayar']); ?>" target="_blank">
                                <img src="<?= base_url('uploads/bukti/' . $p['bukti_bayar']); ?>"
                                    width="80" class="img-thumbnail">
                            </a>
                        <?php else : ?>
                            <span class="text-muted">Belum ada bukti</span>
                        <?php endif; ?>
                    </td>

                    <!-- STATUS -->
                    <td>
                        <?php if ($p['status_pembayaran'] == 'lunas') : ?>
                            <span class="badge bg-success">Lunas</span>
                        <?php else : ?>
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php endif; ?>
                    </td>

                    <!-- AKSI -->
                    <td>
                        <?php if ($p['status_pembayaran'] != 'lunas') : ?>
                            <a href="<?= base_url('peminjaman/setujui_bayar/' . $p['id_peminjaman']); ?>"
                                class="btn btn-success btn-sm">
                                <i class="bi bi-check-circle"></i> Setujui
                            </a>
                        <?php else : ?>
                            <span class="text-success fw-bold">Sudah disetujui</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data pembayaran yang perlu diverifikasi.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>