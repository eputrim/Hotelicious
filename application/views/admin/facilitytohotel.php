<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('admin/addfacilitytohotel'); ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $hotel['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Hotel Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $hotel['name']; ?>" readonly>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <p class="card-text">Hotel Current Facilities:</small></p>
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
                <label for="name" class="col-sm-3 col-form-label">New Hotel Facilities</label>
                <div class="col-sm-8">
                    <select name="facility_id" id="facility_id" class="form-control">
                        <option value="">Select Facility</option>
                        <?php foreach ($hotel_feature as $hf) : ?>
                            <option value="<?= $hf['id']; ?>"><?= $hf['feature'] ?></option>
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
                    <a href="<?= base_url('admin/hotel/') . $hotel['id']; ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->