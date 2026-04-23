<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid p-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">📦 Data Rak Buku</h5>
            <button class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Rak
            </button>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Rak</th>
                        <th>Lokasi / Keterangan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($rak as $r) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><b><?= $r['nama_rak']; ?></b></td>
                            <td><?= $r['lokasi']; ?></td>
                            <td>
                                <a href="<?= base_url('rak/hapus/' . $r['id_rak']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('rak/simpan'); ?>" method="post" class="modal-content form-simpan">
            <?= csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title">Tambah Rak Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Rak</label>
                    <input type="text" name="nama_rak" class="form-control" placeholder="Contoh: Rak A1" required>
                </div>

                <div class="mb-3">
                    <label>Lokasi / Baris</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lantai 1 - Sayap Kanan" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-simpan">
                    <span class="spinner-border spinner-border-sm d-none"></span>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= SCRIPT LOADING ================= -->
<script>
    document.querySelectorAll(".form-simpan").forEach(form => {
        form.addEventListener("submit", function() {
            let btn = form.querySelector(".btn-simpan");
            let spinner = btn.querySelector(".spinner-border");

            btn.disabled = true;
            spinner.classList.remove("d-none");
        });
    });
</script>

<?= $this->endSection(); ?>