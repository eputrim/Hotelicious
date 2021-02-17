<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>


    <?php
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ".", ".");
        return $hasil_rupiah;
    }
    ?>

    <div class="row">
        <div class="col-lg-12">

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center align-middle text-gray-800">#</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Booking Date</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Hotel Name</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Room Type</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Duration</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Check-in Date</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Check-out Date</th>
                        <th scope="col" class="text-center align-middle text-gray-800">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($orders as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td class="text-center align-middle"><?= date('d F Y', $o['order_date']); ?></td>
                            <td class="text-center align-middle">
                                <?php
                                $room = $this->db->get_where('room', ['id' => $o['room_id']])->row_array();
                                $hotel = $this->db->get_where('hotel', ['id' => $room['hotel_id']])->row_array();
                                ?>
                                <?= $hotel['name']; ?>
                            </td>
                            <td class="text-center align-middle">
                                <?= $room['name']; ?>
                            </td>
                            <td class="text-center align-middle"><?= $o['duration']; ?> day</td>
                            <td class="text-center align-middle"><?= $o['check_in']; ?></td>
                            <td class="text-center align-middle"><?= $o['check_out']; ?></td>
                            <td class="text-center align-middle"><?= rupiah($o['price']); ?></td>
                            <td class="text-center align-middle">
                                <a href="<?= base_url('user/vieworders/') . $o['id']; ?>" class="badge badge-warning">Detail</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newHotelModal" tabindex="-1" role="dialog" aria-labelledby="newHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newHotelModalLabel">Add New Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addhotel'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Hotel Name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Hotel Address">
                        <?= form_error('location', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City">
                        <?= form_error('city', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="star">Star : </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="star" id="star" value="1">
                            <label class="form-check-label" for="star">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="star" id="star" value="2">
                            <label class="form-check-label" for="star">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="star" id="star" value="3">
                            <label class="form-check-label" for="star">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="star" id="star" value="4">
                            <label class="form-check-label" for="star">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="star" id="star" value="5" checked>
                            <label class="form-check-label" for="star">5</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>