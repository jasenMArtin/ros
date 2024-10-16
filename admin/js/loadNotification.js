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