<!-- connect file -->
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
    <title>Admin Dashboard</title>
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

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar .nav-link, .navbar .navbar-brand {
            color: #fff !important;
        }

        .navbar .nav-link:hover {
            color: #ffc107 !important;
        }

        .logo {
            height: auto;
            max-width: 200px;
            object-fit: contain;
        }

        .admin_image {
            width: 120px;
            object-fit: cover;
            border-radius: 50%;
        }

        .dashboard-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }

        .dashboard-header h3 {
            font-size: 2rem;
            font-weight: 600;
        }

        .dashboard-header p {
            font-size: 1.2rem;
            font-weight: 400;
        }

        .button a {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            background-color: #ffc107;
            border-radius: 5px;
            padding: 10px 20px;
            display: inline-block;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .button a:hover {
            background-color: #343a40;
            color: #ffc107;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            margin: 0;
        }
        .product_image{
            width: 50px;
            object-fit: contain;
        }
        .edit_img{
            width: 50px;
            object-fit: contain;

        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="../images/logo.png" alt="CLOSET CANVAS" class="logo">
                Admin Dashboard
            </a>
        <div class=" text-white text-center py-2">
                <p class=" mt-2 mb-2 text-white text-center py-2">
                <ul class="navbar-nav ms-auto">
                <?php
            if (!isset($_SESSION['username'])) {
                echo "Welcome Guest!";
            } else {
                echo "Welcome " . $_SESSION['username'] . "!";
            }
            ?>
            </p>
            <?php
            if (!isset($_SESSION['username'])) {
                echo "<a href='admin_login.php' class='text-white ms-2'>Login</a>";
            } else {
                echo "<a href='admin_logout.php' class='text-white ms-2'>Logout</a>";
            }
            ?>
                </ul>
        </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="dashboard-header text-center">
        <div class="container">
            <h3>Welcome to the Admin Dashboard</h3>
            <p>Manage your store with ease and efficiency</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row">
            <!-- Admin Profile -->
            <div class="col-md-3 text-center">
                <img src="../images/logo2.png" alt="Admin" class="admin_image my-3">
                <h5 class="fw-bold"><?php
            if (!isset($_SESSION['username'])) {
                echo "Welcome Guest!";
            } else {
                echo "Welcome " . $_SESSION['username'] . "!";
            }
            ?>
            </p>
                </h5>
            </div>

            <!-- Admin Options -->
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="button text-center">
                            <a href="insert_product.php">Insert Products</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button text-center">
                            <a href="index.php?view_products">View Products</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button text-center">
                            <a href="index.php?insert_categories">Insert Categories</a>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="button text-center">
                            <a href="#">View Categories</a>
                        </div> -->
                    <!-- </div> -->
                    <div class="d-flex justify-content-center align-items-center b-0">
                        <div class="col-md-4">
                            <div class="button text-center">
                        <a href="index.php?insert_brands" class="btn btn-primary">Insert Brands</a>
                        </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="button text-center">
                            <a href="#">View Brands</a>
                        </div> -->
                        <!-- </div> -->
                    <!-- <div class="col-md-4">
                        <div class="button text-center">
                            <a href="../users_area/order.php">All Orders</a>
                        </div>
                        </div> -->
                    
                    <!-- <div class="col-md-4">
                        <div class="button text-center">
                            <a href="#">All Payments</a>
                        </div> -->
                    <!-- </div>  -->
                    <!-- <div class="col-md-4">
                        <div class="button text-center">
                            <a href="#">List Users</a>
                        </div> 
                    </div>  -->
                    
                </div>
            </div>
        </div>

        <!-- Dynamic Content -->
        <div class="my-4">
            <?php
            if (isset($_GET['insert_categories'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brands'])) {
                include('insert_brands.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <!--include footer  -->
<?php
include("../includes/footer.php");
?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
