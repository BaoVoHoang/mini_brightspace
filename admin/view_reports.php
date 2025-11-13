<?php
session_start();
include('../config.php');
include('../includes/header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$total_students = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='student'")->fetch_assoc()['total'];
$total_teachers = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='teacher'")->fetch_assoc()['total'];
$total_courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_enrollments = $conn->query("SELECT COUNT(*) AS total FROM enrollments")->fetch_assoc()['total'];

echo "<h2>System Overview</h2>";
echo "<ul>
        <li>👩‍🎓 Students: $total_students</li>
        <li>👨‍🏫 Teachers: $total_teachers</li>
        <li>📚 Courses: $total_courses</li>
        <li>📝 Enrollments: $total_enrollments</li>
      </ul>";

echo "<a href='dashboard.php'>⬅️ Back to Admin Dashboard</a>";
?>
