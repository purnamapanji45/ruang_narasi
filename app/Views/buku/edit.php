<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="container p-4">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold mb-4">Edit Data Buku</h4>
        <form action="<?= base_url('buku/update/' . $buku['id_book']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sampulLama" value="<?= $buku['sampul'] ?>">
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?= $buku['judul'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Sampul (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="sampul" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning text-white">Update Buku</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>