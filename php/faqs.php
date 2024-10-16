<?php
include 'config.php';
include('../partials/getUserData.php');
// Initialize variables
$name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
$phone_number = isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : '';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Check if user is logged in

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $message = $conn->real_escape_string($_POST['message']);

    // Insert the message into tbl_faqs if user is logged in
    if ($user_id) {
        $sql = "INSERT INTO tbl_message (user_id, message, datetime) VALUES ('$user_id', '$message', NOW())"; 
        
        if ($conn->query($sql) === TRUE) {
            // Use a session variable to indicate success
            $_SESSION['message'] = "Successfully sent message.";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not logged in.";
    }
}


?>
