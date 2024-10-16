<?php
$servername = "localhost";  // Typically 'localhost' if running locally
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password (if any)
$dbname = "chillis";        // Name of your database

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
