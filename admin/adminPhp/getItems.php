<?php
include('../../php/config.php');

// Get the category from the query string
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : 'Food';

// SQL query to fetch items based on the category
$sql = "SELECT * FROM tbl_items WHERE category = '$category' AND item_active = 1";
$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="../css/foods.css">
<h2>List of <?php echo htmlspecialchars($category); ?></h2>
<table>
    <thead>
        <tr>
            <th>Items</th>
            <th>Images</th>
            <th>Names</th>
            <th>Description</th>
            <th>Prices</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="foodTableBody">
        <?php
        // Check if any items are returned from the query
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['item_id'] . "</td>";
                echo "<td><img src='../" . $row['item_image'] . "' alt='" . $row['item_title'] . "' width='50'></td>";
                echo "<td id='name'>" . htmlspecialchars($row['item_title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>₱" . number_format($row['price'], 2) . "</td>";
                echo "<td class='actions'>
                        <button class='button edit'>Edit</button>
                        <button class='button delete' onclick=\"deleteItem('" . $row['item_id'] . "')\">Delete</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            // If no items, show a message
            echo "<tr><td colspan='6'>No items found</td></tr>";
        }
        ?>
    </tbody>
</table>

