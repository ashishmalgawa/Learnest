{
<?php
session_start();
require('../../login-register/database-credentials.php');
$subscriber=$_SESSION['username'];
$subscribedto=$_POST['subscribedto'];
$type=$_POST['type'];

mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("INSERT INTO `subscribed`(`subscriber`, `subscribedTo`, `subscribedTo_type`) VALUES ('$subscriber','$subscribedto','$type')");
if($result)
    print '"success":"true"';
else
    print '"success":"true"';
?>
}