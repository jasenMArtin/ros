<?php
include('config.php'); // Include your database connection

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$cart_id = $data->cart_id;

$response = array();

if (isset($cart_id)) {
    // Prepare and execute the deletion query
    $stmt = $conn->prepare("DELETE FROM tbl_carts WHERE cart_id = ?");
    $stmt->bind_param("i", $cart_id);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Item removed successfully.";
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to remove item.";
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = "No cart ID provided.";
}

echo json_encode($response);
$conn->close();
?>
