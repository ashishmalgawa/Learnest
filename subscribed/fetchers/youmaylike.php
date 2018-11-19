[
<?php
session_start();
require('../../login-register/database-credentials.php');
//$user=$_POST['username'];
//$collegeid='1188';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT COUNT(*),u.name as subscribedTo FROM subscribed s,users u WHERE s.subscribedTo=u.idusers GROUP BY s.subscribedTo ORDER BY COUNT(*) DESC LIMIT 6");

 $c=1;
while($row=mysql_fetch_array($result)){

    print '{"count":"'.$row['COUNT(*)'].'","subscribedTo":"'.$row['subscribedTo'].'"}';
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
