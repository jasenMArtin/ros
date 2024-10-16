<?php
include('config.php'); 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve cart item IDs from the request
$data = json_decode(file_get_contents('php://input'), true);
$cartIds = $data['cartIds'];

if (empty($cartIds)) {
    echo json_encode(['success' => false, 'message' => 'No items selected for checkout']);
    exit();
}

$totalAmount = 0.0;
$cartItems = [];

try {
    // Prepare the insert query for tbl_checkout
    $checkoutQuery = "INSERT INTO tbl_checkout (user_id, cart_id, date, total_amount, payment_status, delivery_status) 
                      VALUES (?, ?, NOW(), ?, 'pending', 'pending')";
    $stmt = $conn->prepare($checkoutQuery);

    // Fetch the selected items and calculate the total amount per item
    foreach ($cartIds as $cartId) {
        $query = "SELECT tbl_carts.*, tbl_items.price, tbl_items.item_title 
                  FROM tbl_carts 
                  INNER JOIN tbl_items ON tbl_carts.item_id = tbl_items.item_id 
                  WHERE tbl_carts.cart_id = ?";
        $stmtSelect = $conn->prepare($query);
        $stmtSelect->bind_param("i", $cartId);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();
        $item = $result->fetch_assoc();
        
        // Calculate the total amount for each item (price * quantity)
        $itemTotal = $item['qty'] * $item['price'];
        $totalAmount += $itemTotal;

        // Add item details to cartItems array (for response, if needed)
        $cartItems[] = [
            'item_title' => $item['item_title'],
            'qty' => $item['qty'],
            'price' => $item['price'],
            'item_total' => $itemTotal,
        ];

        // Insert each cart item's total into tbl_checkout
        $stmt->bind_param("iid", $user_id, $cartId, $itemTotal);
        $stmt->execute();
    }

    // Response to the frontend
    echo json_encode(['success' => true, 'message' => 'Checkout successful', 'cartItems' => $cartItems]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error processing checkout: ' . $e->getMessage()]);
}

$conn->close();
?>
