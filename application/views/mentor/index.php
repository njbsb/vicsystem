<div class="container-fluid text-center">
    <h2 class="margin"><?= $title ?></h2>


    <div class="row">
        <?php foreach($mentors as $mentor): ?>

        <div class="col-sm-4">
            <div class="card mb-3">
                <h3 class="card-header">
                    <?php echo $mentor['sigcode']; ?>
                </h3>
                <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
                <img style="max-height:300px; display: block; object-fit:cover;  padding:10px;"
                    src="<?php echo base_url('assets/images/profile/'.$mentor['photo_path']); ?>"
                    alt="<?php echo $mentor['photo_path']; ?>">

                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?php echo site_url('/mentor/'.$mentor['matric']); ?>">
                            <?php echo $mentor['name']; ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?php echo $mentor['role_name']; ?></h6>
                </div>

                <div class="card-footer text-muted">
                    <?php echo $mentor['email']; ?>
                </div>
            </div>
        </div>

        <?php endforeach ?>
    </div>

</div>