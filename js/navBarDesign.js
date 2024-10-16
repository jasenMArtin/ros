document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header'); 
    const profile = document.querySelector('.profile');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const navbar = document.querySelector('.navbar'); // Target your .navbar for background color
    const navbarToggler = document.querySelector('.navbar-toggler'); // Burger menu button
    const navbarCollapse = document.querySelector('.navbar-collapse'); // Burger menu dropdown container

    // Show/hide dropdown on profile click
    profile.addEventListener('click', function() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Hide dropdown if clicking outside of it
    document.addEventListener('click', function(event) {
        if (!profile.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    // Scroll effect for header
    document.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
            navbar.classList.add('scrolled'); // Add the scrolled class to navbar for background color
        } else {
            header.classList.remove('scrolled');
            navbar.classList.remove('scrolled'); // Remove the scrolled class from navbar
        }
    });

    // Burger menu click effect (even if not scrolled)
    navbarToggler.addEventListener('click', function() {
        // Toggle the 'scrolled' class to apply the background color when the burger menu is clicked
        navbar.classList.toggle('scrolled');
    });

    // Hide burger menu when clicking outside of the navbar
    document.addEventListener('click', function(event) {
        if (!navbarToggler.contains(event.target) && !navbarCollapse.contains(event.target)) {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click(); // Close the burger menu
                navbar.classList.remove('scrolled'); // Remove the background color when closed
            }
        }
    });
});
