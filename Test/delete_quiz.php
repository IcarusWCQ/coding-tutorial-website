<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];

    // Start by deleting options related to questions in the quiz
    $sql_delete_options = "DELETE `option`
                           FROM `option`
                           JOIN question ON `option`.Question_ID = question.Question_ID
                           WHERE question.Quiz_ID = $quiz_id";
    if ($conn->query($sql_delete_options) === TRUE) {
        // Next, delete questions related to the quiz
        $sql_delete_questions = "DELETE FROM question WHERE Quiz_ID = $quiz_id";
        if ($conn->query($sql_delete_questions) === TRUE) {
            // Finally, delete the quiz itself
            $sql_delete_quiz = "DELETE FROM quiz WHERE Quiz_ID = $quiz_id";
            if ($conn->query($sql_delete_quiz) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error deleting quiz: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error deleting questions: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting options: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>Invalid request</div>";
}
?>
