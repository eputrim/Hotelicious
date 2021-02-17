<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="col-lg-8 mx-auto">

        <div class="card mb-3 p-5">
            <h5 class="text-center">
                User Information
            </h5>
            <hr />
            <div class="row no-gutters">
                <div class="col-md-1"> </div>
                <div class="col-md-4">
                    <div class="m-3">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title text-gray-800"><b><?= $user['name']; ?></b></h3>
                        <p class="card-text"><?= $user['email']; ?></p>
                        <p class="card-text"><i class="fas fa-birthday-cake"></i> <?= date('d F Y', strtotime($user['birthdate'])); ?></p>
                        <hr />
                        <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="<?= base_url('user/edit') ?>"><u>Edit My Profile</u></a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->