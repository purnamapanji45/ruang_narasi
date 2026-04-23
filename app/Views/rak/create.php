<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Rak</h2>

<form action="<?= base_url('/rak/store') ?>" method="post">
    <label>Nama Rak</label><br>
    <input type="text" name="nama_rak" required><br><br>

    <label>Keterangan</label><br>
    <textarea name="keterangan"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="<?= base_url('/rak') ?>">Kembali</a>
<?= $this->endSection() ?>