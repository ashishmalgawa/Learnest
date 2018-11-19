(function(){
    var app=angular.module('main',["ngRoute",'profile','search','publicProfileModule',"subscribed"]);
    app.directive('popover', function() {
        return function(scope, elem) {
            elem.popover();
        }
    }).directive('tpublicUploadDirective',function(){
        return{
            restrict:'E',
            templateUrl:'tpublic-profile/tpublic-upload-directive.php',
            controller:function(){

            }   

        };

    });


    app.directive('tooltip', function() {
        return function(scope, elem) {
            elem.tooltip();
        }
    });//since popover doesn't work in ng repeat
    app.directive('mobileView',function(){
        return{
            restrict:'E',
            templateUrl:'home/mobile-view.php',
            controller:function(){

            }
        }; 
    });
    app.directive('smallNotifications',function(){
        return{
            restrict:'E',
            templateUrl:'notifications/small-notifications.php'
        }; 
    });
    app.config(function($routeProvider) {
        $routeProvider
            .when("/", {
            templateUrl : "home/home.php",
            controller:function($scope){
                $scope.togglefile(false);

            }
        })
            .when("/profile", {
            templateUrl : "profile/profile.php"
        })  .when("/subjectView", {
            templateUrl : "home/subjectView.php",
            controller:function($scope){
                if($scope.subjectselected===undefined)
                    $scope.subjectView("refresh");
            }
        }) 
            .when("/subscriber",{
            templateUrl: "subscribed/subscribers.php"
        })  .when("/editProfile", {
            templateUrl : "profile/editProfile.php",
            controller:"editPageCtrl",
            controllerAs:"con"
        })
            .when("/notifications", {
            templateUrl : "notifications/small-notifications.php"
        })
            .when("/search", {
            templateUrl : "search/search-view.php"
        })
            .when("/subscribed",{
            templateUrl: "subscribed/subscribedto.php"
        })
            .when("/publicprofile",{
            templateUrl: "public-profile/public-profile.php",
            controller:function($scope){

                if($scope.pprofile===undefined)
                    $scope.publicprofile("refresh");
            }
        }).when("/tpublicprofile",{
            templateUrl: "tpublic-profile/tpublic-profile.php",
            controller:function($scope){

                if($scope.tpprofile===undefined)
                    $scope.publicprofile("refresh");
            }
        })

        ;
    });


    //created by fatema
    app.controller("editPageCtrl",function($scope,$http){
        var con=this;
        con.name=$scope.name;
        con.dob=new Date($scope.dob);
        con.contact=$scope.contact;
        con.gender=$scope.gender;
        con.branch=$scope.profile.iddegrees;

        $scope.updateProfile=function(){
            $http({
                method :"POST",
                url : "profile/updateProfile.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"name="+con.name+"&contact="+con.contact+"&gender="+con.gender+"&dob="+con.dob+"&branch="+con.branch
            }).then(function mySucces(response) {
                console.log("Profile Updated");
                console.log(response.data);
                $scope.fetchProfile();

                window.location="#profile";
            }, function myError(response) {
                console.log("profileUpdate error="+response);
            });
        };
        //CHANGE PASSWORD
        $scope.changePass=function(){
            var user = firebase.auth().currentUser;
            var credential=firebase.auth.EmailAuthProvider.credential(user.email, $scope.opass);


            user.reauthenticate(credential).then(function() {
                console.log("user reauthenticated");
                if($scope.cpass===$scope.npass){
                    user.updatePassword($scope.npass).then(function() {
                        console.log("update passwrod successful");
                        alert("password changed successfully");


                    }, function(error) {
                        console.log("update passwrod unsuccessful");
                        alert("Please enter a valid password");

                    });
                }else{alert("password doesn't match");}

            }, function(error) {
                console.log("user not reauthenticated");
                alert("please enter correct password");
            });
        };
        //DELETE ACCOUNT
        $scope.deleteAcc=function(){
            var user = firebase.auth().currentUser;
            var credential=firebase.auth.EmailAuthProvider.credential(user.email, $scope.dpass);
            user.reauthenticate(credential).then(function() {
                user.delete().then(function() {
                    var user = firebase.auth().currentUser;

if (user != null) {
  user.providerData.forEach(function (profile) {
    $scope.unlink(providerId);
  });
}

                    $scope.logout();
                    console.log("account deleted successfully");

                }, function(error) {
                    console.log("account not deleted ");
                });

            }, function(error) {
                console.log("user not reauthenticated");
            });

        };
        // LINK/UNLINK
        $scope.getPro=function(){
            var user = firebase.auth().currentUser;
            $scope.allproviders=["google.com","facebook.com"];            
            $scope.providers=[];
            $scope.nullprovide=[];
            if (user != null) {
                user.providerData.forEach(function (profile) {
                    console.log("Sign-in provider: "+profile.providerId);
                    if(profile.providerId!="password"){
                        $scope.providers.push(profile.providerId);

                        $scope.allproviders.splice($scope.allproviders.indexOf(profile.providerId),1);
                    }
                });
                if($scope.providers.length===0){
                    $scope.nullprovide.push("You are not currently linked to any service providers ");
                    $scope.nullprovide.push("true");

                }
            }
        };
        $scope.unlink=function(providerId){

            var user = firebase.auth().currentUser;
            user.unlink(providerId).then(function() {
                $scope.msg="Account unlinked Successfully";
                $scope.$apply();
            }).catch(function(error) {
                $scope.msg="Some error occured";
                $scope.$apply();

            });
        };
        $scope.link=function(providerId){

            var provider;
            if(providerId==="google.com"){
                provider = new firebase.auth.GoogleAuthProvider();
            }else{
                provider = new firebase.auth.FacebookAuthProvider();
            }
            var user = firebase.auth().currentUser;
            user.linkWithPopup(provider).then(function(result) {
                var credential = result.credential;
                var user = result.user;
                $scope.msg="Account linked Successfully";
                $scope.$apply();
                console.log("Account linked Successfully");
            }).catch(function(error) {
                $scope.msg="Some error occured ";
                $scope.$apply();
                console.log("Account linked unSuccessfully");

            });
        };
    });

    app.directive('ngSwitchMultipleWhen', function() {
        // Exact same definition as ngSwitchWhen except for the link fn
        return {
            // Same as ngSwitchWhen
            priority: 1200,
            transclude: 'element',
            require: '^ngSwitch',
            link: function(scope, element, attrs, ctrl, $transclude) {
                var caseStms = scope.$eval(attrs.ngSwitchMultipleWhen);
                caseStms = angular.isArray(caseStms) ? caseStms : [caseStms];

                angular.forEach(caseStms, function(caseStm) {
                    caseStm = '!' + caseStm;
                    ctrl.cases[caseStm] = ctrl.cases[caseStm] || [];
                    ctrl.cases[caseStm].push({ transclude: $transclude, element: element });
                });
            }
        };
    });
    app.directive('desktopView',function(){
        return{
            restrict:'E',
            templateUrl:'home/desktop-view.php',
            controller:function($http,$scope){
                var d=new Date();
                var n =d.getFullYear();

                $scope.filter_year=n.toString();
                console.log($scope.filter_year);
                $scope.now=window.parseInt(n,10);
                $scope.cback=function(){
                    $scope.back();  
                };
                //ajax start 
                $http({
                    method :"POST",
                    url : "home/Top10fetcher.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    }
                }).then(function mySucces(response) {
                    $scope.top10= response.data;

                }, function myError(response) {
                    console.log("degree error="+response);
                }); 
                //ajax ends

            }
        }; 
    }); 
    app.directive('cards',function(){
        return{
            restrict:'E',
            templateUrl:'home/cards.php',
            controller:function($scope,$http){

            }
        }; 
    }); 


    app.directive('learnestNavbar',function(){
        return{
            restrict:'E',
            templateUrl:'home/learnest-navbar.html',
            controller:function($scope){
                $scope.logout=function(){
                    firebase.auth().signOut().then(function() {
                        window.location="logout.php";
                    }).catch(function(error) {
                        console.log("some error occurred"+error);
                    });  

                };
            }
        }; 
    }); 
    app.directive('newsFeed',function(){
        return{
            restrict:'E',
            templateUrl:'home/news-feed.php',
            controller:function(){

            }
        }; 
    }); 
    app.controller('screen',function($http,$scope,$timeout,$interval){
        $http({
            method :"POST",
            url : "login-register/degree-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).then(function mySucces(response) {
            $scope.degrees= response.data;
            console.log($scope.degrees);
        }, function myError(response) {
            console.log("degree error="+response);
        }); 
        //ajax ends
        //samarth cards
        $scope.tab = false;
        $scope.btn = true;
        $scope.showTab = function(year){
            if(year==='first'){
                $scope.tab = true;
                $scope.btn = false;
                $scope.flag='first'}
            else if(year==='second'){
                $scope.tab = true;
                $scope.btn = false;
                $scope.flag='second';
            }
            else if(year==='third'){
                $scope.tab = true;
                $scope.btn = false;
                $scope.flag='third';
            }
            else if(year==='fourth'){
                $scope.tab = true;
                $scope.btn = false;
                $scope.flag='fourth';
            }
        };
        $scope.back=function()
        {
            $scope.btn=true;
            $scope.tab=false;
            $scope.sub=false;
            $scope.togglefile(false);
        };
        $scope.showSub=function(sem){
            $scope.sub=true;
            $scope.toggleSubjectfile(false);
            $scope.semr=sem;
            $scope.fetchSub(sem);
            $scope.togglefile(false);
        };
        $scope.fetchSub=function(sem){
            console.log($scope.semester);
            $http({
                method :"POST",
                url : "home/sub-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"semester="+sem
            }).then(function mySucces(response) {
                $scope.subjects= response.data;
                console.log($scope.subjects);
                $scope.lsubjects=$scope.subjects.slice(0,4);
                $scope.rsubjects=$scope.subjects.slice(4,$scope.subjects.length);
                console.log("subjects fetched");
                console.log($scope.subjects);
                $scope.currentclass=$scope.flag;

            }, function myError(response) {
                console.log("degree error="+response);
            });
        };
        //samarth cards
        //firebase related code start
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                console.log("inside user");
                console.log(user.displayName);
            }
        });
        //firebase related code end
        $scope.togglefile=function(bool){
            $scope.file_flag=bool;

        };
        $scope.toggleSubjectfile=function(bool){
            $scope.files=bool;

        };
        $scope.fetchSubjectFile=function(subjectId,subjectName)
        {
            console.log(subjectId,subjectName);
            $scope.toggleSubjectfile(true);

            $http({
                method :"POST",
                url : "home/subjectFile-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"subid="+subjectId
            }).then(function mySucces(response) {
                $scope.currSubject=subjectId;
                $scope.currSubjectName=subjectName;
                $scope.subjectFile= response.data;
                console.log("subjectFiles fetched");
                $scope.file_flag=true;
                console.log($scope.file_flag+"after file fetch");
                console.log($scope.subjectFile);
            }, function myError(response) {

                console.log("subjectFile error="+response);

            });
        };
        $scope.subjectView=function(semid){
            $http({
                method :"POST",
                url : "home/subject-refresh.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"classid="+semid
            }).then(function mySucces(response) {
                if(response.data.classid!=="notrefresh")
                    semid=response.data.classid;
                $scope.showSub(semid);
                var d=new Date();
                var n =d.getFullYear();
                $scope.subjectselected=true;
                console.log($scope.subjectselected,"selected");
                $scope.filter_year=n.toString();
                console.log($scope.filter_year);
                $scope.now=window.parseInt(n,10);
                $scope.checkSubscribed(semid,'class');
                window.location="#subjectView";  

            }, function myError(response) {

                console.log("subjectFile error="+response);

            });

        };
        $scope.subscribe=function(subscribedto,type){

            $http({
                method :"POST",
                url : "subscribed/fetchers/subscribe.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"subscribedto="+subscribedto+"&type="+type
            }).then(function mySucces(response) {
                console.log(response);
                $scope.fetchNewsfeed();
                firebase.database().ref("/notifications/"+subscribedto).once("value",function(snapshot){
                    if(snapshot.child("nonotifications").exists()){
                        firebase.database().ref("/notifications/"+subscribedto+"/subscribe/"+$scope.username).set($scope.username);
                        firebase.database().ref("/notifications/"+subscribedto+"/nonotifications").remove();
                    }else{
                        firebase.database().ref("/notifications/"+subscribedto+"/subscribe/"+$scope.username).set($scope.username);

                    }


                });
                $scope.checkSubscribed(subscribedto,type);
            }, function myError(response) {

                console.log("subscribe error chala="+response);

            });
        };
        $scope.unsubscribe=function(subscribedto,type){
            console.log("unsubscribe");
            $http({
                method :"POST",
                url : "subscribed/fetchers/unsubscribe.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"subscribedto="+subscribedto
            }).then(function mySucces(response) {
                console.log(response);
                $scope.fetchNewsfeed();
                $scope.checkSubscribed(subscribedto,type);
            }, function myError(response) {

                console.log("subscribe error chala="+response);

            });

        };
        $scope.checkSubscribed=function(subscribedto,type){
            $http({
                method :"POST",
                url : "subscribed/fetchers/checksubscribed.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"subscribedto="+subscribedto+"&type="+type
            }).then(function mySucces(response) {
                $scope.csub=response.data.status;

            }, function myError(response) {

                console.log("subscribe error chala="+response);

            });

        };
        //created by fatema start
        $scope.types = {
            doc:['doc','docx'],
            xls:['xls','xlsx'],
            ppt:['ppt','pptx'],
            pdf:'pdf',
            zip:['zip','rar','tar','gzip','gz','7z'],
            htm:['htm','html'],
            txt:['txt','ini','csv','java','php','js','css'],
            aud: ['mp3', 'wav'],
            vid: ['mp4', 'avi','mpg','mkv','mov','3gp','webm','wmv'],
            img: ['jpg', 'png', 'gif']
        };
        $scope.nfpagify=function(a,pageno){
            $scope.nfthispagesitems=a.slice((pageno-1)*15,pageno*15);

        }
        $scope.fetchNewsfeed=function(){

            $http({
                method :"POST",
                url : "home/newsfeed-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                }
            }).then(function mySucces(response) {
                $scope.newsfeed= response.data;
                console.log("newsfeed fetched");
                console.log($scope.newsfeed);
                $scope.newsfeedpages=Array.from(Array(Math.ceil($scope.newsfeed.length/15)), (e,i)=>i+1) //since 5 elements in 1 page

                $scope.nfpagify($scope.newsfeed,1);

            }, function myError(response) {

                console.log("newsfeed error="+response);


            });
        };

        //created by fatema end
        if(screen.width>450)
            $scope.mobile=false;
        else
            $scope.mobile=true;

        $scope.publicprofile=function(em){
            //fetchprofile em
            $http({
                method :"POST",
                url : "public-profile/fetchers/ppfetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"email="+em
            }).then(function mySucces(response) {
                $scope.pprofile= response.data;

                if($scope.pprofile.name===undefined){       //CHECK IF PUBLIC LINK IS OF STUDENT
                    console.log("PUBLIC LINK CLICKED OF TEACHER");
                    $http({
                        method :"POST",
                        url : "tpublic-profile/fetchers/tppfetcher.php",
                        headers: {
                            'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                        },data:"email="+em
                    }).then(function mySucces(response) {
                        $scope.tpprofile= response.data;
                        $http({
                            method :"POST",
                            url : "teacher/fetchers/branchwiseSubjectForTeacher-fetcher.php",
                            headers: {
                                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                            },
                            data:"username="+$scope.tpprofile.username
                        }).then(function mySucces(response) {
                            $scope.pubbranchwise= response.data;
                            console.log("branchwise Subject fetch");
                            console.log($scope.pubbranchwise);

                            //new ajax
                            $http({
                                method :"POST",
                                url : "teacher/fetchers/branch-fetcher.php",
                                headers: {
                                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                                },
                                data:"username="+$scope.tpprofile.username
                            }).then(function mySucces(response) {
                                $scope.pubtbranch= response.data;
                                console.log("branch fetched");
                                console.log($scope.pubtbranch);
                                console.log($scope.tpprofile.username,"inside public teacher");
                                $scope.fetchUploads($scope.tpprofile.username);
                                window.location="#tpublicprofile";
                            }, function myError(response) {

                                console.log("fetch branch error ="+response);

                            });

                            //new ajax



                        }, function myError(response) {

                            console.log("fetch branchwise subject error ="+response);

                        });


                    }, function myError(response) {

                        console.log("teacher profile error chala="+response);

                    });
                }
                else{
                    $scope.checkSubscribed($scope.pprofile.username,'student');
                    $scope.fetchUploads($scope.pprofile.username);
                    window.location="#publicprofile";
                };
            }, function myError(response) {

                console.log("profile error chala="+response);

            });

        }; 
            $scope.notificationsignal=function(bool){
            console.log("notification light"+bool,$scope.tempnot);
            
            if(!$scope.tempnot||bool===false){
            if(bool){
                c=1;
                $scope.tempnot=true;
                console.log("inside if notifications");
                $scope.notificationtrue=$interval(function(){
                    if(c%2==0&&$scope.tempnot)
                        $scope.notify="color:#FF1D00";
                    else
                        $scope.notify="color:white";
                    c++;


                },500);

            }else{
                console.log("in else notification light"+bool);
                $scope.tempnot=false;
                $scope.notify="color:white";
                $interval.cancel($scope.notificationtrue);

            }
}

        };
        $scope.fetchnotifications=function(){

            var key= firebase.database().ref("/notifications/"+$scope.username).on("value",function(snapshot){
                console.log(snapshot.child("nonotifications").exists());
                if(!snapshot.child("nonotifications").exists()){
                    console.log("inside function",snapshot.val());
                    $scope.newSubscribers=snapshot.val().subscribe;
                    console.log($scope.newSubscribers);
                    $scope.notificationsignal(true);
                    $scope.nonotifications=false;
                    if(snapshot.child("subscribe").exists()){
                        $scope.subKeys=Object.keys($scope.newSubscribers);
                        if($scope.subKeys.length!==2){

                            $http({
                                method :"POST",
                                url : "notifications/name-email.php",
                                headers: {
                                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                                },data:"username="+$scope.newSubscribers[$scope.subKeys[0]]
                            }).then(function mySucces(response) {
                                $scope.subNotNames=response.data;
                                console.log($scope.subNotNames,"after notifications")
                            }, function myError(response) {

                                console.log("sub name error="+response);

                            });
                        }else{

                            $http({
                                method :"POST",
                                url : "notifications/name-email.php",
                                headers: {
                                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                                },data:"username="+$scope.newSubscribers[$scope.subKeys[0]]+"&username2="+$scope.newSubscribers[$scope.subKeys[1]]
                            }).then(function mySucces(response) {
                                $scope.subNotNames=response.data;
                                console.log($scope.subNotNames,"after notifications");
                            }, function myError(response) {

                                console.log(response);

                            });

                        }
                    }
                    if(snapshot.child("fileupload").exists()){
                        $scope.filenotification=true;
                        $scope.newfiles=snapshot.val().fileupload;
                        var tmp=Object.keys($scope.newfiles);
                        $scope.filenumbers=new Object();
                        for (x in tmp){
                            $scope.filenumbers[tmp[x]]=new Object();
                            $scope.filenumbers[tmp[x]].number=(Object.keys($scope.newfiles[tmp[x]])).length;
                            $scope.filenumbers[tmp[x]].name=$scope.newfiles[tmp[x]][Object.keys($scope.newfiles[tmp[x]])[0]];


                        }

                        console.log($scope.filenumbers);
                    }
                }else{
                    $scope.nonotifications=true;
                    $scope.filenotification=false;
                    console.log("nonotifications");
                }
            });
        };
        $scope.clearnotifications=function(){

            $scope.filenotification=false;
            firebase.database().ref("notifications/"+$scope.username+"/nonotifications").set(true);  
            firebase.database().ref("notifications/"+$scope.username+"/subscribe").remove();
            firebase.database().ref("notifications/"+$scope.username+"/fileupload").remove();


        };
        $scope.fetchYourSubscribers=function(us){

            $http({
                method :"POST",
                url : "profile/yoursubscribers.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"username="+us
            }).then(function mySucces(response) {
                $scope.yoursubscribers= response.data;
                console.log("your subscribers fetched");
                console.log($scope.yoursubscribers);
            }, function myError(response) {

                console.log("your subscribers error="+response);

            });
        }
        //profile.js old content

        $scope.toggleadv=function(bool){
            $scope.adv=bool;
        };
        $scope.uploadpagify=function(a,pageno){
            $scope.uthispagesitems=a.slice((pageno-1)*5,pageno*5);

        }
        $scope.puploadpagify=function(a,pageno){
            $scope.puthispagesitems=a.slice((pageno-1)*10,pageno*10);

        }
        $scope.test=function(){
            console.log("test run");
        }

        $scope.fetchUploads=function(uname){
            console.log("fetching uploads started");
            $http({
                method :"POST",
                url : "profile/upload-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"username="+uname
            }).then(function mySucces(response) {
                console.log("fetching uploads finished");
                if(uname===$scope.username){
                    if(!window.location.href.endsWith("/profile"))
                        window.location="#profile";
                    $scope.uploads= response.data;
                    $scope.uploadpages=Array.from(Array(Math.ceil($scope.uploads.length/5)), (e,i)=>i+1) //since 5 elements in 1 page
                    $scope.uploadpagify($scope.uploads,1);

                }
                else{
                    $scope.puploads=response.data;
                    $scope.puploadpages=Array.from(Array(Math.ceil($scope.puploads.length/10)), (e,i)=>i+1) //since 10 elements in 1 page
                    $scope.puploadpagify($scope.puploads,1);

                }



            }, function myError(response) {
                console.log("fetchUploads error="+response);
            });
        };
        $scope.viewFile=function(uname,timestamp,subjectid,dname){
            console.log("fetching file started");
            $http({
                method :"POST",
                url : "profile/file-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"username="+$scope.username+"&timestamp="+timestamp+"&subjectid="+subjectid+"&dname="+dname+"&uname="+uname
            }).then(function mySucces(response) {
                $scope.viewedfile= response.data;
                console.log($scope.viewedfile);
                window.open($scope.viewedfile.location,'_blank');


            }, function myError(response) {
                console.log("viewFile error="+response);
            });
        };
        $scope.deleteFile=function(timestamp,subjectid,dname){
            console.log("file deletion invoked");

            $('#deleteconfirm').modal({backdrop: 'static', keyboard: false , show: true });
            $scope.confirmdelete=function(){
                console.log("delete confirmed");
                $http({
                    method :"POST",
                    url : "profile/deleteFile.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    },
                    data:"username="+$scope.username+"&timestamp="+timestamp+"&subjectid="+subjectid+"&dname="+dname
                }).then(function mySucces(response) {
                    $scope.fileDeletion= response.data;
                    console.log($scope.fileDeletion);
                    $scope.fetchUploads($scope.username);

                }, function myError(response) {
                    console.log("deleteFile error="+response);
                });
            }
        };
        //to display timestamp in ago format
        $scope.timeSince=function(dat) {

            var seconds = Math.floor((Date.now() - $scope.mysqlTimestampToDate(dat).getTime()) / 1000);

            interval = Math.floor(seconds / 86400);
            if(interval>6){
                return dat;
            }else{
                if (interval = 1) {
                    return interval + " day ago";

                }
                else if(interval>1)
                    return interval+"days ago";
                interval = Math.floor(seconds / 3600);
                //            console.log("hours",interval);
                if (interval >= 1) {
                    return interval + " hours ago";
                }

                interval = Math.floor(seconds / 60);
                //            console.log("min",interval);
                if (interval >= 1) {
                    return interval + " minutes ago";
                }
                return Math.floor(seconds) + " seconds ago";
            }
        };

        //timestamp to js date format
        $scope.mysqlTimestampToDate=function(timestamp) {
            //function parses mysql datetime string and returns javascript Date object
            //input has to be in this format: 2007-06-05 15:26:02
            var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
            var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
            return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
        };


        //profile.js old content closed


        //profile fetcher initiated
        $scope.fetchProfile=function(){
            $http({
                method :"POST",
                url : "profile/profile-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                }
            }).then(function mySucces(response) {
                $scope.profile= response.data;
                console.log($scope.profile.name);
                console.log("profile fetched");
                console.log($scope.profile);



                $scope.name=$scope.profile.name;
                $scope.rep=$scope.profile.rep;        
                $scope.email=$scope.profile.email;
                $scope.branch=$scope.profile.branch;        
                $scope.contact=$scope.profile.contact;
                $scope.username=$scope.profile.username;        
                $scope.dob=$scope.profile.dob;
                $scope.gender=$scope.profile.gender;
                $scope.fetchYourSubscribers($scope.username);
                $scope.fetchNewsfeed();
                //        if($scope.name===undefined){
                //                        window.location="index.php";  
                //    ye aakhri me jab website ban jaye tb comment hatana h                
                //}
                $scope.fetchnotifications();
                $scope.loginAlertMessage=true; 
                $timeout(function () { $scope.loginAlertMessage = false; }, 5000);   

                //sem fetcher initiated
                $http({
                    method :"POST",
                    url : "home/sem-fetcher.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    },data:"branch="+$scope.branch
                }).then(function mySucces(response) {
                    $scope.semester= response.data;
                    //console.log('hello');
                    console.log("sem fetched");
                    console.log(response.data);
                    console.log($scope.branch);

                }, function myError(response) {
                    console.log("semester error="+response);
                });




                //        
            }, function myError(response) {

                console.log("degree error chala="+response);

            });
        }

        //profile fetcher completed 

    });


})();