<?php 
session_start();
if(isset($_SESSION['email'])){
    if (headers_sent()){
      die('<script type="text/javascript">window.location.href="' . "main.php" . '";</script>');
    }else{
    header("Location: main.php"); /* Redirect browser */
exit();
      die();
    }    

}

?>

<!DOCTYPE html>
<html lang="en" ng-app="main">
  
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Learnest</title>

        <!-- CSS -->
          <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements-register.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
             .lcursive{
                font-family: 'Pacifico', cursive;
                font-size: 25px;
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
         <!--Angular JS-->
     <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>
 <noscript>
              <center >
                  <div style="padding-top:200px">
                  <h1 class="text-danger lcursive" style="font-size: 50px;"> <span class="glyphicon glyphicon-exclamation-sign"></span> Please enable javascript in your browser settings</h1>
               <p class="text-danger lcursive"><a target="_blank" href="http://activatejavascript.org/en/instructions/">click here</a> to see how to enable these settings for your browser</p>
                  </div>
              </center>
    </noscript>
<body ng-controller="switcher">

    <select-modal></select-modal>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Learnest</strong>- a nest where people can learn</h1>
                            <div class="description">
                            	<p>
                                    Welcome to your college's <i>very own</i>
	                            	<strong>ONLINE PORTAL</strong>
                            	</p>
                            </div>
                        </div>
                    </div>
      
                    <learnest-login ng-show='login'></learnest-login>
                    
                    <learnest-register ng-show='login===false' name="lregister" ></learnest-register>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                            <h3>Queries?<a href="#" onclick="$('#contactus').modal('show')">click here</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            <contact-us></contact-us>
    
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
        <script src="login-register/login.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.2/firebase.js"></script>
<script>
  // Initialize Firebase
  // update config variable with your server
  var config = {
  };
  firebase.initializeApp(config);
</script>
    
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>