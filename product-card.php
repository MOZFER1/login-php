<?php
include 'db_connect.php';



$id = $_GET['id'] ?? null;
if ($id>0) { 

    echo  $id;
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card - PhoneHub</title>
    <link rel="stylesheet" href="product-card.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php 
$stmt = $conn->prepare("SELECT * FROM pr WHERE id = :id");
$stmt->execute(array (':id' => $id));

$raws = $stmt->fetchAll();
foreach($raws as $row){

?>
    <div class="product-card-container">
        <div class="product-card">
            <div class="product-image">
                <img src="<?php echo $row["img"] ?>" alt="Samsung Galaxy A15">
            </div>
            <div class="product-details">
                <h2 class="product-title"><?php echo $row["name"]?></h2>
                <div class="product-rating">
                    <!-- <span class="stars">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                    </span> -->
                    <span class="rating-value">4.0</span>
                </div>
                <!-- <p class="product-desc">A powerful smartphone with a stunning display, long-lasting battery, and advanced camera features. Perfect for everyday use and entertainment.</p> -->
                <div class="product-price">
                    <span class="old-price"><?php echo $row["Price"] ?></span>
                    <span class="new-price"><?php echo $row["New Price"] ?></span>
                </div>
                <div class="product-options">
                    <label for="size">Size:</label>
                    <select id="size">
                        <option value="64gb">64GB</option>
                        <option value="128gb">128GB</option>
                        <option value="256gb">256GB</option>
                    </select>
                </div>
                <div class="product-quantity">
                    <button class="qty-btn" id="decrease">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="10" readonly>
                    <button class="qty-btn" id="increase">+</button>
                </div>
                <button class="add-to-cart-btn" id="addToCart">Add to Cart</button>
            </div>
        </div>
        <div id="cart-message" class="cart-message"></div>
    </div>
    <?php } ?>
    <script src="product-card.js"></script>
</body>
</html>