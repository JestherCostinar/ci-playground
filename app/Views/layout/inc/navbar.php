<nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">CI Playground</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (session()->get('isLoggedIn')) : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Dashboard' ? 'active' : null) ?>" aria-current="page" href="<?= base_url('/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Profile' ? 'active' : null) ?>" href="<?= base_url('/profile') ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'User' ? 'active' : null) ?>" href="<?= base_url('/user') ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Upload Image' ? 'active' : null) ?>" href="<?= base_url('/upload/' . session()->get('id')) ?>">Image Upload</a>
                    </li>
                </ul>

                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout') ?>">Logout</a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Login' ? 'active' : null) ?>" aria-current="page" href="<?= base_url('/') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Register' ? 'active' : null) ?>" href="<?= base_url('/signup') ?>">Register</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>