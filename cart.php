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
    <title>Ecommerce website-cart details</title>
    <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- css file link -->
       <link rel="stylesheet" href="style.css">
       <style>
        .cart_img{
    width: 80px;
    height: 80px;
    object-fit: contain;
    overflow-x: hidden;
        }
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
                echo "<a href='.users_area/user_login.php' class='text-white ms-2'>Login</a>";
            } else {
                echo "<a href='.users_area/logout.php' class='text-white ms-2'>Logout</a>";
            }
            ?>
        </p>
    </div>
<!-- calling cart function -->
 <?php
 cart();
 ?>
</div>

 <!-- fourth child i.e., cart table -->
 <div class="container mt-5">
    <div class="row">
      <form action="" method="post">
        <table class="table table-bordered text-center">

            <!-- php code to display dynamic data -->
            <?php
            global $con;
    $get_ip_add = getIPAddress(); 
    $total_price=0;
    $cart_query="Select * from cart_details where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
      echo "<thead>
      <tr>
      <th>Product Title</th>
      <th>Product Image</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Remove Item</th>
      <th colspan='2'>Operations</th>
  </tr>
</thead>
<tbody>";
      while ($row=mysqli_fetch_array($result)) {
      $product_id=$row['product_id'];
      $select_products="Select * from products where product_id='$product_id'";
      $result_products=mysqli_query($con,$select_products);
      while ($row_product_price=mysqli_fetch_array($result_products)) {
    $product_price=array($row_product_price['product_price']);
    $price_table=$row_product_price['product_price'];
    $product_title=$row_product_price['product_title'];
    $product_image1=$row_product_price['product_image1'];
    $product_values=array_sum($product_price);
    $total_price+=$product_values;
    ?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_folder/product_image/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="quantity" id="" class="form-input w-50"></td>
                    <?php
                    $get_ip_add = getIPAddress(); 
                    if(isset($_POST['update_cart'])){
                      $quantities=$_POST['quantity'];
                      $update_cart="update cart_details set quantity=$quantities where ip_address='$get_ip_add'";
                      $result_quantity=mysqli_query($con,$update_cart);
                      $total_price=$total_price*$quantities;
                    }

                    ?>
                    <td><?php echo $price_table ?></td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                    <td>
                    <!-- <button class="bg-primary px-3 py-2 mx-5 ">Update</button> -->
                     <input type="submit" value="Update Cart" class="bg-secondary px-3 py-2 mx-5 text-light" name="update_cart">
                    <!-- <button class="bg-primary px-3 py-2 mx-5">Remove</button> -->
                    <input type="submit" value="Remove Cart" class="bg-secondary px-3 py-2 mx-5 text-light" name="remove_cart">
                    </td>
                </tr>

                    <?php
                    }
                    }
                    }
                    else{
                      echo "<p class='text-center text-danger fst-italic fw-light fs-3 mt-4'>Cart is empty!</p>";
                    }
                    ?>
            </tbody>

        </table>
        <!-- subtotal -->
         <div class="d-flex mb-5">
          <?php
          $get_ip_add = getIPAddress(); 
          $cart_query="Select * from cart_details where ip_address='$get_ip_add'";
          $result=mysqli_query($con,$cart_query);
          $result_count=mysqli_num_rows($result);
          if($result_count>0){
            echo "<p class='px-3 fw-bold'>Subtotal:<strong class='text-muted'> $total_price/-</strong></p>
            <input type='submit' value='Continue Shopping' class='bg-light px-3 py-2 mx-5 text-dark' name='continue_shopping'>
            <button class='bg-secondary px-3 py-2'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>'";
          }
          else{
            echo " <input type='submit' value='Continue Shopping' class='text-muted px-3 py-2 mx-5' name='continue_shopping'>";
          }
          if(isset($_POST['continue_shopping'])){
            echo "<script>window.open('index.php','_self')</script>";
          }
          ?>
            
         </div>
    </div>
 </div> 
 </form>
 <!-- functions to remove item -->
  <?php
  function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
      foreach($_POST['removeitem'] as $remove_id)
      echo $remove_id;
      $delete_query="Delete from cart_details where product_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
  echo $remove_item=remove_cart_item();
  ?>

<!-- last child -->
<?php
include("./includes/footer.php");
?>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html> 