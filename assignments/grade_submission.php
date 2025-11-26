<?php
// assignments/grade_submission.php
session_start();
require_once __DIR__ . '/../config.php';

// AUTH GUARD (must be FIRST)
if (!isset($_SESSION['user_id'], $_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

$logged_user_id = (int) $_SESSION['user_id'];
$submission_id  = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($submission_id <= 0) {
    http_response_code(400);
    echo "Invalid submission ID.";
    exit();
}

/*
    CORRECT TEACHER CHECK:
    - users.user_id → teachers.user_id → teachers.teacher_id
    - teachers.teacher_id → courses.teacher_id
    - courses.course_id → assignments.course_id
    - assignments.assignment_id → submissions.assignment_id
*/
$sql = "
SELECT 
    s.submission_id,
    s.grade,
    s.submitted_at,
    a.assignment_id,
    a.title,
    c.course_name
FROM submissions s
JOIN assignments a ON a.assignment_id = s.assignment_id
JOIN courses c ON c.course_id = a.course_id
JOIN teachers t ON t.teacher_id = c.teacher_id
WHERE s.submission_id = ? 
  AND t.user_id = ?   -- VERY IMPORTANT: match logged teacher
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $submission_id, $logged_user_id);
$stmt->execute();
$submission = $stmt->get_result()->fetch_assoc();

if (!$submission) {
    http_response_code(403);
    echo "❌ You do not have permission to grade this submission.";
    exit();
}

// ======================
//  SAVE GRADE (POST)
// ======================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $grade = isset($_POST['grade']) ? (int) $_POST['grade'] : -1;

    if ($grade < 0 || $grade > 100) {
        echo "❌ Grade must be between 0 and 100.";
    } else {

        // Update grade with teacher-verification JOIN
        $update = $conn->prepare("
            UPDATE submissions s
            JOIN assignments a ON a.assignment_id = s.assignment_id
            JOIN courses c ON c.course_id = a.course_id
            JOIN teachers t ON t.teacher_id = c.teacher_id
            SET s.grade = ?
            WHERE s.submission_id = ? 
              AND t.user_id = ?
        ");

        $update->bind_param("iii", $grade, $submission_id, $logged_user_id);

        if ($update->execute()) {
            echo "<p style='color: green; font-weight: bold;'>✅ Grade saved successfully.</p>";
        } else {
            echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<h2>Grade Submission</h2>

<p>
    <strong>Course:</strong> <?= htmlspecialchars($submission['course_name']) ?><br>
    <strong>Assignment:</strong> <?= htmlspecialchars($submission['title']) ?><br>
</p>

<form method="POST" style="max-width: 300px; margin-top: 20px;">
    <label><strong>Grade (0–100):</strong></label><br>
    <input type="number" name="grade" min="0" max="100"
           value="<?= htmlspecialchars((string)$submission['grade']) ?>" 
           required class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Save Grade</button>
</form>
