<?php include('../partials/menu.php'); ?> 
<?php include('../php/knownFor.php'); ?> 
<title>Homepage</title>
<link rel="stylesheet" href="../styles/homepage.css">

    <section class="hero-section">
        <div class="hero-content">
            <h1>Your Everyday Indian Food</h1>
            <p>Good for the soul, good for you.</p>
            <a href="#" class="order-button">Order Now</a>
        </div>
    </section>

        <!-- What we're known for -->
    <div class="max-w-7xl mx-auto py-12">
        <h2 class="text-center text-3xl font-bold text-orange-600 mb-4">What We're Known For</h2>
        <p class="text-center text-gray-600 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="group relative">
                <img src="https://via.placeholder.com/300x300.png?" alt="Tandoori Chicken" class="w-full h-72 object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-white bg-opacity-50 opacity-0 transition-opacity duration-300 flex items-center justify-center overlay">
                    <h3 class="text-xl text-gray-800 font-semibold">Tandoori Chicken</h3>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group relative">
                <img src="https://via.placeholder.com/300x300.png?" alt="Palak Paneer" class="w-full h-72 object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-white bg-opacity-50 opacity-0 transition-opacity duration-300 flex items-center justify-center overlay">
                    <h3 class="text-xl text-gray-800 font-semibold">Palak Paneer</h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group relative">
                <img src="https://via.placeholder.com/300x300.png?" alt="Biryani" class="w-full h-72 object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-white bg-opacity-50 opacity-0 transition-opacity duration-300 flex items-center justify-center overlay">
                    <h3 class="text-xl text-gray-800 font-semibold">Biryani</h3>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="group relative">
                <img src="https://via.placeholder.com/300x300.png?" alt="Butter Chicken" class="w-full h-72 object-cover rounded-lg shadow-md">
                <div class="absolute inset-0 bg-white bg-opacity-50 opacity-0 transition-opacity duration-300 flex items-center justify-center overlay">
                    <h3 class="text-xl text-gray-800 font-semibold">Butter Chicken</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- what we make -->
    <div class="max-w-7xl mx-auto py-12">
        <h2 class="text-center text-3xl font-bold text-orange-600 mb-4">What We Make</h2>
        <p class="text-center text-gray-600 mb-8">Explore our delicious items by category!</p>
        
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <?php
            // Display items dynamically
            if (!empty($items)) {
                foreach ($items as $item) {
                    // Check if the category is "Drinks"; if so, skip to the next iteration
                    if ($item['category'] === 'Drinks' || $item['category'] === 'Food' ) {
                        continue; // Skip the current iteration if the category is "Drinks"
                    }
                    
                    // Debugging output to ensure data is being fetched correctly
                    echo '<!-- Debug: Category: ' . htmlspecialchars($item['category']) . ', Title: ' . htmlspecialchars($item['item_title']) . ', Image: ' . htmlspecialchars($item['item_image']) . ' -->';
                    
                    echo '<div class="group text-center">';
                    echo '<img src="' . htmlspecialchars($item['item_image']) . '" alt="' . htmlspecialchars($item['item_title']) . '" class="w-full h-72 object-cover rounded-lg shadow-md">';
                    echo '<h3 class="text-xl text-gray-800 font-semibold mt-4">' . htmlspecialchars($item['category']) . '</h3>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-span-5 text-center text-gray-600">No items found.</div>';
            }
            ?>
        </div>
    </div>


    <!-- icons -->
    <div class="flex justify-center items-center space-x-20 px-20 py-20">
        <!-- First Icon -->
        <div class="text-center">
            <i class="fas fa-utensils text-5xl text-orange-700"></i>
            <p class="mt-4 text-lg font-semibold">Dishes for You</p>
            <p class="text-red-600 mt-2">45</p>
        </div>

        <!-- Second Icon -->
        <div class="text-center">
            <i class="fas fa-globe-asia text-5xl text-orange-700"></i>
            <p class="mt-4 text-lg font-semibold">Different Origin</p>
            <p class="text-red-600 mt-2">15</p>
        </div>

        <!-- Third Icon -->
        <div class="text-center">
            <i class="fas fa-drumstick-bite text-5xl text-orange-700"></i>
            <p class="mt-4 text-lg font-semibold">Specialties from India</p>
            <p class="text-red-600 mt-2">10</p>
        </div>

        <!-- Fourth Icon -->
        <div class="text-center">
            <i class="fas fa-fire text-5xl text-orange-700"></i>
            <p class="mt-4 text-lg font-semibold">Years Cooking</p>
            <p class="text-red-600 mt-2">5</p>
        </div>
    </div>

    <!-- Discount Section -->
<div class="max-w-7xl mx-auto py-12 bg-yellow-500 rounded-lg shadow-lg text-center my-8">
    <h2 class="text-4xl font-bold text-white mb-4">Use Our 5% Discount Code</h2>
    <p class="text-xl text-white mb-6">Save on your next purchase! Apply the code <span class="font-bold">SAVE5</span> at checkout to get 5% off.</p>
    <a href="orderNow.php" class="inline-block bg-white text-yellow-500 font-semibold py-3 px-8 rounded-full hover:bg-gray-100 transition-all duration-300">Shop Now</a>
</div>


    <!-- <div class="relative w-full h-screen">
    <img src="https://via.placeholder.com/1920x1080.png?text=" alt="Restaurant Background" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute top-20 left-0 p-6 px-20">
        <h1 class="text-white text-3xl font-bold">Welcom x Our Restaurant</h1>
        <p class="text-white text-xl mt-2 py-10 ">We don’t just make food. We make people’s days. Swagat Indian Cuisine was built on the belief that food should be special, and we carry that belief into everything we do. With over two decades of experience, we understand how to best serve our customers with true service principles. We create food we’re proud to serve and deliver it fast, with a smile. No matter where you find us, we’re making sure each meal our customers enjoy is delicious and one-of-a-kind.</p>
        <p class="text-white text-3xl font-semibold">Chillis</p>
    </div> -->

    <div class="clearfix">
            <!-- Include the contact form -->
            <?php include('contactMap.php'); ?>
    </div>





</div>
