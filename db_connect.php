<?php
$db_hostname = "sql307.byetcluster.com";
$db_username = "if0_42188214";
$db_password = "WYHSJP8r1l2";
$db_name = "if0_42188214_pglife";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}