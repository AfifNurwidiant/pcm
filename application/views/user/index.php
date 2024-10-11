<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <!-- Cek apakah $user ada dan gambar tersedia -->
                <img src="<?= isset($user) && !empty($user['image']) ? base_url('assets12/img/profile/') . $user['image'] : base_url('assets12/img/profile/default.png'); ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Cek apakah $user ada -->
                    <h5 class="card-title"><?= isset($user) ? $user['name'] : 'Nama Tidak Ditemukan'; ?></h5>
                    <p class="card-text"><?= isset($user) ? $user['email'] : 'Email Tidak Ditemukan'; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= isset($user) ? date('d F Y', $user['date_created']) : 'Tanggal Tidak Ditemukan'; ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->