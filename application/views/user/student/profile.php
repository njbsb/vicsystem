<h2 class="text-center"><?php echo $title; ?></h2>

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
                    src="<?php echo base_url('assets/images/profile/').$student['photo_path']; ?>" alt="Card image">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    <?= $student['matric'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <h3><b><?= $student['name'] ?></b></h3>
            <h6><b>Club name:</b> <?= $student['signame'] ?></h6>
            <h6><b>Program:</b> <?= $student['program_name'] ?></h6>
            <h6><b>Year:</b> 3</h6>
            <h6><b>Phone Num:</b> <a href="#"><?= $student['phonenum'] ?></a></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
            <h6><b>Mentor:</b> <?= $student['mentor_name'] ?></h6>

        </div>
    </div> <br>

    <h2>Previous Activity and Roles</h2> <br>
    <div class="card bg-light mb-3" style="">
        <div class="card-header">Treasurer</div>
        <div class="card-body">
            <h4 class="card-title">Short Film Competition 2019</h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
        </div>
    </div>
</div>