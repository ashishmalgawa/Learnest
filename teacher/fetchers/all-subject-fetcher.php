[
<?php
session_start();
require('../../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select * from subjects");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"sid":"'.$row[0].'","sname":"'.$row[1].'","classid":"'.$row[2].'"}';
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