{
<?php
$classid=$_POST['classid'];
require('../login-register/database-credentials.php');
session_start();
if($classid!=="refresh")
{    $_SESSION['classid']=$classid;
 print '"classid":"notrefresh"';
}else
{$classid=$_SESSION['classid'];
print '"classid":"'.$classid.'"';
}
?>
}