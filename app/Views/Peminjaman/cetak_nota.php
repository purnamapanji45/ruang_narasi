<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nota Peminjaman - Ruang Narasi</title>
    <style>
        /* Desain Nota */
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
        }

        .nota-container {
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #000;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }

        .content {
            margin-top: 15px;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            border-top: 1px dashed #000;
            padding-top: 10px;
            font-size: 12px;
        }

        .table {
            width: 100%;
        }

        .table td {
            padding: 5px 0;
        }

        /* Tombol - Tidak akan tercetak di kertas */
        .no-print {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 15px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 13px;
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-print {
            background-color: #28a745;
        }

        @media print {
            .no-print {
                display: none;
            }

            .nota-container {
                border: none;
                margin: 0;
                width: 100%;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="nota-container">
        <div class="header">
            <strong>RUANG NARASI</strong><br>
            Perpustakaan Digital<br>
            <small><?= date('d/m/Y H:i'); ?></small>
        </div>

        <div class="content">
            <table class="table">
                <tr>
                    <td>Peminjam</td>
                    <td>: <strong><?= $pinjam['nama_peminjam']; ?></strong></td>
                </tr>
                <tr>
                    <td>Buku</td>
                    <td>: <?= $pinjam['judul']; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>: <strong><?= strtoupper($pinjam['status']); ?></strong></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            Terima Kasih Telah Berkunjung<br>
            - Harap Kembalikan Tepat Waktu -
        </div>
    </div>

    <div class="no-print">
        <button class="btn btn-print" onclick="window.print()">Cetak Nota</button>
        <a href="<?= base_url('peminjaman'); ?>" class="btn btn-back">Kembali ke Data Peminjaman</a>
    </div>

</body>

</html>