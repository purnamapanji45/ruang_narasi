<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white text-center py-3">
                    <h4 class="fw-bold mb-0">Daftar Akun ES</h4>
                    <small class="text-muted">Buat akun baru untuk masuk sistem</small>
                </div>

                <div class="card-body p-4">

                    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="username login" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>

                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required>

                                <span class="input-group-text" onclick="togglePassword('password', this)" style="cursor:pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password</label>

                            <div class="input-group">
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Ulangi password" required>

                                <span class="input-group-text" onclick="togglePassword('confirmpassword', this)" style="cursor:pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="anggota">Anggota</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        <!-- hidden role biar otomatis anggota -->
                        <input type="hidden" name="role" value="anggota">

                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill">
                            Daftar Sekarang
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
<?= $this->endSection() ?>