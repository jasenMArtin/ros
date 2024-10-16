function toggleCheckboxes() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.itemCheckbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

document.addEventListener('DOMContentLoaded', function() {
document.getElementById('purchase-button').addEventListener('click', function() {
const checkboxes = document.querySelectorAll('.itemCheckbox:checked');
const cartIds = Array.from(checkboxes).map(cb => cb.value);

console.log('Selected Cart IDs:', cartIds); // Debugging line

if (cartIds.length > 0) {
    fetch('../php/purchase.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ cartIds: cartIds }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Debugging line
        if (data.success) {
            alert('Purchase successful!');
            location.reload();
        } else {
            alert('Purchase failed: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
} else {
    alert('Please select at least one item to purchase.');
}
});
});
