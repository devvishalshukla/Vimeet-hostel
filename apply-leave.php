<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
$fromtime=$_POST['fromtime'];    
$totime=$_POST['totime'];   
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];  
$repodate=$_POST['repodate'];    
$description=$_POST['description'];  
$busfacility=$_POST['bus'];  
$newfromdate=$fromdate."(".$fromtime.")";
$newtodate=$todate."(".$totime.")";
$date_today= date('d/m/Y');
    
   if($repodate < $todate || $repodate<$fromdate){
    $error=" Please enter valid reporting date!";
}
   else if($fromdate < $date_today){
    $error=" FromDate has passed!Enter valid date";
}
else if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
else{    
    $sql = "SELECT ToDate,FromDate from tblleaves where empid=:eid AND ToDate=:todate AND FromDate=:fromdate";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$empid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$newfromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$newtodate,PDO::PARAM_STR);    
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{$error="You have already applied for this leave!";}
    else{
$sql1="INSERT INTO tblleaves(FromDate,ToDate,ReportingDate,PostingDate,Description,BusFacility,empid) VALUES(:fromdate,:todate,:repodate,'$date_today',:description,:bus,:empid)";
$query1 = $dbh->prepare($sql1);

$query1->bindParam(':fromdate',$newfromdate,PDO::PARAM_STR);
$query1->bindParam(':todate',$newtodate,PDO::PARAM_STR);
$query1->bindParam(':repodate',$repodate,PDO::PARAM_STR);      
$query1->bindParam(':description',$description,PDO::PARAM_STR);
$query1->bindParam(':bus',$busfacility,PDO::PARAM_STR);
$query1->bindParam(':empid',$empid,PDO::PARAM_STR);
$query1->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Leave applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
}
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Apply Leave</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
	
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">  -->
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
                        <div class="page-title">Apply for Leave</div>
                    </div>
                    <div class="col s12 m12 l8">
					<div class="card">
                            <div class="card-content">
					
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h3>Apply for Leave</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>




<div class="input-field col m6 s12">
<label for="fromdate">From  Date(dd/mm/yyyy)</label>
<input placeholder="" id="" name="fromdate" class="" type="text" required>

</div>
<div class="input-field col m6 s12">
<label for="todate">To Date(dd/mm/yyyy)</label>
<input placeholder="" id="" name="todate" class="" type="text" required>
</div>

<div class="form-control col m6 s12">
<label for="fromtime">From(Time of Day)</label>
<select name="fromtime">
    <option value="morning">Morning</option>
    <option value="evening">Evening</option>
    </select>
       
</div>
<div class="form-control col m6 s12">
<label for="totime">To(Time of Day)</label>
<select name="totime">
    <option value="morning">Morning</option>
    <option value="evening">Evening</option>
    </select>
       
</div>                                                            
<div class="input-field col m6 s12" style="margin-top:20px;">
<label for="repodate">Reporting Date(dd/mm/yyyy)</label>
<input placeholder="" id="" name="repodate" class="" type="text" data-inputmask="'alias': 'date'" required>
</div>    
 
<div class="form-control col m6 s12">
<label for="bus">Leaving by college bus?</label>
<select name="bus">
    <option value="yes">Yes</option>
    <option value="no">No</option>
    </select>
       
</div>                                                               
<div class="input-field col m12 s12">
<label for="birthdate">Description</label>    

<textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
</div>
</div>
      <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn indigo m-b-xs">Apply</button>                                             

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
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
          <script src="assets/js/pages/form-input-mask.js"></script>
                <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
</html>
<?php } ?> 