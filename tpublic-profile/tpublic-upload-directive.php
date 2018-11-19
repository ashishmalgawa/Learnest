<div id="accordion" class="panel-group">
        <div class="panel panel-default" ng-repeat="u in puthispagesitems">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <!--target="_self" is for turning of angular route for this particular link-->
                    <a data-toggle="collapse" data-parent="#accordion" target="_self" href="#{{$index}}"> 
                        <span class="glyphicon glyphicon-film"  ng-show="u.file_type=='video'"></span>
                        <span class="glyphicon glyphicon-book"  ng-show="u.file_type=='book'"></span>
                        <span class="glyphicon glyphicon-duplicate" ng-show="u.file_type==='others'"></span>
                        {{u.title}}
                    </a>
                    <small>
                        <a href="" style="position:absolute;right:30px;" ng-click="viewFile(u.authorid,u.timestamp,u.subjectid,u.document_name);"><span class="glyphicon glyphicon-download-alt"></span></a>
                    </small>
                   
                </h4>
            </div>
            <!--in is used to show overview by default-->
            <div id="{{$index}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="media" >
                                  <div class="media-left">
                                    <a href="#">
                                        <span class="glyphicon glyphicon-film" style="font-size:64px" ng-show="u.file_type=='video'"></span>
                                        <span class="glyphicon glyphicon-book" style="font-size:64px" ng-show="u.file_type=='book'"></span>
                                        <span class="glyphicon glyphicon-duplicate" style="font-size:64px" ng-show="u.file_type==='others'"></span>
                                    
                                      </a>
                                  </div>
                                <div class="media-body">
                                <h4 class="media-heading">{{u.title}}  
                                    <a style="position:absolute;right:30px;" ng-click="viewFile(u.authorid,u.timestamp,u.subjectid,u.document_name);"><span class="glyphicon glyphicon-download-alt"></span></a></h4>    
                                <h6>{{u.description}}</h6>
                                <h6 class="text-muted">{{u.numdownloads}} times downloaded                              
                                   
                                </h6>
                            
                            </div>
                        </div>

                </div>
            </div>
            <div class="panel-footer" style="height: 30px;">
                
                <small>{{timeSince(u.timestamp)}}</small>
            </div>
        </div>
    </div>
<center>
<div id="spageination" >
                
                    <ul class="pagination">
                    
                  <li><a href="" ng-repeat="x in puploadpages" ng-click="puploadpagify(puploads,x)">{{x}}</a></li>
                </ul>
                </div>


<h1 class="lcursive" ng-show="puploads.length===0" >    
    <span class="glyphicon glyphicon-exclamation-sign" style="color:#1681FF"></span> {{tpprofile.name}} hasn't uploaded any files yet</h1>
</center>
