<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded Admin Credentials for security
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid Admin Credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | PG-Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card p-4 shadow border-0 rounded-4" style="width: 380px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">PGLife Admin</h3>
            <p class="text-muted small">Control Panel Access</p>
        </div>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger small py-2"><?= $error; ?></div>
        <?php } ?>

        <form action="admin_login.php" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Enter admin username">
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Login to Dashboard</button>
        </form>
    </div>

</body>
</html>