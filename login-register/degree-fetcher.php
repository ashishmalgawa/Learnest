[
<?php

require('database-credentials.php');

//$collegeid='1188';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select iddegrees,name from degrees");
$c=0;
while($row=mysql_fetch_array($result)){
    
    print '{"name":"'.$row['name'].'","iddegrees":"'.$row['iddegrees'].'"}';
    if($c!=sizeof($row)){
        print ",";
    }
    else{
        print "";
        
    }
    $c++;
}
?>
]