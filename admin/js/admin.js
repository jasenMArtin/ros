document.addEventListener("DOMContentLoaded", function () {
    // Dropdown toggle functionality
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('a');
        const menu = dropdown.querySelector('.dropdown-menu');

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const isActive = dropdown.classList.contains('active');

            // Hide all dropdowns and remove 'active' class
            dropdowns.forEach(d => {
                d.classList.remove('active');
                d.querySelector('.dropdown-menu').style.display = 'none';
            });

            // Toggle the current dropdown
            if (!isActive) {
                menu.style.display = 'block';
                dropdown.classList.add('active');
            } else {
                menu.style.display = 'none';
                dropdown.classList.remove('active');
            }
        });
    });

    // Function to load content dynamically
    function loadContent(path, sectionId) {
        document.getElementById(sectionId).addEventListener('click', function (event) {
            event.preventDefault();

            // Check if the content has already been loaded
            if (document.querySelector(`#${sectionId}Content`)) {
                console.log(`${sectionId} already loaded!`);
                return;
            }

            // Fetch the content based on the path
            fetch(path)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    // Parse the fetched HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Get the content inside the body
                    const content = doc.querySelector('body').innerHTML;

                    // Create a wrapper div with an ID to prevent multiple loads
                    const wrapper = document.createElement('div');
                    wrapper.id = `${sectionId}Content`; // Set an ID to check if it's already loaded
                    wrapper.innerHTML = content;

                    // Insert the content after the reviews-section
                    document.querySelector('.reviews-section').insertAdjacentElement('afterend', wrapper);

                    // Load the associated CSS and JS files dynamically
                    loadAssets();
                })
                .catch(error => {
                    console.error(`Error loading ${sectionId}:`, error);
                });
        });
    }

    

    // Call the function for each section to load content dynamically
    loadContent('../html/foods.html', 'loadFoods');
    loadContent('../html/drinks.html', 'loadDrinks');
    loadContent('../html/desserts.html', 'loadDesserts');
    loadContent('../html/snacks.html', 'loadSnacks');
    loadContent('../html/faq.html', 'loadFaq');  // This line handles the FAQ section loading

});


// Function to load FAQ content into the section
function loadFaqContent(url, elementId) {
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            document.getElementById(elementId).innerHTML = data; // Load FAQ content into the specified section
        })
        .catch(error => console.error('Error loading FAQ content:', error));
}

// Event listener for loading the FAQ section
document.getElementById('loadFaq').addEventListener('click', function() {
    loadFaqContent('../html/faq.html', 'faqSection'); // Load FAQ content
    document.getElementById('faqSection').classList.remove('hidden'); // Show the FAQ section
    document.getElementById('viewFood').innerHTML = ''; // Clear food content if needed
});
