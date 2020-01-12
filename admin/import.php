<?php
if(isset($_POST["submit"]))
{
$host="localhost"; // Host name.
$db_user="root"; //mysql user
$db_password=""; //mysql pass
$db='slms'; // Database name.
//$conn=mysql_connect($host,$db_user,$db_password) or die (mysql_error());
//mysql_select_db($db) or die (mysql_error());
$con=mysqli_connect($host,$db_user,$db_password,$db);
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


echo $filename=$_FILES["file"]["name"];
$ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));

//we check,file must be have csv extention
if($ext=="csv" || $ext=="xls")
{
  $file = fopen($filename, "r");
         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
         {
            $sql = "INSERT INTO tblstudents(EmpId,FirstName,LastName,EmailId,Password,Gender,Address,City,Phonenumber,Status) VALUES(:empid,:fname,:lname,:email,:password,:gender,:address,:city,:mobileno,:status)";
            mysqli_query($con, $sql);
         }
         fclose($file);
         echo "CSV File has been successfully Imported.";
}
else {
    echo "Error: Please Upload only CSV File";
}

header('location:leaves.php');
}
?>