<?php
include 'config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Plain text password

    // Prepare and execute the query to fetch user data based on email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['user_id']; 
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['role'] = $user['role']; // Store the user's role in the session

            // Redirect based on the user's role
            if ($user['role'] == 'admin') {
                header("Location: ../admin/html/admin.php"); // Redirect to admin page
            } elseif ($user['role'] == 'staff') {
                header("Location: ../staff/trial.php"); // Redirect to staff page
            } else {
                header("Location: ../website/homepage.php"); // Default redirection for users
            }
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Incorrect email or password. Please try again.";
    }

 // After processing, redirect to prevent resubmission
 header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
 exit();
}
?>
