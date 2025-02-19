<?php
include 'db.php';
include 'header.php';

$quiz_id = $_GET['quiz_id'];

// Fetch quiz title from the database
$sql = "SELECT Quiz_Title FROM quiz WHERE Quiz_ID = $quiz_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quiz_title = $row['Quiz_Title'];
} else {
    $quiz_title = "Quiz Title Not Found"; // Default value if quiz not found (should handle this case better)
}
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Edit Quiz: <?php echo htmlspecialchars($quiz_title); ?></h5>
    <a href="add_questions.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-primary mb-3">Add New Question</a>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Quiz List</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Question Text</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM question WHERE Quiz_ID = $quiz_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Question_Text']}</td>
                    <td>
                      <a href='edit_question.php?question_id={$row['Question_ID']}' class='btn btn-secondary'>Edit</a>
                      <a href='delete_question.php?question_id={$row['Question_ID']}' class='btn btn-danger'>Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No questions found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'footer.php'; ?>
