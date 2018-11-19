<div class="container">
    <ol class="breadcrumb" ng-show="tsub">
  
  <li class="breadcrumb-item active" ng-show="tsub"><a href="" ng-click="fetchSubject(tsemr);">{{tsemr.substring(0,tsemr.length-1)}} Semester {{tsemr.substring(tsemr.length-1)}}</a></li>
<li class="breadcrumb-item active" ng-show="tfiles">{{tcurrSubjectName}}</li>
                <select ng-show="tfiles" ng-model="filter" ng-init="filter='All'">
                    <option value="All">All</option>
                    <option value="videos">Videos</option>
                    <option value="book">Books</option>
                    <option value="others">Others</option>   
                    
                </select>
                    <select ng-show="tfiles" ng-model="filter_year">
                        <option value="true" disabled>select a year</option>
                    <option value="{{now}}" ng-selected="filter_year">{{now}}</option>
                    <option value="{{now-1}}">{{now-1}}</option>
                    <option value="{{now-2}}">{{now-2}}</option>
                    <option value="{{now-3}}">{{now-3}}</option>   
                </select>
                </ol>
    <center>
        <div class="learnest-logo" ng-show="files" style="font-size :25px;">{{tcurrSubjectName}}</div>
        <div class="learnest-logo" ng-hide="files" style="font-size :25px;">{{tsemr.substring(0,tsemr.length-1)}} Semester {{tsemr.charAt(tsemr.length-1)}}</div>

    </center>
    <hr>
        
        <div class="row" ng-show="tsub">
                
                <div  ng-repeat="s in lsubject" ng-hide="tfile_flag">
                    
                    <div class="col-sm-3">
                        <center>
                            
                            <a href="" ng-click="tfetchSubjectFile(s.subjectid,s.subName);"><span style="font-size:55px;" class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            <br>
                                {{s.subName}}    
                            </a>
                        </center>
                    
                    </div>
                  </div>
            </div>
            <div class="row" ng-show="tsub">
                <div ng-repeat="s in rsubject" ng-hide="tfile-flag">
                    <div class="col-sm-3">
                        <center>
                            <a href="" ng-click="tfetchSubjectFile(s.subjectid,s.subName);"><span style="font-size:55px;" class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            <br>
                                {{s.subName}}    
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
                <div ng-show="tfile_flag">
                    <div class="roundspin" ng-show="logo_flag1">
  <div class="double-bounce1"></div>
  <div class="double-bounce2"></div>
</div>
                <div class="row">
                                            <div ng-repeat="f in tsubjectFile" >
                            <div ng-repeat="f1 in f" >
                                <center>
<a href="" ng-switch="f1.ext" ng-click="viewFile(f1.author,f1.timestamp,tcurrSubject,f1.dname);" ng-show="(f1.file_type===filter||filter==='All')&&((mysqlTimestampToDate(f1.timestamp)|date:'yyyy')===filter_year)" class="col-sm-3" >
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
</div>