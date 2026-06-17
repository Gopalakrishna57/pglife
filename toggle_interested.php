<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

// 1. Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please login first to add items to your wishlist!";
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['property_id']) || empty($_GET['property_id'])) {
    echo "Property ID is missing!";
    exit;
}

$property_id = $_GET['property_id'];

// 2. Check if already interested
$sql_check = "SELECT * FROM interested_users_properties WHERE user_id = '$user_id' AND property_id = '$property_id'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Already exists -> Remove it (Unlike)
    $sql_delete = "DELETE FROM interested_users_properties WHERE user_id = '$user_id' AND property_id = '$property_id'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to detail page safely
    header("Location: property_detail.php?id=" . $property_id);
} else {
    // New interest -> Insert it (Like)
    $sql_insert = "INSERT INTO interested_users_properties (user_id, property_id) VALUES ('$user_id', '$property_id')";
    mysqli_query($conn, $sql_insert);
    // Redirect back to detail page safely
    header("Location: property_detail.php?id=" . $property_id);
}
?>