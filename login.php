<?php
include 'db_connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // تسجيل الدخول
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if ($email && $password) {
            try {
                $stmt = $conn->prepare("SELECT id, name, password FROM user WHERE email = :email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                
                if ($stmt->rowCount() === 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = $row['name'];
                        header("Location: user.php");
                        exit();
                    } else {
                        $message = "incorrect password.";
                    }
                } else {
                    $message = "email not found";
                }

            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }

        } else {
            $message = "all fields are required.";
        }
    } elseif (isset($_POST['register'])) {
        // التسجيل
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if ($name && $email && $password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (:name, :email, :password)");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $hashed_password);

                if ($stmt->execute()) {
                    $message = "successfully registered.";
                } else {
                    $message = "An error occurred during registration.";
                }

            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }

        } else {
            $message = "all fields are required.";
        }
    }
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup Form</title>
    <link rel="stylesheet" href="login.css">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form method="post" action="">
                <h1>Login</h1>
                 <?php if($message) echo '<div class="msg">'.$message.'</div>'; ?>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="login" class="btn">Login</button>
                <p>or login with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google' ></i></a>
                    <a href="#"><i class='bx bxl-facebook' ></i></a>
                    <a href="#"><i class='bx bxl-github' ></i></a>
                    <a href="#"><i class='bx bxl-linkedin' ></i></a>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <form method="post" action="">
                <h1>Registration</h1>
                <?php if($message) echo '<div class="msg">'.$message.'</div>'; ?>
                <div class="input-box">
                    <input type="text" name="name" placeholder="name" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>
                <button type="submit" name="register" class="btn">Register</button>
                <p>or register with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google' ></i></a>
                    <a href="#"><i class='bx bxl-facebook' ></i></a>
                    <a href="#"><i class='bx bxl-github' ></i></a>
                    <a href="#"><i class='bx bxl-linkedin' ></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
<script src="main.js"></script>
</body>
</html>
