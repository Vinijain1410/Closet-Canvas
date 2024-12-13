<!-- to connect php file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas: Payment Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .hero {
            position: relative;
            /* background: url('../images/payment-bg.jpg') no-repeat center center/cover; */
            height: 200px;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1%;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .payment-options {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2px;
        }

        .payment-card {
            border: none;
            transition: transform 0.2s ease-in-out;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            height: 50%;
            object-fit: contain;
        }

        .payment-card img {
            /* width: 100%; */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .payment-card h5 {
            padding: 20px;
            color: #343a40;
            font-weight: 700;
        }

        .payment-card a {
            text-decoration: none;
            display: flex;
            text-align: center;
            background-color: #ffc107;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px 10px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .payment-card a:hover {
            background-color: #343a40;
            color: #ffc107;
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
    
    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1 class="text-dark mt-2">Secure Your Payment</h1>
            <p class="text-dark fw-bold fs-5">Choose your preferred payment method</p>
        </div>
    </div>

    <!-- PHP code to access user ID -->
    <?php
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    $result = mysqli_query($con, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];
    ?>

    <!-- Payment Options -->
    <div class="container">
        <div class="payment-options">
            <!-- Online Payment -->
            <!-- <div class="card payment-card">
                <img src="../images/payment-bg.jpg" alt="Online Payment">
                <h5>Pay Online</h5>
                <a href="https://www.paypal.com" target="_blank">Pay Now</a>
            </div> -->

            <!-- Offline Payment -->
            <div class="card payment-card">
                <img src="../images/payment-bg.jpg" alt="Offline Payment">
                <h5>Payment Checkout</h5>
                <a href="order.php?user_id=<?php echo $user_id; ?>">Pay Here!</a>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
