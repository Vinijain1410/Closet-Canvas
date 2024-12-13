<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas: User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .registration-container {
            margin: 3% auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .registration-title {
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
        .btn-register {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
        }
        .btn-register:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .login-link {
            color: #dc3545;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        .text-center img {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 registration-container">
            <h2 class="registration-title">Create Your Account</h2>
            <div class="text-center">
                <img src="../images/logo.png" alt="Closet Canvas Logo">
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- User Name -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">User Name</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required name="user_username">
                </div>
                <!-- Email -->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required name="user_email">
                </div>
                <!-- User Image -->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">Upload Your Image</label>
                    <input type="file" id="user_image" class="form-control" required name="user_image">
                </div>
                <!-- Password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required name="user_password">
                </div>
                <!-- Confirm Password -->
                <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Re-enter your password" autocomplete="off" required name="conf_user_password">
                </div>
                <!-- Address -->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required name="user_address">
                </div>
                <!-- Contact -->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact number" autocomplete="off" required name="user_contact">
                </div>
                <!-- Register Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-register" name="user_register">Register</button>
                </div>
                <!-- Login Link -->
                <div class="text-center mt-3">
                    <p class="small fw-bold">Already have an account? <a href="user_login.php" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
// PHP code for handling registration
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Check if user already exists
    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists.')</script>";
    } elseif ($user_password !== $conf_user_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        // Insert new user data
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (user_name, user_email, user_password, user_image, user_ip, user_address, user_contact) VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $sql_execute = mysqli_query($con, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('Registration Successful!')</script>";
        }
    }

    // Redirect based on cart status
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $rows_count_cart = mysqli_num_rows($result_cart);

    if ($rows_count_cart > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart. Redirecting to checkout.')</script>";
        echo "<script>window.open('checkout.php', '_self');</script>";
    } else {
        echo "<script>window.open('../index.php', '_self');</script>";
    }
}
?>
