<h4 class="text-center"><?= $title ?></h4>
<h4 class="text-center"><?= $president['acadyear'] ?></h4>

<div class="row text-center">
    <div class="col-md-4 offset-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $president['rolename']; ?>
            </h4>
            <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?php echo base_url('assets/images/profile/' . $president['profile_image']); ?>" alt="<?= $president['profile_image']; ?>">

            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= site_url('/student/' . $president['student_matric']) ?>">
                        <?= $president['name'] ?>
                    </a>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
            </div>

            <div class="card-footer text-muted">
                <?= $president['email'] ?>
            </div>
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $president['rolename']; ?>
            </h4>
            <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?php echo base_url('assets/images/profile/' . $president['profile_image']); ?>" alt="<?= $president['profile_image']; ?>">

            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= site_url('/student/' . $president['student_matric']) ?>">
                        <?= $president['name'] ?>
                    </a>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
            </div>

            <div class="card-footer text-muted">
                <?= $president['email'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $president['rolename']; ?>
            </h4>
            <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?php echo base_url('assets/images/profile/' . $president['profile_image']); ?>" alt="<?= $president['profile_image']; ?>">

            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= site_url('/student/' . $president['student_matric']) ?>">
                        <?= $president['name'] ?>
                    </a>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
            </div>

            <div class="card-footer text-muted">
                <?= $president['email'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <h4 class="card-header text-white bg-dark">
                <?= $president['rolename']; ?>
            </h4>
            <!-- object-fit:cover for square crop
                    border-radius:50%; for circle crop -->
            <img style="max-height:240px; max-width:auto; display: block; object-fit:cover;  padding:10px;" src="<?php echo base_url('assets/images/profile/' . $president['profile_image']); ?>" alt="<?= $president['profile_image']; ?>">

            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= site_url('/student/' . $president['student_matric']) ?>">
                        <?= $president['name'] ?>
                    </a>
                </h5>
                <h6 class="card-subtitle text-muted"><?= $president['student_matric']; ?></h6>
            </div>

            <div class="card-footer text-muted">
                <?= $president['email'] ?>
            </div>
        </div>
    </div>
</div>
<div class="row text-center">
    <?php if ($orgajks) : ?>
        <?php foreach ($orgajks as $ajk) : ?>
            <div class="col-md-4">
                <div class="card mb-3">

                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <td>Matric</td>
            <td>Name</td>
            <td>Role</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sigcommittees as $sigcom) : ?>
            <tr>
                <td><?= $sigcom['student_matric'] ?></td>
                <td><?= $sigcom['name'] ?></td>
                <td><?= $sigcom['rolename'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>