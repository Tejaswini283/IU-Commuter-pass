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
<title>Nearby Rider- IUCommuterPass(IUCP)</title>
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
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--dataTable-->
    <link rel="stylesheet" href="vendor/data-table/media/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
   <?php include("include/header.php");?>
<!-- page BODY -->
<!-- ========================================================= -->
<div class="page-body">
<?php include("include/sidebar.php");?>
        <!-- ========================================================= -->
        <div class="content">
            <!-- content HEADER -->
            <!-- ========================================================= -->
            <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="dashboard.php">Dashboard</a></li>
                        <li><a>Near By Rider</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--SEARCHING, ORDENING & PAGING-->
            <div class="row animated fadeInRight">
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Near By Rider</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                            <?php
if(isset($_POST['add'])){

     $passenger = htmlspecialchars($_SESSION['user_id']);
   $rider = htmlspecialchars($_POST['choose']);

    $select = mysqli_query($con,"SELECT * FROM rider where rider_id='$rider' and status=1 and start_date=curdate() order by id desc ");
    $fetch = mysqli_fetch_array($select);

    $idx = $fetch['Id'];

    $chooser =  explode(",",$fetch['choose_commuter']);
    $array = array();

    foreach($chooser as $key) {    
        $array[] = $key; 
    }

    if(in_array($passenger, $array)){
        echo"<div class='alert alert-danger'>you already choosed this rider !</div>";
    }else{

        $select2 = mysqli_query($con,"SELECT * FROM rider where  status=1 and start_date=curdate() order by id desc ");
        while($fetch2 = mysqli_fetch_array($select2)){
            $idx2 = $fetch2['Id'];
        $chooser2 =  $fetch2['choose_commuter'];

        $chooser2 = str_replace("$passenger,","",$chooser2);
      $chooser2 = str_replace(",$passenger","",$chooser2);
      $chooser2 = str_replace("$passenger","",$chooser2);
 $update = mysqli_query($con,"UPDATE `rider` SET `choose_commuter`='$chooser2' WHERE  Id='$idx2'");

        }



if($fetch['choose_commuter']==""){
 $implode = "$passenger";
}else{
    $implode = $fetch['choose_commuter'].",$passenger";  
}
$update = mysqli_query($con,"UPDATE `rider` SET `choose_commuter`='$implode' WHERE  Id='$idx'");

   $update = mysqli_query($con,"UPDATE `rider` SET `choose_commuter`='$implode' WHERE  Id='$idx'");

    if($update){
        echo"<div class='alert alert-success'>Successfully Add in your ride !</div>";
    }



    }


   

}
?>

                                <form method="post">
                                <button type="submit" name="add" class="pull-right btn btn-primary">Choose Now <i class="fa fa-plus"></i></button>
                               
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                         <th>Rider Name</th>
                                            <th>Start Location</th>
                                            <th>Destination</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                         
                                          <th>Choose</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
 $passenger = htmlspecialchars($_SESSION['user_id']);

$select = mysqli_query($con,"SELECT * FROM passenger where passenger_id='$passenger' and status=1 and Date=curdate() order by id desc");
$fetch = mysqli_fetch_array($select);

  $startlocation = $fetch['StartLocation'];

$selectOne = mysqli_query($con,"SELECT rider.*,users.id as riderid,users.first_name,users.last_name FROM `rider` left join users on users.id=rider.rider_id where rider.start_location='$startlocation' and rider.start_date=curdate() and rider.status=1
");
while($fetchOne = mysqli_fetch_array($selectOne)){
    

   $chooser =  explode(",",$fetchOne['choose_commuter']);
    $array = array();

    foreach($chooser as $key) {    
        $array[] = $key; 
    }

?>


<tr>
    <td><?= $fetchOne['first_name'] ?>d <?= $fetchOne['last_name'] ?></td>
    <td><?= $fetchOne['start_location'] ?></td>
    <td><?= $fetchOne['destination_location'] ?></td>
    <td><?= $fetchOne['start_date'] ?></td>
    <td><?= $fetchOne['start_time'] ?></td>

    <?php
    if(in_array($passenger, $array)){?>
    
    <td><label for="choose<?= $fetchOne['Id'] ?>"><input type="radio" checked name='choose' value='<?= $fetchOne['riderid'] ?>'  id="choose<?= $fetchOne['Id'] ?>">Choose</label></td>
<?php } else{?>
    <td><label for="choose<?= $fetchOne['Id'] ?>"><input type="radio" name='choose' value='<?= $fetchOne['riderid'] ?>'  id="choose<?= $fetchOne['Id'] ?>">Choose</label></td>

    <?php } ?>
    <td><a href="message.php?rider=<?= $fetchOne['rider_id'] ?>" class="btn btn-success">Contact</a></td>

</tr>

                                           <?php   }?>
                                    </tbody>
                                </table>
</form>
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
<!--dataTable-->
<script src="vendor/data-table/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
<!--Examples-->
<script src="javascripts/examples/tables/data-tables.js"></script>
    <script src="javascripts/customise.js"></script>

</body>


<script>
    
   function del(id){
$("#del_page_id").val(id);
    }
</script>

</html>
