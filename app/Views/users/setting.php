<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">

    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-gear-fill me-2 text-secondary"></i> Pengaturan Sistem</h3>
        <a href="javascript:window.history.back();" class="btn btn-light btn-sm rounded-pill px-3 border">
            <i class="bi bi-chevron-left me-1"></i> Kembali
        </a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">⚙️ Konfigurasi Umum</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Perpustakaan</label>
                        <input type="text" class="form-control" value="Ruang Narasi" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Versi Aplikasi</label>
                        <input type="text" class="form-control" value="v1.0.2-Beta" disabled>
                    </div>
                    <div class="alert alert-info border-0 small">
                        <i class="bi bi-info-circle-fill me-2"></i> Pengaturan ini hanya bisa diubah oleh Super Admin es.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">🔒 Keamanan Akun</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Mau ganti password? Klik tombol di bawah es.</p>
                    <a href="<?= base_url('profile') ?>" class="btn btn-outline-danger w-100 py-2 rounded-3">
                        <i class="bi bi-shield-lock me-2"></i> Ganti Password Sekarang
                    </a>
                    <i class="bi bi-shield-lock me-2"></i> Ganti Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>