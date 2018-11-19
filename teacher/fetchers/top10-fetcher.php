[<?php
//session_start();
require('../../login-register/database-credentials.php');
//$tname="vivekkapoor";
$tname=$_POST['tech_name'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select u.name,d.name,u.rep,u.email from users as u,degrees as d where u.idusers in(select authorid from documents where  subjectid in (select fk_idsubjects from teacher_subject where fk_idteachers='$tname')) and u.iddegrees=d.iddegrees order by u.rep DESC limit 10");

$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"name":"'.$row[0].'","branch":"'.$row[1].'","rep":"'.$row[2].'","email":"'.$row[3].'"}';
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