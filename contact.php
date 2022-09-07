<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['role'])){
    echo"<script>window.open('index','_self');</script>";
    
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
                        <li><a>Contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--SEARCHING, ORDENING & PAGING-->
            <div class="row animated fadeInRight">
                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Contact</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">

                                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
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


    $select = mysqli_query($con,"SELECT contact.*,p.Id as pid,p.first_name as p_fname,p.last_name  as p_lname,r.first_name as rider_fname,r.last_name as rider_lname FROM contact left JOIN users as p on p.id=contact.passenger_id left JOIN users as r on r.id=contact.rider_id WHERE contact.date=curdate() and contact.rider_id='$sessionid' order by contact.id desc");




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
