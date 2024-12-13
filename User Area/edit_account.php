<?php
if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `user_table` where user_name='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['user_name'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_contact=$row_fetch['user_contact'];

    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_contact=$_POST['user_contact'];
        $user_image = $_FILES['user_image']['name']; // Corrected variable name
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        // update query
        $update_data="update `user_table` set user_name='$user_name',user_email='$user_email',user_image='$user_image',user_address='$user_address',user_contact='$user_contact' where user_id=$update_id";
        $update_result_query=mysqli_query($con,$update_data);
        if($update_result_query){
            echo "<script>alert'Data Updated Successfully!'</script>";
            echo "<script>window.open('logout.php','_self')</script>";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closet Canvas: Edit Account</title>
</head>
<body>
   <p class="text-success mb-3 fs-3 mt-3 fw-semibold text-center">Edit Account<p>
   <form action="" method="post" enctype="multipart/form-data" class="text-center">
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>" name="user_name">
    </div>
    <div class="form-outline mb-4">
        <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
    </div>
    <div class="form-outline mb-4 d-flex w-50 m-auto">
        <input type="file" class="form-control m-auto" name="user_image">
        <img src="./user_images/<?php echo $user_image ?>" alt="" class="edit_image">
    </div>
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
    </div>
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_contact ?>" name="user_contact">
    </div>
    <input type="submit" value="update" class="bg-dark text-light py-2 px-3 border-2" name="user_update">

   </form>
</body>
</html>