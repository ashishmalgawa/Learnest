[
<?php
session_start();
require('../../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result1=mysql_query("SELECT name,iddegrees FROM degrees ");
$c=1;
while($row1=mysql_fetch_array($result1)){
    
    print '{"bname":"'.$row1['name'].'","bid":"'.$row1['iddegrees'].'"}';
    if($c!=mysql_num_rows($result1)){
        print ",";
    }
    else{
        print "";       
    }
    $c++;
}

?>
]