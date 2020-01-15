<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=intval($_GET['cid']);
}
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Complaint Details</title>
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
      <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
 </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Complaint Details</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>Complaint Details</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <div class="row">
<?php 
$cid=$_GET['cid'];
/*$sql = "SELECT * from  tblcomplaint";*/
$sql = "SELECT * FROM tblcomplaint WHERE id=:cid limit 1";
$query = $dbh->prepare($sql);
$query -> bindParam(':cid',$cid, PDO::PARAM_INT);
$query -> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{           
    $empid=$result->EmpId;

    $sql = "SELECT EmpId,FirstName,LastName FROM tblstudents WHERE id=:empid limit 1";
$query = $dbh->prepare($sql);
$query -> bindParam(':empid',$empid, PDO::PARAM_INT);
$query -> execute();
$rows=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($rows as $row)
{
    ?> 
<div class="input-field col  m6">
<label for="empcode">Student Code</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($row->EmpId);?>" type="text" autocomplete="off"  readonly>
</div> 

<div class="input-field col  m6">
<label for="empcode">Student Name</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($row->FirstName." ".$row->LastName);?>" type="text" autocomplete="off"  readonly>
</div> 

<?php } }?>



<div class="input-field col m6 s12">
<label for="roomno">Room No</label>
<input id="roomno" name="roomno" value="<?php echo htmlentities($result->RoomNo);?>"  type="text" readonly>
</div>

<div class="input-field col m6 s12">
<label for="complaint">Complaint </label>
<input id="complaint" name="complaint" value="<?php echo htmlentities($result->Complaint);?>" type="text" autocomplete="off" readonly>
</div>

<div class="input-field col s12">
<label for="description">Description</label>
<textarea id="description" name="description" class="materialize-textarea" length="500" readonly><?php echo htmlentities($result->Description);?></textarea>
</div>

<div class="input-field col s12">
<label for="regDate">Reporting Date</label>
<input id="regDate" name="regDate" type="tel" value="<?php echo htmlentities($result->regDate);?>" maxlength="10" autocomplete="off" readonly>
 </div>

</div>
</div>

<?php }}?>

                                                    
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
    </body>
</html>