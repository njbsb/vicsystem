<div class="container-fluid text-center">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <?php $profile_image = 'default.jpg' ?>
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= base_url('assets/images/profile/' . $profile_image) ?>">
                <div class="card-footer text-muted">
                    Joined <?= $student['sigcode'] ?>: <?= $student['yearjoined'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-left">
            <h3><b><?= $student['name'] ?></b></h3>
            <h6><b>Matric:</b> <?= $student['id'] ?></h6>
            <h6><b>Program:</b> <?= $student['program_name'] ?></h6>
            <h6><b>Year:</b> <?= $student['year'] ?></h6>
            <h6><b>Phone Num:</b> <?= $student['phonenum'] ?></h6>
            <h6><b>Email:</b> <a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
            <h6><b>Mentor:</b> <?= $student['mentor_name'] ?></h6>

        </div>
        <?php if (!$this->session->userdata('user_type') == 'mentor') : ?>
        <div class="col-lg-4">
            <?= form_open('/student/edit/' . $student['id']); ?>
            <input type="submit" value="Edit Student" class="btn btn-outline-primary">
            <?= form_close() ?>
        </div>
        <?php endif ?>
    </div>
    <hr>

    <h2>Previous Activity and Roles</h2> <br>
    <h4 class="text-primary"><b>Activities</b></h4>
    <?php if ($activity_roles) : ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th>Year</th>
                    <th>Activity</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activity_roles as $actrole) : ?>
                <?php $desc = (isset($actrole['description'])) ? ' (' . $actrole['description'] . ')' : '' ?>
                <tr class="table-light">
                    <td><?= $actrole['acadyear'] . ' Semester ' . $actrole['semester'] ?></td>
                    <td><?= $actrole['activity_name'] ?></td>
                    <td><?= $actrole['role'] . $desc ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php else : ?>
    <p>No data of roles in activity found</p>
    <?php endif ?>
    <hr>
    <h4 class="text-secondary"><b><?= $student['signame'] ?></b></h4>
    <br>
    <?php if ($org_roles) : ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th>Academic Year</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($org_roles as $orgrole) : ?>
                <?php $desc = (isset($orgrole['description'])) ? ' (' . $orgrole['description'] . ')' : '' ?>
                <tr class="table-light">
                    <td><?= $orgrole['acadyear'] ?></td>
                    <td><?= $orgrole['role'] . $desc ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header text-warning"></div>
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-text"><?= $orgrole['description'] ?></p>
                </div>
            </div>
        </div> -->

    </div>
    <?php else : ?>
    <p>No data of roles in SIG found</p>
    <?php endif ?>
</div>