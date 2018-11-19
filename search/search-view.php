<div ng-controller="searchController as sc" class="row" ng-init="searchtimes=1" >
    <div class="col-sm-3">
        <!--style="background-image: url(assets/img/backgrounds/chalkboard-backgrounds/chalkboard-black.jpg);color:white-->
        <div class="panel panel-default" >
            <div class="panel-heading" style="background-image: url(assets/img/backgrounds/chalkboard-backgrounds/chalkboard-black.jpg);color:white" >
                Advanced Search

            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" id="advstudents"><a href="" ng-click="advSearch('students')"  target="_self"><span class="glyphicon glyphicon-user"></span> Students</a></li>
                </ul>
                <div ng-show="(advsitem==='students')&&advopen">

                    <ul class="list-group">
                        <form role="form"  method="post"  ng-submit="sc.doAdvSearch('students')">
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.name" placeholder="Name..*"></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.email" placeholder="Email..*"></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.username" placeholder="Username..*"></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.contact" placeholder="Contact Number..*"></li>
                            <li class="list-group-item">
                                <select class="form-control" id="sel1" ng-model="sc.degree" >
                                    <option value=""  selected>Branch...</option>
                                    <option ng-repeat="x in degrees" value="{{x.iddegrees}}">{{x.name}}</option>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-block btn-primary" type="submit">Search</button>
                                <center><small ng-attr-style="{{sc.studerror}}">* atleast one of these is necessary</small></center>
                            </li>
                        </form>
                    </ul>    

                </div>    
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" id="advteachers"><a href="" target="_self" ng-click="advSearch('teachers')"><span class="glyphicon glyphicon-education"></span> Teachers</a></li>
                </ul>
                <div ng-show="(advsitem==='teachers')&&advopen">
                    <ul class="list-group">
                        <form role="form"  method="post"  ng-submit="sc.doAdvSearch('teachers')">
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.name" placeholder="Name.."></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.email" placeholder="Email.."></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.username" placeholder="Username.."></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.contact" placeholder="Contact Number.."></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.subject" placeholder="Subject.."></li>
                            <li class="list-group-item">
                                <select class="form-control" id="sel1" ng-model="sc.degree" >
                                    <option value=""  selected>Branch...</option>
                                    <option ng-repeat="x in degrees" value="{{x.iddegrees}}">{{x.name}}</option>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-block btn-primary" type="submit">Search</button>
                                <center><small ng-attr-style="{{sc.teacherror}}" ng-show="sc.teachflag">Please fill atleast one of the fields</small></center>

                            </li>
                        </form>
                    </ul>             
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" id="advfiles"><a href="" target="_self" ng-click="advSearch('files')"><span class="glyphicon glyphicon-file"></span> Files</a></li>
                </ul>
                <div ng-show="(advsitem==='files')&&advopen">
                    <form ng-submit="sc.doAdvSearch('files')">
                        <ul class="list-group">
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.title" placeholder="Title.."></li>
                            <li class="list-group-item"><input type="text" class="form-control" ng-model="sc.des" placeholder="Description.."></li>
                            <li class="list-group-item"><input type="text" class="form-control"  ng-model="sc.upname" placeholder="Uploader Name.."></li>
                            <li class="list-group-item"><input type="text" class="form-control"  ng-model="sc.subject" placeholder="Subject.."></li>
                            <li class="list-group-item">
                                <select class="form-control" id="sel1" ng-model="sc.degree" >
                                    <option value=""  selected>Branch...</option>
                                    <option ng-repeat="x in degrees" value="{{x.iddegrees}}">{{x.name}}</option>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <select class="form-control" id="sel1" ng-model="sc.filetype" >
                                    <option value=""  selected>File Type...</option>
                                    <option  value="video">Video</option>
                                    <option  value="book">Book</option>
                                    <option  value="others">Others</option>
                                </select>
                            </li>
                            <li class="list-group-item"><button class="btn btn-block btn-primary" type="submit">Search</button>
                            <center><small ng-attr-style="{{sc.fileerror}}" ng-show="sc.fileflag">Please fill atleast one of the fields</small></center>
                            </li>
                            
                        </ul>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6">    
        <div id="search results" ng-hide="adv">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" ng-hide="adv">
                <li class="active">
                    <a class="nav-link" target="_self" data-toggle="tab" href="#searchstudents" ng-click="doSearch('students',1)" id="sstudents" role="tab"><span class="glyphicon glyphicon-user"></span> Students</a>
                </li>
                <li>
                    <a target="_self"  class="nav-link" data-toggle="tab" ng-click="doSearch('teachers',1)" href="#searchteachers" id="steachers"  role="tab"><span class="glyphicon glyphicon-education"></span> Teachers</a>
                </li>
                <li>
                    <a class="nav-link"  target="_self"  data-toggle="tab" ng-click="doSearch('files',1)" href="#searchfiles" id="sfiles" role="tab"><span class="glyphicon glyphicon-file"></span> Files</a>
                </li> 
                <li>
                    <a class="nav-link"  target="_self"  data-toggle="tab" ng-click="doSearch('classes',1)" href="#searchclasses" id="sclasses" role="tab"><span class="glyphicon glyphicon-leaf"></span> Classes</a>
                </li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content" ng-hide="searchloader">
                <div class="tab-pane active" id="searchstudents" role="tabpanel">
                    <br>
                    <div  ng-repeat="x in thispagesitems" >
                        <div style="border-radius: 5px;border: 1px solid #BABFBE;">

                            <div class="media" style="padding-top:20px;padding-left:10px"  >
                                <div class="media-left">
                                    <a href="" ng-click="publicprofile(x.email)">
                                        <img class="media-object" src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                        <img class="media-object" src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">

                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a ng-click="publicprofile(x.email)">{{x.name}}</a></h4>
                                    <h6 >{{x.email}} </h6>
                                    <h6 class="text-muted">reputation:{{x.rep}}  </h6>
                                </div>

                            </div>

                        </div>
                        <br>
                    </div>


                </div>
                <div class="tab-pane" id="searchteachers" role="tabpanel">
                    <br>
                    <div ng-repeat="x in thispagesitems">
                        <div style="border-radius: 5px;border: 1px solid #BABFBE;">

                            <div class="media" style="padding-top:20px;padding-left:15px">
                                <div class="media-left">
                                    <a href="#" >
                                        <img class="media-object" src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                        <img class="media-object" src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">

                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="" ng-click="publicprofile(x.email)">{{x.name}}</a></h4>
                                    <h6 >{{x.email}} </h6>
                                    <h6 class="text-muted">{{x.contact}} </h6>
                                    Subjects: <a href="#" ng-repeat="s in x.subjects">{{s.subject}} </a>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>

                </div> 
                <div class="tab-pane" id="searchclasses" role="tabpanel">
                    <br>
                    <div ng-repeat="x in thispagesitems">
                        <div style="border-radius: 5px;border: 1px solid #BABFBE;">

                            <div class="media" style="padding-top:20px;padding-left:15px">
                                <div class="media-left">
                                    <a href="#" ng-click="subjectView(x.classid)">
                                        <i class="fa fa-university" aria-hidden="true" height="56px" width="56px"></i>

                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="" ng-click="subjectView(x.classid)">{{x.classname}}</a></h4>
                                  
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>

                </div>
                <div class="tab-pane" id="searchfiles" role="tabpanel">

                    <br>          
                    <div class="panel panel-default" ng-repeat="u in thispagesitems">

                        <!--in is used to show overview by default-->
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
                                    <h5 class="media-heading">{{u.title}}  
                                        <a style="position:absolute;right:30px;" ng-click="viewFile(u.authorid,u.timestamp,u.subjectid,u.document_name);"><span class="glyphicon glyphicon-download-alt"></span></a></h5>    
                                    <h6 class="text-muted">{{u.description}}</h6>
                                    <h6 class="text-muted">                              
                                        {{u.subject}}
                                    </h6>

                                </div>
                            </div>

                        </div>

                        <div class="panel-footer" style="height: 30px;">
                            <small >{{stimeSince(u.timestamp)}}</small>
                            <small style="position:absolute;right:50px; ">{{u.numdownloads}} times downloaded</small>
                        </div>
                    </div>


                </div>
                <center>
                    <div id="spageination" ng-show="!stempty&&(searchresults.length!==0&&searchresults!==undefined)">

                        <ul class="pagination">

                            <li><a href="" ng-repeat="x in searchpages" ng-click="pagify(searchresults,x)">{{x}}</a></li>
                        </ul>
                    </div>
                    <div ng-show="searchresults.length===0&&!stempty" class="lcursive"  style="padding-top:20px">
                        <span class="glyphicon glyphicon-exclamation-sign" style="color:#FF4D45"></span>
                        There aren't any items which match given criteria

                    </div>
                </center>
            </div>
        </div>
        <div id="advanced search results" ng-show="adv">

            <div  class="learnest-logo" style="font-size:20px">
                <center>Advanced Search Results</center>
                <hr>
            </div>

            <!-- Tab panes -->
            <div  ng-hide="searchloader">
                <div  id="searchstudents" ng-show="searchadvsucc==='student'">
                    <br>
                    <div  ng-repeat="x in thispagesitems" >
                        <div style="border-radius: 5px;border: 1px solid #BABFBE;">

                            <div class="media" style="padding-top:20px;padding-left:10px"  >
                                <div class="media-left">
                                    <a href="" ng-click="publicprofile(x.email)">
                                        <img class="media-object" src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                        <img class="media-object" src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">

                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a ng-click="publicprofile(x.email)">{{x.name}}</a></h4>
                                    <h6 >{{x.email}} </h6>
                                    <h6 class="text-muted">reputation:{{x.rep}}  </h6>
                                </div>

                            </div>

                        </div>
                        <br>
                    </div>


                </div>
                <div  id="searchteachers" ng-show="searchadvsucc==='teacher'">
                    <br>
                    <div ng-repeat="x in thispagesitems">
                        <div style="border-radius: 5px;border: 1px solid #BABFBE;">

                            <div class="media" style="padding-top:20px;padding-left:15px">
                                <div class="media-left">
                                    <a href="#" >
                                        <img class="media-object" src="profile/user_male.png" ng-show="x.gender==='male'" alt="user-pic" height="64px" width="64px">
                                        <img class="media-object" src="profile/user_female.png" ng-show="x.gender==='female'" alt="user-pic" height="64px" width="64px">

                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="" ng-click="publicprofile(x.email)">{{x.name}}</a></h4>
                                    <h6 >{{x.email}} </h6>
                                    <h6 class="text-muted">{{x.contact}} </h6>
                                    Subjects: <a href="#" ng-repeat="s in x.subjects">{{s.subject}} </a>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>

                </div>
                <div id="searchfiles" ng-show="searchadvsucc==='files'">

                    <br>          
                    <div class="panel panel-default" ng-repeat="u in thispagesitems">

                        <!--in is used to show overview by default-->
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
                                    <h5 class="media-heading">{{u.title}}  
                                        <a style="position:absolute;right:30px;" ng-click="viewFile(u.authorid,u.timestamp,u.subjectid,u.document_name);"><span class="glyphicon glyphicon-download-alt"></span></a></h5>    
                                    <h6 class="text-muted">{{u.description}}</h6>
                                    <h6 class="text-muted">                              
                                        {{u.subject}}
                                    </h6>

                                </div>
                            </div>

                        </div>

                        <div class="panel-footer" style="height: 30px;">
                            <small >{{stimeSince(u.timestamp)}}</small>
                            <small style="position:absolute;right:50px; ">{{u.numdownloads}} times downloaded</small>
                        </div>
                    </div>


                </div>
                <center>
                    <div id="spageination" ng-show="!stempty&&(searchresults.length!==0&&searchresults!==undefined)">

                        <ul class="pagination">

                            <li><a href="" ng-repeat="x in searchpages" ng-click="pagify(searchresults,x)">{{x}}</a></li>
                        </ul>
                    </div>
                    <div ng-show="searchresults.length===0&&!stempty" class="lcursive"  style="padding-top:20px">
                        <span class="glyphicon glyphicon-exclamation-sign" style="color:#FF4D45"></span>
                        There aren't any items which match given criteria

                    </div>
                </center>
            </div>
        </div>

        <div id="search loading" ng-show="searchloader">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
            <center><small>Please wait ...</small></center>
        </div>


    </div>

    <div class="col-sm-3">
    </div>    
</div>