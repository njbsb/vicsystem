<h2 class="text-center"><?= $title ?></h2>

<div class="container-fluid text-center">
    <?php $hidden = array('usertype_id' => $usertype_id) ?>
    <?= form_open_multipart('user/update/' . $student['id'], '', $hidden) ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-primary mb-3" style="max-width: 20rem;">
                <?php $profile_image = ($student['profile_image']) ? $student['profile_image'] : 'default.jpg'; ?>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <div class="card-footer text-muted">
                    <?= $student['id'] ?>
                </div>
            </div>

            <div class="form-group">
                <label>Select profile photo</label>
                <input name="profile_image" type="file" class="form-control-file" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted"><?= $profile_image ?></small>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $student['name'] ?>" readonly>
                <!-- <input name="usertype_id" value="<?= $user['usertype_id'] ?>" type="hidden" class="form-control" readonly> -->
            </div>
            <div class="form-group">
                <label>SIG</label>
                <select name="sig_id" class="form-control" id="" readonly disabled>
                    <?php foreach ($sigs as $sig) : ?>
                        <?php $selected = ($sig['id'] == $student['sig_id']) ? 'selected' : ''; ?>
                        <option value="<?= $sig['id'] ?>" <?= $selected ?>><?= $sig['signame'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label>Program</label>
                <select name="program_code" class="form-control" id="" readonly disabled>
                    <?php foreach ($programs as $program) : ?>
                        <?php $selected = ($program['code'] == $student['program_code']) ? 'selected' : ''; ?>
                        <option value="<?= $program['code'] ?>" <?= $selected ?>><?= $program['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Year</label>
                <input class="form-control" name="year" value="-" readonly>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input class="form-control" name="phonenum" value="<?= $student['phonenum'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="<?= $student['email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Mentor</label>
                <select name="mentor_matric" class="form-control" id="" readonly disabled>
                    <?php foreach ($mentors as $mentor) : ?>
                        <?php $selected = ($mentor['id'] == $student['mentor_matric']) ? 'selected' : ''; ?>
                        <option value="<?= $mentor['id'] ?>" <?= $selected ?>><?= $mentor['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </div>
    <?= form_close() ?>
</div>