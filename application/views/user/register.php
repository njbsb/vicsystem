<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>

<div class="row">
    <div class="col-md-5 card">
        <div class="card-body justify-content-md-center">
            <h3 class="text-pink"><?= $title ?></h3>
            <?php $hidden = array('usertype' => $usertype) ?>
            <?= form_open('register', '', $hidden) ?>
            <!-- NAME -->
            <div class="form-group">
                <label>Name</label>
                <input value="<?= $name ?>" type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <!-- ID -->
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>ID/Matric</label>
                        <input value="<?= $id ?>" type="text" class="form-control" id='id' name="id" maxlength="8" size="8" placeholder="ID/Matric No" required>
                    </div>
                    <div class="col-6">
                        <label for="dob">Date of Birth</label>
                        <input name="dob" class="form-control" type="date" value="<?= $dob ?>" id="dob" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="phonenum">Phone Number</label>
                        <input value="<?= $phonenum ?>" type="tel" name="phonenum" id="phonenum" class="form-control" placeholder="0123456789" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="custom-control custom-radio">
                    <input value="m" type="radio" id="customRadio1" name="gender" class="custom-control-input" checked="">
                    <label class="custom-control-label" for="customRadio1">Male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input value="f" type="radio" id="customRadio2" name="gender" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio2">Female</label>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label>Email</label>
                <input value="<?= $email ?>" type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div id="pwtext" class="valid-feedback">Success! You've done it.</div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm password">
                        <div id="confirmtext" class="valid-feedback">Success! You've done it.</div>
                    </div>
                </div>
            </div>

            <button id="submitform" type="submit" class="btn btn-primary btn-block" disabled>Register</button>
            <?= form_close() ?>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card-body">
            <!-- <h3 class="home-title">Sign Up Now!</h3> -->
            <img src="<?= base_url('assets/images/login.png') ?>" style="max-width:100%; max-height: 100%;" alt="">
            <br><br>
            <p>Already have an account? <a href="<?= site_url('login') ?>">Sign In</a></p>
        </div>
    </div>
</div>

<script>
var input1 = document.getElementById("password");
var input2 = document.getElementById("confirmpassword");
var message1 = document.getElementById("pwtext");
var message2 = document.getElementById("confirmtext");
var submitbtn = document.getElementById("submitform");

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirmpassword").val();
    if (password != confirmPassword) {
        input2.className = "form-control is-invalid";
        message2.className = "invalid-feedback";
        message2.innerHTML = "Password mismatch!";
        submitbtn.disabled = true;
    } else {
        if (password != '' || confirmPassword != '') {
            input2.className = "form-control is-valid";
            message2.className = "valid-feedback";
            message2.innerHTML = "Password match!";
            submitbtn.disabled = false;
        }
    }
}

function checkEmpty() {
    var password = $("#password").val();
    var confirmPassword = $("#confirmpassword").val();
    if (password == '') {
        input1.className = "form-control is-invalid";
        message1.className = "invalid-feedback";
        message1.innerHTML = "Password cannot be empty!";
    } else {
        input1.className = "form-control is-valid";
        message1.className = "valid-feedback";
        message1.innerHTML = "";
    }
}
$(document).ready(function() {
    $("#password").keyup(checkEmpty);
    $("#password, #confirmpassword").keyup(checkPasswordMatch);
    // $('#submitpassword').
});
</script>