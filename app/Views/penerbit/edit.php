<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">
    <h3>Edit Data Penerbit</h3>
    <hr>

    <form action="<?= base_url('penerbit/update/' . $penerbit['id']); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="<?= $penerbit['nama_penerbit']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat_penerbit" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat_penerbit" name="alamat_penerbit" rows="3" required><?= $penerbit['alamat_penerbit']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="telepon_penerbit" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon_penerbit" name="telepon_penerbit" value="<?= $penerbit['telepon_penerbit']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="<?= base_url('penerbit'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>