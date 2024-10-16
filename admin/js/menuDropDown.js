        // JavaScript to handle dropdown toggle
        document.querySelector('.dropdown-toggle').addEventListener('click', function (e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('hidden'); // Toggle visibility
        });