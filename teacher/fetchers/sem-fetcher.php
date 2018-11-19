[
<?php
session_start();
require('../../login-register/database-credentials.php');
$branch=$_POST['branch'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result1=mysql_query("SELECT classid,name FROM class WHERE classid IN (SELECT classid FROM class_degree WHERE degreeid='$branch')");
$c=1;
while($row1=mysql_fetch_array($result1)){
    
    print '{"cname":"'.$row1['name'].'","classid":"'.$row1['classid'].'"}';
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