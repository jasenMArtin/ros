<?php
// Include the database configuration file
include 'config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the form data
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);

    // Validate passwords
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, address, password, phone_number) 
                VALUES ('$first_name', '$last_name', '$email' , '$address', '$hashed_password', '$phone_number')";

        if ($conn->query($sql) === TRUE) {
            // Set session variables after successful registration
            $_SESSION['user_id'] = $conn->insert_id; // Retrieve the ID of the newly inserted record
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name; // Optional if you want to store last name as well

            // Redirect to homepage.php after successful registration
            header("Location: ../website/homepage.php");
            exit();  // Ensure the script stops executing after the redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}
?>
