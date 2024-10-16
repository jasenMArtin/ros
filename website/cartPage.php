<?php include('../partials/menu.php'); ?> 
<?php include('../php/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../styles/cartPage.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="../js/sendPurchase.js"></script>
    <style>
        .cart-container {
            justify-content: space-between;
        }

        .cart-items {
            flex: 0.6;
            padding-right: 20px;
        }

        .order-summary {
            flex: 0.3;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            position: relative;
            max-width: 600px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
        }

        .cart-item-details {
            flex-grow: 1;
            margin-left: 15px;
        }

        .cart-item-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .cart-item-qty-price {
            font-size: 16px;
        }

        .cart-item-total {
            font-size: 18px;
            font-weight: bold;
            color: #d2691e;
        }

        .remove-item {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: red;
            color: white;
            padding: 3px 6px;
            border-radius: 50%;
            cursor: pointer;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-buttons input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            margin: 0 5px;
        }

        .quantity-buttons button {
            background-color: #d2691e;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
$current_page = basename($_SERVER['PHP_SELF']);


if (isset($_SESSION['user_id'])) { 
    echo '
    <nav class="mt-20 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center space-x-4">
                <a href="../website/cartPage2.php" class="text-gray-700 bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "cart.php" ? "bg-yellow-300" : "") . '">Cart</a>
                <a href="../website/checkOut.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "checkout.php" ? "bg-yellow-300" : "") . '">Checkout</a>
                <a href="../website/orderHistory.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "order-history.php" ? "bg-yellow-300" : "") . '">Order History</a>
            </div>
        </div>
    </nav>
    ';
    
    // Fetch user_id and items in the cart
    $user_id = $_SESSION['user_id'];
    $query = "SELECT tbl_carts.*, tbl_items.price, tbl_items.item_image, tbl_items.item_title
              FROM tbl_carts 
              INNER JOIN tbl_items ON tbl_carts.item_id = tbl_items.item_id 
              WHERE tbl_carts.user_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $total_price = 0;

    if ($result->num_rows > 0) {
        echo "<div class='flex'>";
        
        echo "<div class='w-1/2 mr-6'>"; 
        echo "<h2 class='bg-gray-500 text-white p-2 w-full'>Food Items</h2>";
        echo "<div class='cart-container'>";
        echo "<div class='cart-items'>";
    
        while ($row = $result->fetch_assoc()) {
            $item_total = $row['qty'] * $row['price'];
            $total_price += $item_total;
    
            echo "<div class='cart-item' data-cart-id='" . htmlspecialchars($row['cart_id']) . "'>"; // Parent div for the item
            echo "<div class='remove-item' data-cart-id='" . htmlspecialchars($row['cart_id']) . "'><i class='fas fa-trash-alt fa-xs'></i></div>";
            echo "<td><input type='checkbox' class='itemCheckbox' value='" . $row['cart_id'] . "'></td>";
            echo "<img src='" . htmlspecialchars($row['item_image']) . "' alt='" . htmlspecialchars($row['item_title']) . "'>";
            echo "<div class='cart-item-details'>";
            echo "<div class='cart-item-name'>" . htmlspecialchars($row['item_title']) . "</div>";
            echo "<div class='cart-item-qty-price'>" . htmlspecialchars($row['qty']) . " x ₱" . number_format($row['price'], 2) . "</div>";
            echo "<div class='quantity-buttons'>";
            echo "<button class='decrease-qty' data-cart-id='" . htmlspecialchars($row['cart_id']) . "'>-</button>";
            echo "<input type='text' class='item-qty' value='" . htmlspecialchars($row['qty']) . "' readonly data-cart-id='" . htmlspecialchars($row['cart_id']) . "'>";
            echo "<button class='increase-qty' data-cart-id='" . htmlspecialchars($row['cart_id']) . "'>+</button>";
            echo "</div>";
            echo "</div>";
            echo "<div class='cart-item-total'>₱" . number_format($item_total, 2) . "</div>";
            echo "</div>";
            echo "<hr class='my-2 border-gray-300'>";
        }

        echo "</div>"; // Close .cart-items
        echo "</div>"; // Close .cart-container 
        echo "</div>"; // Close first column

        echo "<div class='w-1/2'>"; // Start second column
        echo "<h2 class='bg-gray-500 text-white p-2 w-full'>Order Summary</h2>";
        echo "<div class='order-summary'>";
        echo "<p>Selected items total: ₱" . number_format($total_price, 2) . "</p>";
        echo "<button class='button' id='purchase-button'>Purchase</button>";
        echo "</div>"; 
        echo "</div>"; // Close second column
        echo "</div>"; // Close flex container
    } else { 
        echo '
        <div class="flex flex-col items-center justify-center min-h-screen">
            <img src="../assets/emptyCart.png" alt="Empty Cart"  class="mb-3 w-52">
            <h1 class="text-2xl font-semibold mb-2">No Items in cart</h1>
            <p class="text-gray-600 mb-4">Add items you want to shop</p>
            <a href="../website/orderNow.php" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-md">Start Shopping</a>
        </div>
        ';
    }
    

    $stmt->close();
} else { // Else condition for if user is not logged in
    echo '
        <div class="flex flex-col items-center justify-center min-h-screen">
            <img src="../assets/emptyCart.png" alt="Empty Cart"  class="mb-3 w-52">
            <h1 class="text-2xl font-semibold mb-2">No Items in cart</h1>
             <p class="text-gray-600">
            Please <a href="../login/login.php" class="text-blue-500 hover:underline">Log in</a> / 
            <a href="../login/signup.php" class="text-blue-500 hover:underline">Sign up</a> to add items
        </p>
        </div>';
}

$conn->close();
?>

<script src="../js/deleteItemFromCart.js"></script>
<script src="../js/updateCartQuantity.js"></script>
</body>
</html>
