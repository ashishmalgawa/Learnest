[
<?php
session_start();
require('../../login-register/database-credentials.php');
//$email=$_SESSION['email'];
$userId=$_POST['username'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result1=mysql_query("select degrees.name,degrees.iddegrees  FROM degrees where degrees.iddegrees in (select class_degree.degreeid from class_degree where class_degree.classid in (select subjects.classid from subjects where subjects.idsubjects in (select teacher_subject.fk_idsubjects from teacher_subject where teacher_subject.fk_idteachers='$userId')))");
$c=1;
while($row1=mysql_fetch_array($result1)){
    
    print '{"bname":"'.$row1[0].'","bid":"'.$row1[1].'"}';
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