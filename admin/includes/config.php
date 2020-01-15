<?php 
// DB credentials.
define('DB_HOST','sql310.epizy.com');
define('DB_USER','epiz_25061212');
define('DB_PASS','vihostel');
define('DB_NAME','epiz_25061212_slms');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>