<?php

// include connect file
// include('./includes/connect.php');
// include('functions/common_function.php');

// getting products
function getproducts(){
    global $con;
    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query="Select * from `products` order by rand() LIMIT 0,9";
         $result_query=mysqli_query($con,$select_query);
         while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image1=$row['product_image1'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fst-italic fs-6'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id'class='btn btn-secondary'>View More</a>
        </div>
     </div>
</div>";
         }
}
}
}

// getting all products
function get_all_products(){
  global $con;
  // condition to check isset or not
  if(!isset($_GET['category'])){
      if(!isset($_GET['brand'])){
  $select_query="Select * from `products` order by rand()";
       $result_query=mysqli_query($con,$select_query);
       while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
<img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
<div class='card-body'>
  <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
  <p class='card-text'>$product_description</p>
  <p class='card-text fw-bold'>Price: $product_price</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
  <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
      </div>
   </div>
</div>";
}
}
}
}


// getting unique categories
function get_unique_categories(){
    global $con;

    // condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query="Select * from `products` where category_id=$category_id";
         $result_query=mysqli_query($con,$select_query);
         $num_of_rows=mysqli_num_rows($result_query);
         if($num_of_rows==0){
            echo "<p class='text-center text-secondary fst-italic fw-semibold fs-5'>Sorry, for the inconvinience but there is no stock available for this category right now!!</p>";
         }
         while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image1=$row['product_image1'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
     </div>
</div>";
         }
}
}

// getting unique brands
function get_unique_brands(){
    global $con;

    // condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
    $select_query="Select * from `products` where brand_id=$brand_id";
         $result_query=mysqli_query($con,$select_query);
         $num_of_rows=mysqli_num_rows($result_query);
         if($num_of_rows==0){
            echo "<p class='text-center text-secondary fst-italic fw-semibold fs-5'>Sorry, for the inconvinience but there is no stock available for this brand right now!!<p>";
         }
         while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image1=$row['product_image1'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
     </div>
</div>";
         }
}
}


// displaying brands in side nav
function getbrands(){
    global $con;
    $select_brand="select * from `brands`";
    $result_brand=mysqli_query($con,$select_brand);
    while($row_data=mysqli_fetch_assoc($result_brand)){
      $brand_title=$row_data['brand_title'];
      $brand_id=$row_data['brand_id'];
      echo " <li class='nav-item'>
    <a href='index.php?brand=$brand_id' class='nav-link'>$brand_title</a>
  </li> ";
    }
}

// displaying categories in side nav
function getcategories(){
    global $con;
    $select_categories="select * from `categories`";
            $result_categories=mysqli_query($con,$select_categories);
            while($row_data=mysqli_fetch_assoc($result_categories)){
              $category_title=$row_data['category_title'];
              $category_id=$row_data['category_id'];
              echo " <li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link'>$category_title</a>
          </li> ";
            }
}


// searching products function
function search_product(){
  global $con;
    if(isset($_GET['search_data_product'])){
      $search_data_value=$_GET['search_data'];
    $search_query="Select * from `products` where product_keywords like '%$search_data_value%'";
         $result_query=mysqli_query($con,$search_query);
         $num_of_rows=mysqli_num_rows($result_query);
         if($num_of_rows==0){
            echo "<p class='text-center text-secondary fst-italic fw-semibold fs-5'>No Results Match!!</p>";
         }
         while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image1=$row['product_image1'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
     </div>
</div>";
         }
}
}



// view details function
function view_details(){
  global $con;
  // condition to check isset or not
  if(isset($_GET['product_id'])){
  if(!isset($_GET['category'])){
      if(!isset($_GET['brand'])){
        $product_id=$_GET['product_id'];
  $select_query="Select * from `products` where product_id=$product_id";
       $result_query=mysqli_query($con,$select_query);
       while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_image2=$row['product_image2'];
        $product_image3=$row['product_image3'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
<img src='./admin_folder/product_image/$product_image1'class='card-img-top' alt='...'>
<div class='card-body'>
  <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
  <p class='card-text'>$product_description</p>
  <p class='card-text'fw-bold>Price: $product_price</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
  <a href='product_details.php?product_id=$product_id'class='btn btn-secondary'>View More</a>
      </div>
   </div>
</div>

<div class='col-md-8'>
        <!-- related cards -->
         <div class='row'>
            <div class='col-md-12'>
                <!-- <h4 class='text-center'>Related Products</h4> -->
            </div>
            <div class='col-md-6'>
            <div class='card'>
  <img src='./admin_folder/product_image/$product_image2'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id'class='btn btn-secondary'>View More</a>
        </div>
     </div>
            </div>
            <div class='col-md-6'>
            <div class='card'>
  <img src='./admin_folder/product_image/$product_image3'class='card-img-top' alt='...'>
  <div class='card-body'>
    <p class='card-title fw-bold fw-bold fst-italic'>$product_title<p>
    <p class='card-text'>$product_description</p>
    <p class='card-text fw-bold'>Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add To Cart</a>
    <a href='product_details.php?product_id=$product_id'class='btn btn-secondary'>View More</a>
        </div>
     </div>
            </div>
         </div>
       </div>
";
       }
}
}
}
}

// ip address function
function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  


// cart function
function cart(){
if (isset($_GET['add_to_cart'])) {
  global $con;
  $get_ip_add = getIPAddress();  
  $get_product_id=$_GET['add_to_cart'];
  $select_query="Select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
  $result_query=mysqli_query($con,$select_query);
  $num_of_rows=mysqli_num_rows($result_query);
         if($num_of_rows>0){
            echo "<script>alert('This item is already present inside cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
         }
         else{
          $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',0)";
          $result_query=mysqli_query($con,$insert_query);
          echo "<script>alert('This item is added to cart successfuly')</script>";
          echo "<script>window.open('index.php','_self')</script>";
         }
}
}

// function to get cart item numbers
function cart_item(){
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_add = getIPAddress();  
    $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }       
    else{
            global $con;
    $get_ip_add = getIPAddress();  
    $select_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
           }
           echo $count_cart_items;
  }
   

  // total cart price
  function total_cart_price(){
    global $con;
    $get_ip_add = getIPAddress(); 
    $total_price=0;
    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
    $result=mysqli_query($con,$cart_query);
    while ($row=mysqli_fetch_array($result)) {
      $product_id=$row['product_id'];
      $select_products="Select * from `products` where product_id='$product_id'";
      $result_products=mysqli_query($con,$select_products);
      while ($row_product_price=mysqli_fetch_array($result_products)) {
    $product_price=array($row_product_price['product_price']);
    $product_values=array_sum($product_price);
    $total_price+=$product_values;
      }
    }
    echo $total_price;
  }
  

  // get user order details
  function get_user_order_details() {
    global $con;
    // Check if username exists in session
    if (!isset($_SESSION['username'])) {
        echo "<p class='text-center text-danger mt-5 fs-2 fw-bold'>User not logged in!</p>";
        return;
    }
    $username = $_SESSION['username'];
    // Fetch user details
    $get_details = "SELECT user_id FROM user_table WHERE user_name = '$username'";
    $result_query = mysqli_query($con, $get_details);
    if (!$result_query) {
        die("Error fetching user details: " . mysqli_error($con));
    }
    // Fetch user ID
    $row_query = mysqli_fetch_assoc($result_query);
    if (!$row_query) {
        echo "<p class='text-center text-danger mt-5 fs-2 fw-bold'>User not found in the database!</p>";
        return;
    }
    $user_id = $row_query['user_id'];
    if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
        // Fetch pending orders
        $get_orders = "SELECT * FROM user_orders WHERE user_id = $user_id or order_status = 'pending'";
        $result_orders_query = mysqli_query($con, $get_orders);
        if (!$result_orders_query) {
            die("Error fetching orders: " . mysqli_error($con));
        }
        // Count the number of rows in the result
        $row_count = mysqli_num_rows($result_orders_query);
        // Display message based on the number of pending orders
        if ($row_count > 0) {
            echo "<p class='text-center text-success mt-5 fs-2 fw-semibold'>You Have <span class='text-danger'>$row_count</span> Pending Orders!</p>";
            echo "<p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
        } else {
            echo "<p class='text-center text-success mt-5 mb-2 fs-2 fw-semibold'>You Have Zero Pending Orders!</p>";
            echo "<p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
        }
    }
}

?>