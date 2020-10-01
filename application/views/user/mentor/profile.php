<h2 class="text-center"><?php echo $title; ?></h2>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <!-- <div class="card mb-3"> -->
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <!-- <div class="card-header">Student</div> -->
                <!-- <h3 class="card-header">
                    Header
                </h3> -->
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?php if ($mentor['profile_image']) {
                                                                                                        echo base_url('assets/images/profile/') . $mentor['profile_image'];
                                                                                                    } else {
                                                                                                        echo base_url('assets/images/profile/') . 'default.jpg';
                                                                                                    }
                                                                                                    ?>">
                <!-- <div class="card-body">

                </div> -->
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
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
    </div>
    <hr>
    <h2>Previous Activity and Roles</h2> <br>
    <?php if ($activity_roles) : ?>
        <h4>Activity</h4>
        <?php foreach ($activity_roles as $actrole) : ?>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header"><?= $actrole['activity_name'] ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $actrole['rolename'] ?></h4>
                    <p class="card-text"><?= $actrole['role_desc'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
        <hr>
    <?php endif ?>
</div>