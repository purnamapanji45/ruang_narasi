<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h3>Data Penulis</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penulis</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($penulis as $p) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_penulis'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>