<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['role'])){
  echo"<script>window.open('index','_self');</script>";
  
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
<style>
    .bold{
        font-weight: 900;
    }
    .wrapper {
        height: 1200px;
    }
    .nav-tabs , .nav-tabs>li>a {
    border-bottom: none !important;
}

.nav-tabs.nav-justified>li>a, .nav-tabs>li>a ,.tab-content {
    border: none !important;

    }
    .db_box {
     padding: 0px  !important; 
}
.stats{
        padding: 30px  !important; 
        margin-top: 30px;
 
}
.r4_counter {
    width:100%;
    height: 200px;
    background-size: cover;
        background-image: linear-gradient(rgb(0 0 0 / 0%), rgb(0 0 0 / 0%) ), url("https://members.realriseacademy.com/imgs/get-started.248e64ee.png");
    position: relative;
}
.FixedHeightContainer
{
  float:right;
  height: 300px;
  width:100%;  
   display: flex;
  flex-direction: column;
    flex-grow: 1;  
  overflow: auto;
  background-color: white;
  padding: 15px;
}
.Content{
    background-color: grey;
  
    width: 100%;
    border-radius: 99px;
    color: white ;
    padding: 20px;
    margin-top: 10px;

}
</style>
         
<body>
<div class="wrap">
<?php include("include/header.php");?>
<!-- page BODY -->
<!-- ========================================================= -->
<div class="page-body">
<?php include("include/sidebar.php");?>

<?php

$rider = htmlspecialchars($_SESSION['user_id']);

$select = mysqli_query($con,"SELECT * FROM rider where rider_id='$rider' and status=1  and start_date=curdate() order by id desc ");
$fetch = mysqli_fetch_array($select);


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
<li><a><?php if(isset($_GET['add'])){ echo'Start Ride';  } else{  echo'Contact With Rider'; } ?></a></li>
</ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">

<!--STRIPE-->
<div class="col-md-12">
<h4 class="section-subtitle"><b><?php if(isset($_GET['add'])){ echo'Start Ride';  } else{  echo'Contact With Rider'; } ?></b> </h4>
<div class="panel">
<div class="panel-content">
<div class="row">
<div class="col-sm-12">

<div class="FixedHeightContainer">
     <?php

 $sessionid = htmlspecialchars($_SESSION['user_id']);

  $rider_id = $_GET['rider'];
  $select = mysqli_query($con,"SELECT contact.*,p.Id as pid,p.first_name as p_fname,p.last_name  as p_lname,r.first_name as rider_fname,r.last_name as rider_lname,s.first_name as s_fname,s.last_name  as s_lname FROM contact left JOIN users as s on s.id=contact.sender_id  left JOIN users as p on p.id=contact.passenger_id left JOIN users as r on r.id=contact.rider_id WHERE contact.date=curdate() and contact.passenger_id='$sessionid' and contact.rider_id='$rider_id' order by contact.id desc");


while($fetch = mysqli_fetch_array($select)){
                                        
                                         ?>
                                         
  <div class="Content">

       <span style="color:#ff9a42"><?= $fetch['s_fname'] ?> <?= $fetch['s_lname'] ?></span>

 <?= $fetch['msg'] ?>
  </div>
<?php } ?>
</div>

<?php 
if(isset($_POST['msg'])){
    $msg = $_POST['txt'];

   $run= mysqli_query($con,"INSERT INTO `contact`(`passenger_id`, `rider_id`, `msg`, `date`, `time`, `sender_id`) VALUES ('$sessionid','$rider_id','$msg',now(),now(),'$sessionid')");

   if($run){
    echo"<script>window.open('message.php?rider=$rider_id','_self')</script>";
}
}?>

<form action="" method="POST" role="form"  autocomplete="off">
    <legend>Message</legend>

    <div class="form-group">
        <textarea type="text" class="form-control" name="txt" placeholder="Your Message"></textarea>
    </div>

    

    <button type="submit" name="msg" class="btn btn-primary">Send</button>
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
