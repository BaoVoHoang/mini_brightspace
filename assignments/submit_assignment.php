<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$assignment_id = $_GET['assignment_id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $assignment_id) {
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO submissions (assignment_id, student_id, file_path)
                VALUES ('$assignment_id', '$student_id', '$targetFile')
                ON DUPLICATE KEY UPDATE file_path='$targetFile', submitted_at=NOW()";

        $message = $conn->query($sql)
            ? "✅ File submitted successfully!"
            : "❌ Database error: " . $conn->error;
    } else {
        $message = "❌ File upload failed.";
    }
}

render('submit_assignment_view', [
    'assignment_id' => $assignment_id,
    'message' => $message
]);
