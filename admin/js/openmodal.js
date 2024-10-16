// Admin username (hardcoded here, but it can come from a session or database)
const adminUsername = "Admin123";

function openModal(id) {
    // Close all modals before opening a new one
    closeAllModals();
    document.getElementById(`modal-${id}`).style.display = "flex"; // Use flex to center modal content
}

function closeModal(id) {
    console.log(`Closing modal: modal-${id}`);
    document.getElementById(`modal-${id}`).style.display = "none";
}

function closeAllModals() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => modal.style.display = "none");
}

function submitReply(event, id) {
    event.preventDefault(); // Prevent form from refreshing the page
    const replyText = document.getElementById(`reply-text-${id}`).value;

    if (replyText.trim() === "") {
        alert("Please enter a reply before submitting."); // Alert if no reply is entered
        return; // Exit the function
    }

    // Close the modal after submission
    closeModal(id);

    // Add the reply to the replies table (this will include edit/delete buttons and admin's username)
    createOrUpdateRepliesTable(id, replyText, adminUsername);

    // Clear the textarea for future replies
    document.getElementById(`reply-text-${id}`).value = "";
}

// Function to create or update the replies table
function createOrUpdateRepliesTable(id, replyText, username) {
    // Create or get the div wrapper for the replies table to apply spacing
    let repliesWrapper = document.getElementById("replies-wrapper");

    if (!repliesWrapper) {
        repliesWrapper = document.createElement("div");
        repliesWrapper.id = "replies-wrapper";
        repliesWrapper.classList.add("mt-6", "mb-6"); // Add margin top and bottom

        // Create the table itself inside the wrapper
        let repliesTable = document.createElement("table");
        repliesTable.id = "replies-table";
        repliesTable.classList.add("table", "table-responsive", "border", "w-full");

        // Create table header
        const thead = document.createElement("thead");
        thead.innerHTML = `
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Admin</th>
                <th class="border px-4 py-2">Reply</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>`;
        repliesTable.appendChild(thead);

        // Create the tbody element
        const tbody = document.createElement("tbody");
        repliesTable.appendChild(tbody);

        // Append the table to the wrapper
        repliesWrapper.appendChild(repliesTable);

        // Insert the wrapper after the users table
        const usersTable = document.getElementById("users-table");
        usersTable.insertAdjacentElement('afterend', repliesWrapper);
    }

    // Reference the table inside the wrapper
    let repliesTable = document.getElementById("replies-table");
    let tbody = repliesTable.querySelector("tbody");

    // Add a new row with the ID, admin's username, reply text, and action buttons
    const newRow = document.createElement("tr");

    // Conditionally add edit and delete buttons only if the reply is from the logged-in admin
    const actionButtons = (username === adminUsername) ? `
        <button class="edit-btn" onclick="editReply(this)">
            <i class="fas fa-edit btn-icon"></i>
        </button>
        <button class="delete-btn" onclick="deleteReply(this)">
            <i class="fas fa-trash btn-icon"></i>
        </button>
    ` : '';

    newRow.innerHTML = `
        <td class="border px-4 py-2">${id}</td>
        <td class="border px-4 py-2">${username}</td>
        <td class="border px-4 py-2">${replyText}</td>
        <td class="border px-4 py-2 center">
            <div class="actions-buttons">
                ${actionButtons} <!-- Only the logged-in admin sees these buttons -->
            </div>
        </td>
    `;

    // Append new row to the tbody
    tbody.appendChild(newRow);
}

// Function to edit a reply
function editReply(button) {
    // Check if the reply belongs to the logged-in admin before allowing edit
    const replyRow = button.closest('tr');
    const replyUsername = replyRow.querySelector('td:nth-child(2)').innerText;

    if (replyUsername !== adminUsername) {
        alert("You can only edit your own replies.");
        return;
    }

    const replyText = replyRow.querySelector('td:nth-child(3)').innerText;

    // Show the custom edit reply modal
    const modal = document.getElementById('editReplyModal');
    const textArea = document.getElementById('editReplyText');
    textArea.value = replyText; // Set current reply text in textarea
    modal.style.display = 'block';

    // Get the buttons
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');

    // When Save is clicked, update the reply
    saveButton.onclick = function () {
        const newReply = textArea.value.trim();
        if (newReply !== "") {
            replyRow.querySelector('td:nth-child(3)').innerText = newReply;
        }
        modal.style.display = 'none';
    };

    // When Cancel is clicked, close the modal
    cancelButton.onclick = function () {
        modal.style.display = 'none';
    };
}

// Function to delete a reply
function deleteReply(button) {
    // Check if the reply belongs to the logged-in admin before allowing delete
    const replyRow = button.closest('tr');
    const replyUsername = replyRow.querySelector('td:nth-child(2)').innerText;

    if (replyUsername !== adminUsername) {
        alert("You can only delete your own replies.");
        return;
    }

    // Show the custom confirmation modal
    const modal = document.getElementById('deleteConfirmModal');
    modal.style.display = 'block';

    // Get the buttons
    const yesButton = document.getElementById('yesButton');
    const noButton = document.getElementById('noButton');

    // When Yes is clicked, delete the reply
    yesButton.onclick = function () {
        replyRow.remove();
        modal.style.display = 'none';
    };

    // When No is clicked, close the modal
    noButton.onclick = function () {
        modal.style.display = 'none';
    };
}

// Ensure modal opening works for reply submission
document.querySelectorAll('form').forEach(form => {
    form.onsubmit = (event) => {
        const id = form.querySelector('textarea').id.split('-')[2]; // Extracting the ID from the textarea ID
        submitReply(event, id);
    };
});

// Optional: Close modal on clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeAllModals(); // Close all modals when clicking outside
    }
};
