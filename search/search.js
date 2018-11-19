
var app=angular.module('search',[]);
app.controller('searchController',function($scope,$http,$timeout,$interval){
    //ajax start 
    this.studerror="color:#FF5F58";
    this.teacherror="color:#FF5F58";
    this.fileerror="color:#FF5F58";
    console.log(this.studerror);
    $scope.advSearch=function(sitem){
        if($scope.advsitem===sitem){
            if($scope.advopen===false)
                $scope.advopen=true;
            else
                $scope.advopen=false;
        }
        else{
            $scope.advsitem=sitem;
            $scope.advopen=true;
            console.log('else');
        }

        if($scope.advopen){
            if(this.temp===undefined){
                this.temp='#adv'+$scope.advsitem;
                $(this.temp).addClass('active');
            }
            else{
                $(this.temp).removeClass('active');
                this.temp='#adv'+$scope.advsitem;
                $(this.temp).addClass('active');

            }

        }
        else{
            $(this.temp).removeClass('active');

        }
    }
    this.doAdvSearch=function(sitem){

        if(sitem==="students"){
            if(!this.name)
                this.name="";
            if(!this.email)
                this.email="";
            if(!this.username)
                this.username=""
                if(!this.contact)
                    this.contact=""
                    if(!this.degree)
                        this.degree=""


                        if(this.name===""&&this.email===""&&this.contact===""&&this.username===""){
                            console.log("error");
                            var sc=this;
                            sc.c=1;
                            sc.studflag=true;
                            $interval(function(){
                                console.log("inside interval");
                                if(sc.studflag){
                                    if(sc.c%2==0)
                                        sc.studerror="color:red";
                                    else
                                        sc.studerror="color:#FF5F58";
                                    sc.c++;
                                }
                                else{
                                    sc.studerror="color:#FF5F58";
                                }
                            },500,21);
                        }
            else{
                this.studflag=false;

                $scope.toggleadv(true);
                $scope.searchloader=true;
                console.log(this);   
                //ajax start 
                $http({
                    method :"POST",
                    url : "search/advanced/advanced.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    },data:"name="+this.name+"&email="+this.email+"&username="+this.username+"&sitem="+sitem+"&degree="+this.degree
                    +"&contact="+this.contact
                }).then(function mySucces(response) {
                    $scope.searchresults=response.data;
                    console.log(response.data,"advanced success")
                    $scope.searchloader=false;
                    $scope.searchpages=Array.from(Array(Math.ceil($scope.searchresults.length/5)), (e,i)=>i+1) //since 5 elements in 1 page
                    $scope.searchadvsucc="student";
                    $scope.pagify($scope.searchresults,1);
                }, function myError(response) {
                    console.log(response,"error");
                }); 
                //ajax ends
            }
        }else if((sitem==="teachers")){

            if(!this.name)
                this.name="";
            if(!this.email)
                this.email="";
            if(!this.username)
                this.username="";
            if(!this.contact)
                this.contact="";
            if(!this.degree)
                this.degree="";
            if(!this.subject)
                this.subject="";


            if(this.name===""&&this.email===""&&this.contact===""&&this.username===""&&this.degree===""&&this.subject===""){
                console.log("error");
                var sc=this;
                sc.b=1;
                sc.teachflag=true;
                $interval(function(){
                    console.log("inside interval");
                    if(sc.teachflag){
                        if(sc.b%2==0)
                            sc.teacherror="color:red";
                        else
                            sc.teacherror="color:#FF5F58";
                        if(sc.b==21)
                            sc.teachflag=false;
                        sc.b++;
                    }
                    else{
                        sc.teacherror="color:#FF5F58";
                    }
                },500,21);
            }
            else{
                this.teachflag=false;

                $scope.toggleadv(true);
                $scope.searchloader=true;
                console.log(this);   
                //ajax start 
                $http({
                    method :"POST",
                    url : "search/advanced/advanced.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                    },data:"name="+this.name+"&email="+this.email+"&username="+this.username+"&sitem="+sitem+"&degree="+this.degree
                    +"&contact="+this.contact+"&subject="+this.subject
                }).then(function mySucces(response) {
                    console.log(response);
                    $scope.searchresults=response.data;
                    console.log(response.data,"advanced success")
                    $scope.searchloader=false;
                    $scope.searchpages=Array.from(Array(Math.ceil($scope.searchresults.length/5)), (e,i)=>i+1) //since 5 elements in 1 page
                    $scope.searchadvsucc="teacher";
                    $scope.pagify($scope.searchresults,1);
                }, function myError(response) {
                    console.log(response,"error");
                }); 
                //ajax ends
            }
        }else{
            if(!this.title)
                this.title="";
            if(!this.des)
                this.des="";
            if(!this.upname)
                this.upname="";
            if(!this.subject)
                this.subject="";
            if(!this.degree)
                this.degree="";
            if(!this.filetype)
                this.filetype="";


            if(this.title===""&&this.des===""&&this.upname===""&&this.filetype===""&&this.degree===""&&this.subject===""){
                console.log("error");
                var sc=this;
                sc.a=1;
                sc.fileflag=true;
                $interval(function(){
                    console.log("inside interval");
                    if(sc.fileflag){
                        if(sc.a%2==0)
                            sc.fileerror="color:red";
                        else
                            sc.fileerror="color:#FF5F58";
                        if(sc.a==21)
                            sc.fileflag=false;
                        sc.a++;
                    }
                    else{
                        sc.fileerror="color:#FF5F58";
                    }
                },500,21);
            }
            else{
                this.fileflag=false;

                $scope.toggleadv(true);
                $scope.searchloader=true;
                console.log(this);   
                //ajax start 
                $http({
                    method :"POST",
                    url : "search/advanced/advanced.php",
                    headers: {
                        'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"                    },data:"title="+this.title+"&des="+this.des+"&upname="+this.upname+"&filetype="+this.filetype+"&branch="+this.degree+"&subject="+this.subject+"&sitem="+sitem
                }).then(function mySucces(response) {
                    console.log(response);
                    $scope.searchresults=response.data;
                    console.log(response.data,"advanced success")
                    $scope.searchloader=false;
                    $scope.searchpages=Array.from(Array(Math.ceil($scope.searchresults.length/5)), (e,i)=>i+1) //since 5 elements in 1 page
                    $scope.searchadvsucc="files";
                    $scope.pagify($scope.searchresults,1);
                }, function myError(response) {
                    console.log(response,"error");
                }); 
                //ajax ends
            }
        }
    }
});
app.directive('searchNavbar',function(){
    return{
        restrict:'E',
        templateUrl:'search/search-navbar.php',
        controller:function($scope,$http,$timeout){

            $scope.pagify=function(a,pageno){
                $scope.thispagesitems=a.slice((pageno-1)*5,pageno*5);

            }

            $scope.stimeSince=function(timestamp){
                if($scope.searchitem==='files'&&!$scope.searchloader){
                    console.log($scope.timeSince(timestamp));
                    return $scope.timeSince(timestamp);

                }
            }

            $scope.doSearch=function(sitem,stimes){

                $scope.searchitem=sitem;
                console.log($scope.searchitem,sitem,"in the beg");
                if(!window.location.href.endsWith("search")){
                    window.location="#search";
                    
                  $timeout(function() {
        angular.element(document.getElementById('s'+sitem)).trigger('click')
    });
                
                }
                console.log("search initiated");
                $scope.adv=false;

                $scope.searchloader=true;
                $scope.stempty=false;
                if($scope.navsearchtext===undefined||$scope.navsearchtext===""||$scope.navsearchtext===null){
                    $scope.searchloader=false;
                    $scope.searchresults="";
                    $scope.pagify($scope.searchresults,1);
                    $scope.stempty=true;
                    console.log("empty");

                }else{
                    //ajax start 
                    console.log($scope.searchitem);
                    $http({
                        method :"POST",
                        url : "search/search-script.php",
                        headers: {
                            'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
                        },
                        data:"searchtext="+$scope.navsearchtext+"&searchitem="+$scope.searchitem+"&searchtimes="+stimes
                    }).then(function mySucces(response) {
                        $scope.searchresults= response.data;
                        $scope.searchloader=false;
                        $scope.toggleadv(false);
                        console.log($scope.adv);
                        console.log($scope.searchresults);
                        $scope.searchpages=Array.from(Array(Math.ceil($scope.searchresults.length/5)), (e,i)=>i+1) //since 5 elements in 1 page

                        $scope.pagify($scope.searchresults,1);


                    }, function myError(response) {
                        console.log("search error="+response);
                    }); 

                    //ajax ends
                }
            };
        }
    }; 
});