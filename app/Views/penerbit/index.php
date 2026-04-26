<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h3>Data Penerbit</h3>

<table class="table table-bordered">

</table>
<a href="<?= base_url('penerbit/create'); ?>" class="btn btn-primary mb-3">Tambah Penerbit</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Penerbit</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($penerbit as $p) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $p['nama_penerbit']; ?></td>
                <td><?= $p['alamat_penerbit']; ?></td>
                <td><?= $p['telepon_penerbit']; ?></td>
                <td>
                    <a href="<?= base_url('penerbit/edit/' . $p['id']); ?>" class="btn btn-sm btn-warning">Edit</a>

                    <form action="<?= base_url('penerbit/delete/' . $p['id']); ?>" method="post" style="display:inline;">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                    </form>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>