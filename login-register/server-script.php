{
<?php
$page=$_POST['page'];
//$page='login';

require('database-credentials.php');
mysql_connect('localhost',$dbusername,$dbpassword) or die("no connection");
mysql_select_db($dbname) or die("no database");
if($page==="register"){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $username=$_POST['username'];
    $contact=$_POST['contact'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $college=$_POST['collegeid'];    
    $degree=$_POST['degree'];
    $result = mysql_query("select email from users where email='$email'");
    $usernameresult = mysql_query("select idusers from users where idusers='$username'");
    $contactresult = mysql_query("select contact from users where contact='$contact'");
    if(mysql_num_rows($result)>0){
        print '"message":"Email already exists",';
        print '"status":false';
    }
    else if(mysql_num_rows($usernameresult)>0){
        print '"message":"Username already exists",';
        print '"status":false';
    }

    else if(mysql_num_rows($contactresult)>0){
        print '"message":"Mobile number already registered",';
        print '"status":false';
    }
    else{

        $results = mysql_query("select email from teachers where email='$email'");
        if(mysql_num_rows($results))
        {
            print '"message":"You have already registered as a teacher",';
            print '"status":false';
        }else{
            $r = mysql_query("select email from teachers where idteacher='$username'");
            if(mysql_num_rows($r))
            {
                print '"message":"This username is already acquired by a teacher",';
                print '"status":false';
            }else{
                $d=mysql_query("INSERT INTO `users` (`idusers`, `email`, `dob`, `iddegrees`, `contact`, `gender`, `name`, `rep`) VALUES ('$username','$email','$dob',$degree,'$contact','$gender','$name',0)");
                print '"message":"registeration succesful",';
                print '"status":true';   
            }
        }
    }

}//register
else{//means login
    $email=$_POST['email'];
    //            $email="ashishmalgawa@gmail.com";

    $result = mysql_query("select email from teachers where email='$email'");
    if(mysql_num_rows($result)>0){
        print '"message":"login succesful",';
        print '"status":true,';
        print '"person":"teacher"';

        // Start the session
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION['person']= "teacher";
    }   
    else{
        $results = mysql_query("select email from users where email='$email'");
        if(mysql_num_rows($results)>0){
            print '"message":"login succesful",';
            print '"status":true,';
            print '"person":"student"';

            // Start the session
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION['person']= "student";
        }  
        else{
            print '"message":"Invalid Email id and password combination",';
            print '"status":false';
        }
    }
}//login end

?>
}