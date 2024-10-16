document.querySelectorAll('.remove-item').forEach(item => {
    item.addEventListener('click', function() {
        const cartId = this.getAttribute('data-cart-id');

        // Send AJAX request to delete the item
        fetch('../php/deleteItemFromCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_id: cartId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the cart item and its corresponding <hr>
                this.closest('.cart-item').remove(); // This removes the entire .cart-item including the hr that follows it
                // Reload the page to reflect the changes
                location.reload(); 
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error removing the item.');
        });
    });
});