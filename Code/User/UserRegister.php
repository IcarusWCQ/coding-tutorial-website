<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'projectdb');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO user (User_Name, User_Email, User_Password) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            echo "Registration successful";
            echo '<br><br>';
            echo '<button onclick="location.href=\'../../Mainmenu.html\'">Go to Main Menu</button>';
        } else {
            echo "Registration failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement";
    }

    $conn->close();
}
?>
