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
    <script>
            function toggleCheckboxes() {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.itemCheckbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('purchase-button').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.itemCheckbox:checked');
            const cartIds = Array.from(checkboxes).map(cb => cb.value);

            console.log('Selected Cart IDs:', cartIds); // Debugging line

            if (cartIds.length > 0) {
                fetch('../php/purchase.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ cartIds: cartIds }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging line
                    if (data.success) {
                        alert('Purchase successful!');
                        location.reload();
                    } else {
                        alert('Purchase failed: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert('Please select at least one item to purchase.');
            }
        });
    });
    </script>
    <style>
td, th {
    padding: 5px; 
    text-align: left;
    border: 1px solid #ccc; 
}
.button {
    background-color: #d2691e; 
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold; 
}
    </style>
</head>
<body>
<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get the current file name
// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    echo '
    <!-- Sub Navigation for Cart Page -->
    <nav class="mt-20 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center space-x-4">
                <a href="../website/cartPage.php" class="text-gray-700 bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "cart.php" ? "bg-yellow-300" : "") . '">Cart</a>
                <a href="../website/checkOut.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "checkout.php" ? "bg-yellow-300" : "") . '">Checkout</a>
                <a href="../website/orderHistory.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "order-history.php" ? "bg-yellow-300" : "") . '">Order History</a>
            </div>
        </div>
    </nav>
    ';

    $user_id = $_SESSION['user_id'];

    // SQL query to get the items in the cart
    $query = "SELECT tbl_carts.*, tbl_items.price, tbl_items.item_image, tbl_items.item_title
              FROM tbl_carts 
              INNER JOIN tbl_items ON tbl_carts.item_id = tbl_items.item_id 
              WHERE tbl_carts.user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any items in the cart
    if ($result->num_rows > 0) {
        echo "<div class='cart-container'>";
        echo "<h2>Your Cart (" . $result->num_rows . " items)</h2>";
        
        // Select All Checkbox
        echo "<input type='checkbox' id='selectAll' onclick='toggleCheckboxes()'> Select All<br>";
        echo "<table class='cart-table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Select</th>"; // New column for checkboxes
        echo "<th>Item</th>";
        echo "<th>Name</th>";
        echo "<th>Spice Level</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Display the cart items
        while ($row = $result->fetch_assoc()) {
            $item_total = $row['qty'] * $row['price'];
        
            echo "<tr class='cart-item'>";
            echo "<td><input type='checkbox' class='itemCheckbox' value='" . $row['cart_id'] . "'></td>"; // Checkbox for each item
            echo "<td class='item-details'>";
            echo "<img src='" . htmlspecialchars($row['item_image']) . "' alt='" . htmlspecialchars($row['item_title']) . "' class='item-image' />";
            echo "</td>";
            echo "<td class='item-name'>" . htmlspecialchars($row['item_title']) . "</td>";
            echo "<td class='item-spice-level'>" . htmlspecialchars($row['spice_level']) . "</td>";
            echo "<td class='item-price'>$" . number_format($row['price'], 2) . "</td>";
            echo "<td class='item-quantity'>" . htmlspecialchars($row['qty']) . "</td>";
            echo "<td class='item-subtotal'>$" . number_format($item_total, 2) . "</td>";
            echo "</tr>";
        }
        

        // Closing tags for table and container
        echo "</tbody>";
        echo "</table>";
        echo "<button class='button' id='purchase-button'>Purchase</button>"; // Add Purchase button
        echo "</div>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }

    // Close the statement
    $stmt->close();
} else {
    // Display the "Your Cart is Empty" message if the user is not logged in
    echo '
    <div class="flex flex-col items-center justify-center min-h-screen items-center ">
    <h1 class="text-2xl font-semibold mb-4">Your Cart is Empty</h1>
    <p class="text-gray-600">
        Please <a href="../login/login.php" class="text-blue-500 hover:underline">Log in</a> / 
        <a href="../login/signup.php" class="text-blue-500 hover:underline">Sign up</a> to add items
    </p>
    </div>
    ';
}

// Close the database connection
$conn->close();
?>

</body>
</html>
