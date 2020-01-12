<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "delete from tblleaves WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);

$query -> execute();
header('location:leaves.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Total Leave </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
						
                    <div class="col lg4 s12">
                        <div class="page-title">Leave History</div>
						</div>
                    <div class="col lg4 s12">
                         <form action="todays-data.php" method="post">
                <button type="submit" id="btnExport"
                    name='export' value="Export to Excel"
                    class="btn btn-info">Export to Excel</button>
            </form>
						</div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Leave History</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="220">Student Name</th>
                                            
                                             <th >From Date</th>                 
                                            <th >To Date</th> 
                                            <th >Reporting</th> 
                                            <th >BUS Required</th> 
                                            <th>Description</th>
                                            <th align="center">Action</th>
                                           
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT tblleaves.id as lid,tblstudents.FirstName,tblstudents.LastName,tblstudents.EmpId,tblstudents.id,tblleaves.FromDate,tblleaves.ToDate,tblleaves.ReportingDate,tblleaves.BusFacility,tblleaves.Description,tblleaves.PostingDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id where date(tblleaves.regDate)=CURDATE() order by tblleaves.FromDate desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></td>
                                            <td><?php echo htmlentities($result->FromDate);?></td>
                                            <td><?php echo htmlentities($result->ToDate);?></td>
                                            <td><?php echo htmlentities($result->ReportingDate);?></td>
                                            <td><?php echo htmlentities($result->BusFacility);?></td>
                                              <td><?php echo htmlentities($result->Description);?></td>                         

           <td>
<a href="leaves.php?inid=<?php echo htmlentities($result->lid);?>" onclick="return confirm('Are you sure you want to cancel this leave?');" > <i class="material-icons" >clear</i></a>
</td>
                                    </tr>
                                         <?php $cnt++;} }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					
                </div>
				
            </main>
         
        
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>