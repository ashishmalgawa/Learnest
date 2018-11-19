<link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">
<div class="panel panel-default" >
                <div class="panel-body">
                <ul class="nav nav-pills nav-stacked" ng-repeat="b in tbranch">
  <li role="presentation" id="">
<!--
      <img class="img img-responsive" src="assets/img/year/second.png" alt="branch 1" role="button" ng-click="tsemshow(b.bname,b.bid);">
      
-->
      <div class="lala" role="button" ng-click="tsemshow(b.bname,b.bid);">
           {{b.bname}}</div></li>
                    <br>
                
                                    
                <ul class="list-group" ng-show="(tsemsitem===b.bname)&&tsemopen">
  <div ng-repeat="s in tsem">
                    <li class="list-group-item">
    <a  href="" ng-click="fetchSubject(s.classid);" target="_self">{{s.cname}}</a>
  </li>
                    </div>
</ul>
             </ul>       
                </div>
            </div>