<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <h3 class="mb-4 fw-bold">📖 Buku yang Saya Pinjam</h3>

    <!-- ✅ NOTIFIKASI -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Sampul</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($pinjaman)) : ?>
                            <?php foreach ($pinjaman as $p) : ?>

                                <?php
                                $tgl_kembali = new DateTime($p['tanggal_kembali']);
                                $today = new DateTime(date('Y-m-d'));

                                $denda = 0;
                                if ($today > $tgl_kembali && $p['status'] == 'dipinjam') {
                                    $telat = $today->diff($tgl_kembali)->days;
                                    $denda = $telat * 2000;
                                }
                                ?>

                                <tr>

                                    <!-- Sampul -->
                                    <td>
                                        <img src="<?= base_url('img/' . ($p['sampul'] ?? 'default_cover.jpg')); ?>"
                                            width="50"
                                            class="rounded shadow-sm">
                                    </td>

                                    <!-- Judul -->
                                    <td class="fw-semibold">
                                        <?= esc($p['judul']); ?>
                                    </td>

                                    <!-- Tanggal Pinjam -->
                                    <td>
                                        <?= date('d-m-Y', strtotime($p['tanggal_pinjam'])); ?>
                                    </td>

                                    <!-- Batas Kembali -->
                                    <td class="fw-bold <?= ($today > $tgl_kembali ? 'text-danger' : '') ?>">
                                        <?= date('d-m-Y', strtotime($p['tanggal_kembali'])); ?>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <?php if ($p['status'] == 'diajukan') : ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>

                                        <?php elseif ($p['status'] == 'dipinjam') : ?>
                                            <span class="badge bg-primary">Dipinjam</span>

                                        <?php elseif ($p['status'] == 'kembali') : ?>
                                            <span class="badge bg-success">Dikembalikan</span>

                                        <?php endif; ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td>
                                        <?php if ($p['status'] == 'dipinjam'): ?>

                                            <?php if ($today > $tgl_kembali): ?>
                                                <!-- 🔴 TELAT -->
                                                <a href="<?= base_url('anggota/bayar/' . $p['id_peminjaman']); ?>"
                                                    class="btn btn-danger btn-sm">
                                                    🔥 Bayar Denda
                                                </a>

                                                <div class="small text-danger mt-1">
                                                    Denda: Rp <?= number_format($denda); ?>
                                                </div>

                                            <?php else: ?>
                                                <!-- 🟢 BELUM TELAT -->
                                                <span class="badge bg-success">Masih Dipinjam</span>
                                            <?php endif; ?>

                                        <?php elseif ($p['status'] == 'kembali'): ?>

                                            <span class="badge bg-secondary">Selesai</span>

                                        <?php elseif ($p['status'] == 'diajukan'): ?>

                                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>

                                        <?php endif; ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data pinjaman
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>