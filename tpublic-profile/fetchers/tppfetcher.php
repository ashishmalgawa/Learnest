
<?php
session_start();
require('../../login-register/database-credentials.php');
$email=$_POST['email'];
if($email==='refresh'){
    $email=$_SESSION['publicemail'];
}
else{
    $_SESSION['publicemail']=$email;
}
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select * from teachers where email='$email'");
while($row=mysql_fetch_array($result)){

    print '{"name":"'.$row['name'].'","gender":"'.$row['gender'].'","dob":"'.$row['dob'].'","contact":"'.$row['contact'].'","username":"'.$row['idteacher'].'",';
    
}
 print '"email":"'.$email.'"}';
?>
