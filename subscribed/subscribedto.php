<div class="row" ng-controller="subscribeController" ng-init="fetchTopSubscribedUser();yourSubscribed('student');">
    <div class="col-sm-3">
        <ul class="list-group">
            <li class="list-group-item list-group-item-info">Top Subscribed Students</li>                
            <li class="list-group-item justify-content-between" ng-repeat="sub in topSubscribedUser">
                {{sub.subscribedTo|capitalize}}<br>
            </li>

        </ul>
    </div>
    <div class="col-sm-9"> 
        <div id="search results">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a class="nav-link" target="_self" data-toggle="tab" href="#subsStudents" ng-click="yourSubscribed('student')" role="tab"><span class="glyphicon glyphicon-user"></span> Students</a>
                </li>
                <li>
                    <a target="_self"  class="nav-link" data-toggle="tab" ng-click="yourSubscribed('teacher')" href="#subsTeachers" role="tab"><span class="glyphicon glyphicon-education"></span> Teachers</a>
                </li>
                <li>
                    <a class="nav-link"  target="_self"  data-toggle="tab" ng-click="yourSubscribed('class')" href="#subsClasses" role="tab"><span class="glyphicon glyphicon-leaf"></span> Classes</a>
                </li>
            </ul>
                     
            <!-- Tab panes -->
            <div class="tab-content" ng-hide="searchloader">
                <div class="tab-pane active" id="subsStudents" role="tabpanel">
                    <br>
                    <div class="row" ng-repeat="u in subthispagesitems">
                        <div class="col-md-2" ng-repeat="x in u">
                            <center>    
                            <img src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                <img src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">
                                
                            </center>
                            <div class="caption" style="padding-top:4px;">
                                    <h5 class="media-heading"><center>
                                        <a href="" popover  data-trigger="hover" data-html="true" data-selector=""
                                        data-original-title="<center>{{x.name}}</center>" data-placement="bottom" 
                                       data-content="<center><p class='text-muted'>{{x.email}}</p>
                                                     <p class='text-muted'>{{x.branch}}
                                                     </p><p class='text-muted'>rep:{{x.rep}}</p></center>"
                                       ng-click="publicprofile(x.email)">{{x.name}}</a></center></h5>
                                </div>

                        </div>
                        </div>
                     
               
              
                    <br>
                </div>
                <div class="tab-pane" id="subsTeachers" role="tabpanel">
                    <br>
                    <div class="row" ng-repeat="u in subthispagesitems">
                        <div class="col-md-2" ng-repeat="x in u">
                            <center>    
                            <img src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                <img src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">
                                
                            </center>
                            <div class="caption" style="padding-top:4px;">
                                    <h5 class="media-heading"><center><a href="" title="Header" data-toggle="popover" data-trigger="hover" data-content="Some content" ng-click="publicprofile(x.email)">{{x.name}}</a></center></h5>
                                </div>
                        </div>
                        </div>

                </div>
                <div class="tab-pane" id="subsClasses" role="tabpanel">

                    <br>          
                      <div class="row" ng-repeat="u in subthispagesitems">
                        <div class="col-md-2" ng-repeat="x in u">
                            <center>  
                                <a>
                            <span class="glyphicon glyphicon-folder-open" style="font-size:64px"></span>  </a>
                            </center>
                            <div class="caption" style="padding-top:10px;">
                                    <h5 class="media-heading"><center><a href="" ng-click="subjectView(x.classid)">{{x.name}}</a></center></h5>
                                </div>
                        </div>
                        </div>


                </div>
                <center>
                    <ul class="pagination">
                    
                  <li><a href="" ng-repeat="x in subscribedpages" ng-click="subscribedpagify(yourSubscribes,x)">{{x}}</a></li>
                </ul>
                    
                    <div ng-show="yourSubscribes.length===0" class="lcursive"  style="padding-top:20px">
                        <span class="glyphicon glyphicon-exclamation-sign" style="color:#FF4D45"></span>
                        You haven't subscribed any {{$scope.subtype}}

                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
