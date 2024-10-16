<?php
session_start(); // Start the session
include('config.php'); // Include your database connection

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

// Get the raw POST data and decode the JSON
$data = json_decode(file_get_contents('php://input'), true);

// Check if the required fields are set
if (isset($data['item_id'], $data['qty'], $data['spice_level'])) {
    $user_id = intval($_SESSION['user_id']); // Use session user ID
    $item_id = intval($data['item_id']);
    $qty = intval($data['qty']);
    $spice_level = $data['spice_level'];

    // Check if the item already exists in the cart
    $stmt = $conn->prepare("SELECT qty FROM tbl_carts WHERE user_id = ? AND item_id = ? AND spice_level = ?");
    $stmt->bind_param("iis", $user_id, $item_id, $spice_level);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Item exists, so update the quantity
        $row = $result->fetch_assoc();
        $new_qty = $row['qty'] + $qty;
        
        // Update the quantity in the cart
        $update_stmt = $conn->prepare("UPDATE tbl_carts SET qty = ? WHERE user_id = ? AND item_id = ? AND spice_level = ?");
        $update_stmt->bind_param("iiis", $new_qty, $user_id, $item_id, $spice_level);
        
        if ($update_stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item quantity updated in the cart']);
        } else {
            echo json_encode(['success' => false, 'error' => $update_stmt->error]);
        }
        $update_stmt->close();
    } else {
        // Item does not exist, so insert a new record
        $insert_stmt = $conn->prepare("INSERT INTO tbl_carts (user_id, item_id, qty, spice_level, added_date) VALUES (?, ?, ?, ?, NOW())");
        $insert_stmt->bind_param("iiis", $user_id, $item_id, $qty, $spice_level);
        
        if ($insert_stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item added to the cart']);
        } else {
            echo json_encode(['success' => false, 'error' => $insert_stmt->error]);
        }
        $insert_stmt->close();
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

// Close the database connection
$conn->close();
?>

