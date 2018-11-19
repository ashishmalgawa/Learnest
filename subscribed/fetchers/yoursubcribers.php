[
<?php
session_start();
require('../../login-register/database-credentials.php');
$username=$_POST['username'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select degrees.name as branch,u.name as name,u.rep as rep,u.idusers as idusers,u.gender as gender,u.email as email from users u,subscribed s,degrees where u.idusers=s.subscriber and s.subscribedTo='$username' and u.iddegrees=degrees.iddegrees ORDER BY s.stimestamp;");

$c=1;
while($row=mysql_fetch_array($result)){
    if($c%6===1)
    print '[';
    
    print '{"name":"'.$row['name'].'","username":"'.$row['idusers'].'","branch":"'.$row['branch'].'","rep":"'.$row['rep'].'","email":"'.$row['email'].'","gender":"'.$row['gender'].'"}';
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
 
?>
]