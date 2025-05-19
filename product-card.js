document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.getElementById('decrease');
    const increaseBtn = document.getElementById('increase');
    const quantityInput = document.getElementById('quantity');
    const addToCartBtn = document.getElementById('addToCart');
    const cartMessage = document.getElementById('cart-message');

    decreaseBtn.addEventListener('click', function() {
        let qty = parseInt(quantityInput.value, 10);
        if (qty > 1) {
            quantityInput.value = qty - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let qty = parseInt(quantityInput.value, 10);
        if (qty < 10) {
            quantityInput.value = qty + 1;
        }
    });

    addToCartBtn.addEventListener('click', function() {
        const size = document.getElementById('size').value;
        const qty = quantityInput.value;
        cartMessage.textContent = `Added ${qty} Samsung Galaxy A15 (${size.toUpperCase()}) to cart!`;
        cartMessage.style.color = '#27ae60';
        setTimeout(() => {
            cartMessage.textContent = '';
        }, 2500);
    });
});