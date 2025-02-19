<?php
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];

    $sql = "SELECT * FROM question WHERE Question_ID = $question_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question_text = $row['Question_Text'];
    } else {
        echo "<div class='alert alert-danger' role='alert'>Question not found</div>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $question_text = $_POST['question_text'];
    $options = $_POST['options'];
    $correct_option = $_POST['correct_option'];

    // Update question text
    $sql_update_question = "UPDATE question SET Question_Text = '$question_text' WHERE Question_ID = $question_id";
    if ($conn->query($sql_update_question) === TRUE) {
        // Update options (assuming all options are updated every time)
        $sql_delete_options = "DELETE FROM `option` WHERE Question_ID = $question_id";
        if ($conn->query($sql_delete_options) === TRUE) {
            foreach ($options as $index => $option_text) {
                $is_correct = ($index == $correct_option) ? 1 : 0;
                $sql_insert_option = "INSERT INTO `option` (Question_ID, Option_Text, Is_Correct) VALUES ('$question_id', '$option_text', '$is_correct')";
                $conn->query($sql_insert_option);
            }
            echo "<div class='alert alert-success' role='alert'>Question updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error updating options: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error updating question text: " . $conn->error . "</div>";
    }
}
?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Edit Question</h5>
    <form method="post" action="edit_question.php">
      <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
      <div class="form-group">
        <label for="question_text">Question Text</label>
        <textarea class="form-control" id="question_text" name="question_text" rows="3" placeholder="Question Text" required><?php echo $question_text; ?></textarea>
      </div>
      <div class="form-group">
        <label>Options</label>
        <?php
        $sql_options = "SELECT * FROM `option` WHERE Question_ID = $question_id";
        $result_options = $conn->query($sql_options);
        if ($result_options->num_rows > 0) {
            while ($row_option = $result_options->fetch_assoc()) {
                $option_text = $row_option['Option_Text'];
                $is_correct = $row_option['Is_Correct'] ? 'checked' : '';
                echo "<div class='input-group mb-3'>
                        <input type='text' class='form-control' name='options[]' value='$option_text' required>
                        <div class='input-group-append'>
                          <div class='input-group-text'>
                            <input type='radio' name='correct_option' value='$option_text' $is_correct required>
                          </div>
                        </div>
                      </div>";
            }
        }
        ?>
      </div>
      <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
