<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "pglife");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
