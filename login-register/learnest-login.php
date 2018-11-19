<!-- Modal -->
<div id="fpass" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send yourselves a password reset link</h4>
            </div>
            <form role="form"  method="post" class="login-form" ng-submit="forgotpassword()">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="sr-only" for="form-username" id="email">Email</label>
                        <input type="email" placeholder="Email..." class="form-control" ng-model="femail" required>
                    </div>
                    <button type="submit" class="btn" >Send Password Reset Link</button>
                    <div ng-show="fpasserror">
                        <hr >
                        <div class="alert alert-danger" >
                            <strong>Some error occurred!</strong> Please check the email you have entered and try again 
                        </div>
                    </div>
                    <div ng-show="fpasssucc">
                        <hr>
                        <div class="alert alert-success" >
                            <strong>Email sent!</strong> 
                        </div>
                    </div>      
                </div>
            </form>

        </div>

    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-sm-offset-3 form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>Login</h3>
                <p>Enter your email and password to log on:</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-key"></i>
            </div>
        </div>
        <div class="form-bottom">
            <form role="form"  method="post" class="login-form" ng-submit="fireLogin()">
                <div class="form-group">
                    <label class="sr-only" for="form-username" id="email">Email</label>
                    <input type="email" placeholder="Email..." class="form-control" ng-model="email" required>
                </div>
                <div class="form-group" >
                    <label class="sr-only " for="form-password" >Password</label>
                    <input type="password" id="password" placeholder="Password..." class="form-control" ng-model="password" required>
                </div>


                <button type="submit" name="person" id="person" class="btn" onclick="this.blur();">Sign in</button>                    
            </form>
            <p><a href="" data-toggle="modal" data-target="#fpass">Forgot your password?</a></p>

            <center>
                <div class="sk-folding-cube" ng-show="loading">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
                <p><a href="#lregister" ng-click="login=false">Create Account</a></p>

                <p>Sign in with <a href="" ng-click="googlelogin()"><span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-google fa-stack-1x"></i>
                    </span></a> 
                    <a href="" ng-click="fblogin()">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-facebook fa-stack-1x"></i>
                        </span>
                    </a></p>
            </center>


            <div class="alert alert-danger alert-dismissable" ng-show="error">

                <strong>Warning!</strong> {{errormsg}}</div>


        </div>
    </div>
</div>
