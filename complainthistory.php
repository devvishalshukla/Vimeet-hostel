<?php
session_start();
error_reporting(0);
include('includes/configure.php');
include 'includes/config.php';
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Complaint History</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       <!--  <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> -->
        <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Complaint History</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Complaint History</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>	
                                        <tr>
                                            <th>#</th>
                                            <th>Room No</th>
                                            <th>Compaint Type</th>
                                             <th>Description</th>
                                             <th>Reg Date</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$eid=$_SESSION['eid'];

//code for show UserId number
$query=mysqli_query($con,"select EmpId from tblstudents WHERE id=$eid limit 1");
while($row=mysqli_fetch_array($query))
{
 /*$rmno=$row['RoomNo'];*/
 $empid=$row['EmpId'];
}
/*$RoomNo=$rmno;*/
$EmpId=$empid;
/*
echo '<script> alert("Your EmpID No is  " + "'.$EmpId.'")</script>';
*/
$sql =mysqli_query($con,"SELECT RoomNo, Complaint, Description, regDate from tblcomplaint where EmpId='$eid'");
/*$result = $con->query($sql);*/
$cnt=1;
    while($row = mysqli_fetch_array($sql) ){ ?>
          
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row["RoomNo"]);?></td>
                                            <td><?php echo htmlentities($row["Complaint"]);?></td>
                                            <td><?php echo htmlentities($row["Description"]);?></td>
                                            <td><?php echo htmlentities($row["regDate"]);?></td>
                                        </tr>
                                         <?php $cnt++;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>