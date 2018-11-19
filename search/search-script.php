[
<?php
 
require('../login-register/database-credentials.php');
//$email='ashishmalgawa@gmail.com';
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$searchtext=$_POST['searchtext'];
$searchitem=$_POST['searchitem'];
$searchtimes=$_POST['searchtimes'];
//$searchitem='students';
//$searchtext='up';
    if($searchitem==='students'){
        $result=mysql_query("select email,name,rep,gender,idusers from users where name like '%$searchtext%' order by rep desc");
        $c=1;
        while($row=mysql_fetch_array($result)){

          print '{"email":"'.$row[0].'","name":"'.$row[1].'","rep":"'.$row[2].'","gender":"'.$row[3].'","username":"'.$row[4].'"}';
         if($c!=mysql_num_rows($result)){
                print ",";
            }
            else{
                print "";
        }
        $c++;
        }
    }
    else if($searchitem==='teachers'){
        $a=1;
        $result=mysql_query("select t.name,t.email,t.idteacher,t.gender,t.contact from teachers as t where name like '%$searchtext%' limit 70");
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
    }else if($searchitem==='classes'){
           $result=mysql_query("SELECT class.classid, class.name FROM `class` WHERE class.name like '%$searchtext%' or class.classid like '%$searchtext%'");
$c=1;
while($row=mysql_fetch_array($result)){
    
    print '{"classid":"'.$row[0].'","classname":"'.$row[1].'"}';
    
    
    if($c!=mysql_num_rows($result)){
        print ",";
    }
    else{
        print "";       
    }
    $c++;
}
       
    }
    else {
        
        $result=mysql_query("SELECT d.`title`,d.`timestamp`,d.`dname`,d.`numdownloads`,d.`description`,s.sname,d.`file_type`,d.subjectid FROM `documents` as d,subjects as s WHERE  title like '%$searchtext%' and d.subjectid=s.idsubjects  ORDER BY `timestamp` DESC");
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