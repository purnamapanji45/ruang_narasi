<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3>Data Kategori</h3>

<a href="<?= base_url('kategori/create') ?>" class="btn btn-primary mb-3">Tambah</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($kategori as $k) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nama_kategori'] ?></td>
                <td>
                    <a href="<?= base_url('kategori/edit/' . $k['id_kategori']) ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="<?= base_url('kategori/delete/' . $k['id_kategori']) ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>