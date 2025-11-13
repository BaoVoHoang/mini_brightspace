<?php
session_start();
include('../config.php');
include('../includes/header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}

$submission_id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grade = $_POST['grade'];
    $sql = "UPDATE submissions SET grade = '$grade' WHERE submission_id = '$submission_id'";
    if ($conn->query($sql)) {
        echo "✅ Grade saved successfully.";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<h2>Grade Submission</h2>
<form method="POST">
    <label>Grade (0–100):</label>
    <input type="number" name="grade" min="0" max="100" required>
    <button type="submit">Save Grade</button>
</form>
