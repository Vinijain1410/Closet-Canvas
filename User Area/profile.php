<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .profile-container {
            margin-top: 20px;
        }

        .side-nav {
            background-color: #343a40;
            color: white;
            border-radius: 10px;
            padding: 20px;
        }

        .side-nav a {
            color: white;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .side-nav a:hover {
            color: #ffc107;
            text-decoration: none;
        }

        .profile-image {
            width: 150px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            margin: auto;
            display: block;
            border: 3px solid #ffc107;
        }

        .profile-header {
            margin: 20px 0;
            text-align: center;
        }

        .profile-header h3 {
            font-weight: 600;
        }

        .main-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-content h4 {
            color: #343a40;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../images/logo.png" alt="Logo" class="logo" style="max-width: 800px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">My Account</a></li>
                    <li class="nav-item"><a class="nav-link" href="../display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cart.php">Cart<i class="fa-solid fa-cart-shopping ms-1"><sup><?php cart_item(); ?></sup></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="../users_area/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container profile-container">
        <div class="row">
            <!-- Side Navigation -->
            <div class="col-md-3 side-nav">
                <p class="fs-4 fw-bold text-center text-hover">Your Profile</p>
                <?php
                $user_name = $_SESSION['username'];
                $user_query = "SELECT * FROM `user_table` WHERE user_name='$user_name'";
                $result_user = mysqli_query($con, $user_query);
                $user_row = mysqli_fetch_array($result_user);
                $user_image = $user_row['user_image'];
                echo "<img src='./user_images/$user_image' alt='Profile Image' class='profile-image'>";
                ?>
                <ul class="mt-4">
                    <li class="mb-3"><a href="profile.php">Pending Orders</a></li>
                    <li class="mb-3"><a href="profile.php?edit_account">Edit Account</a></li>
                    <li class="mb-3"><a href="profile.php?my_orders">My Orders</a></li>
                    <li><a href="../users_area/logout.php">Logout</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="main-content">
                    <div class="profile-header">
                        <p class="fs-3 fw-bold">Welcome, <?php echo $_SESSION['username']; ?>!</p>
                        <p class="text-muted">Manage your account and view your activities</p>
                    </div>
                    <div>
                        <?php
                        get_user_order_details();
                        if (isset($_GET['edit_account'])) {
                            include('edit_account.php');
                        }
                        if (isset($_GET['my_orders'])) {
                            include('user_orders.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
