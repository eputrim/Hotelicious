<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

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

    <div class="card mb-3 p-3 col-lg-8 mx-auto">
        <form class="user p-5" method="post" action="<?= base_url('user/bookprocess/') . $room['id'] ?>">
            <h4 class="text-center text-gray-800">
                <b>BOOKING FORM</b>
            </h4>
            <hr />
            <div class="form-group">
                <h5>
                    Full Name :
                </h5>
                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Visitor Full Name According to Identity Card (KTP)" value="<?= set_value('name'); ?>">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <h5>
                    Phone Number :
                </h5>
                <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder=" Visitor Phone Number" value="<?= set_value('phone'); ?>">
                <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <h5>
                    Email :
                </h5>
                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Visitor Email Address" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class=" form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h5>
                        Check-in Date :
                    </h5>
                    <input type="date" class="form-control form-control-user" id="checkin" , name="checkin" value="<?= set_value('checkin'); ?>">
                    <?= form_error('checkin', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-sm-6">
                    <h5>
                        Check-out Date :
                    </h5>
                    <input type="date" class="form-control form-control-user" id="checkout" , name="checkout" value="<?= set_value('checkout'); ?>">
                </div>
            </div>
            <hr />
            <div class="form-group row">
                <div class="col-sm-3">
                    <h5>Hotel Name</h5>
                </div>
                <div class="col-sm-1">
                    <h5>:</h5>
                </div>
                <div class="col-sm-8">
                    <h5><?= $hotel['name']; ?></h5>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <h5>Room Type</h5>
                </div>
                <div class="col-sm-1">
                    <h5>:</h5>
                </div>
                <div class="col-sm-8">
                    <h5><?= $room['name']; ?></h5>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <h5>Price <small><small class=>per night </small></small>
                    </h5>
                </div>
                <div class="col-sm-1">
                    <h5>:</h5>
                </div>
                <div class="col-sm-8 ">
                    <h5><?= rupiah($room['price']); ?></h5>
                </div>
            </div>
            <hr />

            <button type="submit" class="btn btn-primary btn-user btn-block">
                <b>BOOK</b>
            </button>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->