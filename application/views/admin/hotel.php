<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>


    <div class="row">
        <div class="col-lg-10">

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newHotelModal">Add New Hotel</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hotel Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($hotel as $h) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $h['name']; ?></td>
                            <td><?= $h['city']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/facilitytohotel/') . $h['id']; ?>" class="badge badge-primary">add facilitiy</a>
                                <a href="<?= base_url('admin/viewhotel/') . $h['id']; ?>" class="badge badge-warning">view</a>
                                <a href="<?= base_url('admin/edithotel/') . $h['id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('admin/deletehotel/') . $h['id']; ?>" class="badge badge-danger">delete</a>
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
                        <label for="star" class="col-sm-2 col-form-label">Star</label>
                        <div class="col-sm-10">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>