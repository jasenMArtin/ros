<?php 
// Get user_id from the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$phone_number = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Only fetch user data if the user_id is set
if ($user_id) {
    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Get user data
        $user = $result->fetch_assoc();
    } else {
        $user = []; // Initialize an empty array if no user is found
    }
} else {
    $user = []; // No user logged in
}
?>
