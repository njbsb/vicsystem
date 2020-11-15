<h2 class="text-center">Edit: <?= $student['id'] ?></h2>


<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <?php $profile_image = ($student['profile_image']) ? $student['profile_image'] : 'default.jpg' ?>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <div class="card-footer text-muted">
                    Joined <?= $student['sigcode'] ?>: <?= $student['year_joined'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">

            <?php if (validation_errors()) : ?>
                <?= validation_errors() ?>
            <?php endif ?>

            <?= form_open('student/update/' . $student['id']); ?>
            <fieldset>
                <!-- NAME -->
                <div class="form-group">
                    <label>Student Name</label>
                    <input name="name" type="text" class="form-control form-control-lg" aria-describedby="" placeholder="Enter student name" value="<?= $student['name'] ?>" readonly>
                </div>
                <!-- SIG -->
                <div class="form-group">
                    <label>Select SIG</label>
                    <select name="sig_id" class="form-control form-control-sm">
                        <?php foreach ($sigs as $sig) : ?>
                            <?php $selected = ($sig['id'] == $student['sig_id']) ? 'selected' : '' ?>
                            <option value="<?= $sig['id'] ?>" <?= $selected ?>>
                                <?= $sig['namecode'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- PROGRAM -->
                <div class="form-group">
                    <label>Select Program</label>
                    <select name="program_code" class="form-control form-control-sm">
                        <?php foreach ($programs as $program) : ?>
                            <?php $selected = ($program['code'] == $student['program_code']) ? 'selected' : '' ?>
                            <option value="<?= $program['code'] ?>" <?= $selected ?>>
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
                            <?php $selected = ($mentor['id'] == $student['mentor_matric']) ? 'selected' : '' ?>
                            <option value="<?= $mentor['id'] ?>" <?= $selected ?>>
                                <?= $mentor['name'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" disabled>Update</button>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div> <br>
</div>