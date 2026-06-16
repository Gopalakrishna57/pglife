<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PG-Life</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/common.css">
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['full_name'];
$user_email = $_SESSION['email'];

// 2. Fetch all properties that THIS user interested in (JOIN Query)
$sql = "SELECT p.* FROM properties p 
        INNER JOIN interested_users_properties i ON p.id = i.property_id 
        WHERE i.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Query Failed: " . mysqli_error($conn);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | PG-Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include("header.php"); ?>

    <div class="container my-5">
        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 text-center bg-white">
                    <div class="mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; fs-2: bold;">
                        <i class="fas fa-user fs-2"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1"><?= $user_name; ?></h4>
                    <p class="text-muted small mb-3"><?= $user_email; ?></p>
                    <hr>
                    <div class="text-start small text-secondary">
                        <p class="mb-2"><strong>Account Status:</strong> <span class="badge bg-success">Active Student</span></p>
                        <p class="mb-0"><strong>Location:</strong> Hyderabad, India</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
                    <h3 class="fw-bold text-dark mb-4"><i class="fas fa-heart text-danger me-2"></i>My Interested PGs</h3>

                    <?php if (mysqli_num_rows($result) == 0) { ?>
                        <div class="text-center py-5 text-muted">
                            <i class="far fa-heart fa-3x mb-3 text-secondary"></i>
                            <h5>No properties added yet!</h5>
                            <p class="small">Go to properties page and click the heart icon to add here.</p>
                            <a href="property_list.php" class="btn btn-primary btn-sm mt-2 fw-bold">Browse PGs</a>
                        </div>
                    <?php } else { ?>
                        
                        <div class="row g-3">
                            <?php while($property = mysqli_fetch_assoc($result)) { ?>
                                <div class="col-12 border rounded-3 p-3 bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-sm-3">
                                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=150&h=100" class="img-fluid rounded-3 w-100" alt="PG View">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <h5 class="fw-bold text-primary mb-1"><?= $property['name']; ?></h5>
                                            <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt"></i> <?= $property['address']; ?></p>
                                            <span class="badge bg-dark text-uppercase small">For: <?= $property['gender']; ?></span>
                                        </div>
                                        <div class="col-sm-3 text-sm-end mt-3 mt-sm-0">
                                            <div class="fw-bold text-dark fs-5 mb-2">₹ <?= $property['rent']; ?>/-</div>
                                            <a href="property_detail.php?id=<?= $property['id']; ?>" class="btn btn-outline-primary btn-sm w-100 fw-bold">View</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>