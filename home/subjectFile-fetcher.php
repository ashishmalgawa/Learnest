[
<?php
$subjectid=$_POST['subid'];
//$subjectid="cc01";
require('../login-register/database-credentials.php');
//$degree=$_SESSION['branch'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$result=mysql_query("select dname,title,timestamp,authorid,description,file_type from documents where subjectid='$subjectid'");
$c=1;
while($row=mysql_fetch_array($result)){
    if($c%2===1)
    print '[';
    
    $ext=pathinfo($row["dname"], PATHINFO_EXTENSION);
    print '{"fileName":"'.$row['title'].'","timestamp":"'.$row['timestamp'].'","author":"'.$row['authorid'].'","descrip":"'.$row['description'].'","file_type":"'.$row['file_type'].'","dname":"'.$row['dname'].'","ext":"'.$ext.'"}';
    if($c!==mysql_num_rows($result)&&$c%2===0){
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