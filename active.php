<?php 
include("include/connection.php");

 $u_id = base64_decode($_GET['user']);

$update = mysqli_query($con,"UPDATE `users` SET `active`='1' WHERE id='$u_id'");

if($update){
    echo"<script>window.open('index.php?active=1','_self');</script>";
  
}
