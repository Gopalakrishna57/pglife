<?php
require("db_connect.php"); // Connects to database directly from main folder

// Capture data from POST request
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$college_name = $_POST['college_name'];
$gender = $_POST['gender'];

// Encrypt password using SHA256 secure hash
$password = hash("sha256", $password);
// Check if user email already exists in our records
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('This email is already registered! Try logging in.'); window.location.href='index.php';</script>";
    exit;
}

// Insert new user entry into database table
$sql = "INSERT INTO users (email, password, full_name, phone, gender, college_name) VALUES ('$email', '$password', '$full_name', '$phone', '$gender', '$college_name')";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Something went wrong: " . mysqli_error($conn);
    exit;
}

echo "<script>alert('Your account has been created successfully!'); window.location.href='index.php';</script>";
?>