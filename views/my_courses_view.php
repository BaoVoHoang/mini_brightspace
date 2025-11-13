<h2 class="text-center mb-4">🎓 My Enrolled Courses</h2>
<div class="card shadow-sm p-4">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Course Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['course_name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="2" class="text-center text-muted">No courses enrolled.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
