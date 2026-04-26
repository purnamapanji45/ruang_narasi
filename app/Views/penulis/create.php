<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h4>Tambah Penulis</h4>

<form action="<?= base_url('penulis/store') ?>" method="post">
    <label>Nama Penulis</label><br>
    <input type="text" name="nama_penulis" required><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('penulis') ?>">Kembali</a>
</form>

<?= $this->endSection() ?>