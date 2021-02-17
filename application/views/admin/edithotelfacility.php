<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('admin/doedithotelfacility'); ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $hotel_feature['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="hotel_id" class="col-sm-3 col-form-label">Hotel Feature Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $hotel_feature['feature']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Hotel Feature Illustration Code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $hotel_feature['icon']; ?>">
                    <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="text-middle"></div>
                <label for="name" class="col-sm-4 col-form-label">Hotel Feature Illustration Icon :</label>
                <i class="<?= $hotel_feature['icon']; ?> fa-3x"></i>
            </div>
            <div class="form-group row">
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-sm-1">
                    <a href="<?= base_url('admin/hotelfacility'); ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->