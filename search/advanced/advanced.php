[
<?php
require('../../login-register/database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$sitem=$_POST['sitem'];
//$sitem='files';
if($sitem=='students')
{
    $values=array($_POST['name'],$_POST['email'],$_POST['username'],$_POST['contact'],$_POST['degree']);
  
$conditions=array(" name like '%$values[0]%'"," email like '%$values[1]%'"," idusers like '%$values[2]%'"," contact like '%$values[3]%'"," iddegrees = '$values[4]'");
    $changed=false;
    function queryGenerator($c=0){
        global $values;
        global $changed;
        global $conditions;
        $select="select email,name,rep,gender,idusers,dob,contact from users ";
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
}else if($sitem==="teachers"){
    
       $values=array($_POST['name'],$_POST['email'],$_POST['username'],$_POST['contact'],$_POST['subject'],$_POST['degree']);
//       $values=array("","","","","a","");
  
$conditions=array(" teachers.name like '%$values[0]%'"," teachers.email like '%$values[1]%'"," teachers.idteacher like '%$values[2]%'"," teachers.contact like '%$values[3]%' "," teachers.idteacher in (select teacher_subject.fk_idteachers from teacher_subject where teacher_subject.fk_idsubjects in (SELECT subjects.idsubjects from subjects where subjects.sname like '%$values[4]%') and teacher_subject.fk_idteachers=teachers.idteacher)"," teachers.idteacher in (select teacher_subject.fk_idteachers from teacher_subject where teacher_subject.fk_idsubjects in (select subjects.idsubjects from subjects where subjects.classid in (select class_degree.classid from class_degree where class_degree.degreeid=$values[5])))");
    $changed=false;
    function queryGenerator($c=0){
        global $values;
        global $changed;
        global $conditions;
        $select="select teachers.name,teachers.email,teachers.idteacher,teachers.gender,teachers.contact from teachers ";
        if($c < 6 && $values[$c]!==""){
            if($changed)
                return "&&".$conditions[$c].queryGenerator($c+1);
            else{
                $changed=true;
                return $select." where".$conditions[$c].queryGenerator($c+1);
            }
        }else{
            if($c===6)
                return "";
            else
                return queryGenerator($c+1);
        }
    }
   
$chutiyapa= queryGenerator();
$result=mysql_query($chutiyapa);
   
    $a=1;
    while($row=mysql_fetch_array($result)){
        
        print '{"name":"'.$row[0].'","email":"'.$row[1].'","username":"'.$row[2].'","gender":"'.$row[3].'","contact":"'.$row[4].'",';
            $subjects=mysql_query('SELECT sname FROM subjects where idsubjects in (select fk_idsubjects from teacher_subject where fk_idteachers="'.$row[2].'")');
            print '"subjects":[';
            $c=1;
            while($r=mysql_fetch_array($subjects)){
                
          print '{"subject":"'.$r[0].'"}';
         if($c!=mysql_num_rows($subjects)){
                print ",";
            }
            else{
                print "";
                $c++;
        }
        $c++;
            }
            print ']}';
         if($a!=mysql_num_rows($result)){
                print ",";
            }
            else{
                print "";
        }
        $a++;   
        }
    
 
}else{
       $values=array($_POST['title'],$_POST['des'],$_POST['upname'],$_POST['filetype'],$_POST['branch'],$_POST['subject']);
//         $values=array("","","","","0","a");
$conditions=array(" title like '%$values[0]%'"," description like '%$values[1]%'"," authorid in (select users.idusers from users where users.name like '%$values[2]%') "," d.file_type='$values[3]'"," s.classid in (select class_degree.classid from class_degree WHERE class_degree.degreeid=$values[4])"," s.sname like '%$values[5]%'");
    $changed=false;
    function queryGenerator($c=0){
        global $values;
        global $changed;
        global $conditions;
        $select="SELECT d.`title`,d.`timestamp`,d.`dname`,d.`numdownloads`,d.`description`,s.sname,d.`file_type`,d.subjectid FROM `documents` as d,subjects as s WHERE d.subjectid=s.idsubjects ";
        if($c < 6 && $values[$c]!==""){
            if($changed)
            {return " && ".$conditions[$c].queryGenerator($c+1);
            
            }else{
                $changed=true;
                return $select." && ".$conditions[$c].queryGenerator($c+1);
            }
        }else{
            if($c===6)
                return "";
            else
                return queryGenerator($c+1);
        }
    }
   $temp= queryGenerator();
$result=mysql_query($temp);
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"title":"'.$row['title'].'","timestamp":"'.$row['timestamp'].'","document_name":"'.$row['dname'].'","numdownloads":"'.$row['numdownloads'].'","description":"'.$row['description'].'","subject":"'.$row[5].'","file_type":"'.$row['file_type'].'","subjectid":"'.$row['subjectid'].'"}';
    
    
    if($c!=mysql_num_rows($result)){
        print ",";
    }
    else{
        print "";       
    }
    $c++;
}
    
    
}
?>
]