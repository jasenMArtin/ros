document.querySelectorAll('.increase-qty, .decrease-qty').forEach(button => {
    button.addEventListener('click', function() {
        const cartId = this.getAttribute('data-cart-id');
        const qtyInput = document.querySelector(`.item-qty[data-cart-id='${cartId}']`);
        let currentQty = parseInt(qtyInput.value);

        if (this.classList.contains('increase-qty')) {
            currentQty++;
        } else if (this.classList.contains('decrease-qty') && currentQty > 1) {
            currentQty--;
        }

        // Update the displayed quantity
        qtyInput.value = currentQty;

        // Send AJAX request to update the quantity in the database
        fetch('../php/updateCartQuantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_id: cartId, qty: currentQty })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Error: ' + data.message);
            }
                            location.reload(); 

        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error updating the quantity.');
        });
    });
});