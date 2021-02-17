<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><b><?= $title; ?></b></h1>


    <div class="row">
        <div class="col-lg-10">

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newHotelFacilityModal">Add New Hotel Facility</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hotel Facility Name</th>
                        <th scope="col">Icon Code</th>
                        <th scope="col">Icon Illustration</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($hotel_feature as $h) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $h['feature']; ?></td>
                            <td><?= $h['icon']; ?></td>
                            <td><i class="<?= $h['icon']; ?>"></i></td>
                            <td>
                                <a href="<?= base_url('admin/edithotelfacility/') . $h['id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('admin/deletehotelfacility/') . $h['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newHotelFacilityModal" tabindex="-1" role="dialog" aria-labelledby="newHotelFacilityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newHotelFacilityModalLabel">Add New Hotel Facility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addhotelfacility'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Hotel Facility Name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Hotel Facility Icon Code">
                        <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
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