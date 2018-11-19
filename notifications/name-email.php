[
<?php
session_start();
require('../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");

$username=$_POST['username'];
if(isset($_POST['username2'])){
    $username2=$_POST['username2'];
    $result=mysql_query("select name,email from users where idusers='$username' or idusers='$username2'");
    $c=1;

    while($row=mysql_fetch_array($result)){
        print '{"name":"'.$row[0].'","email":"'.$row[1].'"}';
        if($c!=mysql_num_rows($result))
            print ",";
        else 
            print "";
        $c++;
    }
}else{
    $result=mysql_query("select name,email from users where idusers='$username'");
    while($row=mysql_fetch_array($result))
        print '{"name":"'.$row[0].'","email":"'.$row[1].'"}';

}
?>
]
