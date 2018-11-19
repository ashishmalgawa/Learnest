
<?php
session_start();
require('../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$name=$_POST['name'];
$username=$_SESSION['username'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$branch=$_POST['branch'];
$row=mysql_fetch_array($result);
mysql_query("UPDATE users SET name='$name',gender='$gender',contact='$contact',dob='$dob',iddegrees='$branch' WHERE idusers='$username'");  
print '{"message":"Profile Update Successful"}';
?>
