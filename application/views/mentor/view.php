<!-- <h2><?= 'Mentor: ' . $mentor['name'] ?></h2> -->

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/') . 'default.jpg' ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <h3><b><?= $mentor['name'] ?></b></h3>
            <h6><b>Position: </b><?= $mentor['position'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
            <h6><b>Club name:</b> <?= $mentor['signame'] ?></h6>
            <h6><b>Role:</b> <?= $mentor['role'] ?></h6>
            <h6><b>Room:</b> <?= $mentor['roomnum'] ?></h6>
        </div>
        <?php if ($isMentor) : ?>
        <div class="col-lg-4">
            <?= form_open('/mentor/edit/' . $mentor['id']) ?>
            <input type="submit" value="Edit Mentor" class="btn btn-outline-secondary">
            <?= form_close() ?>
        </div>
        <?php endif ?>

    </div>
    <hr>

    <h2>Previous Activities and Roles</h2> <br>
    <?php if ($activity_roles) : ?>
    <h4>Activities</h4>
    <div class="row justify-content-center">
        <?php foreach ($activity_roles as $actrole) : ?>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <!-- <div class="card-header"><a class="text-white" href="<?= site_url('activity/' . $actrole['slug']) ?>"><?= $actrole['title'] ?></a></div> -->
                <div class="card-header"><?= $actrole['academicsession'] ?></div>
                <div class="card-body">
                    <!-- <h4 class="card-title">Activity Advisor</h4>
                            <p class="card-text"><small class="text-muted"><?= $actrole['academicsession'] ?></small></p> -->
                    <h5 class="card-title"><a class="text-white" href="<?= site_url('activity/' . $actrole['slug']) ?>"><?= $actrole['title'] ?></a></h5>
                    <p class="card-text"><small class="text-muted">Activity Advisor</small></p>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php else : ?>
    <p>No data of activity roles found</p>
    <?php endif ?>
</div>