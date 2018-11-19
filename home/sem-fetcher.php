
<?php
session_start();
require('../login-register/database-credentials.php');
$degree=$_POST['branch'];

//$degree="Computer Science";

mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select classid from class_degree where degreeid=(select iddegrees from degrees where name='$degree')");
print "{";
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '"id'.$c.'":"'.$row['classid'].'"';
    if($c!=mysql_num_rows($result)){
        print ",";
    }
    else{
        print "";       
    }
    $c++;
}
print "}";

?>
