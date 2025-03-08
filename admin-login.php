<?php
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded credentials (Replace with database validation)
    $admin_user = "admin";
    $admin_pass = "password123"; // Change this to a secure hash in production

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: view-appointments.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Bootstrap & Custom Styles -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-pro.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        body {
            background-color: #f5f5f5;
        }

        .login-container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo img {
            height: 70px;
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #739E77;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #5e8863;
            box-shadow: 0 0 5px rgba(115, 158, 119, 0.5);
        }

        .btn-login {
            background-color: #739E77;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #5e8863;
            transform: scale(1.05);
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/imgs/logo/logo1.png" alt="logo not found">
            </div>
            <h3 class="mb-3">Admin Login</h3>

            <!-- Error Message -->
            <?php if (!empty($error)) {
                echo "<div class='error-message'>$error</div>";
            } ?>

            <form action="admin-login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>

                <button type="submit" class="btn btn-login mt-3">Login</button>
            </form>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>