 // Function to toggle the dropdown menu
 function toggleDropdown(button) {
    const dropdown = button.nextElementSibling;
    const icon = button.querySelector('.fa-chevron-down');
    const isVisible = dropdown.style.display === 'block';

    // Close all other dropdowns
    document.querySelectorAll('.dropdown-content').forEach(function(content) {
        content.style.display = 'none';
    });

    // Reset rotation on all icons
    document.querySelectorAll('.fa-chevron-down').forEach(function(icon) {
        icon.classList.remove('rotate');
    });

    // Toggle the clicked dropdown
    dropdown.style.display = isVisible ? 'none' : 'block';

    // Toggle rotation of the icon
    if (!isVisible) {
        icon.classList.add('rotate');
    }
}

// Close dropdown if clicked outside
window.addEventListener('click', function(event) {
    if (!event.target.matches('.dropdown button') && !event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-content').forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });

        // Reset the icon rotation when dropdown is closed
        document.querySelectorAll('.fa-chevron-down').forEach(function(icon) {
            icon.classList.remove('rotate');
        });
    }
});

// Function to change the status
function setStatus(elementId, status) {
    const statusElement = document.getElementById(elementId);
    if (status === 'Deactivated') {
        statusElement.className = 'status-deactivated';
        statusElement.textContent = 'Deactivated';
    }
}

// Function to delete the user row
function deleteUser(element) {
    const row = element.closest('tr');
    if (row) {
        row.remove();
    }
}