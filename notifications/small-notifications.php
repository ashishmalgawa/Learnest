<!--
<ul class="list-group" >

<li class="list-group-item" >{{newSubscribers[subKeys[0]]}} has Subscribed your profile</li>
<li class="list-group-item" >{{newSubscribers[subKeys[1]]}} has Subscribed your profile</li>
<li class="list-group-item" ng-show="subKeys.length>2"><a href="" ng-click="publicprofile(subNotName.email)">{{subNotName.name}}</a> and <a href="">{{subKeys.length-1}} others</a> have subscribed you </li>
</ul>
-->
<div class="roundspin" ng-hide="newSubscribers||nonotifications||filenotification">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
  <div ng-show="nonotifications" style="height:80px;padding-left:4px;padding-right:4px;padding-top:5px;">
        <center>
        <h3 class="lcursive"> <span class="glyphicon glyphicon-exclamation-sign" style="color:#1681FF"></span>
                You have no notifications</h3>
        </center>
    </div>
<div ng-show="newSubscribers" ng-hide="nonotifications" style="padding-left:15px;padding-right:15px;">
    <div style="padding-top:15px"></div>
        <p ng-show="subKeys.length===1"><a href="" ng-click="publicprofile(subNotNames[0].email)">{{subNotNames["0"].name}}</a> has Subscribed your profile</p>
    
    <div ng-show="subKeys.length===2">
        <p><a href="" ng-click="publicprofile(subNotNames[0].email)">{{subNotNames["0"].name}}</a> has Subscribed your profile</p>
    <hr>
        <p ><a href="" ng-click="publicprofile(subNotNames[1].email)">{{subNotNames["1"].name}}</a> has Subscribed your profile</p>
    </div>
    <p  ng-show="subKeys.length>2"><a href="" ng-click="publicprofile(subNotNames[0].email)">{{subNotNames["0"].name}}</a> and <a href="#subscriber ">{{subKeys.length-1}} others</a> have subscribed your profile  </p>

    <hr ng-show="subKeys.length>0&&filenotification"/>
    <div ng-show="filenotification">
        <div ng-repeat="(y,x) in filenumbers">
            <p ng-show="x.number===1">a new file has been uploaded in <a href="" ng-click="subjectView(y)">{{x.name}}</a></p>
            <p ng-hide="x.number===1">{{x.number}} new files have been uploaded in <a href="" ng-click="subjectView(y)">{{ x.name}}</a></p>
            <hr ng-hide="$last">
        </div>
    </div>
    <div style="padding-top:4px"></div>
</div>
<button class="btn btn-block"  ng-hide="nonotifications" ng-show="newSubscribers||filenotification" ng-click="clearnotifications()">Clear all notifications</button>