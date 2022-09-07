<?php

include("include/connection.php");

?>
<!doctype html>
<html lang="en" class="fixed accounts forgot-password">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Reset Password - Stocksuni</title>
   <link rel="icon" href="../image/cropped-Logo-1-1-32x32.png" sizes="32x32" />
<link rel="icon" href="../image/cropped-Logo-1-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="../image/cropped-Logo-1-1-180x180.png" />
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="stylesheets/css/style.css">
</head>
<style>
    .box{
        margin-top: 10% !important;
    }
</style>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body  animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
      
        <div class="box">
            <!--FORGOT PASSWPRD FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <?php 
                                            $u_id = base64_decode($_GET['user']);
                                            $u_code =htmlspecialchars($_GET['code']);
                                        $selectUser = mysqli_query($con,"SELECT * FROM users where id='$u_id' and code='$u_code'");
                                        $rowUser = mysqli_num_rows($selectUser);
                                        if($rowUser>0){?>
                    <form id="updatepassword_reset"  autocomplete="off">
                         <div id="alert"></div>
                        <h4>Change Your Password</h4>
                        <div class="form-group mt-md">
                                <span class="input-with-icon">
                                        <input type="hidden"  name="user"  value="<?= base64_decode($_GET['user']) ?>">
                                        <input type="text" class="form-control" name="newpass"  placeholder="New Password">
                                     
                                    </span>
                        </div> 
                         <div class="form-group mt-md">
                                <span class="input-with-icon">
                                        <input type="text" class="form-control" name="confirmpass"  placeholder="Confirm Password">
                                       
                                    </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block ">Update</button>
                        </div>
                        <div class="form-group text-center">
                            You remembered?, <a href="index.php">Sign in!</a>
                        </div>
                    </form>
                    <?php } else{
                                        echo"<div class='alert alert-danger'>your Verification link has been expired</div>";
                                     } ?>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="javascripts/template-script.min.js"></script>
<script src="javascripts/template-init.min.js"></script>
    <script src="javascripts/customise.js"></script>

<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>


</html>
