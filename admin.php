<?php
include 'db_connect.php';
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
            <form class="admin-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="phoneName">Phone Name</label>
                        <input type="text" id="phoneName" placeholder="Enter phone name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="text" id="price" placeholder="Enter price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Url img</label>
                    <textarea id="description" placeholder="input url img"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="stock">new pric</label>
                        <input type="text" id="stock" placeholder="input the new price">
                    </div>
                   
                </div>
                <button type="submit" class="primary-button">Add Phone</button>
            </form>
        </section>
       
</body>
</html>
