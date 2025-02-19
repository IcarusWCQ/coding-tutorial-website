<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];

    // Delete question options first
    $sql_delete_options = "DELETE FROM `option` WHERE Question_ID = $question_id";
    if ($conn->query($sql_delete_options) === TRUE) {
        // Then delete the question
        $sql_delete_question = "DELETE FROM question WHERE Question_ID = $question_id";
        if ($conn->query($sql_delete_question) === TRUE) {
            header("Location: edit_quiz.php?quiz_id={$_GET['quiz_id']}");
            exit();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error deleting question: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting question options: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>Invalid request</div>";
}
?>
