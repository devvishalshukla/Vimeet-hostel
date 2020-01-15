<?php
define('DB_HOST','sql310.epizy.com');
define('DB_USER','epiz_25061212');
define('DB_PASS','vihostel');
define('DB_NAME','epiz_25061212_slms');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>