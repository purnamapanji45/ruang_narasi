<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman - Ruang Narasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">LAPORAN PEMINJAMAN BUKU</h2>
            <h4 class="text-primary">Perpustakaan Digital Ruang Narasi</h4>
            <p class="text-muted">Tanggal Cetak: <?= date('d F Y') ?></p>
            <hr>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($peminjaman as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nama_peminjam'] ?></td>
                        <td><?= $p['judul'] ?></td>
                        <td><?= $p['tanggal_pinjam'] ?></td>
                        <td><?= $p['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row mt-5">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>Mengetahui,</p>
                <br><br>
                <p class="fw-bold text-decoration-underline"><?= session()->get('nama') ?></p>
                <p>Manager Perpustakaan</p>
            </div>
        </div>

        <button class="btn btn-dark no-print" onclick="window.history.back()">Kembali</button>
    </div>
</body>

</html>