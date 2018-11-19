[
<?php

require('../login-register/database-credentials.php');

mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select u.name,d.name,u.rep,u.email from users as u,degrees as d where u.iddegrees=d.iddegrees order by u.rep DESC limit 10");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"name":"'.$row[0].'","branch":"'.$row[1].'","rep":"'.$row[2].'","email":"'.$row[3].'"}';
    if($c<mysql_num_rows($result)){
        print ",";
    }
    else{
        print "";
        
    }
    $c++;
    
}


?>
]
