<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('scoreboard') ?>">Score Board</a></li>
    <li class="breadcrumb-item active"><?= $student['id'] ?></li>
</ol>
<h3 class="text-dark"><?= sprintf("Score Board: %s", $student['name']) ?></h3>
<?php if ($academicplans) : ?>
<?php foreach ($academicplans as $plan) : ?>
<hr>
<div class="card">
    <div class="card-body">
        <div class="text-center">
            <h3><?= $plan['academicsession'] ?></h3>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4 col-sm-4 border-right">
                <h6 class="text-center">Academic</h6>
                <br>
                <div class="row justify-content-center">
                    <?php if ($plan['academicdesc']) : ?>
                    <?php foreach ($plan['academicdesc'] as $desc) : ?>
                    <img data-toggle="tooltip" title="oyeah" class="rounded-circle" style="object-fit:cover;" src="<?= base_url('assets/images/badge.png') ?>" alt="" width="60px" height="60px">&nbsp;
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
                <br>
                <ul>
                    <?php if ($plan['academicdesc']) : ?>
                    <?php foreach ($plan['academicdesc'] as $desc) : ?>
                    <li>&#9989; <?= $desc ?></li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="col-lg-4 col-sm-4 border-right">
                <h6 class="text-center">Activity</h6>
                <br>
                <div class="row justify-content-center">
                    <?php if ($plan['activitydesc']) : ?>
                    <?php foreach ($plan['activitydesc'] as $desc) : ?>
                    <img data-toggle="tooltip" title="activity badge" class="rounded-circle" style="object-fit:cover;" src="<?= base_url('assets/images/badge.png') ?>" alt="" width="60px"
                        height="60px">&nbsp;
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
                <br>
                <ul>
                    <?php if ($plan['activitydesc']) : ?>
                    <?php foreach ($plan['activitydesc'] as $desc) : ?>
                    <li>&#9989; <?= $desc ?></li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="col-lg-4 col-sm-4">
                <h6 class="text-center">External</h6>
                <br>
                <div class="row justify-content-center">
                    <?php if ($plan['externaldesc']) : ?>
                    <?php foreach ($plan['externaldesc'] as $desc) : ?>
                    <img data-toggle="tooltip" title="external activity" class="rounded-circle" style="object-fit:cover;" src="<?= base_url('assets/images/badge.png') ?>" alt="" width="60px"
                        height="60px">&nbsp;
                    <?php endforeach ?>
                    <?php endif ?>
                </div>
                <br>
                <ul>
                    <?php if ($plan['externaldesc']) : ?>
                    <?php foreach ($plan['externaldesc'] as $desc) : ?>
                    <li>&#9989; <?= $desc ?></li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="container">
                <h6><?= sprintf("Badge Count: %s", $plan['badgecount']) ?></h6>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php else : ?>
<p>No academic plan were registered for this student</p>
<?php endif ?>