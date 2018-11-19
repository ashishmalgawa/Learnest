{
<?php
require('database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");

$email=$_POST['email'];
//$email="ashishmalgawa@gmail.com";
$result = mysql_query("select email from users where email='$email'");
if(mysql_num_rows($result)===1){
    print '"status":true';
}
else{
    $tresult = mysql_query("select email from teachers where email='$email'");
    if(mysql_num_rows($tresult)===1){
        print '"status":true';
    }
    else
        print '"status":false';

}

?>
}