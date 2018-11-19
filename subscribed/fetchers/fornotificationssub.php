[
<?php
session_start();
require('../../login-register/database-credentials.php');
$username=$_POST['username'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("Select name AS name,idusers as id from users where idusers in (select subscriber from subscribed where subscribedTo='$username')
UNION 
select teachers.name as name,teachers.idteacher as id from teachers where teachers.idteacher in (select subscriber from subscribed where subscribedTo='$username');");
$c=1;
while($row=mysql_fetch_array($result)){
print '{"name":"'.$row[0].'","username":"'.$row[1].'"}';
    if($c!=mysql_num_rows($result))
        print ",";
    else
        print "";
    $c++;
}
 
?>
]