<?php

$con=mysqli_connect('localhost','root','','closet_store');
if(!$con){
    // echo "connection successful";
    die(mysqli_error($con));
}

?>