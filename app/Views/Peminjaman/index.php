<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Peminjaman</h1>
        <a href="<?= base_url('peminjaman/create'); ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> + Tambah Peminjaman
        </a>
    </div>

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">

                    <!-- THEAD -->
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- TBODY -->
                    <tbody>
                        <?php $i = 1;
                        foreach ($pinjam as $p) : ?>

                            <?php
                            // 🔥 HITUNG DENDA SEKALI SAJA
                            $jt = new DateTime($p['tanggal_kembali']);
                            $now = new DateTime();
                            $denda = 0;

                            if ($now > $jt && $p['status'] == 'dipinjam') {
                                $telat = $now->diff($jt)->days;
                                $denda = $telat * 2000;
                            }
                            ?>

                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $p['nama_peminjam']; ?></td>
                                <td><?= $p['judul']; ?></td>

                                <td class="text-center">
                                    <?= date('d/m/Y', strtotime($p['tanggal_pinjam'] ?? date('Y-m-d'))); ?>
                                </td>

                                <td class="text-center">
                                    <?= date('d/m/Y', strtotime($p['tanggal_kembali'])); ?>
                                </td>

                                <!-- STATUS -->
                                <td class="text-center">
                                    <?php if ($p['status'] == 'diajukan') : ?>
                                        <span class="badge bg-warning text-dark">Diajukan</span>
                                    <?php elseif ($p['status'] == 'dipinjam') : ?>
                                        <span class="badge bg-primary">Dipinjam</span>
                                    <?php else : ?>
                                        <span class="badge bg-success">Kembali</span>
                                    <?php endif; ?>
                                </td>

                                <!-- DENDA -->
                                <td class="text-center">
                                    <?php if ($denda > 0) : ?>
                                        <span class="text-danger fw-bold">
                                            Rp <?= number_format($denda); ?>
                                        </span>
                                    <?php else : ?>
                                        Rp 0
                                    <?php endif; ?>
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">

                                        <?php if ($p['status'] == 'diajukan') : ?>
                                            <a href="<?= base_url('peminjaman/setuju/' . $p['id_peminjaman']); ?>"
                                                class="btn btn-sm btn-success">
                                                Setuju
                                            </a>

                                        <?php elseif ($p['status'] == 'dipinjam') : ?>

                                            <?php if ($denda > 0) : ?>
                                                <a href="<?= base_url('peminjaman/bayar/' . $p['id_peminjaman']); ?>"
                                                    class="btn btn-sm btn-warning">
                                                    💰 Bayar
                                                </a>
                                            <?php else : ?>
                                                <a href="<?= base_url('peminjaman/selesai/' . $p['id_peminjaman']); ?>"
                                                    class="btn btn-sm btn-primary">
                                                    Selesai
                                                </a>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                        <a href="<?= base_url('peminjaman/nota/' . $p['id_peminjaman']); ?>"
                                            class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-printer me-3"></i>
                                        </a>

                                        <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data ini?')">
                                            <i class="bi bi-trash me-3"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>