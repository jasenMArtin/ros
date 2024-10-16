<?php include('../partials/menu.php'); ?> 
<?php include('../php/config.php'); ?>
<link rel="stylesheet" href="../styles/orderNow.css">
<title>Order Now</title>
<style>
    /* Main container styling */
    .mainContainer {
        display: flex; /* Change to flex for better responsiveness */
        width: 100%;
        margin-top: 5em;
        background-color: #ececec;
    }
    /* Sidebar styling */
    .sidebar {
        padding: 25px;
        background-color: gray;
        transition: transform 0.3s ease, opacity 0.3s ease; /* Transition for smooth toggling */
        opacity: 1; /* Always visible on desktop */
        transform: translateX(0); /* Positioned normally */
        z-index: 100; /* Ensure it’s above other elements */
    }

    /* Mobile styles */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed; /* Fix the sidebar to the left */
            height: 100%; /* Full height */
            opacity: 0; /* Initially hidden */
            transform: translateX(-100%); /* Start off-screen */
        }
        .sidebar.active {
            opacity: 1; /* Make visible */
            transform: translateX(0); /* Move to visible position */
            z-index: 10000;
        }
        .toggle-btn {
            display: block; /* Show the toggle button on mobile */
            position: fixed; /* Fix it to the top left */
            top: 7em;
            left: 1em; /* Add left positioning for better placement */
            background: #333; /* Background color */
            color: white; /* Text color */
            border: none; /* No border */
            padding: 7px;
            cursor: pointer; /* Pointer cursor */
            transform: rotate(270deg); /* Rotate it to read top to bottom */
        }
    }

    /* Desktop styles */
    @media (min-width: 769px) {
        .toggle-btn {
            display: none; /* Hide the toggle button on larger screens */
        }
    }

    /* Main content styling */
    .food-menu {
        flex-grow: 1; /* Allow main content to grow */
        padding: 20px;
    }
</style>

<body>
<button class="toggle-btn" onclick="toggleSidebar()">Category</button>

<div class="mainContainer">
    <div class="sidebar" id="sidebar">
        <h3>Category</h3>
        <div class="option">
            <label>
                <input type="radio"> Veggies
            </label>
        </div>
        <div class="option">
            <label>
                <input type="radio"> Meat
            </label>
        </div>
        <div class="option">
            <label>
                <input type="radio"> Chicken Biryani
            </label>
        </div>
        <div class="option">
            <label>
                <input type="radio"> Seafood
            </label>
        </div>
    </div>

    <!-- FOOD Menu Section -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <!-- Display the items from the Database -->
            <?php
                $sql = "SELECT * FROM tbl_items WHERE item_active = 1"; 
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="<?php echo $row['item_image']; ?>" alt="<?php echo $row['item_title']; ?>" class="img-responsive img-curve">
                            </div>
                            <div class="food-menu-desc">
                                <h6><?php echo $row['item_title']; ?></h6>
                                <p class="food-price">₱<?php echo $row['price']; ?></p>
                                <p class="food-detail"><?php echo $row['description']; ?></p>
                                <a href="#" class="btn btn-primary add-to-cart-btn" 
                                    data-title="<?php echo $row['item_title']; ?>" 
                                    data-price="<?php echo $row['price']; ?>" 
                                    data-description="<?php echo $row['description']; ?>" 
                                    data-image="<?php echo $row['item_image']; ?>" 
                                    data-id="<?php echo $row['item_id']; ?>">Add to Cart</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='error'>Food not found.</div>";
                }

                $conn->close();
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Food Card Modal -->
    <div id="foodCardModal" class="food-card-modal" style="display: none;">
        <div class="food-card">
            <span class="close">&times;</span>
            <div class="food-card-img">
                <img id="foodCardImage" src="" alt="Food Image" data-item-id="">
            </div>
            <div class="food-card-content">
                <h2 id="foodCardTitle"></h2>
                <p id="foodCardDescription"></p>
                <p><strong>Price:</strong> <span id="foodCardPrice" class="price"></span></p>
                <p><strong>Spice Level:</strong>
                    <select id="foodCardSpiceLevel" class="spice-level">
                        <option value="mild">Mild</option>
                        <option value="medium">Medium</option>
                        <option value="spicy">Spicy</option>
                        <option value="extra spicy">Extra Spicy</option>
                    </select>
                </p>
                <p class="qty"><strong>Quantity:</strong> 
                    <button class="qty-btn" onclick="updateQuantity(-1)">-</button>
                    <span id="foodCardQuantity" class="quantity">1</span>
                    <button class="qty-btn" onclick="updateQuantity(1)">+</button>
                </p>
                <p><strong>Subtotal:</strong> <span id="foodCardSubtotal" class="subtotal"></span></p>
                <p>
                    <textarea id="foodCardNotes" rows="3" placeholder="Enter any notes here..."></textarea>
                </p>
                <button class="add-to-cart" id="addToCartButton">Add to cart</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/orderNow.js"></script>
<script>
    // Toggle sidebar visibility
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active'); // Toggle active class to show/hide sidebar
    }

    // Hide sidebar when clicking outside
    document.addEventListener('click', function (event) {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.querySelector('.toggle-btn');

        // Check if the clicked target is not the sidebar and not the toggle button
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove('active'); // Hide sidebar if clicking outside
        }
    });

    // Hide sidebar on scroll
    window.addEventListener('scroll', function() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('active')) {
            sidebar.classList.remove('active'); // Hide the sidebar
        }
    });
</script>

</body>
</html>
