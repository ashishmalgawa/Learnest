
<?php
//session_start();
require('../../login-register/database-credentials.php');
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
$fsem=$_POST['fsem'];
$sub=$_POST['fsubject'];
$filetyp=$_POST['fileType'];
$branch=$_POST['fbranch'];
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

$result1=mysql_query("SELECT name FROM degrees where iddegrees='$branch'");
$row1=mysql_fetch_array($result1);
$branch=$row1['name'];

$result2=mysql_query("SELECT name FROM class where classid='$fsem'");
$row2=mysql_fetch_array($result2);
$fsem=$row2['name'];
//echo $fsem;

$result3=mysql_query("SELECT sname FROM subjects where idsubjects='$sub'");
$row3=mysql_fetch_array($result3);
$subName=$row3['sname'];
//echo subName;

$now=(new DateTime())->format("YmdHis");
$appendedName=$uname.$now.'.'.$ext;
//echo $_POST['dsec'];
$path='../../uploadedFile/'.$branch.'/'.$fsem.'/'.$subName;
//echo $path;
//Check if the directory already exists.
if(!is_dir($path)){
    //Directory does not exist, so lets create it.
    if (!mkdir($path, 0777, true)) {
        die('Failed to create folders...');
    }
}

$path=$path.'/'.$appendedName;
//echo $path;
//to find subjectid
//$result=mysql_query("SELECT idsubjects FROM subjects WHERE classid = (SELECT classid FROM class WHERE name='$fsem') and sname='$sub'");
//$row=mysql_fetch_array($result);
print '"status":';
if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
    $insertQuery="INSERT INTO documents (title,dname, authorid, description, subjectid, file_type) VALUES ('$title','$appendedName','$uname','$desc','$sub','$filetyp')";
    if(mysql_query($insertQuery)){
        print 'true}';

    }else{
        print 'false}';
    }
}else{
    print 'false}';
}
?>
