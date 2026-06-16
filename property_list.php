<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

$city_name = isset($_GET['city']) ? trim($_GET['city']) : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'none';

// 1. Base query - Fetch everything safely
$sql = "SELECT * FROM properties WHERE 1=1";

if ($gender != 'all') {
    $sql = $sql . " AND gender = '$gender'";
}

if ($sort == 'desc') {
    $sql = $sql . " ORDER BY rent DESC";
} elseif ($sort == 'asc') {
    $sql = $sql . " ORDER BY rent ASC";
}

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
    <title>Best PGs | PG-Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include("header.php"); ?>

    <div class="container my-5">
        <h2 class="mb-4 fw-bold text-dark">Available Properties in <?= htmlspecialchars($city_name); ?></h2>

        <div class="mb-4 d-flex gap-2 flex-wrap">
            <a href="property_list.php?city=<?= urlencode($city_name); ?>&gender=all&sort=<?= $sort; ?>" class="btn <?= $gender=='all' ? 'btn-dark' : 'btn-outline-dark'; ?>">All Genders</a>
            <a href="property_list.php?city=<?= urlencode($city_name); ?>&gender=Boys&sort=<?= $sort; ?>" class="btn <?= $gender=='Boys' ? 'btn-primary' : 'btn-outline-primary'; ?>">Boys Only</a>
            <a href="property_list.php?city=<?= urlencode($city_name); ?>&gender=Girls&sort=<?= $sort; ?>" class="btn <?= $gender=='Girls' ? 'btn-danger' : 'btn-outline-danger'; ?>">Girls Only</a>
            
            <span class="ms-auto"></span>
            
            <a href="property_list.php?city=<?= urlencode($city_name); ?>&gender=<?= $gender; ?>&sort=asc" class="btn <?= $sort=='asc' ? 'btn-warning text-dark' : 'btn-outline-warning text-dark'; ?>">Rent: Low to High</a>
            <a href="property_list.php?city=<?= urlencode($city_name); ?>&gender=<?= $gender; ?>&sort=desc" class="btn <?= $sort=='desc' ? 'btn-warning text-dark' : 'btn-outline-warning text-dark'; ?>">Rent: High to Low</a>
        </div>

        <div class="row g-4">
            <?php 
            $has_properties = false;
            while ($property = mysqli_fetch_assoc($result)) {
                
                // 2. PERFECT STRIPPED FILTER: Checks if the clicked city name exists inside the property's address string
                if (!empty($city_name)) {
                    $address_text = isset($property['address']) ? (string)$property['address'] : '';
                    
                    // If the city name (e.g., 'Chennai') is NOT found in the address, skip this property card!
                    if (stripos($address_text, $city_name) === false) {
                        continue;
                    }
                }
                
                $has_properties = true;
            ?>
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-3 p-3">
                        <div class="row g-0 align-items-center"> 
                            <div class="col-md-4">
                                <?php 
                                $live_images = [
                                    "https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=500&auto=format&fit=crop&q=60",
                                    "https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=500&auto=format&fit=crop&q=60",
                                    "https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=500&auto=format&fit=crop&q=60",
                                    "https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=500&auto=format&fit=crop&q=60",
                                    "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=500&auto=format&fit=crop&q=60",
                                    "https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=500&auto=format&fit=crop&q=60"  
                                ];

                                $image_index = $property['id'] % count($live_images);
                                $final_image = $live_images[$image_index];
                                ?>
                                <img src="<?= $final_image; ?>" class="card-img-top rounded-3" alt="<?= $property['name']; ?>" style="width: 100%; height: 220px; object-fit: cover;">
                            </div>
                            <div class="col-md-8 ps-md-4 mt-3 mt-md-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="fw-bold mb-1 text-primary"><?= $property['name']; ?></h4>
                                    <div>
                                        <i class="fa-regular fa-heart text-danger fs-4" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                                <p class="text-muted mb-2"><i class="fas fa-map-marker-alt text-secondary"></i> <?= $property['address']; ?></p>
                                <p class="text-dark small mb-3"><?= $property['description']; ?></p>
                                
                                <div class="badge bg-light text-dark p-2 mb-3 border fs-6">
                                    For: <span class="fw-bold text-uppercase"><?= $property['gender']; ?></span>
                                </div>

                                <div class="d-flex flex-wrap gap-3 mb-3 bg-light p-2 rounded border text-secondary small">
                                    <span><i class="fas fa-star text-warning"></i> Clean: <b><?= $property['rating_clean']; ?></b></span>
                                    <span><i class="fas fa-star text-warning"></i> Food: <b><?= $property['rating_food']; ?></b></span>
                                    <span><i class="fas fa-star text-warning"></i> Safety: <b><?= $property['rating_safety']; ?></b></span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                    <div>
                                        <span class="fs-4 fw-bold text-dark">₹ <?= $property['rent']; ?>/-</span>
                                        <span class="text-muted small"> month</span>
                                    </div>
                                    <a href="property_detail.php?id=<?= $property['id']; ?>" class="btn btn-primary px-4 fw-bold shadow-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } 
            if (!$has_properties) {
                echo '<div class="col-12 text-center my-5"><h4 class="text-muted">No properties found matching your selection.</h4></div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
