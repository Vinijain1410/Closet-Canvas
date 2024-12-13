<p class="text-center text-dark fs-3 fw-semibold">All products</p>
<table class="table table-responsive table-bordered mt-5 table-secondary table-hover">
    <thead class="table-dark text-center">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
<tbody class="text-dark text-center">
    <?php
    $get_products="SELECT * FROM `products`";
    $result=mysqli_query($con,$get_products);
    while($row=mysqli_fetch_assoc($result)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
    ?>
        <tr>
        <td><?php echo $product_id; ?></td>
        <td><?php echo $product_title; ?></td>
        <td><img src='./product_image/<?php echo $product_image1;?>' class='product_image'/></td>
        <td><?php echo $product_price;?></td>
        <td><?php 
        $get_count="SELECT * FROM `pending_orders` WHERE product_id=$product_id";
        $result_count=mysqli_query($con,$get_count);
        $row_count=mysqli_num_rows($result_count);
        echo $row_count;
        ?>
        </td>
        <td>True</td>
        <td><a href='index.php?edit_products=<?php echo $product_id;?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product=<?php echo $product_id;?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
    </tr>
    <?php
    }
    ?>
</tbody>
</table>
