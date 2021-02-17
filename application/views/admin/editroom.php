<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('admin/doeditroom'); ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $room['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="hotel_id" class="col-sm-2 col-form-label">Hotel Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hotel_id" name="hotel_id" value="<?= $hotel['name']; ?>" readonly>
                    <?= form_error('hotel_id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Room Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $room['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="count" class="col-sm-2 col-form-label">Room Availability</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="count" name="count" min="1" max="50" value="<?= $room['count']; ?>">
                    <?= form_error('count', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Price per Night</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" min="10000" max="10000000" value="<?= $room['price']; ?>">
                    <?= form_error('price', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Room Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/room/') . $room['image']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-sm-1">
                    <a href="<?= base_url('admin/room'); ?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->