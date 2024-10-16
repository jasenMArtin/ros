document.querySelectorAll('.add-to-cart-btn').forEach(button => {
      button.addEventListener('click', function(event) {
          event.preventDefault();
          
          const title = this.getAttribute('data-title');
          const price = this.getAttribute('data-price');
          const description = this.getAttribute('data-description');
          const image = this.getAttribute('data-image');
          const id = this.getAttribute('data-id');

          document.getElementById('foodCardTitle').textContent = title;
          document.getElementById('foodCardPrice').textContent = '$' + price;
          document.getElementById('foodCardDescription').textContent = description;
          document.getElementById('foodCardImage').src = image;
          document.getElementById('foodCardImage').setAttribute('data-item-id', id);
          document.getElementById('foodCardQuantity').textContent = 1;
          document.getElementById('foodCardSubtotal').textContent = '$' + price;

          document.getElementById('foodCardModal').style.display = 'flex';
      });
  });

  document.querySelector('.close').addEventListener('click', function() {
      document.getElementById('foodCardModal').style.display = 'none';
  });

  window.onclick = function(event) {
      if (event.target == document.getElementById('foodCardModal')) {
          document.getElementById('foodCardModal').style.display = 'none';
      }
  };

  let quantity = 1;

  function updateQuantity(change) {
      quantity = Math.max(1, quantity + change);
      const price = parseFloat(document.getElementById('foodCardPrice').textContent.substring(1));
      document.getElementById('foodCardQuantity').textContent = quantity;
      document.getElementById('foodCardSubtotal').textContent = '$' + (quantity * price).toFixed(2);
  }

  document.getElementById('addToCartButton').addEventListener('click', function() {
const item_id = document.getElementById('foodCardImage').getAttribute('data-item-id');
const qty = parseInt(document.getElementById('foodCardQuantity').textContent);
const spice_level = document.getElementById('foodCardSpiceLevel').value;
const notes = document.getElementById('foodCardNotes').value;

const data = {
  item_id: item_id,
  qty: qty,
  spice_level: spice_level,
  notes: notes
};

fetch('../php/addCart.php', {
  method: 'POST',
  headers: {
      'Content-Type': 'application/json'
  },
  body: JSON.stringify(data)
})
.then(response => response.json())
.then(result => {
  console.log(result); // Log the result
  if (result.success) {
      alert('Item added to cart successfully!');
      document.getElementById('foodCardModal').style.display = 'none'; // Close modal
  } else {
      alert('Error adding to cart: ' + result.error);
  }
})
.catch(error => {
  console.error('Error:', error);
  alert('There was an error processing your request.');
});
});
