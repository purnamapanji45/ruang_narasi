<?= $this->extend('layout/main'); ?> <?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-white">
            <h5 class="mb-0">💰 Pembayaran Denda</h5>
        </div>
        <div class="card-body">

            <table class="table table-borderless">
                <tr>
                    <td width="200">Nama Peminjam</td>
                    <td>: <b><?= $pinjam['nama_peminjam']; ?></b></td>
                </tr>
                <tr>
                    <td>Judul Buku</td>
                    <td>: <?= $pinjam['judul']; ?></td>
                </tr>
                <tr>
                    <td>Total Denda</td>
                    <td>: <b class="text-danger">Rp <?= number_format($denda); ?></b></td>
                </tr>
            </table>

            <hr>

            <form action="<?= base_url('peminjaman/upload_bukti/' . $pinjam['id_peminjaman']); ?>" method="post" enctype="multipart/form-data">

                <?= csrf_field(); ?>

                <input type="hidden" name="denda_nominal" value="<?= $denda; ?>">

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_bayar" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="transfer">Transfer Bank (DANA/Rekening)</option>
                        <option value="qris">QRIS (Scan Barcode)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_bayar" class="form-control" required>
                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        ✔ Kirim Bukti Pembayaran
                    </button>

                    <a href="<?= base_url('anggota/pinjaman_saya'); ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>