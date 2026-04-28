<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .card-stats {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 5px solid #0d6efd;
        /* Biru Persib/Barca */
    }

    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .book-card {
        transition: all 0.3s ease;
        border: none;
    }

    .book-card:hover {
        transform: scale(1.03);
    }

    .btn-pinjam {
        background: linear-gradient(45deg, #052c65, #0d6efd);
        border: none;
        color: white;
    }

    .btn-pinjam:hover {
        background: linear-gradient(45deg, #0d6efd, #052c65);
        color: white;
    }

    .bg-perpustakaan {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
            url('https://source.unsplash.com/1600x900/?library,books');
        background-size: cover;
    }
</style>

<div class="container-fluid p-4 bg-perpustakaan" style="min-height: 100vh;">

    <div class="mb-5 p-4 rounded-4 shadow-sm bg-white border-start border-primary border-5">
        <h2 class="fw-bold text-dark" style="font-family: 'Playfair Display', serif;">
            <i class="bi bi-stars text-warning"></i> Selamat Datang, <?= session()->get('nama') ?>.
        </h2>
        <p class="text-muted">Selamat datang di Ruang Narasi. Temukan keajaiban dalam setiap halaman hari ini.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-stats shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-book-half text-primary fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Koleksi Buku</small>
                        <h4 class="fw-bold mb-0 text-primary"><?= $total_buku ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats shadow-sm rounded-4 p-3 bg-white" style="border-left-color: #198754;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-people-fill text-success fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Anggota Aktif</small>
                        <h4 class="fw-bold mb-0 text-success"><?= $total_user ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats shadow-sm rounded-4 p-3 bg-white" style="border-left-color: #ffc107;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-arrow-clockwise text-warning fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Pinjaman</small>
                        <h4 class="fw-bold mb-0 text-warning"><?= $total_pinjam ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats shadow-sm rounded-4 p-3 bg-white" style="border-left-color: #0dcaf0;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-tags-fill text-info fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Kategori</small>
                        <h4 class="fw-bold mb-0 text-info"><?= $total_kategori ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark"><i class="bi bi-journal-bookmark-fill me-2"></i>Rekomendasi King Perpustakaan</h4>
        <a href="<?= base_url('buku') ?>" class="btn btn-primary rounded-pill px-4 shadow-sm">Lihat Semua Koleksi</a>
    </div>

    <div class="row g-4">
        <?php if (!empty($all_books)) : ?>
            <?php foreach ($all_books as $b) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card book-card h-100 shadow-sm rounded-4 overflow-hidden bg-white">

                        <div class="position-relative">
                            <?php $foto_buku = (!empty($b['sampul'])) ? $b['sampul'] : 'default_cover.jpg'; ?>
                            <img src="<?= base_url('img/' . $foto_buku) ?>"
                                class="card-img-top"
                                style="height: 350px; object-fit: cover;"
                                alt="Sampul">

                            <div class="position-absolute bottom-0 start-0 m-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2 shadow">
                                    <i class="bi bi-check-circle-fill me-1"></i> <?= ($b['stok'] > 0) ? 'Tersedia' : 'Habis' ?>
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bold text-dark mb-1 text-truncate" title="<?= $b['judul'] ?>">
                                <?= $b['judul'] ?>
                            </h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-person-circle me-1"></i> ID Penulis: <?= $b['id_penulis']; ?>
                            </p>

                            <div class="d-grid">
                                <?php if ($b['stok'] > 0) : ?>

                                    <?php
                                    $url = (session()->get('role') == 'anggota')
                                        ? 'katalog/detail/'
                                        : 'buku/detail/';
                                    ?>

                                    <a href="<?= base_url($url . $b['id_book']) ?>"
                                        class="btn btn-pinjam rounded-pill py-2 fw-bold">
                                        LIHAT DETAIL
                                    </a>
                                <?php else : ?>
                                    <button class="btn btn-light rounded-pill py-2 text-muted" disabled>STOK HABIS</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-emoji-frown text-muted fs-1"></i>
                    <p class="text-muted mt-3">Belum ada koleksi buku, ayo tambah dulu!</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>