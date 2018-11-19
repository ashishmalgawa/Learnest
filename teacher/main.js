(function(){
    var app=angular.module('tMain',['search','ngRoute','publicProfileModule','tprofile','nya.bootstrap.select']);
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
    app.directive('tdesktopView',function(){
        return{
            restrict:'E',
            templateUrl:'teacher/home/tdesktop-view.php',
            controller:function($scope,$http){
                var d=new Date();
                var n=d.getFullYear();
                $scope.filter_year=n.toString();
                $scope.now=window.parseInt(n,10);
                //ajax start 
                $http({
                    method :"POST",
                    url : "teacher/fetchers/top10-fetcher.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    },data: "tech_name="+$scope.profile.username
                }).then(function mySucces(response) {
                    $scope.top10= response.data;
                    console.log($scope.profile.username);
                    console.log($scope.top10);
                    console.log("top 10 fetchher fetched");
                }, function myError(response) {
                    console.log("top10 fetcher error="+response);
                }); 
                //ajax ends
            }
        }; 
    });

    app.directive('tcards',function(){
        return{
            restrict:'E',
            templateUrl:'teacher/home/tcards.php',
            controller:function($scope,$http){


            }
        }
    });

    app.directive('tnewsFeed',function(){
        return{
            restrict:'E',
            templateUrl:'home/news-feed.php',
            controller:function(){

            }
        }; 
    }); 

    app.config(function($routeProvider) {
        $routeProvider
            .when("/", {
            templateUrl : "teacher/home/home.php",
            controller:function($scope){
                $scope.toggletfile(false);
            }
        })  .when("/subjectView", {
            templateUrl : "teacher/home/subjectView.php",
            controller:function($scope){
                if($scope.subjectselected===undefined)
                    $scope.subjectView("refresh");
            }
        }) .when("/editProfile", {
            templateUrl : "teacher/profile/editProfile.php",
            controller:"editPageCtrl",
            controllerAs:"con"
        })  .when("/subscriber",{
            templateUrl: "subscribed/subscribers.php"
        })
            .when("/profile", {
            templateUrl : "teacher/profile/profile.php"
        })
            .when("/search", {
            templateUrl : "search/search-view.php"
        })
            .when("/publicprofile",{
            templateUrl: "teacher/profile/student-profile.php",
            controller:function($scope){

                if($scope.pprofile===undefined)
                    $scope.publicprofile("refresh");
            }
        })
            .when("/tpublicprofile",{
            templateUrl: "teacher/profile/teacher-profile.php",
            controller:function($scope){

                if($scope.tpprofile===undefined)
                    $scope.publicprofile("refresh");
            }
        });
    });

    app.controller("editPageCtrl",function($scope,$http){
        var con=this;
        con.name=$scope.name;
        con.dob=new Date($scope.dob);
        con.contact=$scope.contact;
        con.gender=$scope.gender;   
        con.checkmembership=function(sid){
            var x=0;
            while(x < $scope.branchwise.length ){   
                if(sid===$scope.branchwise[x]["psubjectid"])
                    return true;
                x++;
            }
            return false;
        };
        con.fetchAllSubjects=function(){
            $http({
                method :"POST",
                url : "teacher/fetchers/all-subject-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                }
            }).then(function mySucces(response) {
                $scope.allSubjects=response.data;
                console.log($scope.allSubjects,"subjects");
                if($scope.branchwise===undefined){

                    $http({
                        method :"POST",
                        url : "teacher/fetchers/branchwiseSubjectForTeacher-fetcher.php",
                        headers: {
                            'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                        },
                        data:"username="+$scope.username
                    }).then(function mySucces(response) {
                        $scope.branchwise= response.data;
                        console.log("branchwise Subject fetch");
                        console.log($scope.branchwise);
                        con.newTeacherSubjects=[];
                        for(x in $scope.allSubjects){
                            if(con.checkmembership($scope.allSubjects[x]["sid"])){
                                con.newTeacherSubjects.push($scope.allSubjects[x]);
                            }
                        }
                        console.log(con.newTeacherSubjects,"teachersubjects");


                    }, function myError(response) {

                        console.log("fetch branchwise subject error ="+response);

                    });



                }else{
                    con.newTeacherSubjects=[];
                    for(x in $scope.allSubjects){
                        if(con.checkmembership($scope.allSubjects[x]["sid"]))
                            con.newTeacherSubjects.push($scope.allSubjects[x]);
                    }
                    console.log(con.newTeacherSubjects,"teachersubjects");

                }
            }, function myError(response) {
                console.log("profileUpdate error="+response);
            });
        }
        $scope.updateProfile=function(){
            var subjects="";
            var b=1;
            for(x in con.newTeacherSubjects){
                subjects=subjects+"&"+"subject"+b+"="+con.newTeacherSubjects[x].sid;
                b++;   
            }
            console.log(subjects);
            $http({
                method :"POST",
                url : "teacher/profile/updateProfile.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"name="+con.name+"&contact="+con.contact+"&gender="+con.gender+"&dob="+con.dob+subjects
            }).then(function mySucces(response) {
                console.log("Profile Updated");
                console.log(response.data);
                $scope.fetchProfile();
                window.location="#profile";
            }, function myError(response) {
                console.log("profileUpdate error="+response);
            });
        }
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
                    console.log("account deleted successfully");
                    var user = firebase.auth().currentUser;

                    if (user != null) {
                        user.providerData.forEach(function (profile) {
                            //console.log("Sign-in provider: "+profile.providerId);
                            $scope.unlink(providerId);
                        });
                    }

                    $scope.logout();

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
    app.controller('screen',function($http,$scope,$interval){
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
                $scope.fetchSubject(semid);
                var d=new Date();
                var n =d.getFullYear();
                $scope.subjectselected=true;
                console.log($scope.subjectselected,"selected");
                $scope.filter_year=n.toString();
                console.log($scope.filter_year);
                $scope.now=window.parseInt(n,10);
                window.location="#subjectView";  

            }, function myError(response) {

                console.log("subjectFile error="+response);

            });

        };
        $scope.toggleSubjectfile=function(bool){
            $scope.files=bool;

        };
        $scope.togglefile=function(bool){
            $scope.file_flag=bool;

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
                $scope.checkSubscribed(subscribedto,type)
            }, function myError(response) {

                console.log("subscribe error chala="+response);

            });

        };
        $scope.fetchnotifications=function(){
            console.log("fetching notifications",$scope.username);
            var key= firebase.database().ref("/notifications/"+$scope.username).on("value",function(snapshot){
                console.log(snapshot.child("nonotifications").exists());
                if(!snapshot.child("nonotifications").exists()){
                    console.log("inside function",snapshot.val());

                    $scope.notificationsignal(true);
                    $scope.nonotifications=false;
                    if(snapshot.child("subscribe").exists()){
                        $scope.newSubscribers=snapshot.val().subscribe;
                        console.log($scope.newSubscribers);
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
        //samarth cards
        $scope.tsemshow=function(tbranch,tbid){
            $scope.fetchSem(tbid);
            console.log(tbranch);

            if($scope.tsemsitem===tbranch){
                if($scope.tsemopen===false)
                    $scope.tsemopen=true;
                else
                    $scope.tsemopen=false;
            }
            else{
                $scope.tsemsitem=tbranch;
                $scope.tsemopen=true;
                console.log('else');
            }

            if($scope.tsemopen){
                if(this.temp===undefined){
                    this.temp='#tsem'+$scope.tsemitem;
                    $(this.temp).addClass('active');
                }
                else{
                    $(this.temp).removeClass('active');
                    this.temp='#adv'+$scope.tsemsitem;
                    $(this.temp).addClass('active');

                }

            }
            else{
                $(this.temp).removeClass('active');

            }

        }
        //samarth cards
        $scope.toggletfile=function(bool){
            $scope.tfile_flag=bool;

        };
        $scope.toggletSubjectfile=function(bool){
            $scope.tfiles=bool;

        };
        $scope.toggletsemopen=function(bool){
            $scope.tsemopen=bool;
            console.log($scope.tsemopen);
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
        $scope.toggleadv=function(bool){
            $scope.adv=bool;
        };
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
                    $scope.fetchUploads($scope.pprofile.username);
                    window.location="#publicprofile";
                };
            }, function myError(response) {

                console.log("profile error chala="+response);

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
        $scope.fetchYourSubscribers=function(us){

            $http({
                method :"POST",
                url : "subscribed/fetchers/yoursubcribers.php",
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


        $scope.uploadpagify=function(a,pageno){
            $scope.uthispagesitems=a.slice((pageno-1)*5,pageno*5);

        }
        $scope.puploadpagify=function(a,pageno){
            $scope.puthispagesitems=a.slice((pageno-1)*10,pageno*10);

        }

        $scope.fetchUploads=function(uname){
            console.log(uname);
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
                console.log($scope.viewedfile.location);
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
                if (interval >= 1) {
                    return interval + " days ago";
                }
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
                url : "teacher/fetchers/profile-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                }
            }).then(function mySucces(response) {
                $scope.profile= response.data;
                console.log($scope.profile.name);
                console.log("profile fetched");
                console.log($scope.profile);

                $scope.name=$scope.profile.name;
                $scope.email=$scope.profile.email;
                $scope.branch=$scope.profile.branch;        
                $scope.contact=$scope.profile.contact;
                $scope.username=$scope.profile.username;        
                $scope.dob=$scope.profile.dob;
                $scope.gender=$scope.profile.gender;
                $scope.fetchYourSubscribers($scope.username);
                $scope.fetchNewsfeed();
                $scope.fetchBranch($scope.username);
                $scope.fetchnotifications();

                //        if($scope.name===undefined){
                //                        window.location="index.php";  
                //    ye aakhri me jab website ban jaye tb comment hatana h                
                //}

                //sem fetcher initiated
                //                $http({
                //                    method :"POST",
                //                    url : "home/sem-fetcher.php",
                //                    headers: {
                //                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                //                    },data:"branch="+$scope.branch
                //                }).then(function mySucces(response) {
                //                    $scope.semester= response.data;
                //                    //console.log('hello');
                //                    console.log("sem fetched");
                //                    console.log(response.data);
                //                    console.log($scope.branch);
                //
                //                }, function myError(response) {
                //                    console.log("semester error="+response);
                //                });
                //
                //


                //        
            }, function myError(response) {

                console.log("degree error chala="+response);

            });
        }

        //profile fetcher completed 
        $scope.back=function()
        {
            $scope.toggletsemopen(false);
            $scope.tsub=false;
            $scope.toggletfile(false);
        };
        //BRANCH fetcher starts
        $scope.fetchBranch=function(uname){
            $http({
                method :"POST",
                url : "teacher/fetchers/branch-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"username="+uname
            }).then(function mySucces(response) {
                $scope.tbranch= response.data;
                console.log("branch fetched");
                console.log($scope.tbranch);
                //                $scope.fetchSem(1);

            }, function myError(response) {

                console.log("fetch branch error ="+response);

            });
        }

        $scope.fetchSem=function(branchId){
            $http({
                method :"POST",
                url : "teacher/fetchers/sem-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"branch="+branchId
            }).then(function mySucces(response) {
                $scope.tsem= response.data;
                console.log("Sem fetched");
                console.log($scope.tsem);
                //                $scope.fetchSubject("CS1");

            }, function myError(response) {

                console.log("fetch sem error ="+response);

            });
        }

        $scope.fetchSubject=function(semId){
            $scope.logo_flag=true;
            $scope.tsub=true;
            $scope.tsemr=semId;
            $scope.toggletfile(false);
            $scope.toggletSubjectfile(false);
            $http({
                method :"POST",
                url : "teacher/fetchers/subject-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"sem="+semId
            }).then(function mySucces(response) {
                $scope.logo_flag=false;
                $scope.subject= response.data;
                $scope.lsubject=$scope.subject.slice(0,4);
                $scope.rsubject=$scope.subject.slice(4,$scope.subject.length);
                console.log("Subject fetched");
                console.log($scope.subject);


            }, function myError(response) {

                console.log("fetch subject error ="+response);

            });
        }

        $scope.fetchBranchwiseSubject=function(user){

            console.log(user);
            $http({
                method :"POST",
                url : "teacher/fetchers/branchwiseSubjectForTeacher-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },
                data:"username="+user
            }).then(function mySucces(response) {
                $scope.branchwise= response.data;
                console.log("branchwise Subject fetch");
                console.log($scope.branchwise);


            }, function myError(response) {

                console.log("fetch branchwise subject error ="+response);

            });
        };

        //created by samarth start
        $scope.tfetchSubjectFile=function(subjectId,subjectName)
        {
            console.log(subjectId);
            $scope.toggletSubjectfile(true);
            $scope.logo_flag1=true;

            $http({
                method :"POST",
                url : "home/subjectFile-fetcher.php",
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                },data:"subid="+subjectId
            }).then(function mySucces(response) {
                $scope.logo_flag1=false;
                $scope.tcurrSubject=subjectId;
                $scope.tcurrSubjectName=subjectName;
                $scope.tsubjectFile= response.data;
                console.log("subjectFiles fetched");
                $scope.tfile_flag=true;
                console.log($scope.tfile_flag+"after file fetch teacher");
                console.log($scope.tsubjectFile);
            }, function myError(response) {

                console.log("subjectFile error="+response);

            });
        }
        //created by samarth end
    });


})();