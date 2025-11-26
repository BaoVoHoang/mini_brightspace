<?php
// assignments/view_assignments.php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/bootstrap.php'; // if you use a render() helper

if (!isset($_SESSION['user_id'], $_SESSION['role'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$role    = $_SESSION['role'];

if ($role === 'teacher') {
    // NOTE: filter via courses.teacher_id, not assignments.teacher_id
    $sql = "SELECT a.assignment_id, a.title, a.description, a.due_date, 
               c.course_name
        FROM assignments a
        JOIN courses c ON a.course_id = c.course_id
        JOIN teachers t ON c.teacher_id = t.teacher_id
        WHERE t.user_id = ?
        ORDER BY a.due_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


} elseif ($role === 'student') {
    $sql = "SELECT a.assignment_id, a.title, a.description, a.due_date, c.course_name
            FROM assignments a
            JOIN courses c ON a.course_id = c.course_id
            JOIN enrollments e ON e.course_id = c.course_id
            WHERE e.student_id = ?
            ORDER BY a.due_date ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);

} else {
    header('Location: ../dashboard.php');
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

// If you don't have a render() helper, include a simple view here.
render('view_assignments_view', ['result' => $result, 'role' => $role]);
