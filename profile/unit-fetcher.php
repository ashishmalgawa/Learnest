[
<?php
session_start();
require('../login-register/database-credentials.php');
$email=$_SESSION['email'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT `unit name`,unitid FROM units WHERE unitid IN (SELECT unitid FROM unit_subject WHERE idsubjects=(SELECT idsubjects FROM subjects WHERE sname="Server Side Programming"))");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"unitName":"'.$row['unit name'].'","unitId":"'.$row['unitid'].'"}';
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