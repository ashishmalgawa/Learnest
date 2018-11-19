{
<?php
session_start();
require('../../login-register/database-credentials.php');
$subscriber=$_SESSION['username'];
$subscribedto=$_POST['subscribedto'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("DELETE FROM `subscribed` WHERE `subscribed`.`subscriber` = '$subscriber' AND `subscribed`.`subscribedTo` = '$subscribedto'");
if($result)
    print '"success":"true"';
else
    print '"success":"true"';
?>
}