<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "Please login to submit a review!";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $property_id = mysqli_real_escape_string($conn, $_POST['property_id']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if (empty($comment) || empty($rating)) {
        header("Location: property_detail.php?id=$property_id&error=fields_required");
        exit;
    }

    // Insert into reviews table
    $sql = "INSERT INTO reviews (property_id, user_id, rating, comment) VALUES ('$property_id', '$user_id', '$rating', '$comment')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: property_detail.php?id=$property_id&success=review_added");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>