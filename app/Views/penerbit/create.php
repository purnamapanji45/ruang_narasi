<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-3">
    <h3>Tambah Data Penerbit</h3>
    <hr>

    <form action="<?= base_url('penerbit/store'); ?>" method="post">
        <?= csrf_field(); ?> <div class="mb-3">
            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required autofocus>
        </div>


        <button type="submit" class="btn btn-success">Simpan Data</button>
        <a href="<?= base_url('penerbit'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>