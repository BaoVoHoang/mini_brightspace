<?php
session_start();
include('../config.php');
include('../includes/header.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$sql = "SELECT c.course_id, c.course_name, c.description
        FROM courses c
        WHERE c.course_id NOT IN (SELECT course_id FROM enrollments WHERE student_id = '$student_id')";
$result = $conn->query($sql);
?>

<h2 class="text-center mb-4">📘 Available Courses</h2>

<div class="card shadow-sm p-4">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Course Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['course_name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><a href="enroll_course.php?course_id=<?= $row['course_id'] ?>" class="btn btn-primary btn-sm">Enroll</a></td>
          </tr>
        <?php endwhile;
      else: ?>
        <tr><td colspan="3" class="text-center text-muted">No available courses.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
