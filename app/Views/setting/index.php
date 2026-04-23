<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <h3 class="fw-bold mb-4">⚙️ Pengaturan Akun</h3>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('pesan') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row">

        <!-- EDIT PROFIL -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">

                <h5 class="mb-3">Edit Profil</h5>

                <form action="<?= base_url('setting/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Foto Profil</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <button class="btn btn-primary w-100">
                        Simpan Perubahan
                    </button>
                </form>

            </div>
        </div>

        <!-- GANTI PASSWORD -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">

                <h5 class="mb-3">Ganti Password</h5>

                <form action="<?= base_url('setting/password') ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="mb-2">
                        <label>Password Lama</label>
                        <input type="password" name="password_lama" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="password_baru" class="form-control">
                    </div>

                    <button class="btn btn-danger w-100">
                        Update Password
                    </button>
                </form>

            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>