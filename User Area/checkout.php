<!-- to connect php file -->
<?php
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas: Checkout Section</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css link -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-light .navbar-nav .nav-link {
            color: #000;
            font-weight: 500;
        }

        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link:hover {
            color: #0056b3;
        }

        .checkout-container {
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checkout-header {
            background: #ffc107;
            color: #fff;
            text-align: center;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }
        .checkout-header:hover {
            background-color: #343a40;
            color: #ffc107;
        }

        .payment-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .payment-option {
            margin: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .payment-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .payment-option img {
            width: 100px;
            margin-bottom: 15px;
        }

        .payment-option a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .payment-option a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="Closet Canvas Logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='profile.php'>My Account</a>
                              </li>";
                        } else {
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='user_registration.php'>Register</a>
                              </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-primary" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- Welcome Message -->
    <div class="bg-secondary text-white text-center py-2">
        <p class="mb-0">
            <?php
            if (!isset($_SESSION['username'])) {
                echo "Welcome Guest!";
            } else {
                echo "Welcome " . $_SESSION['username'] . "!";
            }
            ?>
            <?php
            if (!isset($_SESSION['username'])) {
                echo "<a href='user_login.php' class='text-white ms-2'>Login</a>";
            } else {
                echo "<a href='logout.php' class='text-white ms-2'>Logout</a>";
            }
            ?>
        </p>
    </div>

    <!-- Checkout Section -->
    <div class="container checkout-container">
        <div class="checkout-header">
            <h3 class="fw-semibold fs-4 fst-italic">Checkout</h3>
        </div>
        <div class="payment-section">
            <?php
            if (!isset($_SESSION['username'])) {
                include('user_login.php');
            } else {
                include('payment.php');
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include("../includes/footer.php"); 
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
