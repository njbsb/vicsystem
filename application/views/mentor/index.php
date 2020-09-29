<h2 class="text-center"><?= $title ?></h2>
<div class="container-fluid text-center">
    <div class="row">
        <?php foreach ($mentors as $mentor) : ?>
            <?php if ($mentor['profile_image'] == '') {
                $mentor['profile_image'] = 'default.jpg';
            } ?>

            <div class="col-sm-4">
                <div class="card mb-3">
                    <h4 class="card-header text-white bg-dark">
                        <?php echo $mentor['sigcode']; ?>
                    </h4>
                    <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
                    <img style="max-height:300px; display: block; object-fit:cover;  padding:10px;" src="<?php echo base_url('assets/images/profile/' . $mentor['profile_image']); ?>" alt="<?php echo $mentor['profile_image']; ?>">

                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= site_url('/mentor/' . $mentor['id']) ?>">
                                <?= $mentor['name'] ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle text-muted"><?= $mentor['rolename']; ?></h6>
                    </div>

                    <div class="card-footer text-muted">
                        <?= $mentor['email'] ?>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>

</div>