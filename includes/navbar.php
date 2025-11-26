<?php
require_once __DIR__ . '/bootstrap.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL ?>/dashboard.php">Mini Brightspace</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <?php if ($logged_in): ?>
          <?php if ($role === 'student'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/courses/my_courses.php">My Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/assignments/view_assignments.php">Assignments</a></li>
          <?php elseif ($role === 'teacher'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/assignments/create_assignment.php">Create Assignment</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/assignments/view_submissions.php">View Submissions</a></li>
          <?php elseif ($role === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/dashboard.php">Admin Panel</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link text-danger" href="<?= BASE_URL ?>/auth/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/auth/login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
