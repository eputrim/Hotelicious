<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b>Hotel Detail</b></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
    ?>

    <div class="card mb-3 p-3 col-lg-12">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/hotel/') . $hotel['image']; ?>" class="card-img-top" alt="...">
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
        <hr />
        <h4 class="text-center"><b>Our Rooms:</b></h4>
        <br />
        <div class="card-deck">
            <?php foreach ($room as $r) : ?>
                <div class="card">
                    <img src="<?= base_url('assets/img/room/') . $r['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h3 class="card-title text-gray-800"><b><?= $r['name'] ?></b></h3>
                        <p class="card-text text-danger"><b><?= rupiah($r['price']); ?></b></p>
                        <a href="<?= base_url('user/roomdetail/') . $r['id']; ?>" class="card-text btn btn-outline-primary">View Details</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->