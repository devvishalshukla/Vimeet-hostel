<?php
         
        include('includes/config.php');
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = ($_GET['email']); // Set email variable
    $hash = ($_GET['hash']); // Set hash variable
    echo($email);
    echo($hash);            
    $search = "SELECT EmailId, activation_code FROM tblstudents WHERE EmailId=:email AND activation_code=:hash"; 
    //$match  = $conn->query($search);
     $query= $dbh -> prepare($search);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':hash', $hash, PDO::PARAM_STR);  
$query->execute();                
    if($query->rowCount() >0){
         
echo '<script type="text/javascript">'; 
echo 'alert("User verified!!");'; 
echo 'window.location.href = "apply-leave.php";';
echo '</script>';
      
}else{

        
    echo '<script type="text/javascript">'; 
echo 'alert("either link is invalid or something went wrong");'; 

echo '</script>';
}
       }
            
        ?>