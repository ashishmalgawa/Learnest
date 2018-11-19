[
<?php
session_start();
require('../../login-register/database-credentials.php');
$user=$_POST['username'];
//$class="IT 2nd sem";
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("SELECT authorid,`title`,`timestamp`,`dname`,`numdownloads`,`description`,`subjectid`,`file_type` FROM `documents` WHERE `authorid`='$user' ORDER BY timestamp DESC");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"title":"'.$row['title'].'","timestamp":"'.$row['timestamp'].'","document_name":"'.$row['dname'].'","numdownloads":"'.$row['numdownloads'].'","description":"'.$row['description'].'","authorid":"'.$row['authorid'].'","subjectid":"'.$row['subjectid'].'","file_type":"'.$row['file_type'].'"}';
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