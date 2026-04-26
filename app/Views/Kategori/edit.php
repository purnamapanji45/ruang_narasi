<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Edit Kategori</h4>

    <form action="<?= base_url('kategori/update/' . $kategori['id_kategori']) ?>" method="post">

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control"
                value="<?= $kategori['nama_kategori'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>