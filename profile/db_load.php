
<?php
//session_start();
require('../login-register/database-credentials.php');
//$email=$_SESSION['email'];
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
$videoType=array("video/x-flv","video/mp4","application/x-mpegURL","video/MP2T","video/3gpp","video/quicktime","video/x-msvideo","video/x-ms-wmv","video/ogg","video/webm","video/mkv");
$bookType=array("application/pdf");
print '{"message":';
//give 777 permission to upload folder
$uname=$_POST['author'];
$title=$_POST['title'];
$desc=$_POST['description'];
$cls=$_POST['cls'];
$sub=$_POST['subject'];
$filetyp=$_POST['fileType'];
$branch=$_POST['branch'];
$ext=pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
if($filetyp=="video"){
    if (!in_array($_FILES['file']['type'],$videoType))
        die('"Please select a valid video file","status":false}');
    else
        print '"some error occurred",';//for the false which on line number 59 and 62
}else if($filetyp=="book"){
    if (!in_array($_FILES['file']['type'],$bookType))
        die('"Book should be in PDF format only","status":false}');
    else
         print '"some error occurred",';//for the false which on line number 59 and 62
}else{
    if (in_array($_FILES['file']['type'],$videoType))
        die('"Please select video in file type section.","status":false}');
    else
         print '"some error occurred",';//for the false which on line number 59 and 62
}
$now=(new DateTime())->format("YmdHis");
$appendedName=$uname.$now.'.'.$ext;
//echo $_POST['dsec'];
$rslt=mysql_query("SELECT  `name` FROM `class` WHERE classid='$cls'");
    while($rs=mysql_fetch_array($rslt)){
        $classname=$rs[0];
    
}
$path='../uploadedFile/'.$branch.'/'.$classname.'/'.$sub;
//Check if the directory already exists.
if(!is_dir($path)){
    //Directory does not exist, so lets create it.
    if (!mkdir($path, 0777, true)) {
        die('Failed to create folders...');
    }
}

$path=$path.'/'.$appendedName;
//to find subjectid
$result=mysql_query("SELECT idsubjects FROM subjects WHERE classid = '$cls' and sname='$sub'");
$row=mysql_fetch_array($result);
print '"status":';
if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
    $insertQuery="INSERT INTO documents (title,dname, authorid, description, subjectid, file_type) VALUES ('$title','$appendedName','$uname','$desc','".$row['idsubjects']."','$filetyp')";
    if(mysql_query($insertQuery)){
        print 'true}';

    }else{
        print 'false}';
    }
}else{
    print 'false}';
}
?>
