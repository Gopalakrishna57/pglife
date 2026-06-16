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
    $property_id = mysqli_real_escape_string($conn, $_POST['property_id']);
    $new_description = mysqli_real_escape_string($conn, $_POST['new_description']);

    // SQL query to update description dynamically based on ID
    $sql_update = "UPDATE properties SET description = '$new_description' WHERE id = '$property_id'";

    if (mysqli_query($conn, $sql_update)) {
        // Go back to dashboard with success popup bro
        header("Location: admin_dashboard.php?success=1");
        exit;
    } else {
        echo "Failed to update description: " . mysqli_error($conn);
    }
}
?>