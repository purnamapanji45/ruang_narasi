<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h3>Data Kategori</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($kategori as $k) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nama_kategori'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>