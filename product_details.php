<!-- to connect php file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website</title>
    <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- css file link -->
       <link rel="stylesheet" href="style.css">
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
            height: auto; /* Automatically adjust height based on width */
            max-width: 200px; /* Limit the width */
            object-fit: contain; /* Ensure the image fits within the given dimensions without distortion */
            margin-right: 10px;
        }

        .hero {
            position: relative;
            background: url('./images/hero-bg.jpg') no-repeat center center/cover;
            height: 400px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .hero p {
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .card {
            border: none;
            transition: transform 0.2s ease-in-out;
            overflow-x:hidden;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .side-nav {
            position: sticky;
            top: 20px;
        }

        .side-nav ul {
            padding: 0;
            margin: 0;
            transition: transform 0.2s ease-in-out;
        }

        .side-nav ul li {
            list-style: none;
            margin: 5px 0;
        }

        .side-nav ul li a {
            text-decoration: none;
            color: #343a40;
            font-weight: 500;
            font-size: 1rem;
            padding: 5px 0;
            display: inline-block;
            transition: color 0.3s, border-left 0.3s;
            border-left: 3px solid transparent;
        }

        .side-nav ul li a:hover {
            color: #ffc107;
            border-left: 3px solid #ffc107;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        
        </style>
    </head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="./images/logo.png" alt="CLOSET CANVAS" class="logo">
                CLOSET CANVAS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                    <?php
                    if(isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                    </li>";
                    }
                    else{
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                    </li>";
                    }
                    ?>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart<i class="fa-solid fa-cart-shopping"><sup><?php cart_item();?></sup></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                    <?php
                    if(isset($_SESSION['username'])){
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
                <form class="d-flex ms-3" action="search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
<!-- Welcome Message -->
<div class="bg-secondary text-white text-center py-2">
        <p class=" mt-2 mb-2">
            <?php
            if (!isset($_SESSION['username'])) {
                echo "Welcome Guest!";
            } else {
                echo "Welcome " . $_SESSION['username'] . "!";
            }
            ?>
            <?php
            if (!isset($_SESSION['username'])) {
                echo "<a href='./users_area/user_login.php' class='text-white ms-2'>Login</a>";
            } else {
                echo "<a href='./users_area/logout.php' class='text-white ms-2'>Logout</a>";
            }
            ?>
        </p>
    </div>
<!-- Hero Section -->
<div class="hero">
        <div>
            <h1>Welcome to CLOSET CANVAS</h1>
            <p class="text-light fw-bold fs-5">Your one-stop destination for curated fashion.</p>
        </div>
    </div>
<!-- calling cart function -->
<?php
 cart();
 ?>
 <!-- Main Content -->
 <div class="container-fluid mt-4">
        <div class="row">
            <!-- Side Nav -->
            <div class="col-md-2 side-nav">
                <h4 class="mt-4 fw-semibold">Categories</h4>
                <ul>
                    <?php getcategories(); ?>
                </ul>
                <h4 class="mt-4 fw-semibold">Brands</h4>
                <ul>
                    <?php getbrands(); ?>
                </ul>
            </div>

            <!-- Product Section -->
         <div class="col-md-10">
                <h3 class="text-center mb-4 fw-semibold">Our Latest Collection</h3>
                <div class="row">
                  <?php
          //  calling function
            get_unique_categories();
            get_unique_brands();
            search_product();
            view_details();
         ?>
      </div> 
      </div>  
        </div>

<!-- last child -->
<?php
include("./includes/footer.php");
?>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>