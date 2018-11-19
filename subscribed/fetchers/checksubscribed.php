{
<?php
 session_start();
require('../../login-register/database-credentials.php');
//$email='ashishmalgawa@gmail.com';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$subscribedto=$_POST['subscribedto'];
$type=$_POST['type'];
$username= $_SESSION['username'];
$r=mysql_query("SELECT * FROM `subscribed` WHERE subscribed.subscriber='$username' && subscribedTo='$subscribedto' && subscribedTo_type='$type'");
            if(mysql_num_rows($r)>0)
                print '"status":true }';
            else
                print '"status":false }';

?>