<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="col-md-6 center_div">
        <?php if (isset($validation)) :  ?>
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif ?>
        <?php if (isset($Flash_message)) :  ?>
            <div class="alert alert-success" role="alert">
                Image upload successfully
            </div>
        <?php endif ?>
        <form action="<?= base_url('/upload/' . session()->get('id')); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="userfile">
                <label class="input-group-text">Upload Image</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>
<?= $this->endSection(); ?>