<?php

include("db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Perform basic validation
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_name, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
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