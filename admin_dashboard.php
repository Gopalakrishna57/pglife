<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

// Security Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all registered PGs to show in the table
$sql_fetch = "SELECT * FROM properties";
$result_pgs = mysqli_query($conn, $sql_fetch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PG-Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Top Admin Navbar -->
    <nav class="navbar navbar-dark bg-primary shadow-sm px-4">
        <span class="navbar-brand fw-bold"><i class="fas fa-user-shield me-2"></i>PGLife Admin Console</span>
        <a href="admin_login.php" class="btn btn-light btn-sm fw-bold"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <!-- Success Messages -->
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success fw-bold small">🎉 Action Completed Successfully!</div>
                <?php } ?>

                <!-- 1. ADD NEW PG FORM -->
                <div class="card p-4 border-0 shadow-sm rounded-3 bg-white mb-5">
                    <h3 class="fw-bold text-dark mb-4"><i class="fas fa-plus-circle text-success me-2"></i>Add New PG Property</h3>
                    <hr>
                    <form action="admin_submit.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Property/PG Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g., Cyber Oasis Luxury" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Gender Allowed</label>
                                <select name="gender" class="form-select" required>
                                    <option value="boys">Boys Only</option>
                                    <option value="girls">Girls Only</option>
                                    <option value="unisex">Unisex</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Monthly Rent (₹)</label>
                                <input type="number" name="rent" class="form-control" placeholder="e.g., 8500" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Full Address (Include City Name at end)</label>
                                <input type="text" name="address" class="form-control" placeholder="Plot No, LandMark, CityName" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">PG Description / Details</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Mention rules and facilities..." required></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5 fw-bold"><i class="fas fa-cloud-upload-alt me-2"></i>Publish PG Live</button>
                        </div>
                    </form>
                </div>

                <!-- 2. LIVE PGs LIST & QUICK UPDATE DESCRIPTION -->
                <div class="card p-4 border-0 shadow-sm rounded-3 bg-white">
                    <h3 class="fw-bold text-dark mb-4"><i class="fas fa-edit text-warning me-2"></i>Manage & Update Listed PGs</h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark small">
                                <tr>
                                    <th>PG Name</th>
                                    <th>Rent</th>
                                    <th>Address</th>
                                    <th style="width: 40%;">Quick Update Description</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php while($row = mysqli_fetch_assoc($result_pgs)) { ?>
                                    <tr>
                                        <td class="fw-bold text-primary"><?= $row['name']; ?></td>
                                        <td>₹<?= $row['rent']; ?></td>
                                        <td><?= $row['address']; ?></td>
                                        <td>
                                            <!-- Inline Update Form for each PG bro -->
                                            <form action="admin_update_desc.php" method="POST" class="d-flex gap-2">
                                                <input type="hidden" name="property_id" value="<?= $row['id']; ?>">
                                                <textarea name="new_description" class="form-control form-control-sm" rows="2" required><?= $row['description']; ?></textarea>
                                                <button type="submit" class="btn btn-warning btn-sm fw-bold align-self-center text-dark">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>