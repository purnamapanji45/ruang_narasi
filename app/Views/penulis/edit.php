<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Edit Penulis</h4>

    <form action="<?= base_url('penulis/update/' . $penulis['id_penulis']) ?>" method="post">

        <div class="mb-3">
            <label>Nama Penulis</label>
            <input type="text" name="nama_penulis" class="form-control"
                value="<?= $penulis['nama_penulis'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('penulis') ?>" class="btn btn-secondary">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>