<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2 class="mb-4">Konfirmasi Pembayaran Denda</h2>

    <div class="card shadow">
        <div class="card-body">

            <table class="table">
                <tr>
                    <td>Nama Peminjam</td>
                    <td>: <?= $pinjam['nama_peminjam'] ?></td>
                </tr>
                <tr>
                    <td>Judul Buku</td>
                    <td>: <?= $pinjam['judul'] ?></td>
                </tr>
                <tr>
                    <td>Total Denda</td>
                    <td>: <b class="text-danger">Rp <?= number_format($denda) ?></b></td>
                </tr>
            </table>

            <form action="<?= base_url('peminjaman/proses_bayar/' . $pinjam['id_peminjaman']); ?>" method="post">

                <?= csrf_field(); ?>
                <input type="hidden" name="denda_nominal" value="<?= $denda; ?>">

                <button type="submit" class="btn btn-success">
                    ✔ Konfirmasi Lunas & Kembalikan Buku
                </button>

                <a href="<?= base_url('peminjaman'); ?>" class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>