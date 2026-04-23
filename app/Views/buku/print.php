<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body onload="window.print()">
    <div class="container mt-5">
        <h2 class="text-center mb-4">LAPORAN DATA BUKU PERPUSTAKAAN</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis (ID)</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($daftar_buku as $b) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b['judul'] ?></td>
                        <td><?= $b['id_penulis'] ?></td>
                        <td><?= $b['tahun_terbit'] ?></td>
                        <td><?= $b['stok'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>