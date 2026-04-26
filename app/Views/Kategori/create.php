<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h4>Tambah Kategori</h4>

<form action="<?= base_url('kategori/store') ?>" method="post">
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" required><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('kategori') ?>">Kembali</a>
</form>

<?= $this->endSection() ?>