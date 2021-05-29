<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('student') ?>">Student</a></li>
    <li class="breadcrumb-item active"><?= $student['id'] ?></li>
</ol>

<div class="container-fluid">
    <div class="row text-center">
        <div class="col-lg-4">
            <div class="card border-dark mb-3" style="max-width: 20rem;">
                <img style="max-height:300px; display: block; object-fit:cover; padding:10px;" src="<?= $student['userphoto'] ?>">
                <div class="card-footer text-muted">
                    Joined <?= $student['sigcode'] ?>: <?= $student['yearjoined'] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-left">
            <h3><b><?= $student['name'] ?></b></h3>
            <div class="row">
                <div class="col-sm-3">
                    <h6><b>Matric:</b></h6>
                    <h6><b>Program:</b></h6>
                    <h6><b>Year:</b></h6>
                    <h6><b>Phone Num:</b></h6>
                    <h6><b>Email:</b></h6>
                    <h6><b>Mentor:</b></h6>
                </div>
                <div class="col-sm-9">
                    <h6><?= $student['id'] ?></h6>
                    <h6><?= $student['program_name'] ?></h6>
                    <h6><?= $student['year'] ?></h6>
                    <h6><?= $student['phonenum'] ?></h6>
                    <h6><a href="mailto:<?= $student['email'] ?>"><?= $student['email'] ?></a></h6>
                    <h6><?= $student['mentor_name'] ?></h6>
                </div>
            </div>
            <hr>
            <?php if ($this->session->userdata('user_type') == 'mentor') : ?>
            <div class="row">
                <div class="col-sm-3">
                    <h6><b>Parent Contact 1</b></h6>
                    <h6><b>Parent Contact 2</b></h6>
                    <h6><b>Address</b></h6>
                </div>
                <div class="col-sm-9">
                    <h6><?= $student['parent_num1'] ?></h6>
                    <h6><?= $student['parent_num2'] ?></h6>
                    <h6><?= $student['address'] ?></h6>
                </div>
            </div>
            <?php endif ?>
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
    <div class="text-center">
        <h2>Previous Activity and Roles</h2>
        <br>

    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="text-secondary text-center"><b>Activity Level</b></h4>
            <br>
            <?php if ($activity_roles) : ?>
            <table id="acttable" class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>Year</th>
                        <th>Activity</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php foreach ($activity_roles as $actrole) : ?>
                    <?php $desc = (isset($actrole['description'])) ? sprintf(' (%s)', $actrole['description']) : '' ?>
                    <tr>
                        <td><?= $actrole['acadyear'] . ' Semester ' . $actrole['semester'] ?></td>
                        <td><?= $actrole['activity_name'] ?></td>
                        <td><?= $actrole['role'] . $desc ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php else : ?>
            <p class="text-center">No data found</p>
            <?php endif ?>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-body">
            <h4 class="text-secondary text-center"><b>Organization Level</b></h4>
            <br>
            <?php if ($org_roles) : ?>
            <table id="orgtable" class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>Academic Year</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody class="table-active">
                    <?php foreach ($org_roles as $orgrole) : ?>
                    <?php $desc = (isset($orgrole['description']) or $orgrole['description']) ? sprintf(' (%s)', $orgrole['description']) : '' ?>
                    <tr>
                        <td><?= $orgrole['acadyear'] ?></td>
                        <td><?= $orgrole['role'] . $desc ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php else : ?>
            <p class="text-center">No data found</p>
            <?php endif ?>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#acttable').DataTable();
    $('#orgtable').DataTable();
});
</script>