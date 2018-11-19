[
<?php
session_start();
require('../login-register/database-credentials.php');
$class=$_POST['clas'];
//$class="IT 2nd sem";
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT sname,idsubjects FROM subjects WHERE classid = '$class'");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"subjectName":"'.$row['sname'].'","subjectId":"'.$row['idsubjects'].'"}';
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