[
<?php
session_start();
require('../login-register/database-credentials.php');
$user=$_POST['username'];
//$collegeid='1188';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT u.name as userName,u.email as email,d.name as branchName,u.rep as reputation from users u,degrees d WHERE u.idusers IN (SELECT subscribedTo FROM subscribed WHERE subscribedTo IN (SELECT idusers FROM users) and subscriber='$user') and u.iddegrees=d.iddegrees limit 7");
$c=1;
//print "Helllo";
while($row=mysql_fetch_array($result)){

    print '{"userName":"'.$row['userName'].'","branchName":"'.$row['branchName'].'","rep":"'.$row['reputation'].'","email":"'.$row['email'].'"}';
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
