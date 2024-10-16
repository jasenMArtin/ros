<?php include('../partials/menu.php'); ?> 
<?php include('../php/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="../styles/cartPage.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<?php
$current_page = basename($_SERVER['PHP_SELF']);

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo '
    <!-- Sub Navigation for Cart Page -->
    <nav class="mt-20 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center space-x-4">
                <a href="../website/cartPage.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "cart.php" ? "bg-yellow-300" : "") . '">Cart</a>
                <a href="../website/checkOut.php" class="text-gray-700 hover:bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "checkout.php" ? "bg-yellow-300" : "") . '">Checkout</a>
                <a href="../website/orderHistory.php" class="text-gray-700 bg-yellow-300 font-semibold py-2 px-4 rounded-md no-underline ' . ($current_page == "order-history.php" ? "bg-yellow-300" : "") . '">Order History</a>
            </div>
        </div>
    </nav>
    ';


    // Order History Page Content
    echo "<div class='order-history-container'>";
    echo "<h2>This is your history page</h2>";
    echo "</div>";
} else {
    // Redirect to login page if not logged in
    header("Location: ../login/login.php");
    exit();
}

$conn->close();
?>
