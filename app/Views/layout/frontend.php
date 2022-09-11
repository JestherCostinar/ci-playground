<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <title>Kasmir E-Commerace | <?= $title ?></title>
    <!-- MAIN STYLES -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>

    <?= $this->include('layout/inc/navbar.php'); ?>
    <?= $this->renderSection('content') ?>

    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/jquery-3.6.1.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/boostrap.min.js') ?>"></script>
</body>

</html>