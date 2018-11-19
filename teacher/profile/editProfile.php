<div class="container" ng-controller="editPageCtrl as con" ng-init="con.fetchAllSubjects()">
    <h1>Edit Profile</h1>
    <hr>
    <div class="row">

        <div class="col-md-3">
            <div class="text-center">
                <img ng-src="profile/user_{{con.gender}}.png" class="avatar img-circle" height="30%">
            </div>
        </div>


        <div class="col-md-9 personal-info">

            <h3>Personal Info</h3>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label">User Name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" ng-value="username" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" ng-value="email" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" ng-model="con.name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Contact:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" ng-model="con.contact" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Subjects:</label>
                    <div class="col-lg-8">
                        <ol class="nya-bs-select" data-size="5" ng-model="con.newTeacherSubjects" data-live-search="true" style="width:100%" data-selected-text-format="values" multiple>
                            <li nya-bs-option="option in allSubjects group by option.classid">
                                <span class="dropdown-header">{{$group}}</span> <!-- group header cannot be searched -->
                                <a>
                                    <span>{{ option.sname }}</span> <!-- this content will be search first -->
                                    <span class="small">{{ option.sid }}</span> <!-- if the name failed, this will be used -->
                                    <span class="glyphicon glyphicon-ok check-mark"></span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">DOB:</label>
                    <div class="col-lg-8">
                        <input type="date" ng-model="con.dob"  class="form-control" id="dob" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Gender:</label>
                    <div class="col-xs-4"><input type="radio" ng-model="con.gender" id="gender" value="male">Male</div>
                    <div class="col-xs-4"><input type="radio" ng-model="con.gender" id="gender" value="female">Female</div>
                </div>

                


                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="button" class="btn btn-primary" value="Save Changes" ng-click="updateProfile();">
                        <span></span>
                        <a class="btn btn-default" href="#profile">Cancel</a>
                    </div>
                </div>
            </form>
            <h3 class="lcursive">More Settings</h3>
            <hr>
            <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal1">Change Password</button>

            <div id="myModal1" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal" role="form" style="padding-left:40px;padding-right:40px;" ng-submit="changePass()">
                                <div class="form-group" >


                                    <input class="form-control" type="password" ng-model="opass" value="" placeholder="old password" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" ng-model="npass" value="" placeholder="new password">
                                </div>
                                <div class="form-group" >
                                    <input class="form-control" type="password" value="" ng-model="cpass" placeholder="re-enter password">
                                </div>
                                <div class="form-group" style="padding-top:5px;padding-left:60px;padding-right:60px;">
                                    <input class="form-control btn btn-success" type="submit" value="Change Password">
                                </div>
                            </form> 
                        </div>
                    </div>

                </div>
            </div>


            <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal2" ng-click="getPro();">Unlink/link Account</button>

            <!-- Modal -->
            <div id="myModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Unlink/Link Account</h4>
                        </div>
                        <div class="modal-body">
                            {{nullprovide[0]}}
                            <div ng-repeat="provider in providers" ng-hide="nullprovide[1]">
                                <a href=""  ng-click="unlink(provider)" >Unlink with {{provider.substring(0,(provider.length)-4)}}</a><br> 
                            </div> 
                            <div ng-repeat="provider in allproviders" >
                                <a href=""  ng-click="link(provider)" >Link with {{provider.substring(0,(provider.length)-4)}}</a><br> 
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="msg" >

                                {{msg}}<strong>!</strong> 
                            </div>
                           


                        </div>
                    </div>

                </div>
            </div>


            <!--<label class="row control-label" role="button" ng-click="deleteAcc()">Delete My Account</label>
-->
            <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">Delete My Account</button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Verify your Account</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form class="form-horizontal" ng-submit="deleteAcc()" role="form">
                                    <div class="form-group">
                                        <label>Enter Password</label>
                                        <input type="text" ng-model="dpass" value="">
                                    </div>
                                    <input type="submit" value="Verify and delete" class="btn btn-success">

                                </form>
                            </center>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>  