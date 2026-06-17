<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

// Security Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo "Unauthorized Access!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize the admin inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $rent = mysqli_real_escape_string($conn, $_POST['rent']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Modified Query: Removed 'city' column to prevent the database fatal error bro!
    $sql = "INSERT INTO properties (name, address, description, rent, gender) 
            VALUES ('$name', '$address', '$description', '$rent', '$gender')";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to admin dashboard with success message
        header("Location: admin_dashboard.php?success=1");
        exit;
    } else {
        echo "Database Insertion Failed: " . mysqli_error($conn);
    }
}
?>