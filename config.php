<?php
$host = "localhost";
$user = "root";
$pass = "";  // default in XAMPP
$db = "mini_brightspace";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>