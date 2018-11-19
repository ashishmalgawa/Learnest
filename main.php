<?php 
session_start();
if(!isset($_SESSION['email'])){

    if (headers_sent()){
        die('<script type="text/javascript">window.location.href="' . "index.php" . '";</script>');
    }else{
        header("Location: index.php"); /* Redirect browser */
        exit();
        die();
    }    

}
else{
    if($_SESSION['person']==='teacher'){
        if (headers_sent()){
            die('<script type="text/javascript">window.location.href="' . "teacherMain.php" . '";</script>');
        }else{
            header("Location: teacherMain.php"); /* Redirect browser */
            exit();
            die();
        }
    }

}

?>
<html ng-app="main">
    <head>
        <title>Learnest</title>
        <!--Css Pages Start-->
        <link rel="manifest" href="manifest.json">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="assets/css/navbar.css">
        <link rel="stylesheet" href="assets/css/newsfeed.css">
        <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        

        <style type="text/css">
/* With a simpler media query declaration like this one:*/

  
            .loginmsg{
                position:fixed;
                top:55px;
                right:35px;
                color:white;
                font-family: 'Pacifico', cursive;
            }
            .lcursive{
                font-family: 'Pacifico', cursive;
                font-size: 25px;
            }
            .vertical-center{
                vertical-align: middle;
            }
            .sk-folding-cube {
                margin: 20px auto;
                width: 40px;
                height: 40px;
                position: relative;
                -webkit-transform: rotateZ(45deg);
                transform: rotateZ(45deg);
            }

            .sk-folding-cube .sk-cube {
                float: left;
                width: 50%;
                height: 50%;
                position: relative;
                -webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);
                transform: scale(1.1); 
            }
            .sk-folding-cube .sk-cube:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #333;
                -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
                animation: sk-foldCubeAngle 2.4s infinite linear both;
                -webkit-transform-origin: 100% 100%;
                -ms-transform-origin: 100% 100%;
                transform-origin: 100% 100%;
            }
            .sk-folding-cube .sk-cube2 {
                -webkit-transform: scale(1.1) rotateZ(90deg);
                transform: scale(1.1) rotateZ(90deg);
            }
            .sk-folding-cube .sk-cube3 {
                -webkit-transform: scale(1.1) rotateZ(180deg);
                transform: scale(1.1) rotateZ(180deg);
            }
            .sk-folding-cube .sk-cube4 {
                -webkit-transform: scale(1.1) rotateZ(270deg);
                transform: scale(1.1) rotateZ(270deg);
            }
            .sk-folding-cube .sk-cube2:before {
                -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s;
            }
            .sk-folding-cube .sk-cube3:before {
                -webkit-animation-delay: 0.6s;
                animation-delay: 0.6s; 
            }
            .sk-folding-cube .sk-cube4:before {
                -webkit-animation-delay: 0.9s;
                animation-delay: 0.9s;
            }
            @-webkit-keyframes sk-foldCubeAngle {
                0%, 10% {
                    -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
                    opacity: 0; 
                } 25%, 75% {
                    -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
                    opacity: 1; 
                } 90%, 100% {
                    -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
                    opacity: 0; 
                } 
            }

            @keyframes sk-foldCubeAngle {
                0%, 10% {
                    -webkit-transform: perspective(140px) rotateX(-180deg);
                    transform: perspective(140px) rotateX(-180deg);
                    opacity: 0; 
                } 25%, 75% {
                    -webkit-transform: perspective(140px) rotateX(0deg);
                    transform: perspective(140px) rotateX(0deg);
                    opacity: 1; 
                } 90%, 100% {
                    -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
                    opacity: 0; 
                }
            }
        </style>

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>



        <!--Css Pages End-->
        <!--Angular JS DO NOTE CHANGE THESE VERSIONS!!! ELSE ROUTING WILL NOT WORK-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js">

        </script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
        <script src="assets/js/navbar.js"></script>
    </head>

    <body>
        <div class="container-fluid" ng-controller="screen" ng-init="fetchProfile();">
            <learnest-navbar></learnest-navbar> 
            <br> 
            <div ng-view></div>
            <div class="loginmsg " ng-show="loginAlertMessage">  Logged in as {{name}} </div>
        </div>
        <noscript>
            <center >
                <div style="padding-top:200px">
                    <h1 class="text-danger lcursive" style="font-size: 50px;"> <span class="glyphicon glyphicon-exclamation-sign"></span> Please enable javascript in your browser settings</h1>
                    <p class="text-danger lcursive"><a target="_blank" href="http://activatejavascript.org/en/instructions/">click here</a> to see how to enable these settings for your browser</p>
                </div>
            </center>
        </noscript>
<!--
        firebase
        <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>
-->
        <script src="https://www.gstatic.com/firebasejs/3.7.2/firebase.js"></script>
        <script>
            // Initialize Firebase
            var config = {
            };
            firebase.initializeApp(config);
        </script>
        <!--Javascript Pages-->
        <script type="text/javascript" src="home/home.js"></script>
        <script type="text/javascript" src="profile/profile.js"></script>
        <script type="text/javascript" src="search/search.js"></script>
        <script src="subscribed/subscribed.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="public-profile/public-profile.js"></script>
        
    </body>
</html>
