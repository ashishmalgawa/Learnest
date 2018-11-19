[
<?php
session_start();
require('../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$username=$_SESSION['username'];
$result=mysql_query("SELECT d.title AS title,d.timestamp AS timestamp,d.authorid as authorid,IF(d.description='undefined','',d.description) AS description,d.dname AS dname,u.gender AS gender,u.name AS name,u.email as email,d.subjectid AS subjectid,s.sname AS subjectName,c.name AS className,c.classid as classid FROM subjects s,class c,documents d,users u WHERE (d.authorid IN (SELECT subscribedTo FROM subscribed WHERE subscriber='$username' and subscribedTo_type='student') OR s.classid IN (SELECT subscribedTo FROM subscribed WHERE subscribedTo_type='class' AND subscriber='$username')) and s.idsubjects=d.subjectid AND s.classid=c.classid AND d.authorid=u.idusers
UNION ALL
SELECT d.title AS title,d.timestamp AS timestamp,d.authorid as authorid,IF(d.description='undefined','',d.description) AS description,d.dname AS dname,t.gender AS gender,t.name AS name,t.email as email,d.subjectid AS subjectid,s.sname AS subjectName,c.name AS className,c.classid as classid FROM subjects s,class c,documents d,teachers t WHERE (d.authorid IN (SELECT subscribedTo FROM subscribed WHERE subscriber='$username' and subscribedTo_type='teacher')OR s.classid IN (SELECT subscribedTo FROM subscribed WHERE subscribedTo_type='class' AND subscriber='$username')) and s.idsubjects=d.subjectid and s.classid=c.classid AND d.authorid=t.idteacher ORDER BY timestamp DESC LIMIT 150");
$c=1;
while($row=mysql_fetch_array($result)){
    $ext=pathinfo($row["dname"], PATHINFO_EXTENSION);
    print '{"title":"'.$row['title'].'","timestamp":"'.$row['timestamp'].'","authorid":"'.$row['authorid'].'","description":"'.$row['description'].'","dname":"'.$row['dname'].'","gender":"'.$row['gender'].'","name":"'.$row['name'].'","subjectid":"'.$row['subjectid'].'","ext":"'.$ext.'","subjectName":"'.$row['subjectName'].'","className":"'.$row['className'].'","email":"'.$row['email'].'","classid":"'.$row['classid'].'","shw":"true"}';
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
