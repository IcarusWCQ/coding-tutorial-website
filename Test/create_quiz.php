<?php
session_start();
include 'db.php'; // Ensure this file includes the database connection
include 'header.php'; // Include your header

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: AdminLogin.php"); // Redirect to login if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_title = $_POST['quiz_title'];
    $admin_id = $_SESSION['admin_id']; // Use session variable instead of POST

    $sql = "INSERT INTO quiz (Quiz_Title, Admin_ID) VALUES ('$quiz_title', '$admin_id')";
    if ($conn->query($sql) === TRUE) {
        $quiz_id = $conn->insert_id;
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Create Quiz</h5>
        <form method="post" action="create_quiz.php">
            <div class="form-group">
                <label for="quiz_title">Quiz Title</label>
                <input type="text" class="form-control" id="quiz_title" name="quiz_title" placeholder="Quiz Title" required>
            </div>
            <!-- You don't need to include admin_id input if using session variable -->
            <button type="submit" class="btn btn-primary">Create Quiz</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>