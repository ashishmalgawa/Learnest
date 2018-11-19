
<?php
 session_start();
   /*
   A PHP session is easily started by making a call to the session_start() function.This function first checks if a session is already started and if none is started then it starts one.
   */
if( isset( $_SESSION['counter'] ) ) {
      
$email=$_SESSION['email'];
   }
require('login-register/database-credentials.php');
//$email='ashishmalgawa@gmail.com';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select * from users where email='$email'");
while($row=mysql_fetch_array($result)){
    
    print '{"name":"'.$row['name'].'","dob":"'.$row['dob'].'","rep":"'.$row['rep'].'","contact":"'.$row['contact'].'","username":"'.$row['idusers'].'",';
}
    print '"email":"'.$email.'",';

$result=mysql_query("select name from degrees where iddegrees in (select iddegrees from users where email='$email')");
while($row=mysql_fetch_array($result)){
    
    print '"branch":"'.$row[0].'"}';
}


?>
