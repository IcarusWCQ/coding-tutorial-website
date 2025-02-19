<?php
session_start();

$response = ['logged_in' => false];

if (isset($_SESSION['user_name'])) {
    $response['logged_in'] = true;
    $response['user_name'] = $_SESSION['user_name'];

    if (isset($_SESSION['role'])) {
        $response['role'] = $_SESSION['role'];
    }
}


// Set JSON header
header('Content-Type: application/json');

// Output JSON response
echo json_encode($response);
?>
