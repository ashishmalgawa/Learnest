
<?php
session_start();
require('../login-register/database-credentials.php');
$email=$_SESSION['email'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select * from users where email='$email'");
while($row=mysql_fetch_array($result)){

    print '{"name":"'.$row['name'].'","gender":"'.$row['gender'].'","dob":"'.$row['dob'].'","rep":"'.$row['rep'].'","contact":"'.$row['contact'].'","username":"'.$row['idusers'].'",';
$_SESSION['username']=$row['idusers'];
}
 print '"email":"'.$email.'",';
$result=mysql_query("select name,iddegrees from degrees where iddegrees in (select iddegrees from users where email='$email')");
while($row=mysql_fetch_array($result)){

    print '"branch":"'.$row[0].'","iddegrees":"'.$row[1].'"}';
}
?>
