<?php
// session_data.php

$first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';  
$is_logged_in = isset($_SESSION['user_id']); 
$item_count = 0;

// Fetch the number of items in the cart for the logged-in user
if ($is_logged_in) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT COUNT(*) AS item_count FROM tbl_carts WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $item_count = $row['item_count'];
}
$conn->close();
?>
