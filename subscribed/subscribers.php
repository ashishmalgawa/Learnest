<div class="row" ng-controller="subscribeController" ng-init="fetchYourSubscribers(username);">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8"> 
        <div id="search results">
            <center>
            <h3 class="learnest-logo">Your Subscribers</h3>
            <hr>
            </center>
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
            <center>
                <ul class="pagination">

                    <li><a href="" ng-repeat="x in subscribedpages" ng-click="subscribedpagify(yourSubscribers,x)">{{x}}</a></li>
                </ul>

                <div ng-show="yourSubscribers.length===0" class="lcursive"  style="padding-top:20px">
                    <span class="glyphicon glyphicon-exclamation-sign" style="color:#FF4D45"></span>
                    No Subscribers

                </div>
            </center>
        </div>
    </div>
    <div class="col-sm-2">
    </div>
</div>
