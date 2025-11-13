<h2 class="text-center mb-4">📤 Submit Assignment</h2>

<div class="card shadow-sm p-4 text-center">
  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" class="form-control mb-3" required>
    <button type="submit" class="btn btn-success">Upload</button>
  </form>

  <a href="view_assignments.php" class="btn btn-secondary mt-3">⬅ Back to Assignments</a>
</div>
