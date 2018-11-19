angular.module('tprofile',[])
    .directive("fileInput",fileInput)
    .directive('uploadDirective',uploadDirective)
    .directive('usersUploadDirective',usersUploadDirective)
    .controller('profileController',profileController)
    .filter('capitalize',capitalizeFilter)
    .controller('MainCtrl',MainCtrl); 

MainCtrl.$inject=['$scope'];
function MainCtrl($scope) {


};


//    $parse represents the compiled expression
fileInput.$inject=['$parse'];
function fileInput($parse){
    return{
        //argument element activates when matching element is encountered similarly arguments
        link:function($scope,element,attrs){
            //as file is an element
            element.on("change",function(event){
                //event.target is the element that triggered the event and .files refer to the file uploaded
                var files=event.target.files;
                //console.log(files[0].name);
                console.log("File:",files);
                console.log("File:",element[0].files);
                //                    $parse(attrs.fileInput).assign($scope,element[0].files);
                $parse(attrs.fileInput).assign($scope,files);
                $scope.$apply();
                //bind selected file data into custom fileInput directive
            });
        }
    }
};


function usersUploadDirective(){
    var ddo={
        templateUrl:'teacher/profile/userUploadList.html',
        restrict:'E'
        //        controller:uploadListControllerFunction
    };
    return ddo;
};

function uploadDirective(){
    var ddo={
        templateUrl:'teacher/profile/upload.html',
        restrict:'E',
        controller:uploadControllerFunction
        //        bindToController:true,
        //        controllerAs:uploadCtrl
    };
    return ddo;
};

uploadControllerFunction.$inject=['$scope','$http'];
function uploadControllerFunction($scope,$http){
    console.log("uploadController/Hello");

    //    $scope.fetchSubject=function(){
    //        console.log($scope.cls);
    //
    //        $http({
    //            method :"POST",
    //            url : "profile/subject-fetcher.php",
    //            headers: {
    //                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
    //            },
    //            data:"clas="+$scope.cls
    //        }).then(function mySucces(response) {
    //            $scope.sub= response.data;
    //            console.log("Subject fetched");
    //
    //        }, function myError(response) {
    //            console.log("fetchSubject error="+response);
    //        });
    //
    //    };

};


profileController.$inject=['$scope','$http'];
function profileController($scope,$http){
    console.log("This is profile "+$scope.name+"and gender:"+$scope.gender); 

    //demo starts
    $scope.skills = [];

    $scope.addSkill = function() {
        $scope.skills.push({'title': $scope.newSkill, 'done':false});
        $scope.newSkill = '';
    };

    $scope.deleteSkill = function(index) {	
        $scope.skills.splice(index, 1);
    };
    //demo ends

    $scope.fetchAllBranch=function(){
        $http({
            method :"POST",
            url : "teacher/fetchers/allBranch-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).then(function mySucces(response) {
            console.log("All Branches Fetched");
            $scope.allBranches=response.data;
            console.log(response.data);
        }, function myError(response) {
            console.log("allBranches fetch error="+response);
        });
    };
    con=this;
    //    con.sendNotification=function(cls){
    //        console.log(cls);
    //        $http({
    //            method :"POST",
    //            url : "subscribed/fetchers/fornotificationssub.php",
    //            headers: {
    //                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
    //            },data:"username="+cls
    //        }).then(function mySucces(response) {
    //
    //            console.log("subscribers fetched");
    //            console.log(response.data);
    //            var classname;
    //            for(i in $scope.tsem){
    //                if($scope.tsem[i].classid===cls)
    //                    classname=$scope.tsem[i].cname;
    //            }
    //             var y=0;
    //            for( x in response.data){
    //               
    //                console.log(response.data[x].username);
    //                var username=response.data[x].username;
    //                console.log(x,y);
    //                firebase.database().ref("/notifications/"+username).once("value",function(snapshot){
    //                    console.log(x,y);
    //                    if(snapshot.child("nonotifications").exists()){
    //                        console.log(username,response.data[x].username);
    //                        console.log("/notifications/"+username+"/fileupload/IT1/abc",x);
    //                        var key=firebase.database().ref("/notifications/"+username+"/fileupload/IT1/abc").push().key;
    //                        firebase.database().ref("/notifications/"+username+"/fileupload/"+cls+"/"+key).set(classname);
    //                        console.log("/notifications/"+username+"/fileupload/"+cls+"/"+key,x);
    //                        //                 firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/"+cls).set(classname);
    //                        firebase.database().ref("/notifications/"+username+"/nonotifications").remove();
    //                    }else{
    //                        console.log(username,response.data[x].username);
    //                        console.log("/notifications/"+username+"/fileupload/IT1/abc",x);
    //                        var key=firebase.database().ref("/notifications/"+username+"/fileupload/IT1/abc").push().key;
    //                        firebase.database().ref("/notifications/"+username+"/fileupload/"+cls+"/"+key).set(classname);
    //
    //                    }
    //
    //
    //                });
    //                console.log(x,y);
    //                y++;
    //                console.log("after incter",x,y);
    //                
    //            }    
    //        }, function myError(response) {
    //
    //            console.log(" subscribers error="+response);
    //
    //        });
    //    };
    con.sendNotification=function(cls){
        console.log(cls);
        $http({
            method :"POST",
            url : "subscribed/fetchers/fornotificationssub.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },data:"username="+cls
        }).then(function mySucces(response) {

            console.log("subscribers fetched");
            console.log(response.data);
            var classname;
            for(i in $scope.tsem){
                if($scope.tsem[i].classid===cls)
                    classname=$scope.tsem[i].cname;
            }
            for( x in response.data){
                console.log(response.data[x].username);
                firebase.database().ref("/notifications/"+response.data[x].username).once("value",function(snapshot){
                    if(snapshot.child("nonotifications").exists()){
                        console.log("/notifications/"+response.data[x].username+"/fileupload/IT1/abc");
                        var key=firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/IT1/abc").push().key;
                        firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/"+cls+"/"+key).set(classname);
                        //                 firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/"+cls).set(classname);
                        firebase.database().ref("/notifications/"+response.data[x].username+"/nonotifications").remove();
                    }else{

                        console.log("/notifications/"+response.data[x].username+"/fileupload/IT1/abc");
                        var key=firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/IT1/abc").push().key;
                        firebase.database().ref("/notifications/"+response.data[x].username+"/fileupload/"+cls+"/"+key).set(classname);

                    }


                });

            }    
        }, function myError(response) {

            console.log(" subscribers error="+response);

        });
    };
    $scope.editPage=false;

    $scope.updateProfile=function(){
        $scope.editPage=false;
        $http({
            method :"POST",
            url : "teacher/profile/updateProfile.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },
            data:"name="+$scope.name+"&contact="+$scope.contact+"&gender="+$scope.gender+"&dob="+$scope.dob
        }).then(function mySucces(response) {
            console.log("Profile Updated");
            console.log(response);


        }, function myError(response) {
            console.log("profileUpdate error="+response);
        });
    }




    //to upload file on server and update database
    $scope.uploadFile=function(){
        $scope.uploaderror=false;
        $scope.uploadloader=true;
        console.log('title:',$scope.title);
        //form_data object to ssend data to server
        var form_data=new FormData();
        //to add selected file data to form data object
        console.log("$scope.files:",$scope.files);
        if($scope.files!==undefined&&$scope.files!=="")
        {   
            angular.forEach($scope.files,function(file){
                form_data.append('file',file); 
                console.log(file);
            });

            form_data.append('title',$scope.title);
            form_data.append('description',$scope.description);
            form_data.append('fbranch',$scope.fbranch);
            form_data.append('fsem',$scope.fsem);
            form_data.append('fsubject',$scope.fsubject);
            form_data.append('fileType',$scope.fileType);
            form_data.append('author',$scope.username);

            //        form_data.append("dsec",d.getTime());
            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            $http.post('teacher/profile/db_load.php',form_data,{
                transformRequest: angular.identity,
                headers:{'Content-Type':undefined,'Process-Data':false}
            }).success(function(response){

                $scope.uploadres=response;
                console.log($scope.uploadres);
                $scope.uploadloader=false;
                if(!$scope.uploadres.status){
                    $scope.uploaderrormsg=$scope.uploadres.message;
                    $scope.uploaderror=true;

                }else{
                    $scope.files="";
                    console.log($scope.uploadres.message)
                    $scope.uploaderror=false;
                    $scope.uploadsuccessful=true;
                    con.sendNotification($scope.fsem);
                    $scope.fetchUploads($scope.username);

                    document.getElementById('uploadForm').reset();

                }
            });
        }
        else{
            $scope.uploadloader=false;
            $scope.uploaderror=true;
            $scope.uploaderrormsg="Please select a file to upload";

        }

    };


};




function capitalizeFilter() {
    return function(input) {
        return input.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    };
};


