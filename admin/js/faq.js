document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit');
    const deleteButtons = document.querySelectorAll('.delete');
    const editModal = document.getElementById('editModal');
    const closeModal = document.getElementById('closeModal');
    const editForm = document.getElementById('editForm');
    const faqTableBody = document.getElementById('faqTableBody');
    let currentRow;

    // Open the modal when Edit is clicked
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentRow = this.closest('tr');
            const question = currentRow.children[1].innerText;
            const answer = currentRow.children[2].innerText;

            document.getElementById('editQuestion').value = question;
            document.getElementById('editAnswer').value = answer;
            editModal.classList.remove('hidden');
            event.preventDefault();

        });
    });

    // Close modal
    closeModal.addEventListener('click', function () {
        editModal.classList.add('hidden');
    });

    // Save edited data
    document.getElementById('saveEdit').addEventListener('click', function () {
        const newQuestion = document.getElementById('editQuestion').value;
        const newAnswer = document.getElementById('editAnswer').value;

        // Update table row
        currentRow.children[1].innerText = newQuestion;
        currentRow.children[2].innerText = newAnswer;

        // Close modal
        editModal.classList.add('hidden');
    });

    function loadFAQ() {
        // Hide all sections
        document.querySelectorAll('main > section').forEach(section => {
            section.classList.add('hidden');
        });
    
        // Show the FAQ section
        const faqSection = document.getElementById('faqSection');
        faqSection.classList.remove('hidden');
    
        // Load the FAQ content from faq.php
        fetch('faq.php')
            .then(response => response.text())
            .then(data => {
                faqSection.innerHTML = data; // Set the innerHTML to the fetched data
            })
            .catch(error => console.error('Error loading FAQ:', error));
    }
    
    // Event listener for the FAQ button
    document.getElementById('loadFaq').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        loadFAQ(); // Load the FAQ content
    });
    
});

function loadFAQ() {
    // Hide all sections
    document.querySelectorAll('main > section').forEach(section => {
        section.classList.add('hidden');
    });

    // Show the FAQ section
    const faqSection = document.getElementById('faqSection');
    faqSection.classList.remove('hidden');

    // Load the FAQ content from faq.php
    fetch('faq.php')
        .then(response => response.text())
        .then(data => {
            faqSection.innerHTML = data; // Set the innerHTML to the fetched data
        })
        .catch(error => console.error('Error loading FAQ:', error));
}

// Event listener for the FAQ button
document.getElementById('loadFaq').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default link behavior
    loadFAQ(); // Load the FAQ content
});



