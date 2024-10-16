<?php
session_start();
include '../php/config.php'; 
include '../partials/fetchNumItems.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../images/logoTab.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



</head>
<body>

<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <a class="navbar-brand" href="../website/homepage.php">
            <img src="../images/chillisLogo.png" alt="Logo" width="100" height="100%">
        </a>

        <!-- cart on mobile display only -->
        <div class="shopping-bag d-flex align-items-center mobile-cart">
            <a href="../website/cartPage.php" class="btn d-flex align-items-center">
                <i class="fas fa-shopping-bag"></i>
                <span class="item-count px-1"><?php echo $item_count; ?></span>
            </a>
        </div>

        <div class="profile dropdown d-flex align-items-center mobile-profile">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> <?php echo $first_name ?: 'Guest'; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownProfile">
                        <?php if ($is_logged_in): ?>
                            <a class="dropdown-item" href="../website/userProfile.php">View Profile</a>
                            <a class="dropdown-item" href="../php/signOut.php">Sign Out</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="../login/login.php">Log In</a>
                            <a class="dropdown-item" href="../login/signup.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav text-dark font-weight-bold ml-3">
                <li class="nav-item mx-2"><a class="nav-link" href="../website/homepage.php">HOME</a></li>
                <li class="nav-item mx-2"><a class="nav-link" href="../website/orderNow.php">ORDER NOW</a></li>
                <li class="nav-item mx-2"><a class="nav-link" href="../website/reviews.php">REVIEWS</a></li>
                <li class="nav-item mx-2"><a class="nav-link" href="../website/faqs.php">FAQs</a></li>
                <li class="nav-item mx-2"><a class="nav-link" href="../website/contactUs.php">CONTACT US</a></li>
            </ul>

            <!-- cart on desktop display only -->
            <div class="ml-auto d-flex align-items-center">
                <div class="shopping-bag d-flex align-items-center desktop-cart">
                    <a href="../website/cartPage.php" class="btn d-flex align-items-center">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="item-count px-1"><?php echo $item_count; ?></span>
                    </a>
                </div>

                <div class="profile dropdown d-flex align-items-center desktop-profile">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> <?php echo $first_name ?: 'Guest'; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownProfile">
                        <?php if ($is_logged_in): ?>
                            <a class="dropdown-item" href="../website/userProfile.php">View Profile</a>
                            <a class="dropdown-item" href="../php/signOut.php">Sign Out</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="../login/login.php">Log In</a>
                            <a class="dropdown-item" href="../login/signup.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<script>
    $('.navbar-toggler').click(function() {
    $('.sidebar').toggleClass('active');
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/navBarDesign.js"></script>
</body>
</html>
