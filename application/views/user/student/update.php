<h2 class="text-center"><?= $title ?></h2>

<div class="container-fluid text-center">
    <?= form_open_multipart('user/update/' . $student['id']) ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-secondary mb-3" style="max-width: 20rem;">
                <?php if ($student['profile_image']) : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . $student['profile_image'] ?>">
                <?php else : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . 'default.jpg') ?>">
                <?php endif ?>
                <div class="card-footer text-muted">
                    <?= $student['id'] ?>
                </div>
            </div>

            <div class="form-group">
                <label>Select profile photo</label>
                <input name="profile_image" type="file" class="form-control-file" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Choose a proper profile photo.</small>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $student['name'] ?>" readonly>
                <input name="usertype_id" value="<?= $user['usertype_id'] ?>" type="hidden" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Select Program</label>
                <select name="sig_id" class="form-control" id="" readonly>
                    <?php foreach ($sigs as $sig) : ?>
                        <option value="<?= $sig['id'] ?>" <?php if ($sig['id'] == $student['sig_id']) {
                                                                echo 'selected';
                                                            } ?>>
                            <?= $sig['signame'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label>Program</label>
                <select name="program_code" class="form-control" id="" readonly>
                    <?php foreach ($programs as $program) : ?>
                        <option value="<?= $program['code'] ?>" <?php if ($program['code'] == $student['program_code']) {
                                                                    echo 'selected';
                                                                } ?>>
                            <?= $program['name'] ?>
                        </option>
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
                <select name="mentor_matric" class="form-control" id="" readonly>
                    <?php foreach ($mentors as $mentor) : ?>
                        <option value="<?= $mentor['id'] ?>" <?php if ($mentor['id'] == $student['mentor_matric']) {
                                                                    echo 'selected';
                                                                } ?>>
                            <?= $mentor['name'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </div>
    <?= form_close() ?>
</div>