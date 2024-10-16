document.addEventListener("DOMContentLoaded", function() {
    // Function to load items based on category
    function loadCategory(category) {
        const viewFood = document.getElementById('viewFood');

        fetch(`../adminPhp/getItems.php?category=${category}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Get the response as text (HTML)
            })
            .then(data => {
                // Load the fetched content into the content area
                viewFood.innerHTML = data;
                showSection('viewFood'); // Show food section after loading
            })
            .catch(error => {
                console.error('Error fetching the items content:', error);
            });
    }

    // Function to show a specific section
    function showSection(sectionId) {
        document.querySelectorAll('main > section').forEach(section => {
            section.classList.add('hidden');
        });
        const activeSection = document.getElementById(sectionId);
        if (activeSection) {
            activeSection.classList.remove('hidden');
        }
    }

    // Event listeners for each category
    document.getElementById('loadFoods').addEventListener('click', function(event) {
        event.preventDefault();
        loadCategory('Food');
    });

    document.getElementById('loadDrinks').addEventListener('click', function(event) {
        event.preventDefault();
        loadCategory('Drinks');
    });

    document.getElementById('loadDesserts').addEventListener('click', function(event) {
        event.preventDefault();
        loadCategory('Dessert');
    });

    document.getElementById('loadFaq').addEventListener('click', function(event) {
        event.preventDefault();
        showSection('faqSection'); // Show FAQ section
        // If you want to load content dynamically, fetch it here
    });
});
