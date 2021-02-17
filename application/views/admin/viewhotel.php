<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 pt-3 col-lg-12">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/hotel/') . $hotel['image']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title text-gray-800"><b><?= $hotel['name']; ?></b></h2>
                    <div class="text-warning">
                        <?php for ($i = 0; $i < $hotel['star']; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                    </div>
                    <p class="card-text"><small class="text-muted"><?= $hotel['location']; ?></small></p>
                    <hr />
                    <p class="card-text">Hotel Facilities:</small></p>
                    <div class="container">
                        <div class="row">
                            <?php foreach ($hotel_feature as $hf) : ?>
                                <div class="col-sm">
                                    <div class="text-center text-primary">
                                        <i class="<?= $hf['icon']; ?> fa-2x"></i><br>
                                    </div>
                                    <div class="text-center"><?= $hf['feature']; ?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 mx-auto">
        <a href="<?= base_url('admin/hotel') ?>"><u>Back</u></a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->