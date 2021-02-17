<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>


    <div class="row">
        <div class="col-lg-10">

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoomModal">Add New Room</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hotel Name</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($room as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <?php $hotel = $this->db->get_where('hotel', ['id' => $r['hotel_id']])->row_array(); ?>
                                <?= $hotel['name']; ?>
                            </td>
                            <td><?= $r['name']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/facilitytoroom/') . $r['id']; ?>" class="badge badge-primary">add facilitiy</a>
                                <a href="<?= base_url('admin/viewroom/') . $r['id']; ?>" class="badge badge-warning">view</a>
                                <a href="<?= base_url('admin/editroom/') . $r['id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('admin/deleteroom/') . $r['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoomModalLabel">Add New Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addroom'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="hotel_id" id="hotel_id" class="form-control">
                            <option value="">Select Hotel</option>
                            <?php foreach ($hotel1 as $h) : ?>
                                <option value="<?= $h['id']; ?>"><?= $h['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="count" name="count" min="1" max="50" placeholder="Room Availability">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="price" name="price" min="10000" max="10000000" placeholder="Price per Night">
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