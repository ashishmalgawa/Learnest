[
<?php
session_start();
require('../login-register/database-credentials.php');
$email=$_SESSION['email'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT name,classid FROM class WHERE classid IN (SELECT classid FROM class_degree WHERE degreeid = (SELECT iddegrees FROM users WHERE email='$email'))");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"className":"'.$row['name'].'","classid":"'.$row['classid'].'"}';
    if($c!=mysql_num_rows($result)){
        print ",";
    }
    else{
        print "";       
    }
    $c++;
}
?>
]