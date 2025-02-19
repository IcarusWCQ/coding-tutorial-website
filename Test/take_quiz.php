<?php
session_start();
include 'db.php';
include 'header_quiz.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../User/UserLogin.html");
    exit;
}

$quiz_id = $_GET['quiz_id'];
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['responses'] as $question_id => $option_id) {
        $sql = "INSERT INTO response (User_ID, Quiz_ID, Question_ID, Option_ID) VALUES ('$user_id', '$quiz_id', '$question_id', '$option_id')";
        $conn->query($sql);
    }
    header("Location: result.php?quiz_id=$quiz_id&user_id=$user_id");
    exit;
}

$sql = "SELECT * FROM question WHERE Quiz_ID = '$quiz_id'";
$result = $conn->query($sql);
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Take Quiz</h5>
        <a href="userindex.php" class="btn btn-secondary mb-3">Back to Quiz List</a>
        <form method="post" action="take_quiz.php?quiz_id=<?php echo $quiz_id; ?>">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="mb-3">
                    <p><strong><?php echo $row['Question_Text']; ?></strong></p>
                    <?php
                    $question_id = $row['Question_ID'];
                    $sql_options = "SELECT * FROM `option` WHERE Question_ID = '$question_id'";
                    $result_options = $conn->query($sql_options);
                    while ($option = $result_options->fetch_assoc()) {
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="responses[<?php echo $question_id; ?>]" value="<?php echo $option['Option_ID']; ?>" required>
                            <label class="form-check-label">
                                <?php echo $option['Option_Text']; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit Quiz</button>
        </form>
    </div>
</div>

<?php include 'footer_quiz.php'; ?>
