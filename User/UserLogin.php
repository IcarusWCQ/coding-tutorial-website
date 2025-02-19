<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'projectdb');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT User_Password, User_ID, User_Name FROM user WHERE User_Email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($stored_password, $user_id, $user_name);
        $stmt->fetch();
        
        // Check password and set session if valid
        if ($password === $stored_password) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['role'] = 'user';
            header("Location: ../../Mainmenu.html");
            exit();
        } else {
            echo "Invalid email or password";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare SQL statement";
    }

    $conn->close();
}
?>
