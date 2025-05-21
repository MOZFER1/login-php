<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>لوحة تحكم المسؤول - Mozfer Phone</title>
</head>
<body>
    <nav>
        <a href="#" class="logo">
            <span>📱</span>
            PhoneHub Admin
        </a>
        <div class="nav-links">
            <a href="#">الرئيسية</a>
            <a href="#products">المنتجات</a>
            <a href="#add">إضافة منتج</a>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="logout.php" class="sign-in">تسجيل الخروج</a>
        </div>
    </nav>
    <section class="hero">
        <div class="hero-content">
            <h1>لوحة تحكم المسؤول</h1>
            <p>إدارة المنتجات: إضافة، حذف وتعديل المنتجات بسهولة.</p>
        </div>
    </section>
    <h2 id="products">المنتجات الحالية</h2>
    <div class="products">
<?php  
 $stmt = $conn->prepare("SELECT * FROM pr");
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    ?>
      <div class="product">
          <img src="<?php echo $row["img"] ?>" alt="<?php echo $row["name"] ?>" width="150">
          <h3><?php echo $row["name"] ?></h3>
          <p>السعر: <del><?php echo $row["price"] ?></del> ريال</p>
          <p>السعر الجديد: <?php echo $row["new_price"] ?> ريال</p>
          <form method="post" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?php echo $row["id"] ?>">
            <button type="submit" name="delete" onclick="return confirm('هل أنت متأكد من حذف المنتج؟');">حذف</button>
          </form>
      </div>
<?php } ?>
    </div>
    <h2 id="add">إضافة منتج جديد</h2>
    <form method="post" enctype="multipart/form-data" class="add-product-form">
        <input type="text" name="name" placeholder="اسم المنتج" required>
        <input type="number" name="price" placeholder="السعر القديم" required>
        <input type="number" name="new_price" placeholder="السعر الجديد" required>
        <input type="text" name="img" placeholder="رابط صورة المنتج" required>
        <button type="submit" name="add">إضافة المنتج</button>
    </form>
<?php
// إضافة منتج جديد
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $new_price = $_POST['new_price'];
    $img = $_POST['img'];
    $stmt = $conn->prepare("INSERT INTO pr (name, price, new_price, img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdds", $name, $price, $new_price, $img);
    if($stmt->execute()){
        echo "<p style='color:green;'>تمت إضافة المنتج بنجاح!</p>";
        echo "<meta http-equiv='refresh' content='1'>";
    }else{
        echo "<p style='color:red;'>حدث خطأ أثناء الإضافة!</p>";
    }
}
// حذف منتج
if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM pr WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if($stmt->execute()){
        echo "<p style='color:green;'>تم حذف المنتج بنجاح!</p>";
        echo "<meta http-equiv='refresh' content='1'>";
    }else{
        echo "<p style='color:red;'>حدث خطأ أثناء الحذف!</p>";
    }
}
?>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <a href="#" class="footer-logo">
                    <span>📱</span>
                    PhoneHub
                </a>
                <p class="footer-description">إدارة المنتجات من خلال لوحة تحكم المسؤول.</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2023 PhoneHub. جميع الحقوق محفوظة.</p>
        </div>
    </footer>
</body>
</html>