// Demo cart data
let cart = [
    {id:1, name:'Premium Laptop', desc:'15-inch, 16GB RAM, 512GB SSD', price:1299.99, qty:1, img:'<i class="bx bx-desktop" style="font-size:2.5rem;color:#6c5ce7;"></i>'},
    {id:2, name:'Smartphone Pro', desc:'128GB, Midnight Blue', price:899.99, qty:1, img:'<i class="bx bx-mobile" style="font-size:2.5rem;color:#0984e3;"></i>'},
    {id:3, name:'Wireless Earbuds', desc:'Noise Cancelling, 24h Battery', price:149.99, qty:1, img:'<i class="bx bx-headphone" style="font-size:2.5rem;color:#00b894;"></i>'}
];
let promoApplied = false;
function renderCart() {
    const cartList = document.getElementById('cartList');
    cartList.innerHTML = '';
    cart.forEach((item, idx) => {
        const div = document.createElement('div');
        div.className = 'cart-item';
        div.innerHTML = `
            <div class="cart-item-img">${item.img}</div>
            <div class="cart-item-details">
                <div class="cart-item-title">${item.name}</div>
                <div class="cart-item-desc">${item.desc}</div>
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
            </div>
            <div class="cart-item-actions">
                <button class="qty-btn" onclick="updateQty(${item.id},-1)">-</button>
                <span class="qty-value">${item.qty}</span>
                <button class="qty-btn" onclick="updateQty(${item.id},1)">+</button>
                <button class="remove-btn" onclick="removeItem(${item.id})">Remove</button>
            </div>
        `;
        cartList.appendChild(div);
    });
    document.getElementById('cartItemsCount').textContent = cart.length;
    document.getElementById('cartCount').textContent = cart.length;
    updateSummary();
}
function updateQty(id, delta) {
    cart = cart.map(item => item.id===id ? {...item, qty: Math.max(1, item.qty+delta)} : item);
    renderCart();
}
function removeItem(id) {
    cart = cart.filter(item => item.id!==id);
    renderCart();
}
function updateSummary() {
    let subtotal = cart.reduce((sum, item) => sum + item.price*item.qty, 0);
    let shipping = 0;
    let tax = subtotal*0.09;
    let total = subtotal + shipping + tax;
    if(promoApplied) total *= 0.9;
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('shipping').textContent = `$${shipping.toFixed(2)}`;
    document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}
document.getElementById('clearCartBtn').onclick = function() {
    cart = [];
    renderCart();
};
document.getElementById('applyPromo').onclick = function() {
    const code = document.getElementById('promoInput').value.trim();
    if(code.toLowerCase()==='save10' && !promoApplied) {
        promoApplied = true;
        updateSummary();
        alert('Promo code applied! 10% off.');
    } else if(promoApplied) {
        alert('Promo already applied.');
    } else {
        alert('Invalid promo code. Try SAVE10');
    }
};
renderCart();