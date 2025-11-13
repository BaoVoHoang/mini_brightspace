<?php
session_start();
include('../config.php');
include('../includes/header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

echo "<h2>Admin Dashboard</h2>";
echo "<p>Welcome, {$_SESSION['name']} (Admin)</p>";

echo "<a href='manage_users.php'>👥 Manage Users</a><br>";
echo "<a href='manage_courses.php'>📘 Manage Courses</a><br>";
echo "<a href='view_reports.php'>📊 View Reports</a><br>";
echo "<a href='../auth/logout.php'>Logout</a><br>";
?>
