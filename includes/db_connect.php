<?php
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "";
$db_name = "pglife";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    $response = array("success" => false, "message" => "Database Connection Failed: " . mysqli_connect_error());
    echo json_encode($response);
    exit;
}
?>
