<!-- <h2 class="text-center"><?= $student['name'] ?></h2> -->


<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-light mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;"
                    src="<?php echo base_url('assets/images/profile/').$student['photo_path']; ?>"
                    alt="<?= $student['photo_path']?>">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    Joined VIC: 2016
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <?php echo validation_errors();?>
            <?php echo form_open('student/update/'.$student['matric']); ?>
            <input type="hidden" name="matric" value="<?php echo $student['matric']; ?>">

            <fieldset>
                <div class="form-group">
                    <label>Student Name</label>
                    <input name="studentname" type="text" class="form-control form-control-lg" aria-describedby=""
                        placeholder="Enter student name" value="<?php echo $student['name']; ?>">
                </div>
                <div class="form-group">
                    <label>Select SIG</label>
                    <select name="sig_id" class="form-control form-control-sm">
                        <?php foreach($sigs as $sig): ?>
                        <option value="<?php echo $sig['id']; ?>" <?php 
                        if($sig['id'] == $student['sig_id_fk']) { 
                            echo 'selected'; 
                        } ?>>
                            <?php echo $sig['signame'].' ('.$sig['code'].')'; ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Program</label>
                    <select name="program_code" class="form-control form-control-sm">
                        <?php foreach($programs as $program): ?>
                        <option value="<?php echo $program['code']; ?>" <?php 
                        if($program['code'] == $student['program_code_fk']) { 
                            echo 'selected'; 
                        } ?>>
                            <?php echo $program['name']; ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input name="phonenum" type="tel" class="form-control form-control-sm" aria-describedby=""
                        placeholder="Enter phone number" value="<?php echo $student['phonenum']; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email"
                        value="<?php echo $student['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Select Mentor</label>
                    <select name="mentor_matric" class="form-control form-control-sm">
                        <?php foreach($mentors as $mentor): ?>
                        <option value="<?php echo $mentor['matric']; ?>" <?php 
                        if($mentor['matric'] == $student['mentor_id_fk']) { 
                            echo 'selected'; 
                        } ?>>
                            <?php echo $mentor['name']; ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </fieldset>
            </form>

            <!-- <button type="submit" class="btn btn-primary">Update profiles</button> -->
        </div>
        <!-- <div class="col-lg-4">
            <?php echo form_open('/student/update/'.$student['matric']); ?>
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