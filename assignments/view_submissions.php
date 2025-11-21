<?php
require_once __DIR__ . '/../includes/bootstrap.php';

// User must be logged in
if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'teacher') {

    // TEACHER: See submissions only for assignments they created
    $sql = "SELECT s.submission_id, u.name AS student_name, c.course_name, 
                   a.title, s.file_path, s.submitted_at
            FROM submissions s
            JOIN users u ON s.student_id = u.user_id
            JOIN assignments a ON s.assignment_id = a.assignment_id
            JOIN courses c ON a.course_id = c.course_id
            WHERE a.teacher_id = ?
            ORDER BY s.submitted_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else if ($role === 'student') {

    // STUDENT: See only their own submissions
    $sql = "SELECT s.submission_id, u.name AS student_name, c.course_name, 
                   a.title, s.file_path, s.submitted_at
            FROM submissions s
            JOIN users u ON s.student_id = u.user_id
            JOIN assignments a ON s.assignment_id = a.assignment_id
            JOIN courses c ON a.course_id = c.course_id
            WHERE s.student_id = ?
            ORDER BY s.submitted_at DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    // Admin or invalid role — block access
    header("Location: ../auth/login.php");
    exit();
}

render('view_submissions_view', ['result' => $result]);
