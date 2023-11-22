<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform basic validation (you should enhance this)
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You should perform proper authentication here (e.g., check against a database)
    // For simplicity, I'm using hardcoded values
    $valid_user = ($username == "admin" && $password == "password");

    if ($valid_user) {
        // Start a session
        session_start();

        // Set session variables
        $_SESSION["username"] = $username;

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials, redirect back to the login page
        header("Location: index.php");
        exit();
    }
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: index.php");
    exit();
}
?>