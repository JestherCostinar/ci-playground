<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="col-md-6 center_div">
        <p>Welcome <?= session()->get('firstname') . ' ' . session()->get('lastname')?> | <a href="<?= base_url('/logout') ?>">Logout</a></p>
    </div>
</div>
<?= $this->endSection(); ?>