angular.module('profile',[])
    .directive("fileInput",fileInput)
    .controller('myController',myController)
    .controller('profileController',profileController)
    .directive('uploadDirective',uploadDirective)
    .directive('usersUploadDirective',usersUploadDirective)
    .filter('capitalize',capitalizeFilter);


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

myController.$inject=['$scope','$http'];
function myController($scope,$http){

};

profileController.$inject=['$scope','$http'];
function profileController($scope,$http){
    console.log("This is profile "+$scope.name+"and gender:"+$scope.gender); 

    $scope.fetchClass=function(){
        $http({
            method :"POST",
            url : "profile/class-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).then(function mySucces(response) {
            $scope.classes= response.data;

            console.log("class fetched");
            console.log($scope.classes);


        }, function myError(response) {
            console.log("fetchClass error="+response);
        });
    };
 

    $scope.fetchSubscribedTeachers=function(){
        $http({
            method :"POST",
            url : "profile/subscribedTeacher-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },
            data:"username="+$scope.username
        }).then(function mySucces(response) {
            $scope.subscribedTeachers=response.data;

            console.log("subscribedTeacher fetched");
            console.log($scope.subscribedTeachers);


        }, function myError(response) {
            console.log("fetchSubscribedTeachers error="+response);
        });
    };

    $scope.fetchSubscribedStudents=function(){
        $http({
            method :"POST",
            url : "profile/subscribedStudents-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },
            data:"username="+$scope.username
        }).then(function mySucces(response) {
            $scope.subscribedStudents=response.data;
            console.log("subscribedStudents fetched");
            console.log($scope.subscribedStudents);

        },function myError(response){
            console.log("fetchSubscribedStudents error="+response);
        });
    };
    con=this;
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
            for(i in $scope.classes){
                    if($scope.classes[i].classid===cls)
                        classname=$scope.classes[i].className;
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
            form_data.append('cls',$scope.cls);
            form_data.append('subject',$scope.subject);
            form_data.append('fileType',$scope.fileType);
            form_data.append('author',$scope.username);
            form_data.append('branch',$scope.branch);

            //        form_data.append("dsec",d.getTime());
            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            $http.post('profile/db_load.php',form_data,{
                transformRequest: angular.identity,
                headers:{'Content-Type':undefined,'Process-Data':false}
            }).success(function(response){
                con.sendNotification($scope.cls,$scope.title);
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

function usersUploadDirective(){
    var ddo={
        templateUrl:'profile/userUploadList.html',
        restrict:'E'
//        controller:uploadListControllerFunction
    };
    return ddo;
};

//uploadListControllerFunction.$inject=['$scope','$http'];
//function uploadListControllerFunction($scope,$http){
//    console.log("uploadListController");
//
//   
//
//  
//
//   
//};

function uploadDirective(){
    var ddo={
        templateUrl:'profile/upload.html',
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

    $scope.fetchSubject=function(){
        console.log($scope.cls);

        $http({
            method :"POST",
            url : "profile/subject-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },
            data:"clas="+$scope.cls
        }).then(function mySucces(response) {
            $scope.sub= response.data;
            console.log("Subject fetched");

        }, function myError(response) {
            console.log("fetchSubject error="+response);
        });

    };

};

function capitalizeFilter() {
    return function(input) {
        return input.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    };
};


