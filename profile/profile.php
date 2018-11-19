<!--script for browse button-->
<script type="text/javascript">
    $(document).on('click', '.browse', function(){
        var file = $(this).parent().parent().parent().find('.file');
        file.trigger('click');
    });
    $(document).on('change', '.file', function(){
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
</script>



<div class="row" ng-controller="profileController">
    
    <div class="media col-lg-3"  style="padding-left:50px;padding-bottom:10px" ng-show="mobile">
  <div class="media-left">
    <a href="#">
      <img class="media-object" height="40%" src="profile/user_{{gender}}.png" alt="profile pic">
    </a>
  </div>
  <div class="media-body" style="padding-left:5px">
    <h4 class="media-heading">{{name|uppercase}}</h4>
    <p class="text-muted" >Reputation: {{rep}}<br>
                    Gender :{{gender|capitalize}}<br>
                    Branch :{{branch}}<br>
                    Date of Birth: {{dob}}</p>
                <a href="#editProfile" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> Edit</a>
      
  </div>
</div>
     
    <div class="col-lg-3" id="profile_info" ng-hide="mobile">
        <div class="panel panel-default">
            <div class="panel-heading" align="middle"><img class="img-thumbnail card-img-top" src="profile/user_{{gender}}.png" alt="Card image cap"></div>
            <div class="panel-body">
                <h4>{{name|uppercase}}</h4>
                <p class="text-muted" >Reputation: {{rep}}<br>
                    
                    Branch :{{branch}}<br>
                    Date of Birth: {{dob}}</p>
                <a href="#editProfile" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                
            </div>
        </div>
        <br>
         <ul class="list-group" ng-hide="mobile">
                <li class="list-group-item list-group-item-info learnest-logo black-label">Your Subscribers</li>                
                <li class="list-group-item justify-content-between" ng-repeat="x in yoursubscribers|limitTo:5">
                    <a href="" ng-click="publicprofile(x.email)" style="color:#403F40">{{x.name|capitalize}}</a><br>
                </li>
                <li  class="list-group-item justify-content-between" ng-show="yoursubscribers.length===0"> You don't have any subscribers</li>
                <li class="list-group-item justify-content-between" ng-show="yoursubscribers.length>5"> <a href="#subscriber">View more</a></li>

            </ul>
    </div>
    <div class="col-lg-6" id="user_uploads" ng-init="fetchClass();fetchUploads(username);fetchSubscribedTeachers();fetchSubscribedStudents();">
        <upload-directive></upload-directive>
        
        <h4 class="lcursive">Your Uploads</h4>
        <hr>
        <users-upload-directive></users-upload-directive>
        
    </div>
    <div class="col-lg-3" id="subscribes">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info learnest-logo black-label" >Your Subscribed Teachers</li>                
                <li class="list-group-item justify-content-between" ng-repeat="subs in subscribedTeachers|limitTo:5">
                    <a href="" ng-click="publicprofile(subs.email)" style="color:#403F40">{{subs.teacherName|capitalize}}</a><br>
                </li>
                <li class="list-group-item justify-content-between" ng-show="subscribedTeachers.length===0"> You haven't subscribed any teachers</li>
<li class="list-group-item justify-content-between" ng-show="subscribedTeachers.length>5"> <a href="#subscribed">View more</a></li>

            </ul>
        
            <ul class="list-group">
                <li class="list-group-item list-group-item-info learnest-logo black-label">Your Subscribed Students</li>                
                <li class="list-group-item justify-content-between" ng-repeat="stu in subscribedStudents|limitTo:5">
                    <a href="" ng-click="publicprofile(stu.email)" style="color:#403F40">{{stu.userName|capitalize}}</a> <br>
                    {{stu.branchName}}
                </li>
<li class="list-group-item justify-content-between" ng-show="subscribedStudents.length===0"> You haven't subscribed any students</li>
<li class="list-group-item justify-content-between" ng-show="subscribedStudents.length>5"> <a href="#subscribed">View more</a></li>

            </ul>
         <ul class="list-group" ng-show="mobile">
                <li class="list-group-item list-group-item-info learnest-logo">Your Subscribers</li>                
                <li class="list-group-item justify-content-between" ng-repeat="x in yoursubscribers|limitTo:5">
               <a href="" ng-click="publicprofile(x.email)" style="color:#403F40">{{x.name|capitalize}}</a><br>
                </li>
                <li  class="list-group-item justify-content-between" ng-show="yoursubscribers.length===0"> You don't have any subscribers</li>
                <li class="list-group-item justify-content-between" ng-show="yoursubscribers.length>5"> <a href="#subscriber">View more</a></li>

            </ul>
        </div>
</div>