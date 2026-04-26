<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h3>Data Penulis</h3>
<a href="<?= base_url('penulis/create') ?>" class="btn btn-primary mb-3">Tambah</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penulis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($penulis as $p) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_penulis'] ?></td>
                <td>
                    <a href="<?= base_url('penulis/edit/' . $p['id_penulis']) ?>" class="btn btn-sm btn-primary">Edit</a>

                    <form action="<?= base_url('penulis/delete/' . $p['id_penulis']) ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>