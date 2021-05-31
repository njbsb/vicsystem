<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>
<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-dark mb-3 text-center" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-footer text-muted">
                    <?= $mentor['id'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 text-left">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3><b><?= $mentor['name'] ?></b></h3>

                </div>
                <div class="col-lg-6 col-md-6">
                    <a href="<?= site_url('profile/update') ?>" class="btn btn-outline-primary" style="float:right;"><i class='fas fa-pen'></i> Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6><b>Email</b></h6>
                    <h6><b>Position</b></h6>
                    <h6><b>Role</b></h6>
                    <h6><b>Room Num</b></h6>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-6">
                    <h6><a href="mailto:<?= $mentor['email'] ?>"><?= $mentor['email'] ?></a></h6>
                    <h6><?= $mentor['position'] ?></h6>
                    <h6><?= $mentor['role'] ?></h6>
                    <h6><?= $mentor['roomnum'] ?></h6>
                </div>
            </div>
            <hr>
            <h5>Personal Information</h5>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6><b>Phone Num:</b></h6>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-6">
                    <h6><?= $mentor['phonenum'] ?></h6>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <h2>Previous Activity and Roles</h2> <br>
    <?php if ($activity_roles) : ?>

    <div class="card">
        <div class="card-body">
            <h4>Activities</h4>
            <div class="row justify-content-center">
                <?php foreach ($activity_roles as $actrole) : ?>
                <div class="col-md-4">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><a class="text-white" href="<?= site_url('activity/' . $actrole['slug']) ?>"><?= $actrole['activity_name'] ?></a></div>
                        <div class="card-body">
                            <h4 class="card-title">Advisor</h4>
                            <p class="card-text"><?= $actrole['academicsession'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <?php else : ?>
    <p>No data of activity roles found</p>
    <?php endif ?>
</div>