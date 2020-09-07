<h2><?= 'Mentor: '.$mentor['name'] ?></h2>

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
                    src="<?php echo base_url('assets/images/profile/').$mentor['photo_path']; ?>"
                    alt="<?= $mentor['photo_path']?>">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    Some text
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <h3><b><?= $mentor['name'] ?></b></h3>
            <h6><b>Position: </b><?= $mentor['position'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
            <h6><b>Club name:</b> <?= $mentor['signame'] ?></h6>
            <h6><b>Role:</b> <?= $mentor['rolename'] ?></h6>

            <!-- <h6><b>Phone Num:</b> <?= $student['phonenum'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
            <h6><b>Mentor:</b> <?= $student['mentor_name'] ?></h6> -->

        </div>
        <div class="col-lg-4">
            <?php echo form_open('/mentor/edit/'.$mentor['matric']); ?>
            <input type="submit" value="Edit Mentor" class="btn btn-secondary">
            </form>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <button type="submit" class="btn btn-primary">Update profile 2</button> -->
        </div>

    </div> <br>

    <h2>Previous Activities and Roles</h2> <br>
    <div class="card bg-light mb-3" style="">
        <div class="card-header">Advisor</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div>
</div>