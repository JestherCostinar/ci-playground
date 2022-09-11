<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="col-md-6 center_div">
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= (session()->get('success')) ?>
            </div>
        <?php endif; ?>
        
        <h3><?= $user['firstname'] . ' ' . $user['lastname'] ?></h3>
        <hr>
        <form action="<?= base_url('/profile'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" value="<?= set_value('firstname', $user['firstname']) ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'firstname') : ''; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" value="<?= set_value('lastname', $user['lastname']) ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'lastname') : ''; ?></span>
            </div>
            <div class=" mb-3">
                <label class="form-label">Email address</label>
                <input type="text" class="form-control" readonly value="<?= $user['email'] ?>">
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
            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>
<?= $this->endSection(); ?>