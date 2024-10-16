<?php
include('../php/config.php');
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['cart_id']) && isset($data['qty'])) {
    $cart_id = $data['cart_id'];
    $qty = $data['qty'];
    $stmt = $conn->prepare("UPDATE tbl_carts SET qty = ? WHERE cart_id = ?");
    $stmt->bind_param("ii", $qty, $cart_id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
$conn->close();
?>
