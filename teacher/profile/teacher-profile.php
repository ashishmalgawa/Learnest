<!--script for browse button-->
<script type="text/javascript">
    $(document).on('click', '.browse', function(){
        var file = $(this).parent().parent().parent().find('.file');
        file.trigger('click');
    });
    $(document).on('change', '.file', function(){
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
</script>



<div class="row" >

    <div class="media col-lg-3"  style="padding-left:50px;padding-bottom:10px" ng-show="mobile">
        <div class="media-left">
            <a href="#">
                <img class="media-object" height="40%" src="profile/user_{{tpprofile.gender}}.png" alt="profile pic">
            </a>
        </div>
        <div class="media-body" style="padding-left:5px">
            <h4 class="media-heading">{{tpprofile.name|uppercase}}</h4>
            <p class="text-muted" ><b>Subjects:</b><br>
                <span ng-repeat="a in pubtbranch">
                    <i>{{a.bname}}:</i>
                    <span ng-repeat="b in pubbranchwise" ng-show="a.bid==b.pbranch">
                        {{b.psubject}}
                        {{branchwise[$index+1].pbranch==b.pbranch? ', ' : '.'}}
                    </span><br>
                </span><br>
                Date of Birth: {{tpprofile.dob}}</p>     
        </div>
    </div>

    <div class="col-lg-3" id="profile_info" ng-hide="mobile">
        <div class="panel panel-default">
            <div class="panel-heading" align="middle"><img class="img-thumbnail card-img-top" src="profile/user_{{tpprofile.gender}}.png" alt="Card image cap"></div>
            <div class="panel-body">
                <h4>{{tpprofile.name|uppercase}}</h4>
                <p class="text-muted" >
                    <b>Subjects:</b><br>
                    <span ng-repeat="a in pubtbranch">
                        <i>{{a.bname}}:</i>
                        <span ng-repeat="b in pubbranchwise" ng-show="a.bid==b.pbranch">
                            {{b.psubject}}
                            {{branchwise[$index+1].pbranch==b.pbranch? ', ' : '.'}}
                        </span><br>
                        Date of Birth: {{tpprofile.dob}}
                        </p>

            </div>
        </div>
        <br>

    </div>
    <div class="col-lg-6" id="user_uploads" ng-init="fetchUploads(tpprofile.username);">

        <h4 class="lcursive">{{tpprofile.name | capitalize}}'s Uploads</h4>
        <hr>
        <tpublic-upload-directive></tpublic-upload-directive>

    </div>
    <div class="col-lg-3" id="subscribes">



    </div>
</div>