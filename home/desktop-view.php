<div class="row row-content" >
            <div class="col-sm-2" id="cards">
                <cards></cards><!--Cards will come here-->
                
            </div>
            <div class="col-sm-7" id="newsfeed">

            <news-feed ng-hide="sub"></news-feed>
                <ol class="breadcrumb my-bread" ng-show="sub">
  <li class="breadcrumb-item"><a href="" ng-click="back();">Home</a></li>
  <li class="breadcrumb-item"><a href="">{{currentclass}} year</a></li>
  <li class="breadcrumb-item active" ng-show="sub"><a href="" ng-click="showSub(semr);">Semester {{semr.slice(semr.length-1,semr.length)}}</a></li>
<li class="breadcrumb-item active" ng-show="files">{{currSubjectName}}</li>
                <select ng-show="files" ng-model="filter" ng-init="filter='All'" data-toggle="tooltip" data-palcement="bottom" title="filter documents by type">
                    <option value="All">All</option>
                    <option value="videos">Videos</option>
                    <option value="book">Books</option>
                    <option value="others">Others</option>

                </select>   
                    <select ng-show="files" ng-model="filter_year" data-toggle="tooltip" data-placement="bottom" title="filter documents by year">
                        <option value="true" disabled>select a year</option>
                    <option value="{{now}}" >{{now}}</option>
                    <option value="{{now-1}}">{{now-1}}</option>
                    <option value="{{now-2}}">{{now-2}}</option>
                    <option value="{{now-3}}">{{now-3}}</option>
                </select>
                </ol>
                
                <div class="row" ng-show="sub">

                <div  ng-repeat="s in lsubjects" ng-hide="file_flag">

                    <div class="col-sm-3">
                        <center>

                            <a href="" ng-click="fetchSubjectFile(s.subjectId,s.subjectName);"><span style="font-size:55px;" class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            <br>
                                {{s.subjectName}}
                            </a>
                        </center>

                    </div>
                  </div>
            </div>
            <div class="row" ng-show="sub">
                <div ng-show="sub" ng-repeat="s in rsubjects" ng-hide="file-flag">
                    <div class="col-sm-3">
                        <center>
                            <a href=""><span style="font-size:55px;" class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            <br>
                                {{s.subjectName}}
                            </a>
                        </center>

                    </div>
                  </div>
            </div>
                
                <div class="roundspin" ng-show="logo_flag">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
                

<!-- FILES START-->
                <div ng-show="file_flag">
                    <div class="roundspin" ng-show="logo_flag1">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
                <div class="row">
                                            <div ng-repeat="f in subjectFile" >
                            <div ng-repeat="f1 in f" >
                                <center>
<a href="" ng-switch="f1.ext" ng-show="(f1.file_type===filter||filter==='All')&&((mysqlTimestampToDate(f1.timestamp)|date:'yyyy')===filter_year)" ng-click="viewFile(f1.author,f1.timestamp,currSubject,f1.dname);" class="col-sm-3" >
            <h5>
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
                </h5>
               {{f1.fileName}}
    <!--{{now|date:'y'}}
    {{(mysqlTimestampToDate(f1.timestamp)|date:'yyyy')}}
    {{filter_year}}-->
      </a>

                                </center>
                            </div>
                        </div>


                    </div>
                </div>
<!--FILES END-->
            </div>
            <div class="col-sm-3">
              <ul class="list-group">
              <li class="list-group-item list-group-item-info learnest-logo black-label"><center>Top ten Uploaders</center></li>
<li class="list-group-item justify-content-between" ng-repeat="x in top10">
    <a href="" ng-click="publicprofile(x.email)" style="color:#403F40">{{x.name}}</a><br>
    {{x.branch}}
<span class="badge badge-default badge-pill" tooltop title="reputation" data-placement="top">{{x.rep}}</span>
</li>

</ul>
            </div>
    </div>
