<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0):
header('location:index.php');

else:
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>SLMS Admin | Dashboard</title>
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
<!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
  a{
    color: white;
  }
</style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
   <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <h4>Leaves </h4>
        <hr>
        <!-- Leaves  -->
        <div class="row">
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="todays-leaves.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 
$sql = "SELECT tblleaves.id as lid,tblstudents.FirstName,tblstudents.LastName,tblstudents.EmpId,tblstudents.id,tblleaves.FromDate,tblleaves.ToDate,tblleaves.ReportingDate,tblleaves.BusFacility,tblleaves.Description,tblleaves.PostingDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id where date(tblleaves.regDate)=CURDATE() order by tblleaves.FromDate desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$todayscount=$query->rowCount();
?>
 <h3 class="info"><?php echo htmlentities($todayscount);?></h3>
                      <h6>Todays Leave's</h6>
                    </div>
                    <div>
         <i class="icon-book-open success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>

     <!-- Last Seven Days Complaints --->
    
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <a href="last-sevendays-leaves.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 

$sql = "SELECT tblleaves.id,tblstudents.id,tblleaves.FromDate,tblleaves.ToDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id where date(tblleaves.regDate)>= DATE(NOW()) - INTERVAL 7 DAY order by tblleaves.FromDate desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$last7dayscount=$query->rowCount() 
  ?>
 <h3 class="warning"><?php echo htmlentities($last7dayscount);?></h3>
                      <h6>Last 7 Days Leave's</h6>
                    </div>
                    <div>
    <i class="icon-book-open success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                 <a href="leaves.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 
$sql = "SELECT tblleaves.id,tblstudents.id,tblleaves.FromDate,tblleaves.ToDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$allcount=$query->rowCount();
?>

<h3 class="success"><?php echo htmlentities($allcount);?></h3>
                      <h6>Total Leaves</h6>
                    </div>
                    <div>
                      <i class="icon-book-open success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
          </div>
          <h4>Complaints</h4>
          <hr>
          <!--Complaints -->
          <div class="row">
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                   <a href="todays-complaints.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 
$sql = "SELECT id from tblcomplaint where date(regDate)=CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$todayscount=$query->rowCount();
?>
 <h3 class="info"><?php echo htmlentities($todayscount);?></h3>
                      <h6>Todays Complaint's</h6>
                    </div>
                    <div>
         <i class="icon-docs success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>

     <!-- Last Seven Days Complaints --->
    
          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <a href="last-sevendays-complaints.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 

$sql = "SELECT tblcomplaint.EmpId,tblstudents.id from tblcomplaint join tblstudents on tblcomplaint.EmpId=tblstudents.id where date(tblcomplaint.regDate)>= DATE(NOW()) - INTERVAL 7 DAY";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$last7dayscount=$query->rowCount() 
  ?>
 <h3 class="warning"><?php echo htmlentities($last7dayscount);?></h3>
                      <h6>Last 7 Days Complaints</h6>
                    </div>
                    <div>
    <i class="icon-docs success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                 <a href="complaints.php">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
<?php 
$sql = "SELECT tblcomplaint.EmpId,tblstudents.id from tblcomplaint join tblstudents on tblcomplaint.EmpId=tblstudents.id";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$allcount=$query->rowCount();
?>

<h3 class="success"><?php echo htmlentities($allcount);?></h3>
                      <h6>Total Complaint's</h6>
                    </div>
                    <div>
                      <i class="icon-docs success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </a>
              </div>
            </div>
          </div>
          </div>



        </div>
        </div></div></div>

  <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        
</body>
</html>
<?php endif;?>