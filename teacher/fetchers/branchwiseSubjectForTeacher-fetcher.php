[
<?php
session_start();
require('../../login-register/database-credentials.php');
$userId=$_POST['username'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT cd.degreeid AS pbranch,s.idsubjects AS psubjectid,s.sname AS psubject FROM class_degree cd, subjects s WHERE cd.classid=s.classid AND idsubjects IN (SELECT fk_idsubjects FROM teacher_subject WHERE fk_idteachers='$userId')");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"pbranch":"'.$row['pbranch'].'","psubjectid":"'.$row['psubjectid'].'","psubject":"'.$row['psubject'].'"}';
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