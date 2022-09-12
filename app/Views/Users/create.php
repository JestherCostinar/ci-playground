<?= $this->extend('layout/frontend.php') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <?php if (session()->get('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= (session()->get('success')) ?>
        </div>
    <?php endif; ?>
    <a href="<?= base_url('/user') ?>" class="btn btn-success">Go back to users</a>
    <div class="card mt-2">
        <div class="card-body">
            <form action=" <?= base_url('user/create') ?>" method="post">
                <div class="row">
                    <div class="col">
                        <label class="form-label">Firstname <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" placeholder="First Name" name="firstname" value="<?= set_value('firstname') ?>">
                        <small class=" text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'firstname') : ''; ?></small>
                    </div>
                    <div class="col">
                        <label class="form-label">Lastname <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="<?= set_value('lastname') ?>">
                        <small class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'lastname') : ''; ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>">
                    <small class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'email') : ''; ?></small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger"> *</span></label>
                    <input type="password" class="form-control" name="password" >
                    <small class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'password') : ''; ?></small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password <span class="text-danger"> *</span></label>
                    <input type="password" class="form-control" name="confirmPassword">
                    <small class="text-danger text-sm"><?= isset($validation) ? form_validator($validation, 'confirmPassword') : ''; ?></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>