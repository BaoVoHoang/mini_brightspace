<h2 class="text-center mb-4">📝 My Assignments</h2>

<div class="card shadow-sm p-4">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Course</th>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['course_name']) ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['due_date']) ?></td>
            <td>
              <a href="submit_assignment.php?assignment_id=<?= $row['assignment_id'] ?>" class="btn btn-success btn-sm">Submit</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center text-muted">No assignments found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
