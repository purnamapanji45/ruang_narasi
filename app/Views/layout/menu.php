<div class="sidebar p-3 d-flex flex-column">

    <!-- LOGO -->
    <div class="p-3 text-center mb-3">
        <div class="bg-white bg-opacity-10 rounded-4 py-3 border border-white border-opacity-10">
            <h4 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: #fff; letter-spacing: 2px;">
                <i class="bi bi-bank2 d-block mb-2 fs-3 text-warning"></i>
                PERPUS
            </h4>
            <small class="text-white-50" style="font-size: 10px;">RUANG NARASI v1.0</small>
        </div>
    </div>

    <!-- MENU -->
    <ul class="nav nav-pills flex-column mb-auto px-2">

        <!-- DASHBOARD -->
        <li class="nav-item mb-2">
            <a href="<?= base_url('home') ?>"
                class="nav-link <?= (uri_string() == 'home' || uri_string() == 'dashboard') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                <i class="bi bi-speedometer2 me-3"></i> Dashboard
            </a>
        </li>

        <!-- ADMIN + PETUGAS -->
        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

            <li class="nav-item mb-2">
                <a href="<?= base_url('buku') ?>"
                    class="nav-link <?= (uri_string() == 'buku') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-book me-3"></i> Data Buku
                </a>
            </li>
            <?php if (session()->get('role') == 'admin') : ?>
                <li class="nav-item mb-2">
                    <a href="<?= base_url('rak') ?>"
                        class="nav-link <?= (uri_string() == 'rak') ? 'active bg-warning text-dark fw-bold' : '' ?> py-3 px-4">
                        <i class="bi bi-book me-3"></i> Rak
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item mb-2">
                <a href="<?= base_url('peminjaman') ?>"
                    class="nav-link <?= (uri_string() == 'peminjaman') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-arrow-left-right me-3"></i> Peminjaman
                </a>
            </li>

        <?php endif; ?>

        <!-- ADMIN ONLY -->
        <?php if (session()->get('role') == 'admin') : ?>

            <div class="text-white-50 small fw-bold mt-4 mb-2 px-4"
                style="font-size: 11px; letter-spacing: 1px;">
                MANAGEMENT
            </div>

            <li class="nav-item mb-2">
                <a href="<?= base_url('users') ?>"
                    class="nav-link <?= (uri_string() == 'users') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-people me-3"></i> Data Users
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="<?= base_url('laporan') ?>"
                    class="nav-link <?= (uri_string() == 'laporan') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-file-earmark-bar-graph me-3"></i> Laporan
                </a>
            </li>

        <?php endif; ?>

        <!-- ANGGOTA -->
        <?php if (session()->get('role') == 'anggota') : ?>

            <li class="nav-item mb-2">
                <a href="<?= base_url('katalog') ?>"
                    class="nav-link <?= (uri_string() == 'katalog') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-search me-3"></i> Katalog Buku
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="<?= base_url('anggota/pinjaman_saya') ?>"
                    class="nav-link <?= (uri_string() == 'anggota/pinjaman_saya') ? 'active bg-warning text-dark fw-bold' : 'text-white-50' ?> py-3 px-4">
                    <i class="bi bi-clock-history me-3"></i> Pinjaman Saya
                </a>
            </li>

        <?php endif; ?>

    </ul>

    <!-- LOGOUT -->
    <div class="mt-auto px-3 pb-4">
        <a href="<?= base_url('logout') ?>"
            class="btn btn-outline-danger w-100 rounded-4 py-2 border-0 bg-danger bg-opacity-10">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
        </a>
    </div>

</div>
<style>
    /* CSS Tambahan khusus Sidebar biar lebih JEDER */
    .sidebar .nav-link {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .sidebar .nav-link:hover:not(.active) {
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff !important;
        transform: translateX(8px);
    }

    .sidebar .nav-link.active {
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    /* Garis HR Custom */
    hr {
        border-color: rgba(255, 255, 255, 0.1);
    }
</style>