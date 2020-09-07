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
                    src="<?php echo base_url('assets/images/profile/').$mentor['photo_path']; ?>" alt="Card image">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    <?= $mentor['matric'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <!-- <div class="bs-component">
            </div> -->
            <h3><b><?= $mentor['name'] ?></b></h3>
            <h6><b>Position:</b> <?= $mentor['position'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
            <h6><b>SIG:</b> <?= $mentor['signame'] ?></h6>
            <h6><b>SIG Role:</b> <?= $mentor['rolename'] ?></h6>

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