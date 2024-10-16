<?php include('../php/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>
    <style>
/* Menu Styling */
.menu-section {
    width: 100%;
    background-color: #f4f4f4;
    padding: 20px;
    box-sizing: border-box;
    clear: both; /* Ensures the menu stays above the sidebar */
    display: block; /* Makes sure the menu is a block element */
    text-align: center; /* Centers the menu items horizontally */
}

/* Layout Container */
.content {
    display: flex;
    flex-wrap: nowrap; /* Prevent wrapping */
    width: 100%;
    box-sizing: border-box;
    margin-top: 20px; /* Adds some space between the menu and the content */
}

/* Sidebar Styling */
.sidebar {
    width: 250px; /* Fixed width for sidebar */
    background-color: #ddd;
    padding: 20px;
    height: 100vh; /* Full height sidebar */
    box-sizing: border-box;
    flex-shrink: 0; /* Prevent sidebar from shrinking */
}

/* Main Content Area Styling */
.main-content {
    flex: 1; /* Take up remaining space */
    padding: 20px;
    background-color: #ececec;
    box-sizing: border-box;
}

    </style>
</head>
<body>

    <!-- Menu Section (Exclusive line for the menu) -->
    <div class="menu-section">
    <?php include('../partials/menu.php'); ?>

    </div>

    <!-- Sidebar and Main Content Layout -->
    <div class="content">
        <!-- Sidebar Section (On the left) -->
        <div class="sidebar">
            <h3>Menu Options</h3>
            <div class="option">
                <label>
                    <input type="checkbox"> Veggies
                </label>
            </div>
            <div class="option">
                <label>
                    <input type="checkbox"> Meat
                </label>
            </div>
            <div class="option">
                <label>
                    <input type="checkbox"> Chicken Biryani
                </label>
            </div>
            <div class="option">
                <label>
                    <input type="checkbox"> Seafood
                </label>
            </div>
        </div>

        <!-- Main Content Area (On the right) -->
        <div class="main-content">
            <h2>Food Menu</h2>
            <p>Content or menu items go here.</p>
        </div>
    </div>

</body>
</html>
