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
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
    ?>

    <?php foreach ($hotel as $h) : ?>

        <div class="card mb-3 p-3 col-lg-12">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/hotel/') . $h['image']; ?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title text-gray-800"><b><a href="<?= base_url('user/hoteldetail/') . $h['id']; ?>"><?= $h['name']; ?></a></b></h2>
                        <div class="text-warning">
                            <?php for ($i = 0; $i < $h['star']; $i++) { ?>
                                <i class="fas fa-star"></i>
                            <?php } ?>
                        </div>
                        <p class="card-text"><?= $h['location']; ?></p>
                        <hr />

                        <?php
                        $id = $h['id'];
                        $query = "SELECT `room`.`price`
                            FROM `room`
                            JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                            WHERE `room`.`hotel_id` = $id
                            GROUP BY `hotel`.`id` ASC LIMIT 1
                            ";
                        $room = $this->db->query($query)->row_array();
                        ?>

                        <p class="card-text text-danger text-right"><small>Start from</small></p>
                        <h4 class="card-text text-danger text-right"><b><?= rupiah($room['price']); ?></b>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->