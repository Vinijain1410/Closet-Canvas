<?php
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);

    if ($row_fetch) {
        $invoice_no = $row_fetch['invoice_no'];
        $amount_due = $row_fetch['amount_due'];
    } else {
        die("Invalid Order ID");
    }

    if (isset($_POST['confirm_payment'])) {
        // Retrieve and sanitize user inputs
        $invoice_no = mysqli_real_escape_string($con, $_POST['invoice_no']);
        $amount = mysqli_real_escape_string($con, $_POST['amount']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);

        // Insert payment details into the database
        $insert_query = "INSERT INTO user_payment (order_id, invoice_no, amount, payment_mode, date) 
                         VALUES ($order_id, '$invoice_no', $amount, '$payment_mode', NOW())";

        $result_query = mysqli_query($con, $insert_query);

        if ($result_query) {
            echo "<p class='text-center fs-3 text-light'>Successfully Completed the Payment</p>";
            echo "<script>window.open('profile.php?my_orders', '_self');</script>";
        } else {
            die("Payment Error: " . mysqli_error($con));
        }
    }
    $update_orders = "UPDATE user_orders SET order_status='Complete' WHERE order_id=$order_id";
    $result_orders = mysqli_query($con, $update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas - Confirm Payment</title>
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
        .confirm-payment-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .confirm-payment-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-confirm {
            background-color: #343a40;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
        }
        .btn-confirm:hover {
            background-color: #ffc107;
            color: #343a40;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../images/logo.png" alt="CLOSET CANVAS" class="logo">
                CLOSET CANVAS
            </a>
        </div>
    </nav>

    <!-- Confirm Payment Section -->
    <div class="container">
        <div class="confirm-payment-container mx-auto text-center">
            <h1>Confirm Payment</h1>
            <form action="" method="post" class="mt-4">
                <div class="mb-4">
                    <label for="invoice_no" class="form-label fw-bold">Invoice Number</label>
                    <input type="text" id="invoice_no" name="invoice_no" class="form-control" value="<?php echo $invoice_no; ?>" readonly>
                </div>
                <div class="mb-4">
                    <label for="amount" class="form-label fw-bold">Amount</label>
                    <input type="text" id="amount" name="amount" class="form-control" value="<?php echo $amount_due; ?>" readonly>
                </div>
                <div class="mb-4">
                    <label for="payment_mode" class="form-label fw-bold">Payment Mode</label>
                    <select id="payment_mode" name="payment_mode" class="form-select">
                        <option>Select Payment Mode</option>
                        <option>UPI</option>
                        <option>NetBanking</option>
                        <option>PayPal</option>
                        <option>Cash On Delivery</option>
                        <option>Pay Offline</option>
                    </select>
                </div>
                <button type="submit" name="confirm_payment" class="btn-confirm">Confirm Payment</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../includes/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
