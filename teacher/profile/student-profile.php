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
      <img class="media-object" height="40%" src="profile/user_{{pprofile.gender}}.png" alt="profile pic">
    </a>
  </div>
  <div class="media-body" style="padding-left:5px">
    <h4 class="media-heading">{{pprofile.name|uppercase}}</h4>
    <p class="text-muted" >Reputation: {{pprofile.rep}}<br>
                    Branch :{{pprofile.branch}}<br>
        Date of Birth: {{pprofile.dob}}</p>
      
  </div>
</div>
     
    <div class="col-lg-3" id="profile_info" ng-hide="mobile">
        <div class="panel panel-default">
            <div class="panel-heading" align="middle"><img class="img-thumbnail card-img-top" src="profile/user_{{pprofile.gender}}.png" alt="Card image cap"></div>
            <div class="panel-body">
                <h4>{{pprofile.name|uppercase}}</h4>
                <p class="text-muted" >Reputation: {{pprofile.rep}}<br>
                    Branch :{{pprofile.branch}}<br>
                    Date of Birth: {{pprofile.dob}}</p>
            </div>
        </div>
        <br>
        
    </div>
    <div class="col-lg-6" id="user_uploads" >
       
        <h4 class="lcursive">{{pprofile.name}}'s Uploads</h4>
        <hr>
        <public-upload-directive></public-upload-directive>
        
    </div>
    <div class="col-lg-3" id="subscribes">
            
        
            
        </div>
</div>