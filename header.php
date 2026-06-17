<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="header sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-md navbar-light container justify-content-between py-2">
        <a class="navbar-brand" href="index.php">
            <h3 class="text-warning font-weight-bold mb-0"><i class="fas fa-home"></i> PGLife</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#my-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="my-navbar">
            <ul class="navbar-nav gap-2">
    <?php if (!isset($_SESSION['user_id'])) { ?>
        <li class="nav-item">
            <button class="nav-link btn btn-outline-dark px-3 me-2" data-bs-toggle="modal" data-bs-target="#signup-modal">
                <i class="fas fa-user-plus"></i> Signup
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link btn btn-warning px-4 text-dark font-weight-bold" data-bs-toggle="modal" data-bs-target="#login-modal">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </li>
    <?php } else { ?>
        <li class="nav-item my-auto text-secondary fw-bold pe-2">
            Hi, <?php echo $_SESSION['full_name']; ?>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-danger px-3" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    <?php } ?>
</ul>
        </div>
    </nav>
</div>

<div class="modal fade" id="signup-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Signup with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="post" action="signup_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-university"></i></span>
                        <input type="text" class="form-control" name="college_name" placeholder="College Name" required>
                    </div>
                    <div class="mb-3 d-flex gap-3 justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male" checked>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-dark fw-bold">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="login-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Login with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="post" action="login_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-dark fw-bold">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>