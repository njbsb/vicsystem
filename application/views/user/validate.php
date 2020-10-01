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
        <!-- <div class="card mb-3"> -->
        <div class="card border mb-3 text-center" style="max-width: 20rem;">
            <h4 class="card-header">
                <b><?= ucfirst($user['usertype']) ?></b>
            </h4>
            <!-- <h4 class="card-header">
                <?= ucfirst($user['usertype']) ?>
            </h4> -->
            <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?php if ($user['profile_image']) {
                                                                                                    echo base_url('assets/images/profile/') . $user['profile_image'];
                                                                                                } else {
                                                                                                    echo base_url('assets/images/profile/') . 'default.jpg';
                                                                                                } ?>">
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
                <?php foreach ($sigs as $sig) : ?>
                    <option value="<?= $sig['id'] ?>" <?php if ($user['sig_id'] == $sig['id']) {
                                                            echo 'selected';
                                                        } ?>>
                        <?= $sig['signame'] . ' (' . $sig['code'] . ')' ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Profile image</label>
                    <input name="profile_image" type="file" class="form-control-file" id="" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Choose a proper profile image.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input name="dob" class="form-control" type="date" value="<?= $user['dob'] ?>" id="dob" required>
                </div>
            </div>
        </div>
        <!-- Profile Image -->

    </div>

    <!-- <div class="col-lg-4">
            <?= form_open('/user/edit/' . $user['id']); ?>
            <input type="submit" value="Approve User" class="btn btn-secondary">
            <?= form_close() ?>
        </div>
        <div class="col-lg-8 text-left">
            <button type="submit" class="btn btn-primary">Update profile 2</button>
        </div> -->

</div>
<hr>
<!-- <div class="row">
    <div class="col-md-4">
        <h4><?= ucfirst($user['usertype']) ?> Form</h4>
    </div>
    <div class="col-md-8 text-left">

        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" class="form-control" name="phonenum" placeholder="01X-XXXXXXX">
        </div>
        <div class="form-group">
            <label>Select Program</label>
            <select name="program_code" class="form-control" id="program_code">
                <?php foreach ($programs as $program) : ?>
                    <option value="<?= $program['code'] ?>">
                        <?= $program['name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Select Mentor (<?= $user['code'] ?>)</label>
            <select name="mentor_matric" class="form-control" id="sig_mentor">
                <?php foreach ($mentors as $mentor) : ?>
                    <option value="<?= $mentor['matric'] ?>">
                        <?= $mentor['name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <button class="btn btn-primary">Submit</button>
    </div>
</div>
<?= form_close() ?> -->