<?php 
session_start();
if(isset($_SESSION['role'])){
echo"<script>window.open('dashboard.php','_self');</script>";

}?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>IUCommuterPass(IUCP) - Login</title>
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
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
     
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form id="login"  autocomplete="off">
                <h3>IUCommuterPass(IUCP) Login</h3>
    <?php
if(isset($_GET['active'])){
    echo'<div class="alert alert-success">Thanks For Activated Now Login your account</div>';
}

?>

                <div id="alert"></div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                     
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                        <hr/>
                        <div class="form-group text-center">
                            <a href="sign-up.php">Signup Account</a>
                           
                        </div>
                        <div class="form-group text-center">
                            <a href="forgot.php">Forgot password?</a>
                           
                        </div>
                    </form>
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
