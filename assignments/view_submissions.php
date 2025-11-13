<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if ($_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT s.submission_id, u.name AS student_name, c.course_name, a.title, s.file_path, s.submitted_at
        FROM submissions s
        JOIN users u ON s.student_id = u.user_id
        JOIN assignments a ON s.assignment_id = a.assignment_id
        JOIN courses c ON a.course_id = c.course_id
        ORDER BY s.submitted_at DESC";

$result = $conn->query($sql);

render('view_submissions_view', ['result' => $result]);
