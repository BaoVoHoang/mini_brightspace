<?php
session_start();
include('../config.php');
include('../includes/header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch teachers
$teachers = $conn->query("SELECT t.teacher_id, u.name FROM teachers t JOIN users u ON t.user_id = u.user_id");

// Add course
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $name = $_POST['course_name'];
    $desc = $_POST['description'];
    $teacher = $_POST['teacher_id'];
    $conn->query("INSERT INTO courses (course_name, description, teacher_id)
                  VALUES ('$name', '$desc', '$teacher')");
}

// Delete course
if (isset($_GET['delete'])) {
    $course_id = $_GET['delete'];
    $conn->query("DELETE FROM courses WHERE course_id='$course_id'");
}

$courses = $conn->query("SELECT c.course_id, c.course_name, c.description, u.name AS teacher
                         FROM courses c
                         LEFT JOIN teachers t ON c.teacher_id = t.teacher_id
                         LEFT JOIN users u ON t.user_id = u.user_id");

echo "<h2>Manage Courses</h2>";
echo "<form method='POST'>
        <input type='text' name='course_name' placeholder='Course Name' required>
        <input type='text' name='description' placeholder='Description' required>
        <select name='teacher_id' required>
            <option value=''>-- Select Teacher --</option>";
            while ($t = $teachers->fetch_assoc()) {
                echo "<option value='{$t['teacher_id']}'>{$t['name']}</option>";
            }
echo "</select>
        <button type='submit' name='add_course'>Add Course</button>
      </form><br>";

echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Course Name</th><th>Description</th><th>Teacher</th><th>Action</th></tr>";
while ($c = $courses->fetch_assoc()) {
    echo "<tr>
            <td>{$c['course_id']}</td>
            <td>{$c['course_name']}</td>
            <td>{$c['description']}</td>
            <td>{$c['teacher']}</td>
            <td><a href='?delete={$c['course_id']}'>🗑️ Delete</a></td>
          </tr>";
}
echo "</table>";
?>
