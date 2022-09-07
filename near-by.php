<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['role'])){
    echo"<script>window.open('index.php','_self');</script>";
    
    }
    
if(@$_SESSION['role']==2){
    echo"<script>window.open('book-ride.php?add=new','_self');</script>";
}
?>
<!doctype html>
<html lang="en" class="fixed left-sidebar-top">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Nearby Passenger- IUCommuterPass(IUCP)</title>
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
                        <li><a>Near By Passenger</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--SEARCHING, ORDENING & PAGING-->
            <div class="row animated fadeInRight">
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Near By Passenger</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                            <?php
if(isset($_POST['add'])){

    $rider = htmlspecialchars($_SESSION['user_id']);

    $select = mysqli_query($con,"SELECT * FROM rider where rider_id='$rider' and status=1 and start_date=curdate() order by id desc ");
    $fetch = mysqli_fetch_array($select);

    $idx = $fetch['Id'];

    $implode = @implode(",",$_POST['choose']);

    $update = mysqli_query($con,"UPDATE `rider` SET `choose_commuter`='$implode' WHERE  Id='$idx'");

    if($update){
        echo"<div class='alert alert-success'>Successfully Add in your ride !</div>";
    }

}
?>

                                <form method="post">
                                <button type="submit" name="add" class="pull-right btn btn-primary">Add <i class="fa fa-plus"></i></button>
                               
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                         <th>Passenger Name</th>
                                            <th>Start Location</th>
                                            <th>Destination</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>No of persons</th>
                                            <th>Amount</th>
                                          <th>Choose</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
 $rider = htmlspecialchars($_SESSION['user_id']);

$select = mysqli_query($con,"SELECT * FROM rider where rider_id='$rider' and status=1 and start_date=curdate() order by id desc ");
$fetch = mysqli_fetch_array($select);

 $startlocation = $fetch['start_location'];

$selectOne = mysqli_query($con,"SELECT passenger.*,users.first_name,users.last_name FROM `passenger` left join users on users.id=passenger.passenger_id where passenger.StartLocation='$startlocation' and passenger.Date=curdate()");
while($fetchOne = mysqli_fetch_array($selectOne)){
    

   $chooser =  explode(",",$fetch['choose_commuter']);
    $array = array();

    foreach($chooser as $key) {    
        $array[] = $key; 
    }

?>


<tr>
    <td><?= $fetchOne['first_name'] ?>d <?= $fetchOne['last_name'] ?></td>
    <td><?= $fetchOne['StartLocation'] ?></td>
    <td><?= $fetchOne['Destination'] ?></td>
    <td><?= $fetchOne['Date'] ?></td>
    <td><?= $fetchOne['Time'] ?></td>
    <td><?= $fetchOne['No_of_persons'] ?></td>
    <td><?= $fetchOne['Amount'] ?></td>
    <?php
    if(in_array($fetchOne['Id'], $array)){?>
    
    <td><label for="choose<?= $fetchOne['Id'] ?>"><input type="checkbox" checked name='choose[]' value='<?= $fetchOne['Id'] ?>'  id="choose<?= $fetchOne['Id'] ?>">Choose</label></td>
<?php } else{?>
    <td><label for="choose<?= $fetchOne['Id'] ?>"><input type="checkbox" name='choose[]' value='<?= $fetchOne['Id'] ?>'  id="choose<?= $fetchOne['Id'] ?>">Choose</label></td>

    <?php } ?>
    <td><a href="messages.php?p_id=<?= $fetchOne['passenger_id'] ?>" class="btn btn-success">Contact</a></td>

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
