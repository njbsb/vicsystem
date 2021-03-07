<?php if (validation_errors()) : ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0"><?= validation_errors() ?></p>
</div>
<?php endif ?>
<h2 class="text-center"><?= $user['id'] ?></h2>
<?= form_open('user/validate/' . $user['id']) ?>
<div class="row">
    <div class="col-lg-4">
        <div class="card border mb-3 text-center" style="max-width: 20rem;">
            <h4 class="card-header text-primary">
                <b><?= ucfirst($user['usertype']) ?></b>
            </h4>
            <?php if ($user['profile_image']) : ?>
            <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $user['profile_image']) ?>">
            <?php else : ?>
            <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . 'default.jpg') ?>">
            <?php endif ?>

            <div class="card-footer text-muted">
                Applied: <?= $user['code'] ?>
            </div>
        </div>
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
        <!-- SIG -->
        <div class="form-group">
            <label>SIG</label>
            <select name="sig_id" class="form-control" id="sig_id" readonly>
                <option value="" selected disabled hidden>Choose SIG</option>
                <?php foreach ($sigs as $sig) : ?>
                <option value="<?= $sig['id'] ?>" <?php if ($user['sig_id'] == $sig['id']) {
                                                            echo 'selected';
                                                        } ?>>
                    <?= $sig['namecode'] ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- PROFILE IMAGE -->
                <div class="form-group">
                    <label for="profile_image">Profile image</label>
                    <input name="profile_image" type="file" class="form-control-file" id="" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Choose a proper profile image.</small>
                </div>
            </div>
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
                    <label for="userstatus_id" class="text-danger">*User status</label>
                    <select name="userstatus_id" id="" class="form-control" style="max-width: 20rem;">
                        <option value="" selected disabled hidden>Choose user status</option>
                        <?php foreach ($userstatuses as $us) : ?>
                        <option value="<?= $us['id'] ?>" <?php if ($us['id'] == $user['userstatus_id']) {
                                                                    echo 'selected';
                                                                } ?>><?= $us['userstatus'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- <p class="text-danger">Please select the status of the user</p> -->
    </div>
</div>
<hr>