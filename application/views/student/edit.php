<!-- <h2 class="text-center"><?= $student['name'] ?></h2> -->


<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?php if ($student['profile_image']) {
                                                                                                        echo base_url('assets/images/profile/') . $student['profile_image'];
                                                                                                    } else {
                                                                                                        echo base_url('assets/images/profile/') . 'default.jpg';
                                                                                                    }
                                                                                                    ?>">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    Joined <?= $student['sigcode'] ?>: XXXX
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <?php if (validation_errors()) : ?>
                <?= validation_errors(); ?>
            <?php endif ?>
            <?= form_open('student/update/' . $student['id']); ?>
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

            <fieldset>
                <!-- NAME -->
                <div class="form-group">
                    <label>Student Name</label>
                    <input name="name" type="text" class="form-control form-control-lg" aria-describedby="" placeholder="Enter student name" value="<?php echo $student['name']; ?>">
                </div>
                <!-- SIG -->
                <div class="form-group">
                    <label>Select SIG</label>
                    <select name="sig_id" class="form-control form-control-sm">
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
                            <option value="<?php echo $program['code']; ?>" <?php
                                                                            if ($program['code'] == $student['program_code']) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php echo $program['name']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- PHONENUM -->
                <div class="form-group">
                    <label>Phone number</label>
                    <input name="phonenum" type="tel" class="form-control form-control-sm" aria-describedby="" placeholder="Enter phone number" value="<?php echo $student['phonenum']; ?>">
                </div>
                <!-- EMAIL -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" value="<?php echo $student['email']; ?>">
                </div>
                <!-- MENTOR_MATRIC -->
                <div class="form-group">
                    <label>Select Mentor</label>
                    <select name="mentor_matric" class="form-control form-control-sm">
                        <?php foreach ($mentors as $mentor) : ?>
                            <option value="<?php echo $mentor['id']; ?>" <?php
                                                                            if ($mentor['id'] == $student['mentor_matric']) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php echo $mentor['name']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
            <?= form_close() ?>

            <!-- <button type="submit" class="btn btn-primary">Update profiles</button> -->
        </div>
        <!-- <div class="col-lg-4">
            <?php echo form_open('/student/update/' . $student['matric']); ?>
            <input type="submit" value="Update Student" class="btn btn-secondary">
            </form>
            <button type="submit" class="btn btn-primary">Update profiles</button>
        </div>
        <div class="col-lg-8 text-left">
            <button type="submit" class="btn btn-primary">Update profile 2</button>
        </div> -->

    </div> <br>

    <!-- <h2>Previous Activity and Roles</h2> <br>
    <div class="card bg-light mb-3" style="">
        <div class="card-header">Treasurer</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div> -->
</div>