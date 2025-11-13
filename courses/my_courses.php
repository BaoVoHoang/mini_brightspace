<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$sql = "SELECT course_name, description FROM courses c
        JOIN enrollments e ON c.course_id = e.course_id
        WHERE e.student_id = '$student_id'";
$result = $conn->query($sql);

render('my_courses_view', ['result' => $result]);
