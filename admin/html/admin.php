<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Chilli's Dashboard</title>
</head>
<body>

    <!-- Dashboard Section -->
    <div id="dashboard" class="dashboard hidden">
        <aside class="sidebar">
            <h1>Chilli's</h1>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="dropdown">
                        <!-- The class 'dropdown-toggle' is used for the click event and rotation effect -->
                        <a href="#" class="dropdown-toggle"><i class="fas fa-list"></i> Menus <i class="fas fa-caret-down"></i></a>
                        <ul class="dropdown-menu content-area" id="contentArea">
                            <li><a href="#" id="loadFoods">Foods</a></li>
                            <li><a href="#" id="loadDrinks">Drinks</a></li>
                            <li><a href="#" id="loadDesserts">Desserts</a></li>
                            <li><a href="#" class="add-button"><i class="fas fa-plus"></i> Add</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fas fa-star"></i> Reviews</a></li>
                    <li><a href="#" id="loadFaq"><i class="fas fa-comments"></i> FAQ's</a></li> 
                    <li><a href="#"><i class="fas fa-cogs"></i> Transaction History</a></li>
                    <li><a href="#"><i class="fas fa-user"></i> User Accounts</a></li>
                </ul>  
            </nav>
            <button id="logoutButton" class="logout-button">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Log Out
            </button>
        </aside>

        <main class="main-content">
           

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
    </div>
    
    <script src="../js/admin.js"></script><script>
        
    </script><script src="../js/fetchFoods.js"></script>
</body>
</html>
