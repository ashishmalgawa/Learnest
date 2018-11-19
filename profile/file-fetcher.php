<?php
session_start();
require('../login-register/database-credentials.php');
$user=$_SESSION['username'];
$timestamp=$_POST['timestamp'];
$subjectid=$_POST['subjectid'];
$dname=$_POST['dname'];
$authorid=$_POST['uname'];
//$class="IT 2nd sem";
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
if($authorid!=$user){
    mysql_query("UPDATE documents SET numdownloads= numdownloads+1 WHERE dname='$dname'");
    mysql_query("UPDATE users SET rep=rep+1 WHERE idusers='$authorid'");
}
$result=mysql_query("SELECT sname,classid FROM `subjects` where idsubjects='$subjectid'");
$row=mysql_fetch_array($result);
$result1=mysql_query("SELECT name FROM `class` where classid='".$row['classid']."'");
$row1=mysql_fetch_array($result1);
$result2=mysql_query("SELECT name FROM `degrees` WHERE iddegrees=(SELECT degreeid FROM `class_degree` WHERE classid='".$row['classid']."')");
$row2=mysql_fetch_array($result2);
$url=urlencode('http://localhost/Learnest/uploadedFile/'.$row2['name'].'/'.$row1['name'].'/'.$row['sname'].'/'.$dname);
$url=urldecode($url);
//header('Location:http://localhost/Learnest/uploadedFile/'.$row2['name'].'/'.$row1['name'].'/'.$row['sname'].'/'.$dname);
print '{"location":"'.$url.'"}';
?>



