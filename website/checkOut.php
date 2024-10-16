<?php 
include('../partials/menu.php'); 
include('../php/config.php');

$current_page = basename($_SERVER['PHP_SELF']);

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo '
    <!-- Sub Navigation for Cart Page -->
    <nav class="mt-20 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center space-x-4">
                <a href="../website/cartPage.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "cart.php" ? "bg-yellow-300" : "") . '">Cart</a>
                <a href="../website/checkOut.php" class="text-gray-700 bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "checkout.php" ? "bg-yellow-300" : "") . '">Checkout</a>
                <a href="../website/orderHistory.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "order-history.php" ? "bg-yellow-300" : "") . '">Order History</a>
            </div>
        </div>
    </nav>
    ';

    // Fetch the checkouts along with the item images and quantity
    $sql = "SELECT co.total_amount, co.date, co.payment_status, co.delivery_status, 
                   i.item_image, i.item_title, ca.qty, i.price
            FROM tbl_checkout AS co
            JOIN tbl_carts AS ca ON co.cart_id = ca.cart_id
            JOIN tbl_items AS i ON ca.item_id = i.item_id
            WHERE co.user_id = ? 
            ORDER BY co.date DESC"; 

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $checkout_items = [];
    while ($row = $result->fetch_assoc()) {
        $date_key = date('M d, Y', strtotime($row['date'])); // Group by date in MMM-DD-YYYY format
        $checkout_items[$date_key][] = $row; // Group by checkout date
    }

    // Display the checkout items
    echo "<div class='checkout-container max-w-7xl mx-auto mt-10'>";
    foreach ($checkout_items as $date => $items) {
        echo "<div class='checkout-date bg-gray-100 p-4 rounded-lg shadow-md mb-4'>";
        echo "<h3 class='text-xl font-semibold mb-2'>$date</h3>";

        // Initialize total amount and payment status flags
        $total_amount = 0;
        $payment_status = '';
        $delivery_status = '';

        foreach ($items as $item) {
            echo "<div class='checkout-item flex items-center p-4 border-b'>";
            echo "<img src='" . htmlspecialchars($item['item_image']) . "' alt='" . htmlspecialchars($item['item_title']) . "' class='h-16 w-16 mr-4 rounded-md'>";
            echo "<div class='flex-grow'>";
            echo "<h4 class='font-bold'>" . htmlspecialchars($item['item_title']) . "</h4>";

            // Retrieve qty and price
            $qty = $item['qty'];  // Quantity from tbl_carts
            $price = $item['price']; // Price from tbl_items

            // Calculate subtotal
            $subtotal = $qty * $price;

            // Display qty and subtotal
            echo "<p class='text-gray-600'> $qty x ₱$price = <strong>₱$subtotal</strong></p>";
            echo "</div></div>";

            // Accumulate total amount
            $total_amount += $item['total_amount'];

            // Set payment status and delivery status
            if (empty($payment_status)) {
                $payment_status = htmlspecialchars($item['payment_status']);
            }
            if (empty($delivery_status)) {
                $delivery_status = htmlspecialchars($item['delivery_status']);
            }
        }

        // Define the background color based on payment status
        $payment_status_class = '';
        switch ($payment_status) {
            case 'pending':
                $payment_status_class = 'bg-yellow-300'; // yellow for pending
                break;
            case 'failed':
                $payment_status_class = 'bg-red-500 text-white'; // red for failed
                break;
            case 'completed':
                $payment_status_class = 'bg-green-500 text-white'; // green for completed
                break;
            default:
                $payment_status_class = 'bg-gray-500 text-white'; // default for unknown statuses
                break;
        }

        // Display the total amount, payment status, and delivery status for the date
        echo "<div class='mt-4 font-semibold'>
                <p>Total Amount: $$total_amount</p>
                <p class='$payment_status_class p-2 rounded'>Payment Status: $payment_status</p>
                <p>Delivery Status: $delivery_status</p>
              </div>";

        echo "</div>";
    }
    echo "</div>";

    $stmt->close();
    $conn->close();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../styles/cartPage.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .checkout-date {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .checkout-item {
            transition: background-color 0.2s;
        }
        .checkout-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <!-- Content will be injected here by PHP -->
</body>
</html>
