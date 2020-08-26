<div class="container-fluid text-center">
    <h2 class="margin">Mentor Index Page</h2>


    <div class="row">
        <?php foreach($mentors as $mentor): ?>

        <div class="col-sm-4">
            <div class="card mb-3">

                <h3 class="card-header">
                    VIC-ID: <?php echo $mentor['sig_fk_id']; ?>
                </h3>
                <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
                <img style="max-width:100%; max-height:max-width; display: block; object-fit:cover;  padding:10px;"
                    src="<?php echo $mentor['photo_path']; ?>" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">
                            <?php echo $mentor['name']; ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-muted">Club Advisor (dummy)</h6>
                </div>

                <div class="card-footer text-muted">
                    <?php echo $mentor['email']; ?>
                </div>
            </div>
        </div>

        <?php endforeach ?>
    </div>

</div>