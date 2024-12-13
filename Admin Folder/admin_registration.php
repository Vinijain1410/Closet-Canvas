<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .container {
            margin-top: 50px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-register {
            background-color: #343a40;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        .link-danger {
            color: #ffc107 !important;
        }

        .link-danger:hover {
            color: #343a40 !important;
            text-decoration: underline;
        }

        .img-fluid {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-4">
                <img src="../images/admin-registration.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter Your Username" required="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter Your Email" required="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter Your Password" required="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required" class="form-control">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-register w-100 py-2" name="admin_registration">Register</button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <p class="small fw-bold">Already have an account? <a href="admin_login.php" class="link-danger fw-semibold">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['admin_registration'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.')</script>";
    } else {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$email'";
        $result = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or Email already exists.')</script>";
        } else {
            $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) VALUES ('$username', '$email', '$hash_password')";
            $sql_execute = mysqli_query($con, $insert_query);

            if ($sql_execute) {
                echo "<script>alert('Registration Successful! Redirecting to Login Page.')</script>";
                echo "<script>window.open('admin_login.php', '_self');</script>";
            } else {
                echo "<script>alert('Error: Unable to register.')</script>";
            }
        }
    }
}
?>
