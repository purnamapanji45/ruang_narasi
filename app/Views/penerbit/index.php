<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h3>Data Penerbit</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>penerbit</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($penerbit as $p) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_penerbit'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>