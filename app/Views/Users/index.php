<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content') ?>

<div class="card m-5 ">
    <div class="card-header">
        <h3>Users Table
            <a href="<?= base_url('user/create') ?>" class="btn btn-primary float-end">Add Users</a>
        </h3>
    </div>
    <div class="card-body">
        <table class="table center_div table-striped">

            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $user['firstname'] ?></td>
                        <td><?= $user['lastname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td>
                            <a href="">Edit</a> | <a href="">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>


<?= $this->endSection(); ?>