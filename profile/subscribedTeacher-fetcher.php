[
<?php
session_start();
require('../login-register/database-credentials.php');
$user=$_POST['username'];
//$collegeid='1188';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT name,idteacher,email from teachers WHERE idteacher IN (SELECT subscribedTo FROM subscribed WHERE subscribedTo IN (SELECT idteacher FROM teachers) and subscriber='$user') limit 6");
$c=1;
while($row=mysql_fetch_array($result)){

    print '{"teacherName":"'.$row['name'].'","teacherId":"'.$row['idteacher'].'","email":"'.$row['email'].'"}';
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
