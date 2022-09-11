<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="col-md-6 center_div">
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= (session()->get('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->get('loginError')) :  ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->get('loginError'); ?>
            </div>
        <?php endif ?>
        <form action="<?= base_url('/') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'email') : ''; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
                <span class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'password') : ''; ?></span>

            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="mt-3">
                <span>Don't have an account? <a href="<?= base_url('/signup'); ?>">Register</a></span>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>