<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Rak</h1>
        <a href="<?= base_url('/rak/create') ?>" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus"></i> Tambah Rak
        </a>
    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- CARD -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="50">No</th>
                            <th>Nama Rak</th>
                            <th>Keterangan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($rak)) : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Data rak belum tersedia
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php $no = 1;
                        foreach ($rak as $r) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $r['nama_rak'] ?></td>
                                <td><?= $r['keterangan'] ?></td>
                                <td class="text-center">

                                    <a href="<?= base_url('/rak/edit/' . $r['id_rak']) ?>"
                                        class="btn btn-warning btn-sm text-white">
                                        <i class="bi bi-pencil me-3"></i>
                                    </a>

                                    <a href="<?= base_url('/rak/delete/' . $r['id_rak']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="bi bi-trash me-3"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>