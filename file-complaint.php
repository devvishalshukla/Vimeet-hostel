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
$Complaint=$_POST['Complaint'];
$description=$_POST['description'];
    
    $sql = "SELECT RoomNo from tblstudents where empid=:eid ";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $RoomNo= $result->RoomNo;
}

echo($id);
$sql1="INSERT INTO tblcomplaint(EmpId, RoomNo, Complaint, Description) VALUES(:eid,:RoomNo,:Complaint,:description)";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':EmpId',$newfromdate,PDO::PARAM_STR);
$query1->bindParam(':RoomNo',$newtodate,PDO::PARAM_STR);
$query1->bindParam(':Complaint',$repodate,PDO::PARAM_STR);      
$query1->bindParam(':description',$description,PDO::PARAM_STR);
$query1->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Complaint applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Register Complaint</title>
        
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
                        <div class="page-title">Register Complaint/ Maintainance</div>
                    </div>
                    <div class="col s12 m12 l8">
                    <div class="card">
                            <div class="card-content">
                    
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h4>Register Complaint/ Maintainance</h4>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
       
</div>
<div class="form-control col m6 s12">
<label for="Complaint">Nature of Complaint </label>
<select name="Complaint" required="">
    <option value="">--Select--</option>
    <option value="Civil">Civil Work</option>
    <option value="Electrical">Electrical</option>
    <option value="Plumbing">Plumbing</option>
    <option value="Internet">Internet</option>
    <option value="Other"> Other</option>
    </select>
       
</div>                                                               
<div class="input-field col m12 s12">
<label for="description">Description</label>    

<textarea id="description" name="description" class="materialize-textarea" length="500" required></textarea>
</div>
</div>
      <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn indigo m-b-xs">Register</button>                                             

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