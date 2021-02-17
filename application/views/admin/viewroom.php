<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
    ?>

    <div class="card mb-3 pt-3 col-lg-12">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-title"><?= $hotel['name']; ?></p>
                    <h2 class="card-title text-gray-800"><b><?= $room['name']; ?></b></h2>
                    <h3 class="card-text text-danger text-right"><b><?= rupiah($room['price']); ?></b></h3>
                    <hr />
                    <p class="card-text">Room Facilities:</small></p>
                    <div class="container">
                        <div class="row">
                            <?php foreach ($room_feature as $rf) : ?>
                                <div class="col-sm">
                                    <div class="text-center text-primary">
                                        <i class="<?= $rf['icon']; ?> fa-2x"></i><br>
                                    </div>
                                    <div class="text-center"><?= $rf['feature']; ?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 mx-auto">
        <a href="<?= base_url('admin/room') ?>"><u>Back</u></a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->