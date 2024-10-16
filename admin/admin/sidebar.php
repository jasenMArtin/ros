<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chilli's Dashboard</title>
</head>
<body class="flex bg-gray-100">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gray-800 text-white h-screen p-5 fixed left-0 top-0 transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0 z-50">
        <h1 class="text-xl font-bold mb-6">Chilli's</h1>
        <nav class="nav-menu">
            <ul>

                <li><a href="#" id="loadDashboard" class="active flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-home"></i> Dashboard</a></li>      
                <li><a href="#" id="loadNotification" class="active flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-bell"></i>Notification</a></li>      
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-list"></i> Menus <i class="fas fa-caret-down ml-auto"></i></a>
                    <ul class="dropdown-menu content-area ml-4 hidden">
                        <li><a href="#" id="loadFoods" class="block p-2 hover:bg-gray-600 rounded">Foods</a></li>
                        <li><a href="#" id="loadDrinks" class="block p-2 hover:bg-gray-600 rounded">Drinks</a></li>
                        <li><a href="#" id="loadDesserts" class="block p-2 hover:bg-gray-600 rounded">Desserts</a></li>
                        <li><a href="#" class="add-button block p-2 hover:bg-gray-600 rounded"><i class="fas fa-plus"></i> Add</a></li>
                    </ul>
                </li>
                <li><a href="#" class="flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-star"></i> Reviews</a></li>
                <li><a href="#" id="loadFaq" class="flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-comments"></i> FAQs</a>
                </li>
                <li><a href="#" class="flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-cogs"></i> Transaction History</a></li>
                <li><a href="#" class="flex items-center p-2 hover:bg-gray-700 rounded"><i class="fas fa-user"></i> User Accounts</a></li>
            </ul>
        </nav>
        <button id="logoutButton" class="logout-button mt-10 bg-red-600 text-white px-4 py-2 rounded flex items-center">
            <span class="icon mr-2"><i class="fas fa-sign-out-alt"></i></span> Log Out
        </button>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 h-screen overflow-y-auto">
        <button id="sidebarToggle" class="md:hidden bg-gray-800 text-white p-2 rounded-full focus:outline-none absolute left-4 top-4">
            <i class="fas fa-arrow-right" id="toggleIcon"></i>
        </button>

        <!--Display dashboard  -->
        <section id="dashboardSection" class="hidden"></section>

        <section id="notificationSection" class="hidden"></section>
    
        <!-- Display Food -->
        <section id="viewFood"></section>

        <!-- Display Reviews -->
        <section class="reviews-section">
            <div class="review-cards">
                <div class="review-card"></div>
            </div>
        </section>

        <!-- FAQ content will be loaded here -->
        <section id="faqSection" class="faq-content hidden"></section>
    </main>

    <script src="../js/fetchFoods.js"></script>
    <script src="../js/mobileSidebar.js"></script>
    <script src="../js/menuDropDown.js"></script>
    <script src="../js/faq.js"></script>

    <script>
        document.getElementById('loadDashboard').addEventListener('click', loadDashboard);
            function loadDashboard(event) {
                event.preventDefault();
                document.querySelectorAll('main > section').forEach(section => {
                    section.classList.add('hidden');
                });
                const dashboardSection = document.getElementById('dashboardSection');
                dashboardSection.classList.remove('hidden');
                fetch('dashboard.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        dashboardSection.innerHTML = data;
                    })
                    .catch(error => console.error('Error loading Dashboard:', error));
            }
    </script>

<script>
        document.getElementById('loadNotification').addEventListener('click', loadNotification);
            function loadNotification(event) {
                event.preventDefault();
                document.querySelectorAll('main > section').forEach(section => {
                    section.classList.add('hidden');
                });
                const notificationSection = document.getElementById('notificationSection');
                notificationSection.classList.remove('hidden');
                fetch('notification.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        notificationSection.innerHTML = data;
                    })
                    .catch(error => console.error('Error loading Dashboard:', error));
            }
    </script>
    
</body>
</html>
