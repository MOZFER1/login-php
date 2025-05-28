<?php
include 'db_connect.php';
session_start();
$message = "";

// استخدام الدمج ?? لتفادي التحذير
$name = trim($_POST["name"] ?? '');
$price = trim($_POST["price"] ?? '');
$new_price = trim($_POST["new_price"] ?? '');
$img = trim($_POST["img"] ?? '');

if ($name && $new_price && $price && $img) {
    try {
        $stmt = $conn->prepare("SELECT id FROM pr WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $message = "This phone is already registered.";
        } else {
            $stmt = $conn->prepare("INSERT INTO pr (name, price, img, new_price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $price, $img, $new_price);
            if ($stmt->execute()) {
                $message = "Phone added successfully.";
            } else {
                $message = "Error adding phone: " . $stmt->error;
            }
        }
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
} else {
    $message = "All fields are required.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Phone Sales Admin</title>
<link rel="stylesheet" href="admin-dashboard.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav class="admin-nav">
        <a href="#" class="logo">
            <span>📱</span>
            PhoneHub
        </a>
        <div class="admin-panel">
            <span>Admin Panel</span>
            <span class="admin-avatar"><i class='bx bxs-user'></i></span>
        </div>
    </nav>

    <main class="admin-main">
        <section class="admin-form-section">
            <h2>Add New Phone</h2>
            <?php if ($message) echo '<div class="msg">'.$message.'</div>'; ?>
            <form method="post" action="" class="admin-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="phoneName">Phone Name</label>
                        <input type="text" name="name" id="phoneName" placeholder="Enter phone name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="text" name="price" id="price" placeholder="Enter price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">URL Img</label>
                    <textarea name="img" id="description" placeholder="Input URL img"required></textarea >
                </div>
                <div class="form-group">
                    <label for="stock">New Price</label>
                    <input type="text" name="new_price" id="stock" placeholder="Input the new price" required>
                </div>
                <button type="submit" class="submit-button">Add Phone</button>
            </form>
        </section>
    </main>
</body>
</html>
