<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="col-md-6 center_div">
        <form action="<?= base_url('signup'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" value="<?= set_value('firstname') ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'firstname') : ''; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?= set_value('lastname') ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'lastname') : ''; ?></span>
            </div>
            <div class=" mb-3">
                <label class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'email') : ''; ?></span>
            </div>
            <div class=" mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'password') : ''; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'confirmPassword') : ''; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="mt-3">
                <span>Already have an account? <a href="<?= base_url('/'); ?>">Login</a></span>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>