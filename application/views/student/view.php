<!-- <h2 class="text-center"><?= $student['name'] ?></h2> -->


<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header"><b>Student</b></div> -->
                <!-- <h4 class="card-header">
                    <b>Header</b>
                </h4> -->
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
            <h3><b><?= $student['name'] ?></b></h3>
            <h6><b>Club name:</b> <?= $student['signame'] ?></h6>
            <h6><b>Program:</b> <?= $student['program_name'] ?></h6>
            <h6><b>Year:</b> 3(hardcode)</h6>
            <h6><b>Phone Num:</b> <?= $student['phonenum'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
            <h6><b>Mentor:</b> <?= $student['mentor_name'] ?></h6>

        </div>
        <div class="col-lg-4">
            <?php echo form_open('/student/edit/' . $student['id']); ?>
            <input type="submit" value="Edit Student" class="btn btn-outline-secondary">
            </form>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>

    </div> <br>

    <h2>Previous Activity and Roles</h2> <br>
    <div class="card bg-light mb-3">
        <div class="card-header">Treasurer</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div>
</div>