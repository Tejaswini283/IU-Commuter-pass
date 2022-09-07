<?php 
session_start();
//include("include/connection.php");
$servername = "localhost";
$username = "tparlap";
$password = "style reverted redrawing";
$dbname = "tparlap_db";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);

}

if(@$_SESSION['role']==2){
    echo"<script>window.open('book-ride.php?add=new','_self');</script>";
}
else if($_SESSION['role']==""){
    echo"<script>window.open('index.php','_self');</script>";
}


?>
<!doctype html>
<html lang="en" class="fixed left-sidebar-top">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>IUCommuterPass(IUCP) - Dashboard</title>
<link rel="icon" href="../image/cropped-Logo-1-1-32x32.png" sizes="32x32" />
<link rel="icon" href="../image/cropped-Logo-1-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="../image/cropped-Logo-1-1-180x180.png" />
<!--load progress bar-->
<script src="vendor/pace/pace.min.js"></script>
<link href="vendor/pace/pace-theme-minimal.css" rel="stylesheet" />

<!--BASIC css-->
<!-- ========================================================= -->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="vendor/animate.css/animate.css">
<!--SECTION css-->
<!-- ========================================================= -->
<!--Notification msj-->
<link rel="stylesheet" href="vendor/toastr/toastr.min.css">
<!--Magnific popup-->
<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css">
<!--TEMPLATE css-->
<!-- ========================================================= -->
<link rel="stylesheet" href="stylesheets/css/style.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
</head>
<style>
	#toast-container{
		display: none !important;
	}
</style>
<body>
<div class="wrap">
<?php include("include/header.php");?>
<!-- page BODY -->
<!-- ========================================================= -->
<div class="page-body">
<?php include("include/sidebar.php");?>

<!-- CONTENT -->
<!-- ========================================================= -->
<div class="content">
<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
<ul class="breadcrumbs">
<li><i class="fa fa-home" aria-hidden="true"></i><a href="dashboard.php">Dashboard</a></li>
</ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
<div class="">
<div class="row">


<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--WIDGETBOX-->
<div class="col-sm-12 col-md-4">

<div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
<a href="ride.php?add=new">
<div class="panel-content">
<div class="row">
<div class="col-xs-4">
<span class="icon fa fa-user color-darker-2"></span>
</div>
<div class="col-xs-8">
<h4 class="subtitle color-darker-2">Start New Ride</h4>
<h1 class="title color-w"></h1>
</div>
</div>
</div>
</a>
</div>
<div class="panel widgetbox wbox-2 bg-scale-0">
<a href="ride.php">
<div class="panel-content">
<div class="row">
<div class="col-xs-4">
<span class="icon fa fa-globe color-darker-1"></span>
</div>
<div class="col-xs-8">
<h4 class="subtitle color-darker-1">Update Previous Ride</h4>
</div>
</div>
</div>
</a>
</div>

<div class="panel widgetbox wbox-2 bg-warning color-light">
<a href="near-by.php">
<div class="panel-content">
<div class="row">
<div class="col-xs-4">
<span class="icon fas fa-hand-paper"></span>
</div>
<div class="col-xs-8">
<h4 class="subtitle ">Near By Passenger</h4>
</div>
</div>
</div>
</a>
</div>
<div class="panel widgetbox wbox-3 bg-danger">
<a href="contact.php">
<div class="panel-content">
<div class="row">
<div class="col-xs-4">
<span class="icon fas fa-ban "></span>
</div>
<div class="col-xs-8">
<h4 class="subtitle">Contact Request</h4>
</div>
</div>
</div>
</a>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--AREA CHART-->
<div class="col-sm-8 col-md-8">
<div class="tabs mt-none">
<!-- Tabs Header -->
<ul class="nav nav-tabs nav-justified">
<li class="active"><a href="#home" data-toggle="tab">New 5 Messages</a></li>

</ul>
<!-- Tabs Content -->
<div class="tab-content">
<div class="tab-pane fade in active" id="home">
<div class="table-responsive">
<table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                         <th>Passenger Name</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                          
                                            <th>Time</th>
                                          
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
 $sessionid = htmlspecialchars($_SESSION['user_id']);

if(@$_SESSION['role']==1){
    $select = mysqli_query($con,"SELECT contact.*,p.Id as pid,p.first_name as p_fname,p.last_name  as p_lname,r.first_name as rider_fname,r.last_name as rider_lname FROM contact left JOIN users as p on p.id=contact.passenger_id left JOIN users as r on r.id=contact.rider_id WHERE contact.date=curdate() and contact.rider_id='$sessionid' order by contact.id desc limit 0,5");

}
else{
    $select = mysqli_query($con,"SELECT contact.*,p.Id as pid,p.first_name as p_fname,p.last_name  as p_lname,r.first_name as rider_fname,r.last_name as rider_lname FROM contact left JOIN users as p on p.id=contact.passenger_id left JOIN users as r on r.id=contact.rider_id WHERE contact.date=curdate() and contact.passenger_id='$sessionid' order by contact.id desc limit 0,5");

}


while($fetchOne = mysqli_fetch_array($select)){
    


?>


<tr>
    <td><?= $fetchOne['p_fname'] ?> <?= $fetchOne['p_lname'] ?></td>
    <td><?= $fetchOne['msg'] ?></td>
    <td><?= $fetchOne['date'] ?></td>
    <td><?= $fetchOne['time'] ?></td>

    <td><a href="messages.php?p_id=<?= $fetchOne['pid'] ?>" class="btn btn-success">Contact</a></td>

</tr>

                                           <?php   }?>
                                    </tbody>
                                </table>
</div>
</div>

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
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<!--Notification msj-->
<script src="vendor/toastr/toastr.min.js"></script>
<!--morris chart-->
<script src="vendor/chart-js/chart.min.js"></script>
<!--Gallery with Magnific popup-->
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<!--Examples-->



</body>


</html>