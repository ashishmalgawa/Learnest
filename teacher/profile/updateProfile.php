
<?php
session_start();
require('../../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$name=$_POST['name'];
$username=$_SESSION['username'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
mysql_query("UPDATE teachers SET name='$name',gender='$gender',contact='$contact',dob='$dob' WHERE idteacher='$username'");  

mysql_query("DELETE from teacher_subject WHERE teacher_subject.fk_idteachers='$username'");
mysql_query("DELETE FROM `subscribed` WHERE subscribed.subscriber='$username'");
for($i=1;isset($_POST["subject".$i]);$i++)
    { 
      mysql_query("INSERT INTO `teacher_subject`(`fk_idteachers`, `fk_idsubjects`) VALUES ('$username','".$_POST["subject".$i]."')");
    $result=mysql_query("select subjects.classid from subjects where subjects.idsubjects='".$_POST["subject".$i]."'");
    while($row=mysql_fetch_array($result))  
    mysql_query("INSERT INTO `subscribed`(`subscriber`, `subscribedTo`,`subscribedTo_type`) VALUES('$username','".$row[0]."','class')");
}
?>
