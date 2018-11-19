
<center><h2 class="learnest-logo" name="newsfeed">news feed</h2>
</center>
<hr>
<div class="padding-40" >

    <div ng-repeat="n in nfthispagesitems">
        <!-- Update  -->
            <div class="media shadow" >
  <div class="media-left" style="padding-left:4px;padding-top:4px;">
    <a href="" ng-click="publicprofile(n.email)">
      <img  class="img-circle" ng-src="{{'profile/user_'+n.gender}}.png" width="100" height="100" alt="...">
       
    </a>
       <center>
        <a href="" ng-click="publicprofile(n.email)">{{n.name|capitalize}}</a>
        </center>
  </div>
  <div class="media-body">
       <div class="media" style="padding-left:50px;padding-top:10px">
  <div class="media-left">
    <a href="" ng-switch="n.ext" tooltip title="click here to download this file" ng-click="viewFile(n.authorid,n.timestamp,n.subjectid,n.dname);" data-placement="right">
            <h4>
                        <span class="fa fa-file-word-o text-primary" ng-switch-multiple-when="types.doc"></span>
                        <span class="fa fa-file-excel-o text-success" ng-switch-multiple-when="types.xls"></span>
                        <span class="fa fa-file-powerpoint-o text-danger" ng-switch-multiple-when="types.ppt"></span>
                        <span class="fa fa-file-pdf-o text-danger" href="#" ng-switch-when="pdf"></span>
                        <span class="fa fa-file-archive-o text-muted"ng-switch-multiple-when="types.zip"></span>
                        <span class="fa fa-file-code-o text-info" ng-switch-multiple-when="types.htm"></span>
                        <span class="fa fa-file-text-o text-info" ng-switch-multiple-when="types.txt"></span>
                        <span class="fa fa-file-movie-o text-warning" ng-switch-multiple-when="types.vid"></span>
                        <span class="fa fa-file-audio-o text-warning" ng-switch-multiple-when="types.aud"></span>
                        <span class="fa fa-file-photo-o text-danger" ng-switch-multiple-when="types.img"></span>
                        <span class="fa fa-file" ng-switch-default></span>
                </h4>
               
      </a>
  </div>
  <div class="media-body">
      <h4><div class="media-heading">{{n.title|capitalize}}</div></h4>
      <p class="text-muted">Description: {{n.description}}<br>
      Uploaded in: <a href="" ng-click="subjectView(n.classid)">{{n.className}}</a>/{{n.subjectName}}<br>
      Uploaded on: {{mysqlTimestampToDate(n.timestamp).toDateString()}}</p>
      <p></p>
  </div>
</div>

  </div>
</div>
        <br>
        
    </div>
    <center>
          <ul class="pagination">
                    
                  <li><a  ng-repeat="x in newsfeedpages" ng-click="nfpagify(newsfeed,x)">{{x}}</a></li>
                </ul>
    <div class="lcursive" ng-show="newsfeed.length===0">
    
           <span class="glyphicon glyphicon-exclamation-sign" style="color:#1681FF"></span>
                Subscribe some people to populate newsfeed
    
    </div>
    </center>

</div>




