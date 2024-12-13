<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {

    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temporary name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking empty condition
    if (
        $product_title == '' || $description == '' || $product_keywords == '' ||
        $product_categories == '' || $product_brands == '' || $product_price == '' ||
        $product_image1 == '' || $product_image2 == '' || $product_image3 == ''
    ) {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_image/$product_image1");
        move_uploaded_file($temp_image2, "./product_image/$product_image2");
        move_uploaded_file($temp_image3, "./product_image/$product_image3");

        // Insert query
        $insert_product = "INSERT INTO `products` 
            (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price) 
            VALUES 
            ('$product_title', '$description', '$product_keywords', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price')";
        $result_query = mysqli_query($con, $insert_product);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #ffc107;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #343a40;
            color: #fff;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .page-title {
            color: #343a40;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <p class="text-center page-title fs-1">Insert Product</p>
        <div class="form-container mx-auto mt-4">
            <!-- Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Title -->
                <div class="form-outline mb-4">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required>
                </div>
                <!-- Description -->
                <div class="form-outline mb-4">
                    <label for="description" class="form-label">Product Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" required>
                </div>
                <!-- Keywords -->
                <div class="form-outline mb-4">
                    <label for="product_keywords" class="form-label">Product Keywords</label>
                    <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" required>
                </div>
                <!-- Categories -->
                <div class="form-outline mb-4">
                    <label for="product_categories" class="form-label">Product Category</label>
                    <select name="product_categories" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php
                        $select_query = "SELECT * FROM `categories`";
                        $result_query = mysqli_query($con, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Brands -->
                <div class="form-outline mb-4">
                    <label for="product_brands" class="form-label">Product Brand</label>
                    <select name="product_brands" class="form-select" required>
                        <option value="">Select Brand</option>
                        <?php
                        $select_query = "SELECT * FROM `brands`";
                        $result_query = mysqli_query($con, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Images -->
                <div class="form-outline mb-4">
                    <label for="product_image1" class="form-label">Product Image 1</label>
                    <input type="file" name="product_image1" id="product_image1" class="form-control" required>
                </div>
                <div class="form-outline mb-4">
                    <label for="product_image2" class="form-label">Product Image 2</label>
                    <input type="file" name="product_image2" id="product_image2" class="form-control" required>
                </div>
                <div class="form-outline mb-4">
                    <label for="product_image3" class="form-label">Product Image 3</label>
                    <input type="file" name="product_image3" id="product_image3" class="form-control" required>
                </div>
                <!-- Price -->
                <div class="form-outline mb-4">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required>
                </div>
                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" name="insert_product" class="btn btn-custom">Insert Product</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
