<?php
$servername = "localhost";  // Use "localhost" for local connections
$username = "root";         // Default MySQL username
$password = "";             // Usually blank for local installations
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
