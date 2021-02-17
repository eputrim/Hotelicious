<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('admin/addfacilitytoroom'); ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $room['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Hotel Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="hname" name="hname" value="<?= $hotel['name']; ?>" readonly>
                    <?= form_error('hname', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Room Type</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="rname" name="rname" value="<?= $room['name']; ?>" readonly>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <p class="card-text">Room Current Facilities:</small></p>
            <div class="container">
                <div class="row">
                    <?php foreach ($used as $u) : ?>
                        <div class="col-sm">
                            <div class="text-center text-primary">
                                <i class="<?= $u['icon']; ?> fa-2x"></i><br>
                            </div>
                            <div class="text-center"><?= $u['feature']; ?></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <br />
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">New Room Facilities</label>
                <div class="col-sm-8">
                    <select name="facility_id" id="facility_id" class="form-control">
                        <option value="">Select Facility</option>
                        <?php foreach ($room_feature as $rf) : ?>
                            <option value="<?= $rf['id']; ?>"><?= $rf['feature'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('facility_id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="col-sm-1">
                    <a href="<?= base_url('admin/room/') . $hotel['id']; ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->