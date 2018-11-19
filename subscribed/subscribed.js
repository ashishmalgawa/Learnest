angular.module("subscribed",[])
.controller("subscribeController",subscribeController);

subscribeController.$inject=['$scope','$http'];
function subscribeController($scope,$http){
    $('[data-toggle="popover"]').popover({
            html:true
        }); 
    $scope.fetchTopSubscribedUser=function(){
      $http({
            method :"POST",
            url : "subscribed/fetchers/topSubscribed-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            }
        }).then(function mySucces(response){
            $scope.topSubscribedUser=response.data;
            console.log("topSubscribedUser fetched");
            console.log($scope.topSubscribedUser);

        },function myError(response){
            console.log("fetch topSubscribedUser error="+response);
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
            $scope.yourSubscribers= response.data;
            console.log("your subscribers fetched");
            console.log($scope.yourSubscribers);
            $scope.subscribedpages=Array.from(Array(Math.ceil($scope.yourSubscribers.length/4)), (e,i)=>i+1) //since 4 elements in 1 column

            $scope.subscribedpagify($scope.yourSubscribers,1);
        }, function myError(response) {

            console.log("your subscribers error="+response);

        });
    }
    
     $scope.subscribedpagify=function(a,pageno){
             $scope.subthispagesitems=a.slice((pageno-1)*4,pageno*4);
             
         }
    $scope.yourSubscribed=function(type){
        $scope.subtype=type;
        $http({
            method :"POST",
            url : "subscribed/fetchers/yourSubscribed-fetcher.php",
            headers: {
                'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"
            },
            data:"type="+type
        }).then(function mySucces(response){
            $scope.yourSubscribes=response.data;
            console.log("Subscribe fetched");
            console.log($scope.yourSubscribes);
            $scope.subscribedpages=Array.from(Array(Math.ceil($scope.yourSubscribes.length/4)), (e,i)=>i+1) //since 4 elements in 1 page
                     
                       $scope.subscribedpagify($scope.yourSubscribes,1);
        },function myError(response){
            console.log("fetch Subscribe error="+response);
        });  
    }
}