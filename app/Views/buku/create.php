<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container p-4">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold mb-4">Tambah Buku Baru</h4>

        <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">

                <!-- Judul -->
                <div class="col-md-6 mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Sinopsis / Deskripsi :</label>
                    <input type="text" name="sinopsis" class="form-control" required>
                </div>

                <!-- KATEGORI -->
                <div class="col-md-6 mb-3">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori'] ?>">
                                <?= $k['nama_kategori'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- PENULIS -->
                <div class="col-md-6 mb-3">
                    <label>Penulis</label>
                    <select name="id_penulis" class="form-control" required>
                        <option value="">-- Pilih Penulis --</option>
                        <?php foreach ($penulis as $p) : ?>
                            <option value="<?= $p['id_penulis'] ?>">
                                <?= $p['nama_penulis'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- PENERBIT -->
                <div class="col-md-6 mb-3">
                    <label for="id_penerbit" class="form-label">Penerbit</label>

                    <select name="id_penerbit" id="id_penerbit" class="form-control" required>
                        <option value="">-- Pilih Penerbit --</option>

                        <?php foreach ($penerbit as $p) : ?>
                            <option value="<?= $p['id'] ?>">
                                <?= esc($p['nama_penerbit']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <!-- RAK -->
                <div class="col-md-6 mb-3">
                    <label>Rak</label>
                    <select name="id_rak" class="form-control" required>
                        <option value="">-- Pilih Rak --</option>
                        <?php foreach ($rak as $r) : ?>
                            <option value="<?= $r['id_rak'] ?>">
                                <?= $r['nama_rak'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tahun -->
                <div class="col-md-3 mb-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>

                <!-- Stok -->
                <div class="col-md-3 mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                <!-- Sampul -->
                <div class="col-md-12 mb-3">
                    <label>Sampul Buku</label>
                    <input type="file" name="sampul" class="form-control">
                </div>

            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Buku</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>