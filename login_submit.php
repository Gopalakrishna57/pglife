<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("db_connect.php");

$email = $_POST['email'];
$password = $_POST['password'];

$password = hash("sha256", $password);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Something went wrong: " . mysqli_error($conn);
    exit;
}

$row_count = mysqli_num_rows($result);
if ($row_count == 0) {
    echo "<script>alert('Invalid email or password! Please try again.'); window.location.replace('index.php');</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);
$_SESSION['user_id'] = $row['id'];
$_SESSION['full_name'] = $row['full_name'];
$_SESSION['email'] = $row['email'];

// Safe and Echo structured Redirection Script
echo "<script>";
echo "alert('Welcome back, " . $row['full_name'] . "! You are logged in.');";
echo "window.location.replace('index.php');";
echo "</script>";
?>