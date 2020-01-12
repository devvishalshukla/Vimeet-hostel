<?php  
$conn = new mysqli('localhost', 'root', '');  
mysqli_select_db($conn, 'slms');  
$sql = "SELECT tblleaves.id as lid,tblstudents.FirstName,tblstudents.LastName,tblleaves.FromDate,tblleaves.ToDate,tblleaves.ReportingDate,tblleaves.BusFacility,tblleaves.Description,tblleaves.PostingDate from tblleaves join tblstudents on tblleaves.empid=tblstudents.id where date(tblleaves.regDate)=CURDATE() order by tblleaves.FromDate desc";  
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