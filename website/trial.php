<?php
include '../php/config.php'; 

// SQL query to fetch one item for each distinct category
$sql_items_per_category = "
    SELECT i.category, i.item_title, i.item_image
    FROM tbl_items i
    INNER JOIN (
        SELECT category, MIN(item_id) AS min_id
        FROM tbl_items
        WHERE item_active = 1
        GROUP BY category
    ) AS grouped ON i.item_id = grouped.min_id
    ORDER BY i.category;"; // Order by category for clarity

// Execute the query
$result_items_per_category = $conn->query($sql_items_per_category);

// Check if the query was successful
if ($result_items_per_category === false) {
    die("Query failed: " . $conn->error);
}

// Initialize an array to hold the items
$items = [];

// Fetch the results into an array
while ($row = $result_items_per_category->fetch_assoc()) {
    $items[] = $row; // Store each item in the array
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items by Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <!-- Tailwind CSS CDN -->
</head>
<body>
    <!-- Items by Category Section -->
    <div class="max-w-7xl mx-auto py-12">
        <h2 class="text-center text-3xl font-bold text-orange-600 mb-4">What We Make</h2>
        <p class="text-center text-gray-600 mb-8">Explore our delicious items by category!</p>
        
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <?php
            // Display items dynamically
            if (!empty($items)) {
                foreach ($items as $item) {
                    // Debugging output
                    echo '<!-- Debug: Category: ' . htmlspecialchars($item['category']) . ', Title: ' . htmlspecialchars($item['item_title']) . ' -->';
                    
                    echo '<div class="group text-center">';
                    echo '<img src="' . htmlspecialchars($item['item_image']) . '" alt="' . htmlspecialchars($item['item_title']) . '" class="w-full h-72 object-cover rounded-lg shadow-md">';
                    echo '<h3 class="text-xl text-gray-800 font-semibold mt-4">' . htmlspecialchars($item['item_title']) . '</h3>';
                    echo '<p class="text-gray-500">' . htmlspecialchars($item['category']) . '</p>'; // Display the category name
                    echo '</div>';
                }
            } else {
                echo '<div class="col-span-5 text-center text-gray-600">No items found.</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
