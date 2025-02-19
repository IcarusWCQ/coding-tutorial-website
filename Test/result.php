<?php
include 'db.php';
include 'header_quiz.php';

$quiz_id = $_GET['quiz_id'];
$user_id = $_GET['user_id'];

$sql = "SELECT q.Question_Text, o.Option_Text, o.Is_Correct
        FROM response r
        JOIN question q ON r.Question_ID = q.Question_ID
        JOIN `option` o ON r.Option_ID = o.Option_ID
        WHERE r.Quiz_ID = '$quiz_id' AND r.User_ID = '$user_id'";
$result = $conn->query($sql);
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Quiz Result</h5>
    <a href="userindex.php" class="btn btn-secondary mb-3">Back to Quiz List</a>
    <ul class="list-group">
      <?php while ($row = $result->fetch_assoc()) { ?>
      <li class="list-group-item">
        <p><strong><?php echo $row['Question_Text']; ?></strong></p>
        <p>Your answer: <?php echo $row['Option_Text']; ?></p>
        <?php if ($row['Is_Correct']) { ?>
        <p class="text-success"><strong>Correct</strong></p>
        <?php } else { ?>
        <p class="text-danger"><strong>Incorrect</strong></p>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<?php include 'footer_quiz.php'; ?>
