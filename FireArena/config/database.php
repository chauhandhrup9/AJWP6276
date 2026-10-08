<?php

$host = "localhost";
$user = "root";
$password = "dhrup";
$database = "firearena";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>