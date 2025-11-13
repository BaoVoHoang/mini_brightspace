<h2 class="text-center mb-4">📁 Student Submissions</h2>

<div class="card shadow-sm p-4">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Student</th>
        <th>Course</th>
        <th>Assignment</th>
        <th>File</th>
        <th>Submitted At</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['student_name']) ?></td>
            <td><?= htmlspecialchars($row['course_name']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><a href="<?= $row['file_path'] ?>" target="_blank">Download</a></td>
            <td><?= htmlspecialchars($row['submitted_at']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center text-muted">No submissions yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
