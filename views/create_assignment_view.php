<h2 class="text-center mb-4">✏️ Create Assignment</h2>

<div class="card shadow-sm p-4">
  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Select Course</label>
      <select name="course_id" class="form-select" required>
        <option value="">-- Choose Course --</option>
        <?php while ($row = $courses->fetch_assoc()): ?>
          <option value="<?= $row['course_id'] ?>"><?= htmlspecialchars($row['course_name']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Assignment Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Due Date</label>
      <input type="datetime-local" name="due_date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Create Assignment</button>
  </form>
</div>
