<?php  
$conn = new mysqli('localhost', 'root', '');  
mysqli_select_db($conn, 'slms');  
$sql = "SELECT tblleaves.id ,tblstudents.FirstName,tblstudents.LastName,tblleaves.FromDate,tblleaves.ToDate,tblleaves.ReportingDate,tblleaves.BusFacility,tblleaves.Description,tblleaves.PostingDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id order by tblleaves.PostingDate desc";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t". "From Date" . "\t" . " To Date" . "\t" ." Reporting Date" . " \t" . 			"Bus Facility" . "\t" . "Description" . "\t" . "Posting Date" ;  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?> 
<<?php 
 /*
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'slms');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$filename = "studentInfo.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$query=mysqli_query($con,'SELECT tblleaves.id ,tblstudents.FirstName,tblstudents.LastName,tblleaves.FromDate,tblleaves.ToDate,tblleaves.ReportingDate,tblleaves.BusFacility,tblleaves.Description,tblleaves.PostingDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id order by tblleaves.PostingDate desc');
$flag = false;
while ($row = mysqli_fetch_array($query)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}*/
 ?>