<?php
include 'db.php';
include 'header_quiz.php';

// Fetch all available quizzes
$sql_quizzes = "SELECT * FROM quiz";
$result_quizzes = $conn->query($sql_quizzes);
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Available Quizzes</h5>
    <ul class="list-group">
      <?php while ($quiz = $result_quizzes->fetch_assoc()) { ?>
      <li class="list-group-item">
        <p><strong><?php echo isset($quiz['Quiz_Title']) ? $quiz['Quiz_Title'] : 'No Title'; ?></strong></p>
        <a href="take_quiz.php?quiz_id=<?php echo $quiz['Quiz_ID']; ?>" class="btn btn-primary">Take Quiz</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<?php include 'footer_quiz.php'; ?>
