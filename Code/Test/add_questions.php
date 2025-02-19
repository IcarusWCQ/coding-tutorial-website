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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $question_text = $_POST['question_text'];
  $options = $_POST['options'];
  $correct_option = $_POST['correct_option'];

  $sql = "INSERT INTO question (Quiz_ID, Question_Text) VALUES ('$quiz_id', '$question_text')";
  if ($conn->query($sql) === TRUE) {
    $question_id = $conn->insert_id;

    foreach ($options as $index => $option_text) {
      $is_correct = ($index == $correct_option) ? 1 : 0;
      $sql = "INSERT INTO `option` (Question_ID, Option_Text, Is_Correct) VALUES ('$question_id', '$option_text', '$is_correct')";
      $conn->query($sql);
    }
    echo "<div class='alert alert-success' role='alert'>New question added successfully</div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
  }
}
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Add Questions to Quiz: <?php echo htmlspecialchars($quiz_title); ?></h5>
    <a href="edit_quiz.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-secondary mb-3">Back to Edit Quiz</a>
    <form method="post" action="add_questions.php?quiz_id=<?php echo $quiz_id; ?>">
      <div class="form-group">
        <label for="question_text">Question Text</label>
        <textarea class="form-control" id="question_text" name="question_text" rows="3" placeholder="Question Text" required></textarea>
      </div>
      <div class="form-group">
        <label>Options</label>
        <?php for ($i = 0; $i < 4; $i++) { ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="options[]" placeholder="Option <?php echo $i + 1; ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <input type="radio" name="correct_option" value="<?php echo $i; ?>" required>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
