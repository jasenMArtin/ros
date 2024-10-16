<?php
include 'config.php'; // Ensure this file contains the database connection setup

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