<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>
<h2 class="text-center"><?= $user['id'] ?></h2>
<?php $hidden = array('mentor_id' => $superior['id']) ?>
<?= form_open('user/validate/' . $user['id'], '', $hidden) ?>
<div class="row">
    <div class="col-lg-4 text-center">
        <div class="card border mb-3 text-center" style="max-width: 20rem;">
            <h4 class="card-header text-primary">
                <b><?= ucfirst($user['usertype']) ?></b>
            </h4>
            <?php $profileimage = 'default.jpg' ?>
            <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profileimage) ?>">

            <div class="card-footer text-muted">
                Applied: <?= $user['code'] ?>
            </div>
        </div>
        <?php $badgetype = ($user['userstatus'] == 'pending') ? 'badge-warning' : 'badge-success' ?>
        <span class="badge <?= $badgetype ?>"><?= $user['userstatus'] ?></span>
    </div>

    <div class="col-lg-8 text-left">
        <!-- ID -->
        <div class="form-group">
            <label for="id">ID</label>
            <input value="<?= $user['id'] ?>" class="form-control" name="id" type="text" required readonly>
        </div>
        <!-- NAME -->
        <div class="form-group">
            <label for="name">Name</label>
            <input value="<?= $user['name'] ?>" class="form-control" name="name" type="text" required>
        </div>
        <!-- EMAIL -->
        <div class="form-group">
            <label for="email">Email</label>
            <input value="<?= $user['email'] ?>" class="form-control" name="email" type="text" required>
        </div>
        <!-- MENTOR ID -->
        <?php if ($user['usertype'] == 'student') : ?>
        <div class="form-group">
            <label for="superior_id">Mentor/Superior</label>
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
                <!-- DATE OF BIRTH -->
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input name="dob" class="form-control" type="date" value="<?= $user['dob'] ?>" id="dob" required>
                </div>
            </div>
            <div class="col-md-4">
                <!-- USER STATUS -->
                <div class="form-group">
                    <label for="userstatus" class="text-danger">*User status</label>
                    <select name="userstatus" id="" class="form-control" style="max-width: 20rem;">
                        <option value="" selected disabled hidden>Choose user status</option>
                        <?php foreach ($userstatus as $status) : ?>
                        <?php $selectedstatus = ($status['status'] == $user['userstatus']) ? 'selected' : '' ?>
                        <option value="<?= $status['status'] ?>" <?= $selectedstatus ?>>
                            <?= $status['status'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <small>Please select user status to active to validate as active user</small>
        <br><br>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </div>
</div>
<?= form_close() ?>
<hr>