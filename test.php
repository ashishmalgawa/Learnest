[
<?php
require('login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
//$stype=$_POST['stype'];
$stype='student';
if($stype==='student')
{

    //$name=$_POST['name'];
    //$email=$_POST['email'];
    //$username=$_POST['username'];
    //$contact=$_POST['contact'];
    //$branch=$_POST['branch'];
    $name="";
    $email="a";
    $username="a";
    $contact="";
    $branch=0;
    $values=array($name,$email,$username,$contact,$branch);
    $c=0;
$conditions=array(" name like '%$values[0]%'"," email like '%$values[1]%'"," idusers like '%$values[2]%'"," contact like '%$values[3]%'"," iddegrees = '$values[4]'");
    $changed=false;
    function queryGenerator($c=0){
        global $values;
        global $changed;
        global $conditions;
        $select="select email,name,rep,gender,idusers,dob,contact from users ";
//        $select1="select email from users ";
//        $connector=" and email in (";
        if($c < 5 && $values[$c]!==""){
            if($changed)
                return "&&".$conditions[$c].queryGenerator($c+1);
            else{
                $changed=true;
                return $select." where".$conditions[$c].queryGenerator($c+1);
            }
        }else{
            if($c===5)
                return "";
            else
                return queryGenerator($c+1);
        }
    }
   
}

$result=mysql_query(queryGenerator());
$count=1;
while($row=mysql_fetch_array($result)){

    print '{"name":"'.$row['name'].'","gender":"'.$row['gender'].'","dob":"'.$row['dob'].'","rep":"'.$row['rep'].'","contact":"'.$row['contact'].'","username":"'.$row['idusers'].'",';
 print '"email":"'.$row['email'].'",';
    $email=$row['email'];
$res=mysql_query("select name from degrees where iddegrees in (select iddegrees from users where email='$email')");
while($r=mysql_fetch_array($res)){

    print '"branch":"'.$r[0].'"}';
}
    if($count!=mysql_num_rows($result))
        print ",";
    else
        print "";
    $count++;
}

?>
]