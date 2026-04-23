<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<div class="container py-5" style="max-width: 935px;">
    <div class="row align-items-start mb-5">

        <div class="col-4 text-center">
            <?php
            $fotoPath = 'uploads/users/' . $user['foto'];
            $src = (!empty($user['foto']) && file_exists(FCPATH . $fotoPath)) ? base_url($fotoPath) : base_url('img/default.jpg');
            ?>
            <img src="<?= $src ?>"
                class="rounded-circle border"
                style="width: 150px; height: 150px; object-fit: cover; padding: 3px; border: 2px solid #dbdbdb !important;">
        </div>

        <div class="col-8">
            <div class="d-flex align-items-center mb-3">
                <h3 class="fw-light mb-0 me-4" style="font-size: 28px;"><?= $user['username']; ?></h3>
                <a href="<?= base_url('users/edit/' . ($user['id'] ?? $user['id_user'])) ?>" class="btn btn-light border btn-sm fw-bold px-3">Edit profil</a>
                <i class="bi bi-gear-wide ms-3" style="font-size: 24px; cursor: pointer;"></i>
            </div>

            <div class="d-flex mb-3">
                <div class="me-4"><span class="fw-bold">12</span> buku dipinjam</div>
                <div class="me-4"><span class="fw-bold">414</span> poin</div>
                <div><span class="fw-bold">Admin</span> akses</div>
            </div>

            <div class="mt-2">
                <span class="fw-bold d-block"><?= $user['nama']; ?></span>
                <p class="text-secondary mb-0"><?= $user['email']; ?></p>
            </div>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-center">
        <div class="pt-3 border-top border-dark" style="margin-top: -1px;">
            <small class="fw-bold text-uppercase" style="letter-spacing: 1px;">
                <i class="bi bi-grid-3x3-gap"></i> Buku Saya
            </small>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #fafafa;
    }

    .btn-light {
        background-color: #efefef;
        border: 1px solid #dbdbdb !important;
    }

    .btn-light:hover {
        background-color: #dbdbdb;
    }
</style>