<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item active">Mentor</li>
</ol>
<div class="container-fluid text-center">
    <div class="row justify-content-center">
        <?php if ($mentors) : ?>
        <?php foreach ($mentors as $mentor) : ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-3">
                <?php $bg = ($mentor['id'] == $mentor_matric) ? 'text-white' : 'text-dark'; ?>
                <h4 class="card-header <?= $bg ?>">
                    <?= ($mentor['id'] == $mentor_matric) ? 'My Mentor' : 'Mentor' ?>
                </h4>
                <div class="card-body text-center" style="text-align: center;">
                    <div class="container d-flex flex-column align-items-center">
                        <img class="rounded-circle img-circle" src="<?= $mentor['userphoto'] ?>" width="150" height="150">
                    </div>
                    <br>
                    <h5 class="card-title">
                        <a href="<?= site_url('/mentor/' . $mentor['id']) ?>">
                            <?= $mentor['name'] ?>
                        </a>
                    </h5>
                    <h6 class="card-subtitle text-white"><?= $mentor['role'] ?></h6>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <?php else : ?>
        <p>No data of mentors</p>
        <?php endif ?>
    </div>
</div>