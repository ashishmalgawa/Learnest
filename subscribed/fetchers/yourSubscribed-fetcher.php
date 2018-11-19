[
<?php
session_start();
require('../../login-register/database-credentials.php');
$userId=$_SESSION['username'];
$type=$_POST['type'];
//$type='student';
//$userId='fatema';

mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
if($type==='teacher'){
    $result=mysql_query("select t.name,t.email,t.gender from teachers as t,subscribed as s where s.subscribedTo=t.idteacher and s.subscribedTo_type='teacher' and s.subscriber='$userId'");
$c=1;
while($row=mysql_fetch_array($result)){
    if($c%6===1)
    print '[';
    
    print '{"gender":"'.$row[2].'","name":"'.$row[0].'","email":"'.$row[1].'"}';
    if($c!==mysql_num_rows($result)&&$c%6===0){
        print "],";
    }
    else if($c===mysql_num_rows($result)){
        print "]";
    }
    else{
        print ",";       
    }

    $c++;

}
    
    
}else if($type==='student'){
    $result=mysql_query("SELECT degrees.name,u.name as subscribedTo,u.gender as gender,u.email as email ,u.idusers as username,u.rep as rep FROM subscribed s,users u,degrees WHERE s.subscriber='$userId' AND u.idusers=s.subscribedTo and s.subscribedTo_type='student' and u.iddegrees=degrees.iddegrees ");
$c=1;
while($row=mysql_fetch_array($result)){
    if($c%6===1)
    print '[';
    
    print '{"gender":"'.$row['gender'].'","name":"'.$row['subscribedTo'].'","email":"'.$row['email'].'","rep":"'.$row['rep'].'","username":"'.$row['username'].'","branch":"'.$row[0].'"}';
    if($c!==mysql_num_rows($result)&&$c%6===0){
        print "],";
    }
    else if($c===mysql_num_rows($result)){
        print "]";
    }
    else{
        print ",";       
    }

    $c++;

}
}else{
        $result=mysql_query("select c.name,c.classid from class as c,subscribed as s where c.classid=s.subscribedTo and s.subscribedTo_type ='class' and s.subscriber='$userId'");
$c=1;
while($row=mysql_fetch_array($result)){
    if($c%6===1)
    print '[';
    
    print '{"name":"'.$row[0].'","classid":"'.$row[1].'"}';
    if($c!==mysql_num_rows($result)&&$c%6===0){
        print "],";
    }
    else if($c===mysql_num_rows($result)){
        print "]";
    }
    else{
        print ",";       
    }

    $c++;

}
    
}

?>
]
