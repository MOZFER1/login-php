<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - PhoneHub</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cart-style.css">
</head>
<body>
    <nav>
        <a href="#" class="logo">
            <span>📱</span>
            PhoneHub
        </a>
        <div class="nav-links">
            <a href="#hero">Home</a>
            <a href="#proudct">Phones</a>
            <a href="#features">Features</a>
            <a href="#">Reviews</a>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div class="cart-icon">
                <a href="cart.php">🛒
                    
                <span class="cart-count">3</span>
            </div>
            <a href="login.php" class="sign-in">Sign In</a>
        </div>
    </nav>
    </nav>
    <div class="cart-container">
        <div class="cart-items">
            <h2>Your Cart (<span id="cartItemsCount">3</span> items)</h2>
            <div id="cartList">
                <!-- Cart items will be rendered here by JS -->
            </div>
            <div class="cart-footer">
                <a href="user.php">&larr; Continue Shopping</a>
                <button id="clearCartBtn">Clear Cart</button>
            </div>
        </div>
        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="summary-row"><span>Subtotal</span><span id="subtotal">$0.00</span></div>
            <div class="summary-row"><span>Shipping</span><span id="shipping">$0.00</span></div>
            <div class="summary-row"><span>Tax</span><span id="tax">$0.00</span></div>
            <div class="summary-row total"><span>Total</span><span id="total">$0.00</span></div>
            <div class="promo-code">
                <input type="text" id="promoInput" placeholder="Enter code">
                <button id="applyPromo">Apply</button>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
            <div style="margin-top:1.2rem; font-size:0.95rem; color:#888;">We Accept</div>
            <div class="payment-icons">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/PayPal_2014_logo.png" alt="PayPal">
            </div>
        </div>
    </div>

    <script src="cart.js"></script>
</body>
</html>