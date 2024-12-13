<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    // echo $edit_id;
    $get_products="SELECT * FROM `products` WHERE product_id=$edit_id";
    $result_product=mysqli_query($con,$get_products);
    $row=mysqli_fetch_assoc($result_product);
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_keywords=$row['product_keywords'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    $product_image1=$row['product_image1'];
    $product_image2=$row['product_image2'];
    $product_image3=$row['product_image3'];
    $product_price=$row['product_price'];


    // fetching categories name
    $select_categories= "SELECT * FROM `categories` WHERE category_id=$category_id";
    $result_categories= mysqli_query($con,$select_categories);
    $row_categories=mysqli_fetch_assoc($result_categories);
    $category_title=$row_categories['category_title'];
    

    // fetching brands name
    $select_brands= "SELECT * FROM `brands` WHERE brand_id=$brand_id";
    $result_brands= mysqli_query($con,$select_brands);
    $row_brands=mysqli_fetch_assoc($result_brands);
    $brand_title=$row_brands['brand_title'];
}
?>


<div class="container mt-5">
    <p class="text-center fs-3 fw-semibold">Edit Products</p>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title;?>" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Description</label>
            <input type="text" id="product_desc" value="<?php echo $product_description;?>" name="product_desc" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Keywords</label>
            <input type="text" id="product_Keywords" value="<?php echo $product_keywords;?>" name="product_Keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Category</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title?>"><?php echo $category_title?></option>
                <?php
    $select_all_categories= 'SELECT * FROM `categories`';
    $result_all_categories= mysqli_query($con,$select_all_categories);
    while($row_all_categories=mysqli_fetch_assoc($result_all_categories)){
        $category_title=$row_all_categories['category_title'];
        $category_id=$row_all_categories['category_id'];
        echo "<option value='$category_id'>$category_title</option>";
    };
     ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Brands</label>
            <select name="product_brands" class="form-select">
                <option value="<?php echo $brand_title;?>"><?php echo $brand_title;?></option>
                <?php
    $select_all_brands= "SELECT * FROM `brands`";
    $result_all_brands= mysqli_query($con,$select_all_brands);
    while($row_all_brands=mysqli_fetch_assoc($result_all_brands)){
        $brand_title=$row_all_brands['brand_title'];
        $brand_id=$row_all_brands['brand_id'];
        echo "<option value='$brand_id'>$brand_title</option>";
    };
     ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image1</label>
            <div class="d-flex">
            <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
            <img src="./product_image/<?php echo $product_image1;?>" alt="" clas="edit_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image2</label>
            <div class="d-flex">
            <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
            <img src="./product_image/<?php echo $product_image2;?>" alt="" clas="edit_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image3</label>
            <div class="d-flex">
            <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
            <img src="./product_image/<?php echo $product_image3;?>" alt="" clas="edit_img">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price;?>" name="product_price" class="form-control" required="required">
        </div>
        <div class="text-center m-auto">
            <input type="submit" name="edit_product" value="update product" class="btn btn-dark px-3 mb-3 mt-3">
        </div>
    </form>
</div>
<!-- editng products -->
<?php

if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_Keywords=$_POST['product_Keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];

    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    // checking if field is empty or not
    if($product_title=='' OR $product_keywords=='' OR $product_desc=='' OR $product_category=='' OR $product_brands=='' OR $product_image1=='' OR $product_image2=='' OR $product_image3==''  OR $product_price==''){
        echo "<script>alert('Please fill All The Fields')</script>";
    }
    else{
        move_uploaded_file($temp_image1,"/product_image/$product_image1");
        move_uploaded_file($temp_image2,"/product_image/$product_image2");
        move_uploaded_file($temp_image3,"/product_image/$product_image3");

        // query to update products
        $update_products="UPDATE `products` SET product_title='$product_title', product_description='$product_desc', product_keywords='$product_keywords', 
        category_id='$product_category', brand_id='$product_brands', product_image1='$product_image1', product_image2='$product_image2', 
        product_image3='$product_image2', product_image3='$product_image3', product_price='$product_price', date=NOW() WHERE product_id=$edit_id";
        $result_update=mysqli_query($con,$update_products);
        if($result_update){
        echo "<script>alert('Product Updated Successfully')</script>";
        echo "<script>window.open('./insert_product.php','_self')</script>";
        }

    }

}


?>