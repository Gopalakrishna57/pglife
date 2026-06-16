




<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Property ID is missing!";
    exit;
}

$property_id = $_GET['id'];

// Fetch property details
$sql = "SELECT * FROM properties WHERE id = '$property_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Property not found!";
    exit;
}
$property = mysqli_fetch_assoc($result);

// Fetch reviews for this specific property with User Names
$sql_reviews = "SELECT r.*, u.full_name FROM reviews r 
                INNER JOIN users u ON r.user_id = u.id 
                WHERE r.property_id = '$property_id' ORDER BY r.created_at DESC";
$result_reviews = mysqli_query($conn, $sql_reviews);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $property['name']; ?> | Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="property_detail.css" rel="stylesheet">
</head>
<body class="bg-light">

    <?php include("header.php"); ?>

    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="property_list.php" class="text-decoration-none">Properties</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $property['name']; ?></li>
            </ol>
        </nav>

        <div class="row g-4 mt-2">
            <div class="col-lg-8">
                <div class="card p-3 mb-4 bg-white shadow-sm">
                    <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=800&h=450" class="property-main-img img-fluid mb-3 w-100" alt="Room View">
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h2 class="fw-bold text-primary mb-1"><?= $property['name']; ?></h2>
                        <span class="badge bg-opacity-10 bg-success text-success p-2 fs-6 border border-success text-uppercase"><?= $property['gender']; ?> Only</span>
                    </div>
                    <p class="text-muted"><i class="fas fa-map-marker-alt text-danger"></i> <?= $property['address']; ?></p>
                    <hr>
                    <h5 class="fw-bold text-dark mb-3">About the Property</h5>
                    <p class="text-secondary" style="line-height: 1.7;"><?= $property['description']; ?></p>
                </div>

                <div class="card p-4 mb-4 bg-white shadow-sm">
                    <h5 class="fw-bold text-dark mb-4">Amenities Available</h5>
                    <div class="row g-3 text-center text-secondary">
                        <div class="col-6 col-sm-3"><div class="p-3 amenity-box"><i class="fas fa-wifi text-primary fs-3 mb-2"></i><div class="small fw-semibold">High-Speed Wifi</div></div></div>
                        <div class="col-6 col-sm-3"><div class="p-3 amenity-box"><i class="fas fa-snowflake text-info fs-3 mb-2"></i><div class="small fw-semibold">Air Conditioner</div></div></div>
                        <div class="col-6 col-sm-3"><div class="p-3 amenity-box"><i class="fas fa-utensils text-warning fs-3 mb-2"></i><div class="small fw-semibold">3 Meals Food</div></div></div>
                        <div class="col-6 col-sm-3"><div class="p-3 amenity-box"><i class="fas fa-bolt text-danger fs-3 mb-2"></i><div class="small fw-semibold">Power Backup</div></div></div>
                    </div>
                </div>

                <div class="card p-4 mb-4 bg-white shadow-sm">
                    <h5 class="fw-bold text-dark mb-4"><i class="fas fa-star text-warning me-2"></i>User Reviews</h5>
                    
                    <div class="review-list mb-4">
                        <?php if (mysqli_num_rows($result_reviews) == 0) { ?>
                            <p class="text-muted small">No reviews yet for this PG. Be the first to write one!</p>
                        <?php } else { 
                            while($review = mysqli_fetch_assoc($result_reviews)) { ?>
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="fw-bold mb-1 text-dark"><?= $review['full_name']; ?></h6>
                                        <span class="text-warning small">
                                            <?php for($i=1; $i<=5; $i++) {
                                                echo $i <= $review['rating'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                            } ?>
                                        </span>
                                    </div>
                                    <p class="text-secondary small mb-0"><?= $review['comment']; ?></p>
                                </div>
                        <?php } } ?>
                    </div>

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <hr>
                        <h6 class="fw-bold text-dark mb-3">Write a Review</h6>
                        <form action="submit_review.php" method="POST">
                            <input type="hidden" name="property_id" value="<?= $property_id; ?>">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Rating</label>
                                <select name="rating" class="form-select form-select-sm" style="width: 150px;" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                    <option value="3">⭐⭐⭐ (3/5)</option>
                                    <option value="2">⭐⭐ (2/5)</option>
                                    <option value="1">⭐ (1/5)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Your Comment</label>
                                <textarea name="comment" class="form-control small" rows="3" placeholder="Share your experience staying here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold px-4">Submit Review</button>
                        </form>
                    <?php } else { ?>
                        <div class="alert alert-warning small mb-0">Please login to write a review for this PG.</div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card p-4 bg-white position-sticky sticky-price-card">
                    <div class="mb-3">
                        <span class="text-muted small">Rent starts from</span>
                        <div class="d-flex align-items-baseline">
                            <span class="fs-1 fw-bold text-dark">₹ <?= $property['rent']; ?></span>
                            <span class="text-muted ms-1">/ month</span>
                        </div>
                    </div>
                    <div class="bg-light p-3 rounded-3 border mb-4">
                        <div class="d-flex justify-content-between mb-2 small text-secondary"><span>Maintenance Charges</span><span class="fw-bold text-dark">Included</span></div>
                        <div class="d-flex justify-content-between small text-secondary"><span>Security Deposit</span><span class="fw-bold text-dark">₹ 5,000/-</span></div>
                    </div>
                    <button class="btn btn-book-now text-white w-100 py-3 fs-5 shadow-sm mb-3"><i class="fas fa-bolt me-2"></i> Book This PG Now</button>
                    <a href="toggle_interested.php?property_id=<?= $property['id']; ?>" class="btn btn-outline-danger w-100 py-2 fw-bold"><i class="fa-regular fa-heart me-2"></i> Add to Wishlist</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>