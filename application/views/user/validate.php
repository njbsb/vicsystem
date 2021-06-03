<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('user') ?>">User</a></li>
    <li class="breadcrumb-item active"><?= $user['id'] ?></li>
</ol>
<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>
<h2 class="text-center"><?= $user['id'] ?></h2>
<?php // $hidden = array('superior_id' => $superior['id']) 
?>
<?= form_open('user/validate/' . $user['id']) ?>
<div class="row">
    <div class="col-lg-4 text-center">
        <div class="card border mb-3 text-center" style="max-width: 20rem;">
            <h4 class="card-header text-primary">
                <b><?= ucfirst($user['usertype']) ?></b>
            </h4>
            <?php $profileimage = 'default.jpg' ?>
            <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $user['userphoto'] ?>">

            <div class="card-footer text-white">
                Applied: <?= $user['code'] ?>
            </div>
        </div>
        <small>User created on <?= date_format(date_create($user['createdat']), 'r') ?></small><br>
        <?php $badgetype = ($user['validated']) ? 'badge-success' : 'badge-warning' ?>
        <span class="badge <?= $badgetype ?>"><?= $user['status'] ?></span>
    </div>

    <div class="col-lg-8 text-left">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input value="<?= $user['id'] ?>" class="form-control" name="id" type="text" required readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="<?= $user['name'] ?>" class="form-control" name="name" type="text" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="<?= $user['email'] ?>" class="form-control" name="email" type="text" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phonenum">Phone Number</label>
                            <input value="<?= $user['phonenum'] ?>" type="tel" name="phonenum" id="phonenum" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- DATE OF BIRTH -->
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input name="dob" class="form-control" type="date" value="<?= $user['dob'] ?>" id="dob" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php $malechecked = ($user['gender'] == 'm') ? 'checked' : '' ?>
                    <?php $femalechecked = ($user['gender'] == 'f') ? 'checked' : '' ?>
                    <label for="gender">Gender</label>
                    <div class="custom-control custom-radio">
                        <input value="m" type="radio" id="radiomale" name="gender" class="custom-control-input" <?= $malechecked ?>>
                        <label class="custom-control-label" for="radiomale">Male</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input value="f" type="radio" id="radiofemale" name="gender" class="custom-control-input" <?= $femalechecked ?>>
                        <label class="custom-control-label" for="radiofemale">Female</label>
                    </div>
                </div>
                <hr>
                <?php if ($user['usertype'] == 'student') : ?>
                <div class="form-group">
                    <label class="text-danger" for="superior_id">*Mentor/Superior</label>
                    <select name="superior_id" id="" class="form-control" required>
                        <option value="" disabled selected>Select a mentor</option>
                        <?php foreach ($mentors as $mentor) : ?>
                        <?php $mentorselected = ($user['superior_id'] == $mentor['id']) ? 'selected' : '' ?>
                        <option value="<?= $mentor['id'] ?>" <?= $mentorselected ?>><?= $mentor['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="startdate">Join Date</label>
                            <input value="<?= $user['startdate'] ?>" type="date" name="startdate" id="startdate" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php $enddaterequired = ($user['usertype'] == 'mentor') ? '' : 'required' ?>
                            <label for="startdate">Leave Date</label>
                            <input value="<?= $user['enddate'] ?>" type="date" name="enddate" id="enddate" class="form-control" <?= $enddaterequired ?>>
                            <?php if ($user['usertype'] == 'mentor') : ?>
                            <small>Optional for mentor</small>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php $checked = ($user['validated']) ? 'checked' : '' ?>
                    <?php $checkedtext = ($user['validated']) ? 'Validated' : 'Pending' ?>
                    <?php $textclass = ($user['validated']) ? 'text-dark' : 'text-danger' ?>
                    <?php if (!$user['id'] = $this->session->userdata('username')) : ?>
                    <div class="custom-control custom-switch">
                        <input <?= $checked ?> type="checkbox" class="custom-control-input" name="validated" id="validated" onclick="checkValue()">
                        <label id="displaytext" class="custom-control-label <?= $textclass ?>" for="validated"><?= $checkedtext ?></label>
                    </div>
                    <div style="line-height:100%;">
                        <small>To validate the user as active user, please toggle the validate toggle input. Only validated user is able to sign in and use the system.</small>
                    </div>
                    <?php endif ?>
                </div>
                <br>
                <button type="submit" class="btn btn-primary"><i class='fas fa-save'></i> Save</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<script>
function checkValue() {
    var checkbox = document.getElementById("validated");
    var textdisplay = document.getElementById("displaytext");
    if (checkbox.checked == true) {
        checkbox.value = true;
        textdisplay.innerHTML = 'Validated';
        textdisplay.classList.add('text-dark');
        textdisplay.classList.remove('text-danger');
        console.log(checkbox.value)
    } else {
        checkbox.value = false;
        textdisplay.innerHTML = 'Pending';
        textdisplay.classList.add('text-danger');
        textdisplay.classList.remove('text-dark');
    }
}
$(document).ready(function() {

});
</script>