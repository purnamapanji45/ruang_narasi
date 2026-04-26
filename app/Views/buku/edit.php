<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container p-4">
    <div class="card border-0 shadow-sm p-4">
        <h4 class="fw-bold mb-4">Edit Data Buku</h4>

        <form action="<?= base_url('buku/update/' . $buku['id_book']) ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="sampulLama" value="<?= $buku['sampul'] ?>">

            <div class="row">

                <!-- Judul -->
                <div class="col-md-6 mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="<?= $buku['judul'] ?>" required>
                </div>

                <!-- KATEGORI -->
                <div class="col-md-6 mb-3">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori'] ?>"
                                <?= $k['id_kategori'] == $buku['id_kategori'] ? 'selected' : '' ?>>
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
                            <option value="<?= $p['id_penulis'] ?>"
                                <?= $p['id_penulis'] == $buku['id_penulis'] ? 'selected' : '' ?>>
                                <?= $p['nama_penulis'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- PENERBIT -->
                <div class="col-md-6 mb-3">
                    <label>Penerbit</label>
                    <select name="id_penerbit" class="form-control" required>
                        <option value="">-- Pilih Penerbit --</option>
                        <?php foreach ($penerbit as $p) : ?>
                            <option value="<?= $p['id'] ?>"
                                <?= $p['id'] == $buku['id_penerbit'] ? 'selected' : '' ?>>
                                <?= $p['nama_penerbit'] ?>
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
                            <option value="<?= $r['id_rak'] ?>"
                                <?= $r['id_rak'] == $buku['id_rak'] ? 'selected' : '' ?>>
                                <?= $r['nama_rak'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tahun -->
                <div class="col-md-3 mb-3">
                    <label>Tahun</label>
                    <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit'] ?>" required>
                </div>

                <!-- Stok -->
                <div class="col-md-3 mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $buku['stok'] ?>" required>
                </div>

                <!-- Sampul -->
                <div class="col-md-12 mb-3">
                    <label>Sampul (kosongkan jika tidak diganti)</label>
                    <input type="file" name="sampul" class="form-control">

                    <?php if ($buku['sampul']) : ?>
                        <br>
                        <img src="<?= base_url('img/' . $buku['sampul']) ?>" width="100">
                    <?php endif; ?>
                </div>

            </div>

            <button type="submit" class="btn btn-warning text-white w-100">Update Buku</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>