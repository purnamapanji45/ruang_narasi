<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Form Pinjam Buku</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('peminjaman/save'); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label>Peminjam (Member)</label>
                    <select name="id_user" class="form-control" required>
                        <option value="">-- Pilih Peminjam --</option>
                        <?php foreach ($users as $u) : ?>
                            <option value="<?= $u['id']; ?>">
                                <?= $u['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Buku yang Dipinjam</label>
                    <select name="id_book" class="form-control" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($buku as $b) : ?>
                            <option value="<?= $b['id_book']; ?>"><?= $b['judul']; ?> (Sisa Stok: <?= $b['stok']; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Kembali (Deadline)</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Konfirmasi Pinjaman</button>
                <a href="<?= base_url('peminjaman'); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>