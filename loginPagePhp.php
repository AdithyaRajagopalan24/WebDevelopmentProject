<?php
session_start(); // Start the session to store login status

// Database connection variables
$host = 'localhost';
$db = 'webdevproject';
$user = 'root';
$pass = 'boppu1234!@';

// Create a new database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable to show error or success messages
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to check if email exists
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        // Bind the result and fetch the hashed password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email; // Store user email in session
            $message = "Login successful!"; // Redirect or handle successful login
        } else {
            $message = "Incorrect password. Please try again.";
        }
    } else {
        $message = "No account found with that email.";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();