<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if ($_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO assignments (course_id, title, description, due_date)
            VALUES ('$course_id', '$title', '$description', '$due_date')";
    $message = $conn->query($sql) ? "✅ Assignment created!" : "❌ Error: " . $conn->error;
}

$courses = $conn->query("SELECT course_id, course_name FROM courses");

render('create_assignment_view', [
    'courses' => $courses,
    'message' => $message
]);
