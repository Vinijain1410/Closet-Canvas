<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
    $brand_title=$_POST['brand_title'];

    // query to select data from the database
    $select_query="select * from `brands` where brand_title='$brand_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if ($number>0) {
      echo "<script>alert('This brand is present inside the database')</script>";
    }
    else{
    $insert_query="insert into `brands` (brand_title) value('$brand_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
    echo "<script>alert('Brands has been inserted successfuly)</script>";
    }
}
}
?>
<h3 class="text-center">Insert Brands</h3>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-receipt" style=" background-color: #ffc107;"></i></span>
  <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Brands" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class=" border-0 p-2 my-3" name="insert_brand" value="Insert Brands" style=" background-color: #ffc107;">
   <!-- <button class="bg-primary p-2 my-3 border-0">Insert Brands</button> -->
</div>
</form>