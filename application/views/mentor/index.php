<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Mentor</li>
</ol>
<div class="container-fluid text-center">
    <div class="row">
        <?php foreach ($mentors as $mentor) : ?>
        <div class="col-md-3">
            <div class="card mb-3">
                <?php $bg = ($mentor['id'] == $mentor_matric) ? 'text-pink' : 'text-dark'; ?>
                <h4 class="card-header text-white <?= $bg ?>">
                    <?= ($mentor['id'] == $mentor_matric) ? 'My ' . $mentor['sigcode'] . ' Mentor' : $mentor['sigcode'] ?>
                </h4>
                <img style="display: block; object-fit:cover; padding:10px; border-radius:50%;" src="<?= $mentor['userphoto'] ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?= site_url('/mentor/' . $mentor['id']) ?>">
                            <?= $mentor['name'] ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-muted"><?= $mentor['role'] ?></h6>
                </div>

                <!-- <div class="card-footer">
                    <?= $mentor['email'] ?>
                </div> -->
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>