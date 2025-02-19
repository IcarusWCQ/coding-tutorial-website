<?php
include 'db.php';
include 'header.php';
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Quizzes</h5>
    <a href="create_quiz.php" class="btn btn-primary mb-3">Create New Quiz</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM quiz";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Quiz_Title']}</td>
                    <td>
                      <a href='edit_quiz.php?quiz_id={$row['Quiz_ID']}' class='btn btn-secondary'>Edit</a>
                      <a href='delete_quiz.php?quiz_id={$row['Quiz_ID']}' class='btn btn-danger'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No quizzes found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'footer.php'; ?>
