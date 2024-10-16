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