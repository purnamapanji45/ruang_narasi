<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="container p-4">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold mb-4">Tambah Buku Baru</h4>
        <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Kategori (ID)</label>
                    <input type="number" name="id_kategori" class="form-control" placeholder="Isi ID dari tabel kategori" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Penulis (ID)</label>
                    <input type="number" name="id_penulis" class="form-control" placeholder="Isi ID dari tabel penulis" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Sampul Buku (Foto)</label>
                    <input type="file" name="sampul" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100">Simpan Buku</button>
            <form action="<?= base_url('buku/simpan'); ?>" method="post" enctype="multipart/form-data">
            </form>
    </div>
</div>
<?= $this->endSection() ?>