<div class="text-center mt-5">
  <h2>Welcome, <strong><?= htmlspecialchars($name) ?></strong></h2>
  <p class="lead text-muted">(<?= ucfirst($role) ?>)</p>

  <div class="card shadow-sm p-4 d-inline-block mt-4">
    <?php if ($role == 'student'): ?>
      <a href="courses/view_courses.php" class="btn btn-outline-primary m-2">📘 View All Courses</a>
      <a href="courses/my_courses.php" class="btn btn-outline-success m-2">🎓 My Courses</a>
      <a href="assignments/view_assignments.php" class="btn btn-outline-warning m-2">📝 My Assignments</a>
    <?php elseif ($role == 'teacher'): ?>
      <a href="assignments/create_assignment.php" class="btn btn-outline-primary m-2">✏️ Create Assignment</a>
      <a href="assignments/view_submissions.php" class="btn btn-outline-success m-2">📁 View Submissions</a>
    <?php elseif ($role == 'admin'): ?>
      <a href="admin/manage_users.php" class="btn btn-outline-danger m-2">⚙️ Manage Users</a>
      <a href="admin/manage_courses.php" class="btn btn-outline-primary m-2">📘 Manage Courses</a>
      <a href="admin/view_reports.php" class="btn btn-outline-success m-2">📊 View Reports</a>
    <?php endif; ?>
  </div>

  <div class="mt-4">
    <a href="auth/logout.php" class="btn btn-secondary">Logout</a>
  </div>
</div>
