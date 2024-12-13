<!-- to connect php file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas: User Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .login-container {
            margin: 5% auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            font-size: 2rem;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-size: 1rem;
            color: #6c757d;
            font-weight: 500;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-login {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }
        .btn-login:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .register-link {
            color: #dc3545;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        .text-center img {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-200">
        <div class="col-md-6 login-container">
            <h2 class="login-title">Welcome Back!</h2>
            <div class="text-center">
                <img src="../images/logo.png" alt="Closet Canvas Logo">
            </div>
            <form action="" method="post">
                <!-- User Name Field -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                </div>
                <!-- Password Field -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                </div>
                <!-- Login Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-login bg-primary" name="user_login">Login</button>
                </div>
                <!-- Register Link -->
                <div class="text-center mt-3">
                    <p class="small fw-bold">Don't have an account? <a href="user_registration.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    // Cart items check
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 && $row_count_cart == 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Logged In Successfully');</script>";
                echo "<script>window.open('profile.php','_self');</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Logged In Successfully');</script>";
                echo "<script>window.open('payment.php','_self');</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
