<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['role'])){
echo"<script>window.open('index','_self');</script>";

}

if(@$_SESSION['role']==1){
  echo"<script>window.open('dashboard.php','_self');</script>";
}



?>
<!doctype html>
<html lang="en" class="fixed left-sidebar-top">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>IUCommuterPass(IUCP) - Ride</title>
<link rel="icon" href="../image/cropped-Logo-1-1-32x32.png" sizes="32x32" />
<link rel="icon" href="../image/cropped-Logo-1-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="../image/cropped-Logo-1-1-180x180.png" />
<!--load progress bar-->
<script src="vendor/pace/pace.min.js"></script>
<link href="vendor/pace/pace-theme-minimal.css" rel="stylesheet" />
<!--BASIC css-->
<!-- ========================================================= -->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="vendor/animate.css/animate.css">
     <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
<!--SECTION css-->
<!-- ========================================================= -->
<!--TEMPLATE css-->
<!-- ========================================================= -->
<link rel="stylesheet" href="stylesheets/css/style.css">
 <script src="https://cdn.tiny.cloud/1/4n7vldzhz0q64qgr45c8nhvo18g7i09mxu185krzbc0dwyt1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>
</head>

<body>
<div class="wrap">
<?php include("include/header.php");?>
<!-- page BODY -->
<!-- ========================================================= -->
<div class="page-body">
<?php include("include/sidebar.php");?>

<?php

if(!isset($_GET['add'])){
$passenger = htmlspecialchars($_SESSION['user_id']);

$select = mysqli_query($con,"SELECT * FROM passenger where passenger_id='$passenger' and status=1  and Date=curdate() order by id desc ");
$fetch = mysqli_fetch_array($select);
}

?>
<!-- ========================================================= -->
<div class="content">
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
<ul class="breadcrumbs">
<li><i class="fa fa-columns" aria-hidden="true"></i><a href="dashboard.php">Dashbord</a></li>
<li><a><?php if(isset($_GET['add'])){ echo'Start Ride';  } else{  echo'Update Previous Ride'; } ?></a></li>
</ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">

<!--STRIPE-->
<div class="col-md-12">
<h4 class="section-subtitle"><b><?php if(isset($_GET['add'])){ echo'Start Book New Ride';  } else{  echo'Update Previous Ride'; } ?></b> </h4>
<div class="panel">
<div class="panel-content">
<div class="row">
<div class="col-sm-12">

<form id="<?php if(isset($_GET['add'])){ echo'add'; } else{ echo'update'; } ?>" class="form-horizontal form-stripe" autocomplete="off">

<input type="hidden" id="page" value="book-ride">
<div id="alert" style="padding-left: 50px; padding-left: 50px;"></div>
<div class="form-group">
    <input type="hidden" value="<?= @$fetch['Id'] ?>" name="id" >

<label for="name" class="col-sm-2 control-label">Start Date</label>
<div class="col-sm-10">
<input type="date" class="form-control" value="<?php if(isset($_GET['add'])){ echo date("Y-m-d"); } else{ echo @$fetch['Date']; } ?>" name="start_date" required="">
</div>
</div>
<div class="form-group">

<label for="name" class="col-sm-2 control-label">Start Time</label>
<div class="col-sm-10">
<input type="time" class="form-control" value="<?php if(isset($_GET['add'])){ echo date('H:i:s'); } else{ echo @$fetch['Time']; } ?>" name="start_time" required="">
</div>
</div>
<div class="form-group">
<label for="username" class="col-sm-2 control-label">Start Location</label>
<div class="col-sm-10">
<select type="text" class="form-control"  name="start_location" >

<option <?php if(@$fetch['StartLocation']=="Campus center"){ echo"selected"; } ?>>Campus center</option>
<option <?php if(@$fetch['StartLocation']=="Soic"){ echo"selected"; } ?>>Soic</option>
<option <?php if(@$fetch['StartLocation']=="Walker theater"){ echo"selected"; } ?>>Walker theater</option>
</select>
</div>
</div>
<div class="form-group">
<label for="username" class="col-sm-2 control-label">Destination Location</label>
<div class="col-sm-10">
  <input type="text" name="destination_location" value="<?= @$fetch['Destination'] ?>" class="form-control" placeholder="Destination Location" />

</div>
</div>

<?php if(!isset($_GET['add'])){ ?>
<div class="form-group">
<label for="username" class="col-sm-2 control-label">Do you want to cancle ride?</label>
<div class="col-sm-10">
<select type="text" class="form-control" name="status" >
<option <?php if(@$fetch['status']=="1"){ echo"selected"; } ?>  value="1">No</option>

<option <?php if(@$fetch['status']=="0"){ echo"selected"; } ?> value="0">Yes</option>
</select>
</div>
</div>
<?php } ?>

<div class="form-group">

<label for="name" class="col-sm-2 control-label">No. Of Passenger</label>
<div class="col-sm-10">
<input type="number" class="form-control" value="<?= @$fetch['No_of_persons'];  ?>" name="no_of_persons" required="">
</div>
</div>

<div class="form-group">

<label for="name" class="col-sm-2 control-label">Amount</label>
<div class="col-sm-10">
<input type="text" class="form-control" value="<?= @$fetch['Amount'];  ?>" name="amount" required="">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit"  class="btn btn-primary btn-sbmit">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>

<!--scroll to top-->
<a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
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
