<h2 class="text-center">Edit: <?= $student['id'] ?></h2>


<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <?php if ($student['profile_image']) : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . $student['profile_image'] ?>">
                <?php else : ?>
                    <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . 'default.jpg' ?>">
                <?php endif ?>

                <div class="card-footer text-muted">
                    Joined <?= $student['sigcode'] ?>: XXXX
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">

            <?php if (validation_errors()) : ?>
                <?= validation_errors(); ?>
            <?php endif ?>

            <?= form_open('student/update/' . $student['id']); ?>
            <input type="hidden" name="id" value="<?= $student['id'] ?>">

            <fieldset>
                <!-- NAME -->
                <div class="form-group">
                    <label>Student Name</label>
                    <input name="name" type="text" class="form-control form-control-lg" aria-describedby="" placeholder="Enter student name" value="<?= $student['name'] ?>">
                </div>
                <!-- SIG -->
                <div class="form-group">
                    <label>Select SIG</label>
                    <select name="sig_id" class="form-control form-control-sm" disabled>
                        <?php foreach ($sigs as $sig) : ?>
                            <option value="<?= $sig['id'] ?>" <?php
                                                                if ($sig['id'] == $student['sig_id']) {
                                                                    echo 'selected';
                                                                } ?>>
                                <?= $sig['signame'] . ' (' . $sig['code'] . ')'; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- PROGRAM -->
                <div class="form-group">
                    <label>Select Program</label>
                    <select name="program_code" class="form-control form-control-sm">
                        <?php foreach ($programs as $program) : ?>
                            <option value="<?= $program['code'] ?>" <?php
                                                                    if ($program['code'] == $student['program_code']) {
                                                                        echo 'selected';
                                                                    } ?>>
                                <?= $program['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- PHONENUM -->
                <div class="form-group">
                    <label>Phone number</label>
                    <input name="phonenum" type="tel" class="form-control form-control-sm" aria-describedby="" placeholder="Enter phone number" value="<?= $student['phonenum'] ?>">
                </div>
                <!-- EMAIL -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" value="<?= $student['email'] ?>">
                </div>
                <!-- MENTOR_MATRIC -->
                <div class="form-group">
                    <label>Select Mentor</label>
                    <select name="mentor_matric" class="form-control form-control-sm">
                        <?php foreach ($mentors as $mentor) : ?>
                            <option value="<?= $mentor['id'] ?>" <?php
                                                                    if ($mentor['id'] == $student['mentor_matric']) {
                                                                        echo 'selected';
                                                                    } ?>>
                                <?= $mentor['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div> <br>
</div>