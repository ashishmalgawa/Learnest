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
<div class="row" ng-controller="profileController" ng-init="fetchBranchwiseSubject(username);fetchAllBranch();">
    <div class="media col-lg-3"  style="padding-left:50px;padding-bottom:10px" ng-show="mobile">
        <div class="media-left">
            <a href="#">
                {{username}}
                <img class="media-object" height="40%" ng-src="profile/user_{{gender}}.png" alt="profile pic">
            </a>
        </div>
        <div class="media-body" style="padding-left:5px">
            <h4 class="media-heading">{{name| capitalize}}</h4>
            <p class="text-muted" >
                <b>Subjects:</b><br>
                <span ng-repeat="a in tbranch">
                    <i>{{a.bname}}:</i>
                    <span ng-repeat="b in branchwise" ng-show="a.bid==b.pbranch">
                        {{b.psubject}}
                        {{branchwise[$index+1].pbranch==b.pbranch? ', ' : '.'}}
                    </span><br>
                </span>
                <b>Date of Birth:</b>{{dob}}<br>
                <b>Contact:</b> {{contact}}<br>
                <b>Email:</b> {{email}}
            </p>
            <a class="btn btn-info" href="#editProfile"><span class="glyphicon glyphicon-edit"></span> Edit</a>

        </div>
    </div>

    <div class="col-lg-3" id="profile_info" ng-hide="mobile">
        <div class="panel panel-default">
            <div class="panel-heading" align="middle"><img class="img-thumbnail card-img-top" ng-src="profile/user_{{gender}}.png" alt="Card image cap"></div>
            <div class="panel-body">
                <h4>{{name|uppercase}}</h4>
                <p class="text-muted" >
                    <b>Subjects:</b><br>
                    <span ng-repeat="a in tbranch">
                        <i>{{a.bname}}:</i>
                        <span ng-repeat="b in branchwise" ng-show="a.bid==b.pbranch">
                            {{b.psubject}}
                            {{branchwise[$index+1].pbranch==b.pbranch? ', ' : '.'}}
                        </span><br>
                    </span>
                    <b>Date of Birth:</b>{{dob}}<br>
                    <b>Contact:</b> {{contact}}<br>
                    <b>Email:</b> {{email}}
                </p>
                <a class="btn btn-info" href="#editProfile"><span class="glyphicon glyphicon-edit"></span> Edit</a>

            </div>
        </div>
        <br>

    </div>
    <div class="col-lg-6" id="user_uploads" ng-init="fetchUploads(username);">

        <upload-directive></upload-directive>
        <hr>
        <h4>Your Uploads</h4>
        <users-upload-directive></users-upload-directive>


    </div>
    <div class="col-lg-3" id="subscribes">

        <ul class="list-group" ng-hide="mobile">
            <li class="list-group-item list-group-item-info">Your Subscribers</li>                
            <li class="list-group-item justify-content-between" ng-repeat="x in yoursubscribers[0]|limitTo:5">
                <a href="" ng-click="publicprofile(x.email)" style="color:#403F40" >{{x.name| capitalize}}<br>
            </li>
            <li  class="list-group-item justify-content-between" ng-show="yoursubscribers.length===0"> You don't have any subscribers</li>
            <li  class="list-group-item justify-content-between" ng-show="yoursubscribers.length>5"><a href="#subscriber">View More</a></li>
        </ul>
    </div>
</div>