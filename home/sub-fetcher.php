[
<?php
$classid=$_POST['semester'];
//$classid="CS1";
require('../login-register/database-credentials.php');
//$degree=$_SESSION['branch'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select sname,idsubjects from subjects where classid='$classid'");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"subjectName":"'.$row['sname'].'","subjectId":"'.$row['idsubjects'].'"}';
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