<?php
require_once __DIR__ . '/../includes/bootstrap.php';

// USER MUST BE LOGGED IN
if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role    = $_SESSION['role'];

if ($role === 'teacher') {

    // TEACHER: See assignments they created
    $sql = "SELECT a.assignment_id, a.title, a.description, a.due_date, 
                   c.course_name
            FROM assignments a
            JOIN courses c ON a.course_id = c.course_id
            WHERE a.teacher_id = ?
            ORDER BY a.due_date ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

} elseif ($role === 'student') {

    // STUDENT: See assignments for courses they are enrolled in
    $sql = "SELECT a.assignment_id, a.title, a.description, a.due_date,
                   c.course_name
            FROM assignments a
            JOIN courses c ON a.course_id = c.course_id
            JOIN enrollments e ON e.course_id = c.course_id
            WHERE e.student_id = ?
            ORDER BY a.due_date ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    // OPTIONAL — block admin or other roles
    header("Location: ../dashboard.php");
    exit();
}

// PASS TO VIEW
render('view_assignments_view', [
    'result' => $result,
    'role'   => $role
]);
