<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
    </div>

    <?php
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
    ?>

    <div class="card mb-3 p-5 col-lg-8 mx-auto">
        <h3 class="text-center text-gray-800"><b>BOOKING SUMMARY</b></h3>
        <small class="text-center"><?= date('d F Y', $booking['order_date']); ?></small>
        <hr /><br />
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Full Name</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $booking['name']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Phone Number</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $booking['phone']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Email</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $booking['email']; ?></p>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Hotel Name</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-6">
                <p><?= $hotel['name']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Room Type</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $room['name']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Check-in Date</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $booking['check_in']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Check-out Date</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= $booking['check_out']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Price per Night</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p><?= rupiah($room['price']); ?> x <?= $booking['duration']; ?> days</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <p>Payment Method</p>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <p>Pay at Hotel</p>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-3">
                <b>Final Price</b>
            </div>
            <div class="col-sm-1">:</div>
            <div class="col-sm-4">
                <h4><b><?= rupiah($booking['price']); ?></b></h4>
            </div>
        </div>
    </div>

    <div class="col-sm-2 mx-auto">
        <a href="<?= base_url('user/orders') ?>"><u>See All Booking</u></a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->