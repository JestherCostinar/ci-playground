<?= $this->extend('layout/frontend.php'); ?>

<?= $this->section('content') ?>

<div class="card m-5 ">
    <?php if (session()->get('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= (session()->get('success')) ?>
        </div>
    <?php endif; ?>
    <div class="card-header">
        <h3>Users Table
            <a href="<?= base_url('user/create') ?>" class="btn btn-primary float-end mx-2">Add Users</a>
            <a href="<?= base_url('user/exportuserdata') ?>" class="btn btn-primary float-end">Generate Excel Report</a>

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
                <?php $i = 1;
                foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $user['firstname'] ?></td>
                        <td><?= $user['lastname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td>
                            <a href="<?= base_url('user/update/' . $user['id']) ?>">Edit</a> | <a href="<?= base_url('user/delete/' . $user['id']); ?>" class="confirm-del-btn" id="<?= $user['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>


<?= $this->endSection(); ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $(".confirm-del-btn").click(function(e) {
            e.preventDefault();
            var id = $(this).val();
            if (confirm("Do you want to delete this data?")) {
                // alert(id);
                $.ajax({
                    url: "user/delete/" + id,
                    success: function(response) {
                        window.location.reload();
                        alert("Data deleted");
                    },
                });
            }
        });
    });
    n
</script>
<?= $this->endSection(); ?>