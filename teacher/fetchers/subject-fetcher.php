[
<?php
session_start();
require('../../login-register/database-credentials.php');
$uname=$_SESSION['username'];
$sem=$_POST['sem'];
//$uname="vivekkapoor";
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result1=mysql_query("SELECT t.idsubjects AS idsubjects FROM ((SELECT idsubjects FROM subjects WHERE classid='$sem')
UNION ALL
(SELECT fk_idsubjects as idsubjects FROM teacher_subject WHERE fk_idteachers='$uname'))
AS t GROUP BY idsubjects HAVING COUNT(*)>=2");
$c=1;
while($row=mysql_fetch_array($result1)){
    $result2=mysql_query("SELECT sname FROM subjects WHERE idsubjects='".$row['idsubjects']."'");
    $row1=mysql_fetch_array($result2);
    print '{"subjectid":"'.$row['idsubjects'].'","subName":"'.$row1['sname'].'"}';
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