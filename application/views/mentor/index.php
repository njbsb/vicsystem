<h2 class="text-center"><?= $title ?></h2>
<div class="container-fluid text-center">
    <div class="row">
        <?php foreach ($mentors as $mentor) : ?>
        <div class="col-md-4">
            <div class="card mb-3">
                <?php $bg = ($mentor['id'] == $mentor_matric) ? 'bg-success' : 'bg-dark'; ?>
                <h4 class="card-header text-white <?= $bg ?>">
                    <?= ($mentor['id'] == $mentor_matric) ? 'My ' . $mentor['sigcode'] . ' Mentor' : $mentor['sigcode'] ?>
                </h4>
                <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
                <?php $profile_image = (isset($mentor['profile_image'])) ? $mentor['profile_image'] : 'default.jpg' ?>
                <img style="display: block; object-fit:cover; padding:10px; border-radius:50%;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <!-- <img class="img-mentor" src="<?= base_url('assets/images/profile/' . $profile_image) ?>"> -->
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/mentor/' . $mentor['id']) ?>">
                            <?= $mentor['name'] ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $mentor['role'] ?></h6>
                </div>

                <div class="card-footer text-muted">
                    <?= $mentor['email'] ?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>