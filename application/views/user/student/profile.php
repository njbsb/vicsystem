<h2 class="text-center"><?= $title; ?></h2>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?php if ($student['profile_image']) {
                                                                                                        echo base_url('assets/images/profile/') . $student['profile_image'];
                                                                                                    } else {
                                                                                                        echo base_url('assets/images/profile/') . 'default.jpg';
                                                                                                    }
                                                                                                    ?>">
                <div class="card-footer text-muted">
                    <?= $student['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <h3><b><?= $student['name'] ?></b></h3>
            <h6><b>Club name:</b> <?= $student['signamecode'] ?></h6>
            <h6><b>Program:</b> <?= $student['program_name'] ?></h6>
            <h6><b>Year:</b> 3 (hardcoded)</h6>
            <h6><b>Phone Num:</b> <a href="#"><?= $student['phonenum'] ?></a></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
            <h6><b>Mentor:</b> <?= $student['mentor_name'] ?></h6>
        </div>
    </div>
    <hr>
    <h2>Previous Activity and Roles</h2> <br>
    <?php if ($activity_roles) : ?>
        <h4>Activities</h4>
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
    <?php if ($org_roles) : ?>
        <h4>SIG: <?= $student['signame'] ?></h4>
        <?php foreach ($org_roles as $orgrole) : ?>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header"><?= $orgrole['acadyear'] ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $orgrole['rolename'] ?></h4>
                    <p class="card-text"><?= $orgrole['role_desc'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>