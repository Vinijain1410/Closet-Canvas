<!-- to connect php file -->
<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- bootstrap icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

    <?php
    // Checking session and database connection
    if (!isset($_SESSION['username'])) {
        echo "<p class='text-center text-danger'>User is not logged in.</p>";
        exit;
    }
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $user_name = $_SESSION['username'];
    // Fetching user details
    $get_user = "SELECT * FROM `user_table` WHERE user_name = '$user_name'";
    $result = mysqli_query($con, $get_user);
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<p class='text-center text-danger'>Unable to fetch user details.</p>";
        exit;
    }
    $rowdata = mysqli_fetch_assoc($result);
    $user_id = $rowdata['user_id'];
    ?>
    
    <div class="table-responsive">
        <table class="table table-striped table-grey table-bordered table-hover">
            <tr>
                <th>Order Number</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice Number</th>
                <th>Date and Time</th>
                <th>Completed/Incompleted</th>
                <th>Status</th>
            </tr>

            <?php
            // Fetch user orders
            $get_orders_table = "SELECT * FROM `user_orders` WHERE user_id = '1'";
            $result_orders = mysqli_query($con, $get_orders_table);
                while($row=mysqli_fetch_assoc($result_orders))
                {
                $order_id = $row['order_id'];
                        $amount_due = $row['amount_due'];
                        $total_products = $row['total_products'];
                        $invoice_no = $row['invoice_no'];
                        $order_date = $row['order_date'];
                        $order_status = $row['order_status'] === 'pending' ? 'Incompleted' : 'Completed';
                        echo "<tr class='text-center'>
                            <td>$order_id</td>
                            <td>$amount_due</td>
                            <td>$total_products</td>
                            <td>$invoice_no</td>
                            <td>$order_date</td>
                            <td>$order_status</td>";
                            if ($order_status === 'Completed') {
                                            echo "<td><a class='text-center fst-italic text-dark'>Paid</a></td>";
                                        } else {
                                            echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-center fst-italic text-dark'>Confirm Payment</a></td>";
                                        }
                                        echo "</tr>";
            }
            //     $number = 1;
            //     while ($row_orderdata = mysqli_fetch_assoc($count)) {
            //         $order_id = $row_orderdata['order_id'];
            //         $amount_due = $row_orderdata['amount_due'];
            //         $total_products = $row_orderdata['total_products'];
            //         $invoice_no = $row_orderdata['invoice_no'];
            //         $order_date = $row_orderdata['order_date'];
            //         $order_status = $row_orderdata['order_status'] === 'pending' ? 'Incompleted' : 'Completed';
            //         echo "<tr class='text-center'>
            //             <td>$number</td>
            //             <td>$order_id</td>
            //             <td>$amount_due</td>
            //             <td>$total_products</td>
            //             <td>$invoice_no</td>
            //             <td>$order_date</td>
            //             <td>$order_status</td>";
            //         if ($order_status === 'Completed') {
            //             echo "<td><a class='text-center fst-italic text-light'>Paid</a></td>";
            //         } else {
            //             echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-center fst-italic text-light'>Confirm Payment</a></td>";
            //         }
            //         echo "</tr>";
            //         $number++;
            //     }
            // 
            
            ?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>