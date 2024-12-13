<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    // query to select data from the database
    $select_query="select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if ($number>0) {
      echo "<script>alert('This category is present inside the database')</script>";
    }
    else{
    $insert_query="insert into `categories` (category_title) value('$category_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
    echo "<script>alert('categories has been inserted successfuly)</script>";
    }
}
}
?>
<h3 class="text-center">Insert Categories</h3>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt" style=" background-color: #ffc107"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <!-- <input type="submit" class="form-control bg-secondary" name="insert_cat" value="Insert Categories"> -->
   <input type ="submit" class=" p-2 my-3 border-0" name="insert_cat" value="Insert Categories" style=" background-color: #ffc107;">
</div>
</form>