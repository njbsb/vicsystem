<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-secondary">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h6 class="alert-heading">Oops!</h6>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>
<div class="row">
    <div class="col-md-8 card justify-content-md-center">
        <div class="card-body">
            <h3 class="text-pink">Magic Flick!</h3>
            <h5>An innovative solution to manage your SIG!</h5>
            <img style="max-width: 100%; max-height: 100%; display: block;" src="<?= base_url('assets/images/login.png') ?>" alt="">
        </div>
    </div>
    <div class="col-md-4 col-sm-8">
        <?= form_open('user/login') ?>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center text-pink">Sign In</h3>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" maxlength="8" size="8" class="form-control" placeholder="Enter ID" required autofocus>
                    <div id="usernamemessage" class=""></div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required autofocus>
                    <div id="passwordmessage" class=""></div>
                </div>
                <button disabled type="submit" id="submitbtn" class="btn btn-primary btn-block">Login</button>
                <?= form_close() ?>
                <div class="text-center" style="margin-top:10px;">
                    <a href="#chooseUser" data-toggle="modal" class="text-center">Register here</a>
                </div>

            </div>
        </div>
        <div class="text-center" style="margin-top:10px;">
            <a href="#showForgot" data-toggle="modal" class="text-center">Forgot your password?</a>
        </div>
    </div>
</div>

<div id="chooseUser" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose user type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are a:</p>
                <?= form_open('register') ?>
                <button name="usertype" type="submit" class="btn btn-primary" value="student">Student</button>&nbsp;
                <button name="usertype" type="submit" class="btn btn-primary" value="mentor">Mentor</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<div id="showForgot" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open('resetpassword') ?>
            <div class="modal-header">
                <h5 class="modal-title">Forgot Password?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please fill in the required fields</p>
                <div class="form-group">
                    <label for="user_id"><b>Matric/ID</b></label>
                    <input placeholder="Matric/ID" type="text" name="user_id" id="user_id" class="form-control" maxlength="8" size="8" required>
                </div>
                <div class="form-group">
                    <label for="securitycode"><b>Security code</b></label>
                    <input placeholder="XXXX" type="password" class="form-control" name="securitycode" id="securitycode" maxlength="4" size="4" required>
                    <small>Last 4 digit of your registered phone number</small>
                </div>
                <!-- <small>We will guide you to reset your password</small> -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="submitforgot" type="submit" disabled>Submit</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
var inputuserid = document.getElementById('user_id');
var inputcode = document.getElementById('securitycode');
var inputname = document.getElementById('username');
var inputpassword = document.getElementById('password');
var submitbtn = document.getElementById('submitbtn')
var submitforgot = document.getElementById('submitforgot')
var usernamemessage = document.getElementById("usernamemessage");
var passwordmessage = document.getElementById("passwordmessage");

function checkUsername() {
    var username = $('#username').val();
    if (username == '') {
        inputname.className = 'form-control is-invalid'
        usernamemessage.className = "invalid-feedback";
        usernamemessage.innerHTML = "Username cannot be empty";
    } else {
        inputname.className = 'form-control is-valid'
        usernamemessage.className = "valid-feedback";
        usernamemessage.innerHTML = "";
    }
}

function checkPassword() {
    var password = $('#password').val();
    if (password == '') {
        inputpassword.className = 'form-control is-invalid'
        passwordmessage.className = "invalid-feedback";
        passwordmessage.innerHTML = "Password cannot be empty";
        submitbtn.disabled = true;
    } else {
        inputpassword.className = 'form-control is-valid'
        passwordmessage.className = "valid-feedback";
        passwordmessage.innerHTML = "";
        submitbtn.disabled = false;
    }
}

function checkUserID() {
    var userid = $('#user_id').val();
    if (userid == '' || userid.length < 7) {
        inputuserid.className = 'form-control is-invalid'
    } else {
        inputuserid.className = 'form-control is-valid'
    }
}

function checkCode() {
    var code = $('#securitycode').val();
    if (code == '' || code.length < 4) {
        inputcode.className = 'form-control is-invalid'
        submitforgot.disabled = true;
    } else {
        inputcode.className = 'form-control is-valid'
        submitforgot.disabled = false;
    }
}

$(document).ready(function() {
    $("#username").keyup(checkUsername);
    $("#password").keyup(checkPassword);
    $("#user_id").keyup(checkUserID);
    $("#securitycode").keyup(checkCode);
});
</script>