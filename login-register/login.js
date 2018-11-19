(function(){

    var app=angular.module('main',[]);

    app.controller('switcher',function($scope,$http){
        $scope.login=true;
        $scope.regsuccess=false;
        $scope.googlel=false;
        $scope.firebaselogin=false;
        $scope.loading=false;
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                console.log(user.displayName);
                console.log(user.emailVerified);
                console.log(user.email);
                console.log(user);
                if($scope.regsuccess&&!$scope.googlel){

                    var obj={nonotifications:true};

                    firebase.database().ref("notifications/"+$scope.username).set(obj);
                    user.updateProfile({
                        displayName: $scope.name
                    }).then(function() {
                        user.sendEmailVerification().then(function() {
                            console.log("email sent");
                            $scope.loading=false;
                            $scope.regsuccess=false;
                            $scope.regstatus=true;
                            console.log($scope.regstatus);
                            $scope.$apply();
                        }, function(error) {
                            console.log("email not sent");
                            $scope.loading=false;
                            $scope.error=true;
                            //destroy this entry in mysql delete
                            firebase.auth().signOut().then(function() {
                            }).catch(function(error) {
                                console.log("some error occurred"+error);
                            }); 
                            $scope.errormsg="Some error occurred please try again";
                            $scope.$apply();
                        });    
                    }, function(error) {
                        // delete row from mysql code should come here otherwise there will be inconsistency in both the databases
                        firebase.auth().signOut().then(function() {
                        }).catch(function(error) {
                            console.log("some error occurred"+error);
                        }); 
                    });
                }
                else if($scope.googlel){
                    if (user != null) {
                        user.providerData.forEach(function (profile) {
                            $scope.name=profile.displayName;
                            $scope.email=profile.email;
                            if(profile.providerId==="password"){
                                $scope.email=profile.email;
                            }

                        });
                        //check if user with this email exists in mysql
                        //ajax start 
                        $http({
                            method :"POST",
                            url : "login-register/email-exist-checker.php",
                            headers: {
                                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                            },    
                            data:"email="+$scope.email

                        }).then(function mySucces(response) {
                            console.log(response.data);
                            if(response.data.status){
                                console.log(user.emailVerified);
                                if(user.emailVerified)
                                    $scope.doLogin();
                                console.log("Already registered");
                            }
                            else{
                                $scope.login=false;

                                console.log("need to be registered");
                            }
                        }, function myError(response) {
                        });
                        //ajax ends
                    }



                }
                else if($scope.firebaselogin){
                    console.log("firebase after login");
                    if(user.emailVerified)
                        $scope.doLogin();
                    else{
                        $scope.loading=false;
                        $("#person").removeClass("disabled");
                        console.log($scope.loading);
                        $scope.error=true;
                        $scope.errormsg="Your email is not verified yet!";
                        user.sendEmailVerification().then(function() {
                            console.log("email sent to unverified user");
                        }, function(error) {
                        });
                        $scope.$apply();
                    }
                }

            } else {
                console.log("user not logged in");
            }
        });

    });
    app.directive('learnestLogin',function(){
        return{
            restrict:'E',
            templateUrl:'login-register/learnest-login.php',
            controller:function($http,$scope){
                $scope.forgotpassword=function(){
                    firebase.auth().sendPasswordResetEmail($scope.femail).then(function() {
                        console.log("password reset sent");
                        $scope.fpasssucc=true;
                        $scope.$apply();
                    }, function(error) {
                        console.log("not sent ");
                        $scope.fpasserror=true;
                        $scope.$apply();
                    });
                };
                $scope.fireLogin=function(){
                    $("#person").addClass("disabled");
                    $scope.loading=true;
                    $scope.error=false;
                    $scope.firebaselogin=true;
                    firebase.auth().signInWithEmailAndPassword($scope.email, $scope.password).catch(function(error) {
                        // Handle Errors here.
                        $scope.loading=false;
                        $scope.error=true;
                        if(error.code==='auth/user-not-found')
                            $scope.errormsg="You need to register your account before signing in";
                        $("#person").removeClass("disabled");
                        $scope.errormsg=error.message;
                        $scope.$apply();//forcefully binds 
                    });  
                };
                $scope.googlelogin=function(){
                    $scope.googlel=true;
                    console.log("google login clicked");
                    $scope.error=false;
                    var provider = new firebase.auth.GoogleAuthProvider();
                    //                    var provider = new firebase.auth.FacebookAuthProvider();
                    firebase.auth().signInWithPopup(provider).then(function(result) {
                        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
                        var token = result.credential.accessToken;
                        // The signed-in user info.
                        var user = result.user;
                        // ...
                    }).catch(function(error) {
                        // Handle Errors here.
                        var errorCode = error.code;
                        var errorMessage = error.message;
                        $scope.error=true;
                        $scope.errormsg=error.message;
                        $scope.$apply();
                        // The email of the user's account used.
                        var email = error.email;
                        // The firebase.auth.AuthCredential type that was used.
                        var credential = error.credential;
                        // ...
                    });
                };
                $scope.fblogin=function(){
                    $scope.googlel=true;
                    $scope.error=false;
                    console.log("facebook login clicked");

                    var provider = new firebase.auth.FacebookAuthProvider();
                    firebase.auth().signInWithPopup(provider).then(function(result) {
                        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
                        var token = result.credential.accessToken;
                        // The signed-in user info.
                        var user = result.user;
                        // ...
                    }).catch(function(error) {
                        // Handle Errors here.
                        var errorCode = error.code;
                        var errorMessage = error.message;
                        $scope.error=true;
                        $scope.errormsg=error.message;
                        $scope.$apply();
                        // The email of the user's account used.
                        var email = error.email;
                        // The firebase.auth.AuthCredential type that was used.
                        var credential = error.credential;
                        // ...
                    });
                };
                $scope.error=false;

                $scope.doLogin=function(){
                    console.log("dologin start");
                    console.log($scope.loading);
                    //ajax start 
                    $http({
                        method :"POST",
                        url : "login-register/server-script.php",
                        headers: {
                            'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                        },    
                        data:"email="+$scope.email+"&page=login"
                    }).then(function mySucces(response) {
                        $scope.res= response.data;
                        $scope.loading=false;
                        if($scope.res.status===false)
                        {$scope.error=true;
                         $scope.errormsg=$scope.res.message;    
                        }
                        else{
                            if($scope.res.person==='student')
                                window.location = "main.php";
                            else if($scope.res.person==='teacher')
                                window.location="teacherMain.php";

                        }    
                        $("#person").removeClass("disabled");

                        console.log("result="+$scope.res.message);
                    }, function myError(response) {
                        $scope.res= response.statusText;
                        $scope.loading=false;
                        //                            $scope.errormsg=$scope.response;
                        console.log(response.statusText);
                        console.log(response);
                        $("#person").removeClass("disabled");
                        $scope.error=true;        
                    }); 
                    //ajax ends


                }

            }

        }; 
    });
    app.directive('selectModal',function(){
        return{
            restrict:'E',
            templateUrl:'login-register/select-modal.html'
        }; 
    });
    app.directive('contactUs',function(){
        return{
            restrict:'E',
            templateUrl:'login-register/contact-us.html'  
        }; 
    });
    app.directive('learnestRegister',function(){
        return{
            restrict:'E',
            templateUrl:'login-register/learnest-register.html',
            controller:function($http,$scope,$filter){

                //ajax start 
                $http({
                    method :"POST",
                    url : "login-register/degree-fetcher.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    }
                }).then(function mySucces(response) {
                    $scope.degrees= response.data;

                    $("#person").removeClass("disabled");
                }, function myError(response) {
                    $scope.degerror=true;
                    $("#person").removeClass("disabled");
                    console.log("degree error="+response);
                }); 
                //ajax ends


                $scope.doRegister=function(){
                    console.log("register function activated");
                    $scope.loading=true;
                    $scope.error=false;
                    $("#person").addClass("disabled");
                    console.log($scope.loading);
                    console.log($scope.degree);

                    //Validation Starts
                    if($scope.gender===undefined){
                        $scope.errormsg="Please select a gender";
                        $scope.loading=false;
                        console.log($scope.errormsg);
                        $scope.error=true;
                        $("#person").removeClass("disabled");
                    }
                    else if($scope.password.length<6){
                        $scope.errormsg="Password should be atleast 6 characters long";
                        $scope.loading=false;
                        $scope.error=true;
                        $("#person").removeClass("disabled");
                    }
                    else if($scope.password!==$scope.rpassword){
                        $scope.errormsg="Passwords do not match";
                        $scope.loading=false;
                        console.log($scope.errormsg);
                        $scope.error=true;
                        $("#person").removeClass("disabled");
                    }
                    else if(!Number.isInteger(Number($scope.contact))){
                        $scope.errormsg="Mobile Number should consist of Numbers only";
                        $scope.loading=false;
                        console.log($scope.errormsg);
                        $scope.error=true;
                        $("#person").removeClass("disabled");
                    }
                    else if($scope.contact.length!==10){
                        $scope.errormsg="Mobile Number should consist of 10 characters only";
                        $scope.loading=false;
                        console.log($scope.errormsg);
                        $scope.error=true;
                        $("#person").removeClass("disabled");
                    }

                    else {
                        //validation Ends
                        //ajax start 
                        $http({
                            method :"POST",
                            url : "login-register/server-script.php",
                            headers: {
                                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                            },    
                            data:"email="+$scope.email+"&password="+$scope.password+"&page=register"+"&name="
                            +$scope.name+"&username="+$scope.username+"&contact="+$scope.contact+"&dob="+$scope.dob+"&collegeid="
                            +'0'+"&degree="+$scope.degree+"&gender="+$scope.gender

                        }).then(function mySucces(response) {
                            $scope.res= response.data;


                            if($scope.res.status===false)
                            {  $scope.error=true;
                             $scope.errormsg=$scope.res.message;
                             $scope.loading=false;
                            }
                            else{
                                $scope.regsuccess=true;
                                if($scope.googlel){

                                    $scope.loading=false;
                                    var credential = firebase.auth.EmailAuthProvider.credential($scope.email, $scope.password);
                                    user=firebase.auth().currentUser;
                                    user.link(credential).then(function(user) {
                                        console.log("Account linking success", user);
                                        var obj={nonotifications:true};
                                        firebase.database().ref("notifications/"+$scope.username).set(obj);
                                    }, function(error) {
                                        console.log("Account linking error", error);
                                    });
                                    console.log(user);
                                    user.sendEmailVerification().then(function() {
                                        console.log("email sent to this google account");
                                    }, function(error) {
                                    });
                                }else{
                                    firebase.auth().createUserWithEmailAndPassword($scope.email, $scope.password)
                                        .catch(function(error) {
                                        // Handle Errors here.
                                        var errorCode = error.code;
                                        var errorMessage = error.message;
                                        $scope.error=true;  
                                        $scope.regsuccess=false;
                                        //delete mysql entry code
                                        if (errorCode == 'auth/weak-password') {
                                            $scope.errormsg='The password is too weak.';
                                        } else {
                                            $scope.errormsg=errorMessage;
                                        }
                                        console.log(error);
                                    });

                                }

                                console.log($scope.res.message);
                                //                                window.location="main.php"; 
                            }
                            $("#person").removeClass("disabled");

                            console.log("result="+$scope.res.message);
                        }, function myError(response) {
                            $scope.res= response.statusText;
                            $scope.loading=false;
                            $("#person").removeClass("disabled");
                            console.log($scope.loading);
                            $scope.error=true;     
                            $scope.errormsg=response.data;
                            console.log("result error="+response);
                        });
                    }//ajax ends
                };
            }
        }; 
    });
})();