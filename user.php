<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Mozfer Phone</title>
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
            <a href="login.php" class="sign-in">Logout</a>
        </div>
    </nav>
    <section class="hero">
        <div class="hero-content">
            <h1>Discover Latest<br>Smartphone<br>Technology</h1>
            <p>Enjoy high-quality phones with advanced features at unbeatable prices.</p>
            <div class="cta-buttons">
                <a href="#" class="cta-button primary-button">Shop Now</a>
                <a href="#" class="cta-button secondary-button">Learn More</a>
            </div>
        </div>
        <div class="hero-image">
            <svg class="phone-image" viewBox="0 0 200 400" fill="white">
                <rect x="40" y="20" width="120" height="360" rx="20" />
                <rect x="65" y="40" width="70" height="15" rx="5" />
            </svg>
        </div>
    </section>
  
<h2>Latest Phones</h2>
        <div class="products">



<?php  

 $stmt = $conn->prepare("SELECT * FROM pr");
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    ?>
          <div class="product">
          <a href="product-card.php?id=<?php echo $row["id"] ?>">
              <img src="<?php echo $row["img"] ?>" alt="Samsung Galaxy A15" width="150">
            </a>
            <h3><?php echo $row["name"] ?></h3>
            <p>Price: <del><?php echo $row["price"] ?></del> SAR</p>
            <p>New Price: <?php echo $row["new_price"] ?> SAR</p>
            <button>Add to Cart</button>
          </div>
<?php } ?>
      
        </div>
      </div>
    </div>
      <section class="features">
        <h2>Why Choose PhoneHub?</h2>
        <p class="section-desc">We offer the best smartphone shopping experience with exclusive benefits.</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="#6c5ce7">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <h3>Fast Delivery</h3>
                <p>24-hour delivery in selected cities</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="#6c5ce7">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                    </svg>
                </div>
                <h3>2-Year Warranty</h3>
                <p>All our phones come with extended warranty for your peace of mind</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="#6c5ce7">
                        <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                    </svg>
                </div>
                <h3>Secure Payment</h3>
                <p>Multiple secure payment methods to protect your transactions</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="#6c5ce7">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <h3>24/7 Technical Support</h3>
                <p>Specialized support team ready to help you anytime</p>
            </div>
        </div>
    </section>
    <section class="newsletter">
        <h2>Stay Updated</h2>
        <p>Subscribe to our newsletter to be the first to know about new phone launches and exclusive offers.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <a href="#" class="footer-logo">
                    <span>📱</span>
                    PhoneHub
                </a>
                <p class="footer-description">Your premier destination for premium smartphones at unbeatable prices.</p>
                <div class="social-links">
                    <a href="#">فيسبوك</a>
                    <a href="#">تويتر</a>
                    <a href="#">انستغرام</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Store</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Customer Service</h3>
                <ul class="footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p>📍 123 Tech Street, Digital City, 10001</p>
                    <p>📧 support@phonehub.com</p>
                    <p>📞 +1 (555) 123-4567</p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2023 PhoneHub. All rights reserved.</p>
        </div>
    </footer>
      <script src="script.js"></script>
    
</body>
</html>
