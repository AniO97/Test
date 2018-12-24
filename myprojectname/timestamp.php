<?php
 session_start();
$days=$_POST['days'];
$Date= date('Y-m-d');
$newDate= date('Y-m-d');



echo "$Date" . "<br>";
for($x = 0 ; $x < days ; $x ++ )
 {
    
    $newDate= date('Y-m-d' , strtotime($newDate. " + 1 days"));
    
 }

 $_SESSION['new_Date']= $newDate;
 echo "$newDate";
 
 
 echo "
        <script>
 
            alert('$newDate');
            window.location.href= 'http://localhost.com/brokernewA/login.php' ;
            
 
        </script>;
 
 ";
 exit();
 header("Location: http://localhost.com/brokernewA/login.php ");
 



?>
