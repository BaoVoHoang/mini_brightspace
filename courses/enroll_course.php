<?php
session_start();
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

include('../config.php');

// Temporary session for testing (replace after login system works)
$_SESSION['user_id'] = 277; // change this to an existing student_id

$student_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'];

$sql = "INSERT IGNORE INTO enrollments (student_id, course_id) VALUES ('$student_id', '$course_id')";
if ($conn->query($sql)) {
    echo "✅ Enrolled successfully in course ID $course_id!";
} else {
    echo "❌ Enrollment failed: " . $conn->error;
}
?>
