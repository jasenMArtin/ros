const sidebar = document.getElementById('sidebar');
const toggleButton = document.getElementById('sidebarToggle');
const toggleIcon = document.getElementById('toggleIcon');

// Toggle sidebar visibility
toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    toggleIcon.classList.toggle('fa-arrow-right');
    toggleIcon.classList.toggle('fa-arrow-left');

    // Hide or show the toggle button based on sidebar visibility
    toggleButton.classList.toggle('hidden', !sidebar.classList.contains('-translate-x-full'));
});

// Click outside to close the sidebar
document.addEventListener('click', (event) => {
    if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
        sidebar.classList.add('-translate-x-full');
        toggleIcon.classList.remove('fa-arrow-left');
        toggleIcon.classList.add('fa-arrow-right');
        toggleButton.classList.remove('hidden'); // Show the toggle button when closing the sidebar
    }
});
